<?php

namespace App\Http\Controllers;

use App\Models\Finance_treasury;
use App\Models\Finance_treasury_history;
use App\Models\Marketing_project;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Marketing_bp;
use App\Models\Marketing_bp_detail;
use Illuminate\Support\Facades\Auth;

class MarketingBpController extends Controller
{
    public function index(){
        $count_ongoing = 0;
        $count_publish = 0;
        $sum_ongoing = 0;
        $sum_publish = 0;

        $bpongoing = Marketing_bp::where('status','not like','Done')
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($bpongoing as $key => $value){
            $count_ongoing +=1;
            $sum_ongoing += intval($value->nilai_jaminan);
        }

        $bppublish = Marketing_bp::where('status','like','Done')
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($bppublish as $key => $value){
            $count_publish += 1;
            $sum_publish += intval($value->nilai_jaminan);
        }
        $projects = Marketing_project::where('company_id', \Session::get('company_id'))
            ->get();
        return view('bp.index',[
            'bppublish'=>$bppublish,
            'bpongoing' =>$bpongoing,
            'count_ongoing' => $count_ongoing,
            'count_publish' => $count_publish,
            'sum_ongoing' => $sum_ongoing,
            'sum_publish' =>$sum_publish,
            'projects'=> $projects,
        ]);
    }

    public function addBP(Request $request){
        $prj = Marketing_project::where('id', $request['project'])->first();
        $date = date('Y-m-d');
        $bp = new Marketing_bp();
        $bp->prj_code = $request['project'];
        $bp->perusahaan = $request['company_name'];
        $bp->no_tender = $request['tender_number'];
        $bp->no_bond = $request['bond_number'];
        $bp->type_bond = $request['bond_type'];
        $bp->submit_date = $date;
        $bp->input_date = $date;
        $bp->currency = $request['currency'];
        $bp->status = 'Marketing Done';
        $bp->nilai_jaminan = $request['amount'];
        $bp->prj_name = $prj->prj_name;
        $bp->nama_prj = $request['purpose_work'];
        $bp->date1 = $request['date1'];
        $bp->durasi = $request['duration'];
        $sentence = $request['date1']." +".$request['duration']." day";
        $bp->date2 = date("Y-m-d",strtotime($sentence));
        $bp->alasan_approve_operation = '';
        $bp->alasan_reject_operation = '';
        $bp->alasan_approve_finance = '';
        $bp->alasan_reject_finance = '';
        $bp->save();
        $lastid = $bp->id;

        $details = [
            ['id'=> null,'id_main' => $lastid,'prj_code'=>$request['project'],'currency' =>'','item_name' => 'AMOUNT', 'request_amount' => null, 'actual_amount' => 0.0],
            ['id'=> null,'id_main' => $lastid,'prj_code'=>$request['project'],'currency' => '','item_name' => 'ADMINISTRATION', 'request_amount' => null, 'actual_amount' => 0.0],
        ];
        foreach ($details as $detail){
            Marketing_bp_detail::create($detail);
        }

        return redirect()->route('bp.index');

    }

    public function getFinDiv($id){
        $price = Marketing_bp::where('id', $id)->get();
        $detail = Marketing_bp_detail::where('id_main',$id)->get();

        return view('bp.fin_appr',[
            'price' => $price,
            'detail' => $detail,
        ]);
    }

    public function finDivAppr(Request $request){
        $detail_id = $request['detail_id'];
        $Main_id = $request['main_id'];


        Marketing_bp_detail::where('id_detail', $request['detail_id_AMOUNT'])
            ->where('id_main', $Main_id)
            ->where('item_name', 'AMOUNT')
            ->update([
                'currency' => $request['adm_currency_AMOUNT']
            ]);

        Marketing_bp_detail::where('id_detail', $request['detail_id_ADMINISTRATION'])
            ->where('id_main', $Main_id)
            ->where('item_name', 'ADMINISTRATION')
            ->update([
                'currency' => $request['adm_currency_ADMINISTRATION']
            ]);

        Marketing_bp_detail::where('id_main', $Main_id)
            ->where('item_name','AMOUNT')
            ->update([
                'request_amount' => $request['AMOUNT']
            ]);

        Marketing_bp_detail::where('id_main', $Main_id)
            ->where('item_name','ADMINISTRATION')
            ->update([
                'request_amount' => $request['ADMINISTRATION']
            ]);

        Marketing_bp::where('id',$Main_id)
            ->update([
                'price_date' =>date("Y-m-d"),
                'status' =>'Waiting Approval',
            ]);

        return redirect()->route('bp.index');
    }
    public function getDirAppr($id,$code){
        $key = base64_decode($code);
        $sources = Finance_treasury::where('source','not like','%BR %')->get();
        $price = Marketing_bp::where('id', $id)->get();
        $detail = Marketing_bp_detail::where('id_main',$id)->get();

        return view('bp.dir_appr',[
            'price' => $price,
            'detail' => $detail,
            'code' => $key,
            'sources' =>$sources,
        ]);
    }

