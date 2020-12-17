<?php

namespace App\Http\Controllers;

use App\Models\Asset_new_category;
use App\Models\Asset_type_wo;
use App\Models\Finance_treasury;
use App\Models\Finance_treasury_history;
use App\Models\Marketing_project;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\General_reimburse;
use App\Models\General_reimburse_detail;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;

class GeneralReimburse extends Controller
{
    public function index(){
        $reimburselists = DB::table('general_reimburse')
            ->join('marketing_projects as project','project.id','=','general_reimburse.project')
            ->select('general_reimburse.*','project.prj_name as prj_name')
            ->whereNull('general_reimburse.done')
            ->where('general_reimburse.company_id',\Session::get('company_id'))
            ->where('general_reimburse.created_by',Auth::user()->username)
            ->get();

        $reimbursebanks = DB::table('general_reimburse')
            ->join('marketing_projects as project','project.id','=','general_reimburse.project')
            ->select('general_reimburse.*','project.prj_name as prj_name')
            ->whereNotNull('general_reimburse.done')
            ->where('general_reimburse.company_id',\Session::get('company_id'))
            ->where('general_reimburse.created_by',Auth::user()->username)
            ->get();

        $listperson = User::where('company_id',\Session::get('company_id'))
            ->whereNotIn('password',['xxx','out'])
            ->orderBy('username','ASC')
            ->get();

        $projects = Marketing_project::where('company_id',\Session::get('company_id'))
            ->orderBy('prj_name','ASC')
            ->get();

        $sumcashout =[];
        $sumcashin = [];
        foreach ($reimburselists as $key => $reimburseList1){
            $sumcashin[$reimburseList1->id][] = DB::table('general_reimburse_detail')->where('id_reimburse', '=', $reimburseList1->id)->sum('cashin');
            $sumcashout[$reimburseList1->id][] = DB::table('general_reimburse_detail')->where('id_reimburse', '=', $reimburseList1->id)->sum('cashout');
        }
        foreach ($reimbursebanks as $key => $reimburseList1){
            $sumcashin[$reimburseList1->id][] = DB::table('general_reimburse_detail')->where('id_reimburse', '=', $reimburseList1->id)->sum('cashin');
            $sumcashout[$reimburseList1->id][] = DB::table('general_reimburse_detail')->where('id_reimburse', '=', $reimburseList1->id)->sum('cashout');
        }

        return view('reimburse.index',[
            'listpersons' => $listperson,
            'projects' => $projects,
            'reimburselists' => $reimburselists,
            'reimbursebanks' =>$reimbursebanks,
            'cashin' => $sumcashin,
            'cashout' => $sumcashout
        ]);
    }

    public function addReimburse(Request $request){
        if (isset($request['edit'])){
            General_reimburse::where('id',$request['id'])
                ->update([
                    'subject' => $request['subject'],
                    'currency' => $request['currency'],
                    'project' => $request['project'],
                    'division' => $request['division'],
                    'user' => $request['for_personel'],
                ]);
        }
        if (isset($request['add'])){
            $reimburse = new General_reimburse();
            $reimburse->subject = $request['subject'];
            $reimburse->input_date = date('Y-m-d');
            $reimburse->currency = $request['currency'];
            $reimburse->division = $request['division'];
            $reimburse->user = $request['for_personel'];
            $reimburse->project = $request['project'];

            $reimburse->created_by = Auth::user()->username;
            $reimburse->company_id = \Session::get('company_id');
            $reimburse->save();
        }


        return redirect()->route('reimburse.index');
    }

    public function getDetail($id){
        $reimburse = General_reimburse::where('general_reimburse.id',$id)
            ->where('company_id',\Session::get('company_id'))
            ->first();

        $detailOut = General_reimburse_detail::where('id_reimburse',$id)
            ->whereNotNull('category')
            ->where('cashout','>',0)
            ->orderBy('id', 'DESC')
            ->get();
        $numRowsOut = $detailOut->count();
        $typewo = Asset_type_wo::orderBy('name', 'ASC')->get();
        $category = Asset_new_category::all();

        return view('reimburse.detail',[
            'detail' => $reimburse,
            'detailOut' => $detailOut,
            'numRowsOut' => $numRowsOut,
            'typewo' => $typewo,
            'categories' => $category,
        ]);
    }

