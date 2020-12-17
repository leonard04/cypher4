<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityConfig;
use App\Models\Asset_item;
use App\Models\Asset_new_category;
use App\Models\Asset_type_wo;
use App\Models\Finance_treasury;
use App\Models\Finance_treasury_history;
use App\Models\Marketing_project;
use Illuminate\Http\Request;
use App\Models\General_cashbond;
use App\Models\General_cashbond_detail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;

class GeneralCashbond extends Controller
{
    public function index(){
        $outstandingBnk = DB::table('general_cashbond')
            ->join('general_cashbond_detail as detail','detail.id_cashbond','=','general_cashbond.id')
            ->select('general_cashbond.*','general_cashbond_detail.*')
            ->whereNotNull('general_cashbond.done')
            ->where('general_cashbond.company_id',\Session::get('company_id'))
            ->where('general_cashbond.created_by',Auth::user()->username)
            ->sum('detail.cashout');

        $outstanding = DB::table('general_cashbond')
            ->join('general_cashbond_detail as detail','detail.id_cashbond','=','general_cashbond.id')
            ->select('general_cashbond.*','general_cashbond_detail.*')
            ->whereNull('general_cashbond.done')
            ->where('general_cashbond.company_id',\Session::get('company_id'))
            ->where('general_cashbond.created_by',Auth::user()->username)
            ->sum('detail.cashin');

        $cashbondlists = DB::table('general_cashbond')
            ->join('marketing_projects as project','project.id','=','general_cashbond.project')
            ->select('general_cashbond.*','project.prj_name as prj_name')
            ->whereNull('general_cashbond.done')
            ->where('general_cashbond.company_id',\Session::get('company_id'))
            ->where('general_cashbond.created_by',Auth::user()->username)
            ->get();

        $cashbondbanks = DB::table('general_cashbond')
            ->join('marketing_projects as project','project.id','=','general_cashbond.project')
            ->select('general_cashbond.*','project.prj_name as prj_name')
            ->whereNotNull('general_cashbond.done')
            ->where('general_cashbond.company_id',\Session::get('company_id'))
            ->where('general_cashbond.created_by',Auth::user()->username)
            ->get();

        $listperson = User::where('company_id',\Session::get('company_id'))
            ->whereNotIn('password',['xxx','out'])
            ->orderBy('username','ASC')
            ->get();

        $projects = Marketing_project::where('company_id',\Session::get('company_id'))
            ->orderBy('prj_name','ASC')
            ->get();
        $category = DB::table('asset_items')
            ->join('new_category as category', 'category.id','=','asset_items.category_id')
            ->select('asset_items.*', 'category.name as categoryName')
            ->where('category.name','like','%Transportation%')
            ->orWhere('category.name','like','%Vehicle%')
            ->orWhere('category.name','like','%car%')
            ->get();
        $sumcashout =[];
        $sumcashin = [];
        foreach ($cashbondlists as $key => $cashbondList1){
            $sumcashin[$cashbondList1->id][] = DB::table('general_cashbond_detail')->where('id_cashbond', '=', $cashbondList1->id)->sum('cashin');
            $sumcashout[$cashbondList1->id][] = DB::table('general_cashbond_detail')->where('id_cashbond', '=', $cashbondList1->id)->sum('cashout');
        }
        foreach ($cashbondbanks as $key => $cashbondList1){
            $sumcashin[$cashbondList1->id][] = DB::table('general_cashbond_detail')->where('id_cashbond', '=', $cashbondList1->id)->sum('cashin');
            $sumcashout[$cashbondList1->id][] = DB::table('general_cashbond_detail')->where('id_cashbond', '=', $cashbondList1->id)->sum('cashout');
        }

        return view('cashbond.index',[
            'listpersons' => $listperson,
            'projects' => $projects,
            'cashbondlists' => $cashbondlists,
            'cashbondbanks' =>$cashbondbanks,
            'cashin' => $sumcashin,
            'cashout' => $sumcashout,
            'category' => $category,
            'outstandingBnk' => $outstandingBnk,
            'outstanding' =>$outstanding,
        ]);
    }