    public function submitAppr(Request $request){

        if (isset($request['submit'])){
            if ($request['code']=='detail'){
                Marketing_bp::where('id',$request['main_id'])
                    ->update([
                        'release_date' =>date("Y-m-d"),
                        'status'=> 'Released',
                        'alasan_approve_finance' => '',
                    ]);
                Marketing_bp_detail::where('id_main', $request['main_id'])
                    ->where('item_name','AMOUNT')
                    ->update([
                        'request_amount' => $request['price_AMOUNT']
                    ]);
                Marketing_bp_detail::where('id_main', $request['main_id'])
                    ->where('item_name','ADMINISTRATION')
                    ->update([
                        'request_amount' => $request['price_ADMINISTRATION']
                    ]);
                $treasure_history = [
                    ['id_treasure' => $request['AMOUNT'],'date_input' =>date("Y-m-d"),'description' => $request['jobdesc_AMOUNT'],'IDR' => intval($request['price_AMOUNT']) * (-1),'PIC' => Auth::user()->username],
                    ['id_treasure' => $request['ADMINISTRATION'],'date_input' =>date("Y-m-d"),'description' => $request['jobdesc_ADMINISTRATION'],'IDR' => intval($request['price_ADMINISTRATION']) * (-1),'PIC' => Auth::user()->username]
                ];

                foreach ($treasure_history as $value){
                    Finance_treasury_history::create($value);
                }

            } else {
                Marketing_bp::where('id',$request['main_id'])
                    ->update([
                        'final_date' => date("Y-m-d"),
                        'status'=> 'Done',
                    ]);
                Marketing_bp_detail::where('id_main', $request['main_id'])
                    ->where('item_name','AMOUNT')
                    ->update([
                        'request_amount' => $request['price_AMOUNT']
                    ]);
                Marketing_bp_detail::where('id_main', $request['main_id'])
                    ->where('item_name','ADMINISTRATION')
                    ->update([
                        'request_amount' => $request['price_ADMINISTRATION']
                    ]);

                $treasure_history = [
                    ['id_treasure' => $request['AMOUNT'],'date_input' =>date("Y-m-d"),'description' => $request['jobdesc_AMOUNT'],'IDR' => $request['price_AMOUNT'],'PIC' => Auth::user()->username],
                ];

                foreach ($treasure_history as $value){
                    Finance_treasury_history::create($value);
                }
            }

        }
        if (isset($request['reject'])){
            Marketing_bp::where('id',$request['main_id'])
                ->update([
                    'release_date' =>date("Y-m-d"),
                    'status'=> 'Reject',
                    'alasan_reject_finance' => '',
                ]);
        }

        return redirect()->route('bp.index');
    }

    public function bondR(Request $request){
        if ($request['type'] == 'Retrive'){
            Marketing_bp::where('id', $request['id'])
                ->update([
                   'status' => 'Retrieved',
                   'retrieve_by' => Auth::user()->username,
                   'retrieve_date' => date('Y-m-d'),
                    'retrieve_to' => $request['retrieve_to'],
                ]);
        } else {
            Marketing_bp::where('id', $request['id'])
                ->update([
                    'status' => 'Received',
                    'receive_by' => Auth::user()->username,
                    'receive_date' => date('Y-m-d'),
                    'receive_to' => $request['receive_to'],
                ]);
        }
        return redirect()->route('bp.index');
    }
}