    public function addCashOut(Request $request){
        $arr_str = array("'", "`");
        $deskripsi = str_replace($arr_str, "", $request['deskripsi']);
        if (isset($request['id_edit'])){
            General_reimburse_detail::where('id', $request['id_edit'])
                ->update([
                    'source_string' => $request['source'],
                    'tanggal' => date("Y-m-d", strtotime($request['req_date'])),
                    'no_nota' => $request['subject'],
                    'deskripsi' => $deskripsi,
                    'cashout' =>$request['amount'],
                    'updated_by' => Auth::user()->username,
                ]);
        } else {

            $r_date = date("Y-m-d", strtotime($request['req_date']));
            $currency = $request['curr'];
            $id_imburse = $request['id'];
            $cashin = 0; $cashout = 0;
            $bank_name = $request['source'];

            if($request['cashtype'] == 'cashout'){ $cashout += $request['amount']; } else { $cashin += $request['amount']; }
            if (isset($request['source'])){
                General_reimburse::where('id', $id_imburse)
                    ->update([
                        'input_date' => $r_date,
                    ]);
            }
            $cashOut = new General_reimburse_detail();
            $cashOut->id_reimburse = $id_imburse;
            $cashOut->tanggal = $r_date;
            $cashOut->source_string = $bank_name;
            $cashOut->no_nota = $request['subject'];
            $cashOut->deskripsi = $deskripsi;
            $cashOut->source_int = 0;
            $cashOut->created_by = Auth::user()->username;
            $cashOut->cashin = $cashin;
            $cashOut->cashout = $cashout;
            $cashOut->category = $request['category'];
            $cashOut->save();
        }

        return redirect()->route('reimburse.detail',['id' => $request['id']]);
    }

    public function deleteDetail($id,$id_cb){
        General_reimburse_detail::where('id', $id)->delete();
        return redirect()->route('reimburse.detail',['id' => $id_cb]);
    }

    public function delete($id){
        General_reimburse::where('id',$id)->delete();
        General_reimburse_detail::where('id_reimburse', $id)->delete();
        return redirect()->route('reimburse.index');

    }

    public function getDetRA($id,$who=null){
        $cb = General_reimburse::where('id',$id)
            ->where('company_id',\Session::get('company_id'))
            ->first();
        $sources = Finance_treasury::where('source','not like','%BR %')
            ->get();
        $reimburse_detail = General_reimburse_detail::where('id_reimburse', $id)
            ->where('cashin','>',0)
            ->get();
        $reimburse_detailOut = General_reimburse_detail::where('id_reimburse', $id)
            ->where('cashout','>',0)
            ->get();

        return view('reimburse.reimburse_print',[
            'reimburse' => $cb,
            'sources' => $sources,
            'reimburse_detail' => $reimburse_detail,
            'reimburse_detailOut' => $reimburse_detailOut,
            'who' => base64_decode($who)
        ]);
    }

    public function RAppr(Request $request){
        $m_sum = $request['cashinPost'];
        $datenow = date("Y-m-d");
        $bank_id = $request['bank_sel'];
//        dd($bank_id);
        $br_id = $request['id'];
        $name = Auth::user()->username;
        $text2 = "Cashbond: ".$request['subject'].". (ID: $br_id)";


        if ($request['who'] == 'manager'){
            if (isset($request['approved'])){
                General_reimburse::where('id',$br_id)
                    ->update([
                        'm_approve' => $name,
                        'm_approve_time' => date('Y-m-d H:i:s'),
                        'sisa' => $request['sum'],
                    ]);
            }
        }
        if ($request['who'] == 'finance'){
            $m_sum = $_POST['sum'];
//            $m_sum_min = $m_sum * -1;
            $treasuryHistory = new Finance_treasury_history();
            $treasuryHistory->id_treasure = $bank_id;
            $treasuryHistory->date_input = $datenow;
            $treasuryHistory->description = $text2;
            $treasuryHistory->IDR = $m_sum;
            $treasuryHistory->USD = 0.00;
            $treasuryHistory->PIC = $name;
            $treasuryHistory->created_by= $name;
            $treasuryHistory->company_id = \Session::get('company_id');
            $treasuryHistory->save();
            if (isset($request['approved'])){
                General_reimburse::where('id',$br_id)
                    ->update([
                        'approved_by' => $name,
                        'approved_time' => date('Y-m-d H:i:s'),
                        'sisa' => 0,
                    ]);
            }
        }
        if ($request['who'] == 'user'){
            General_reimburse::where('id',$br_id)
                ->update([
                    'done' => date('Y-m-d'),
                ]);
        }


        return redirect()->route('reimburse.index');
    }
}