    public function addCashbond(Request $request){
        ActivityConfig::store_point('cashbond', 'create');
        $cashbond = new General_cashbond();
        $cashbond->subject = $request['subject'];
        $cashbond->input_date = date('Y-m-d');
        $cashbond->currency = $request['currency'];
        $cashbond->division = $request['division'];
        $cashbond->user = $request['for_personel'];
        $cashbond->project = $request['project'];
        $cashbond->vehicle = $request['vehicle'];
        $cashbond->man_fin_cashout_date = date('Y-m-d', strtotime($request['due_date']));
        if (isset($request['is_private'])){
            $cashbond->is_private = $request['is_private'];
        } else {
            $cashbond->is_private = 0;
        }
        $cashbond->created_by = Auth::user()->username;
        $cashbond->company_id = \Session::get('company_id');
        $cashbond->save();

        return redirect()->route('cashbond.index');
    }

    public function getDetail($id){
        $cashbond = General_cashbond::where('general_cashbond.id',$id)
            ->where('company_id',\Session::get('company_id'))
            ->first();
        $detailIn = General_cashbond_detail::where('id_cashbond',$id)
            ->where('cashin','>',0)
            ->orderBy('id', 'DESC')
            ->get();
        $numRowsIn = $detailIn->count();
        $detailOut = General_cashbond_detail::where('id_cashbond',$id)
            ->whereNotNull('category')
            ->where('cashout','>',0)
            ->orderBy('id', 'DESC')
            ->get();
        $numRowsOut = $detailOut->count();
        $typewo = Asset_type_wo::orderBy('name', 'ASC')->get();
        $category = Asset_new_category::all();

        return view('cashbond.detail',[
            'detail' => $cashbond,
            'detailIn' => $detailIn,
            'detailOut' => $detailOut,
            'numRowsIn' => $numRowsIn,
            'numRowsOut' => $numRowsOut,
            'typewo' => $typewo,
            'categories' => $category,
        ]);
    }

    public function addCashIn(Request $request){
        $arr_str = array("'", "`");
        $deskripsi = str_replace($arr_str, "", $request['deskripsi']);
        if (isset($request['id_edit'])){
            General_cashbond_detail::where('id', $request['id_edit'])
                ->update([
                    'source_string' => $request['source'],
                    'tanggal' => date("Y-m-d", strtotime($request['req_date'])),
                    'no_nota' => $request['subject'],
                    'deskripsi' => $deskripsi,
                    'cashin' =>$request['amount'],
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
                General_cashbond::where('id', $id_imburse)
                    ->update([
                        'input_date' => $r_date,
                    ]);
            }
            $cashIn = new General_cashbond_detail();
            $cashIn->id_cashbond = $id_imburse;
            $cashIn->tanggal = $r_date;
            $cashIn->source_string = $bank_name;
            $cashIn->no_nota = $request['subject'];
            $cashIn->deskripsi = $deskripsi;
            $cashIn->source_int = 0;
            $cashIn->created_by = Auth::user()->username;
            $cashIn->cashin = $cashin;
            $cashIn->cashout = $cashout;
            $cashIn->save();
        }

        return redirect()->route('cashbond.detail',['id' => $request['id']]);
    }

    public function addCashOut(Request $request){
        $arr_str = array("'", "`");
        $deskripsi = str_replace($arr_str, "", $request['deskripsi']);
        if (isset($request['id_edit'])){
            General_cashbond_detail::where('id', $request['id_edit'])
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
                General_cashbond::where('id', $id_imburse)
                    ->update([
                        'input_date' => $r_date,
                    ]);
            }
            $cashOut = new General_cashbond_detail();
            $cashOut->id_cashbond = $id_imburse;
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

        return redirect()->route('cashbond.detail',['id' => $request['id']]);
    }

    public function deleteDetail($id,$id_cb){
        General_cashbond_detail::where('id', $id)->delete();
        return redirect()->route('cashbond.detail',['id' => $id_cb]);
    }

    public function delete($id){
        General_cashbond::where('id',$id)->delete();
        General_cashbond_detail::where('id_cashbond', $id)->delete();
        return redirect()->route('cashbond.index');

    }
    public function getDetRA($id,$who=null){
        $cb = General_cashbond::where('id',$id)
            ->where('company_id',\Session::get('company_id'))
            ->first();
        $sources = Finance_treasury::where('source','not like','%BR %')
            ->get();
        $cashbond_detail = General_cashbond_detail::where('id_cashbond', $id)
            ->where('cashin','>',0)
            ->get();
        $cashbond_detailOut = General_cashbond_detail::where('id_cashbond', $id)
            ->where('cashout','>',0)
            ->get();

        return view('cashbond.cashbond_print',[
            'cashbond' => $cb,
            'sources' => $sources,
            'cashbond_detail' => $cashbond_detail,
            'cashbond_detailOut' => $cashbond_detailOut,
            'who' => base64_decode($who)
        ]);
    }

    public function RAppr(Request $request){
        $m_sum = $request['cashinPost'];
        $datenow = date("Y-m-d");
        $bank_id = $request['bank_sel'];
        $br_id = $request['id'];
        $name = Auth::user()->username;
        $text2min = "Cashbond [out]: ".$request['subject'].". (ID: $br_id)";
        $text2plus = "Cashbond [in]: ".$request['subject'].". (ID: $br_id)";
        if ($request['who'] == 'cashin'){
            $m_sum_min = $m_sum * -1;

            $treasuryHistory = new Finance_treasury_history();
            $treasuryHistory->id_treasure = $bank_id;
            $treasuryHistory->date_input = $datenow;
            $treasuryHistory->description = $text2min;
            $treasuryHistory->IDR = $m_sum_min;
            $treasuryHistory->USD = 0.00;
            $treasuryHistory->PIC = $name;
            $treasuryHistory->created_by= $name;
            $treasuryHistory->company_id = \Session::get('company_id');
            $treasuryHistory->save();

            if (isset($request['approved'])){
                ActivityConfig::store_point('cashbond', 'approve');
                General_cashbond::where('id',$br_id)
                    ->update([
                        'approved_by' => $name,
                        'approved_time' => date('Y-m-d H:i:s'),
                        'man_fin_cashout_date' => $request['due_date'],
                    ]);
            }
        }
        if ($request['who'] == 'director'){
            $treasuryHistory = new Finance_treasury_history();
            $treasuryHistory->id_treasure = $bank_id;
            $treasuryHistory->date_input = $datenow;
            $treasuryHistory->description = $text2plus;
            $treasuryHistory->IDR = intval($m_sum) - intval($request['sum2']);
            $treasuryHistory->USD = 0.00;
            $treasuryHistory->PIC = $name;
            $treasuryHistory->created_by= $name;
            $treasuryHistory->company_id = \Session::get('company_id');
            $treasuryHistory->save();

            ActivityConfig::store_point('cashbond', 'approve_dir');
            General_cashbond::where('id',$br_id)
                ->update([
                    'dir_appr' => $name,
                    'dir_appr_date' => date('Y-m-d H:i:s'),
                ]);
        }
        if ($request['who'] == 'manager'){
            ActivityConfig::store_point('cashbond', 'approve_div');

            General_cashbond::where('id',$br_id)
                ->update([
                    'm_approve' => $name,
                    'm_approve_time' => date('Y-m-d H:i:s'),
                    'sisa' => $request['sum'],
                    'done' => date('Y-m-d H:i:s'),
                ]);
        }

        return redirect()->route('cashbond.index');
    }
}
