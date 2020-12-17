<?php

namespace App\Http\Controllers;

use App\Helpers\FileManagement;
use App\Models\Finance_coa;
use App\Models\Finance_coa_history;
use App\Models\Finance_treasure_sp;
use App\Models\Finance_treasury;
use App\Models\Finance_treasury_history;
use App\Models\Finance_treasury_insert;
use App\Models\Marketing_project;
use App\Models\Procurement_vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class FinanceTreasuryController extends Controller
{
    function index(){
        $treasure = Finance_treasury::where('company_id', Session::get('company_id'))->get();
        $his = Finance_treasury_history::all();
        $tre_his = Finance_treasury_insert::where('company_id', Session::get('company_id'))
            ->where('approved_at', null)
            ->get();

        $count = [];
        foreach ($tre_his as $tre_hi) {
            $count[$tre_hi->id_treasure][] = $tre_hi->id;
        }

        $cashIn = array();
        $cashOut = array();
        $cashSum = array();
        $project = Marketing_project::where('company_id', Session::get('company_id'))->get();
        foreach ($his as $value) {
            if ($value->IDR > 0) {
                $cashIn[$value->id_treasure][] = $value->IDR;
            } elseif ($value->IDR < 0) {
                $cashOut[$value->id_treasure][] = $value->IDR;
            }

            $cashSum[$value->id_treasure][] = $value->IDR;
        }

        return view('finance.treasury.index', [
            'treasuries' => $treasure,
            'cashIn' => $cashIn,
            'cashOut' => $cashOut,
            'cashSum' => $cashSum,
            'projects' => $project,
            'tre_his' => $count,
        ]);
    }

    function add(Request $request){

        $treasure = new Finance_treasury();

        $treasure->source = $request->bank_name;
        $treasure->type   = "bank";
        $treasure->branch = $request->branch_name;
        $treasure->account_name = $request->account_name;
        $treasure->account_number = $request->account_number;
        $treasure->currency = $request->currency;
        if (isset($request->coa)){
            $coa = explode(" ", $request->coa);
            $coa_code = str_replace(str_split('[]'), "", $coa[0]);
            $treasure->bank_code = $coa_code;
        }
        $treasure->company_id = Session::get('company_id');
        $treasure->created_by = Auth::user()->username;

        $treasure->save();
        return redirect()->route('treasury.index');
    }

    function del(Request $request){
        $id = explode("-", base64_decode($request->val));

        $tre_his = Finance_treasury::find(end($id));

        if ($tre_his->delete()) {
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    function deposit(Request $request) {
        $date = date('Y-m-d', strtotime($request->date_input));

        $tre_ins = new Finance_treasury_insert();
        $tre_ins->id_treasure = $request->source;
        $tre_ins->date_insert  = $date;
        $tre_ins->description = $request->description;
        $tre_ins->IDR         = $request->amount;
        $tre_ins->project     = $request->project;
        $tre_ins->created_by  = Auth::user()->username;
        $tre_ins->company_id  = Session::get('company_id');
        $tre_ins->save();

        return redirect()->route('treasury.index');
    }

    function view_treasure($code) {
        $id = (explode("-", base64_decode($code)));
        $tre_his = Finance_treasury_insert::where('id_treasure', end($id))
            ->where('approved_at', null)
            ->get();
        $tre = Finance_treasury::where('id', end($id))->first();

        return view('finance.treasury.view', [
            'treasure' => $tre,
            'tre_his' => $tre_his
        ]);
    }

    function approve(Request $request){
        $id = explode("-", base64_decode($request->val));

        $tre_in = Finance_treasury_insert::find(end($id));
        $tre_in->approved_at = date("Y-m-d H:i:s");
        $tre_in->approved_by = Auth::user()->username;
        $tre_in->updated_by = Auth::user()->username;

        // insert to history
        $iTre = Finance_treasury_insert::where('id', end($id))->first();
        $tre_his = new Finance_treasury_history();
        $tre_his->id_treasure = $iTre->id_treasure;
        $tre_his->date_input  = $iTre->date_insert;
        $tre_his->description = "[".$iTre->project."]".strip_tags($iTre->description);
        $tre_his->IDR         = $iTre->IDR;
        $tre_his->created_by  = Auth::user()->username;
        $tre_his->company_id  = Session::get('company_id');
        $tre_his->save();

        $his = Finance_treasury_insert::where('id', end($id))->first();

        $tre = Finance_treasury::find($his->id_treasure);
        $tre->IDR = $tre->IDR + $his->IDR;

        if ($tre_in->save() && $tre->save() && $tre_his->save()) {
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    function reject(Request $request){
        $id = explode("-", base64_decode($request->val));

        $tre_his = Finance_treasury_insert::find(end($id));

        if ($tre_his->delete()) {
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    function find(Request $request){
        $id = explode("-", base64_decode($request->val));
        $tre = Finance_treasury::where('id', end($id))->first();

        return json_encode($tre);
    }

    function edit(Request $request){

        $tre = Finance_treasury::find($request->id_tre);
        $tre->source = $request->bank_name;
        $tre->branch = $request->branch_name;
        $tre->account_name = $request->account_name;
        $tre->account_number = $request->account_number;
        if (isset($request->coa)){
            $coa = explode(" ", $request->coa);
            $coa_code = str_replace(str_split('[]'), "", $coa[0]);
            $tre->bank_code = $coa_code;
        }
        $tre->currency = $request->currency;
        $tre->save();

        return redirect()->route('treasury.index');
    }

    function history($x) {
        $id = (explode("-", base64_decode($x)));

        $startyear = date('Y', strtotime('-10 years'));
        for ($i = 0; $i < 20; $i++){
            $years[$i] = $startyear;
            $startyear++;
        }

        $tre = Finance_treasury::where('id', end($id))->first();
        $tre_his = Finance_treasury_history::where('id_treasure', $tre->id)
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'DESC')
            ->get();
        $balance = 0;
        foreach ($tre_his as $value){
            $balance += $value->IDR;
        }

        $sp = Finance_treasure_sp::where('company_id', Session::get('company_id'))->get();
        $spData = array();
        foreach ($sp as $item){
            $spData[$item->id] = $item;
        }

        $cashIn = array();
        $cashOut = array();
        $cashSum = array();


        foreach ($tre_his as $value) {
            if ($value->IDR > 0) {
                $cashIn[$value->id_treasure][] = $value->IDR;
            } elseif ($value->IDR < 0) {
                $cashOut[$value->id_treasure][] = $value->IDR;
            }

            $cashSum[$value->id_treasure][] = $value->IDR;
        }

        $vendor = Procurement_vendor::where('company_id', Session::get('company_id'))->get();

        return view('finance.treasury.history', [
            'treasury' => $tre,
            'tre_his' => $tre_his,
            'balance' => $balance,
            'cashIn' => $cashIn,
            'cashOut' => $cashOut,
            'cashSum' => $cashSum,
            'y' => $years,
            'vendors' => $vendor,
            'sp' => $spData
        ]);
    }

    function coa($id){
        $startyear = date('Y', strtotime('-10 years'));
        $years = [];
        for ($i = 0; $i < 20; $i++){
            $years[$i] = $startyear;
            $startyear++;
        }

        $tre = Finance_treasury::where('id', $id)->first();
        $tre_his = Finance_treasury_history::where('id_treasure', $tre->id)
            ->where('USD', 0)
            ->orderBy('date_input', 'desc')
            ->orderBy('id', 'DESC')
            ->get();
        $balance = 0;
        foreach ($tre_his as $value){
            $balance += $value->IDR;
        }

        $cashIn = array();
        $cashOut = array();
        $cashSum = array();

        $coa = Finance_coa_history::all();
        $coa_his = [];
        foreach ($coa as $item){
            $coa_his[$item->id_treasure_history]['coa'] = $item->id;
            $coa_his[$item->id_treasure_history]['file_hash'] = $item->file_hash;
        }

        foreach ($tre_his as $value) {
            if ($value->IDR > 0) {
                $cashIn[$value->id_treasure][] = $value->IDR;
            } elseif ($value->IDR < 0) {
                $cashOut[$value->id_treasure][] = $value->IDR;
            }

            $cashSum[$value->id_treasure][] = $value->IDR;
        }

//        $vendor = Procurement_vendor::where('company_id', Session::get('company_id'))->get();

        return view('finance.treasury.coa', [
            'treasury' => $tre,
            'tre_his' => $tre_his,
            'balance' => $balance,
            'cashIn' => $cashIn,
            'cashOut' => $cashOut,
            'cashSum' => $cashSum,
            'y' => $years,
            'coa_his' => $coa_his
        ]);
    }

    function setcoa(Request $request){
        $his = Finance_treasury_history::find($request->id_his);
        $debit = $request->debit;
        $de_amount = $request->de_amount;
        $credit = $request->credit;
        $cre_amount = $request->cre_amount;
        $upload = false;
        if (!empty($request->file('file_upload'))){
            $file = $request->file('file_upload');
            $filename = explode(".", $file->getClientOriginalName());
            array_pop($filename);
            $filename = str_replace(" ", "_", implode("_", $filename));

            $newFile = $filename."-".date('Y_m_d_H_i_s')."(".$request->id_leads.").".$file->getClientOriginalExtension();
            $hashFile = Hash::make($newFile);
            $hashFile = str_replace("/", "", $hashFile);
            $upload = FileManagement::save_file_management($hashFile, $file, $newFile, "media\lead");
        }

        foreach ($debit as $key => $value){
            if ($value != null){
                $coa = explode(" ", $value);
                $coa_code = str_replace(str_split('[]'), "", $coa[0]);
                $iCoa = new Finance_coa_history();
                $iCoa->no_coa = $coa_code;
                $iCoa->coa_date = $his->date_input;
                $iCoa->debit = $de_amount[$key];
                $iCoa->id_treasure_history = $request->id_his;
                $iCoa->created_by = Auth::user()->username;
                $iCoa->description = $his->descrption;
                if ($upload){
                    $iCoa->file_hash = $hashFile;
                }
                $iCoa->approved_at = date('Y-m-d H:i:s');
                $iCoa->approved_by = Auth::user()->username;
                $iCoa->company_id = Session::get('company_id');
                $iCoa->save();
            }
        }

        foreach ($credit as $key => $value){
            if ($value != null){
                $coa = explode(" ", $value);
                $coa_code = str_replace(str_split('[]'), "", $coa[0]);
                $iCoa = new Finance_coa_history();
                $iCoa->no_coa = $coa_code;
                $iCoa->coa_date = $his->date_input;
                $iCoa->credit = $cre_amount[$key];
                $iCoa->id_treasure_history = $request->id_his;
                $iCoa->created_by = Auth::user()->username;
                $iCoa->description = $his->descrption;
                if ($upload){
                    $iCoa->file_hash = $hashFile;
                }
                $iCoa->approved_at = date('Y-m-d H:i:s');
                $iCoa->approved_by = Auth::user()->username;
                $iCoa->company_id = Session::get('company_id');
                $iCoa->save();
            }
        }

        return redirect()->route('treasury.coa', $his->id_treasure);
    }

    function editcoa(Request $request){
//        dd($request);
        $his = Finance_treasury_history::find($request->id_his);
        $debit = $request->debit;
        $de_amount = $request->de_amount;
        $id_coa_debit = $request->id_coa_debit;
        $credit = $request->credit;
        $cre_amount = $request->cre_amount;
        $id_coa_credit = $request->id_coa_credit;
        $upload = false;
        if (!empty($request->file('file_upload'))){
            $file = $request->file('file_upload');
            $filename = explode(".", $file->getClientOriginalName());
            array_pop($filename);
            $filename = str_replace(" ", "_", implode("_", $filename));

            $newFile = $filename."-".date('Y_m_d_H_i_s')."(".$request->id_leads.").".$file->getClientOriginalExtension();
            $hashFile = Hash::make($newFile);
            $hashFile = str_replace("/", "", $hashFile);
            $upload = FileManagement::save_file_management($hashFile, $file, $newFile, "media\lead");
        }
        if ($request->id_del != null){
            $id_del = json_decode($request->id_del);

            foreach ($id_del as $value){
                Finance_coa_history::find($value)->delete();
            }
        }

        foreach ($debit as $key => $value){
            if ($value != null){
                $coa = explode(" ", $value);
                $coa_code = str_replace(str_split('[]'), "", $coa[0]);
                if ($id_coa_debit[$key] != null){
                    $iCoa = Finance_coa_history::find($id_coa_debit[$key]);
                    $iCoa->no_coa = $coa_code;
                    $iCoa->coa_date = $his->date_input;
                    if ($upload){
                        $iCoa->file_hash = $hashFile;
                    }
                    $iCoa->debit = $de_amount[$key];
                    $iCoa->updated_by = Auth::user()->username;
                    $iCoa->save();
                } else {
                    $iCoa = new Finance_coa_history();
                    $iCoa->no_coa = $coa_code;
                    $iCoa->coa_date = $his->date_input;
                    $iCoa->debit = $de_amount[$key];
                    $iCoa->id_treasure_history = $request->id_his;
                    $iCoa->created_by = Auth::user()->username;
                    $iCoa->description = $his->descrption;
                    if ($upload){
                        $iCoa->file_hash = $hashFile;
                    }
                    $iCoa->approved_at = date('Y-m-d H:i:s');
                    $iCoa->approved_by = Auth::user()->username;
                    $iCoa->company_id = Session::get('company_id');
                    $iCoa->save();
                }
            }
        }

        foreach ($credit as $key => $value){
            if ($value != null){
                $coa = explode(" ", $value);
                $coa_code = str_replace(str_split('[]'), "", $coa[0]);
                if ($id_coa_credit[$key] != null){
                    $iCoa = Finance_coa_history::find($id_coa_credit[$key]);
                    $iCoa->no_coa = $coa_code;
                    $iCoa->coa_date = $his->date_input;
                    $iCoa->credit = $cre_amount[$key];
                    if ($upload){
                        $iCoa->file_hash = $hashFile;
                    }
                    $iCoa->updated_by = Auth::user()->username;
                    $iCoa->save();
                } else {
                    $iCoa = new Finance_coa_history();
                    $iCoa->no_coa = $coa_code;
                    $iCoa->coa_date = $his->date_input;
                    $iCoa->credit = $cre_amount[$key];
                    if ($upload){
                        $iCoa->file_hash = $hashFile;
                    }
                    $iCoa->id_treasure_history = $request->id_his;
                    $iCoa->created_by = Auth::user()->username;
                    $iCoa->company_id = Session::get('company_id');
                    $iCoa->save();
                }
            }
        }

        return redirect()->route('treasury.coa', $his->id_treasure);
    }

    function viewcoa($id){
        $tre_his = Finance_treasury_history::find($id);
        $tre = Finance_treasury::find($tre_his->id_treasure);
        $val = [];
        $coa = Finance_coa::select('id','code','name')
            ->whereNull('deleted_at')->get();
        foreach ($coa as $value){
            $val[$value->code] = "[".$value->code."] ".$value->name;
        }

        $coa_his = Finance_coa_history::where('id_treasure_history', $id)->get();
        $coa_data = [];
        $debet = [];
        $credit = [];
        foreach ($coa_his as $item){
            if ($item->debit > 0){
                $coa_data['id'] = $item->id;
                $coa_data['code'] = $item->no_coa;
                $coa_data['amount'] = $item->debit;
                $debet[] = $coa_data;
            } elseif ($item->credit > 0){
                $coa_data['id'] = $item->id;
                $coa_data['code'] = $item->no_coa;
                $coa_data['amount'] = $item->credit;
                $credit[] = $coa_data;
            }
        }

        $coa = array(
            'debit' => $debet,
            'credit' => $credit
        );


        return view('finance.treasury.view_coa', [
            'tre_his' => $tre_his,
            'treasury' => $tre,
            'coa' => $val,
            'coa_his' => $coa_his,
            'data_coa' => $coa
        ]);
    }

    function findsp(Request $request){
        $sp = Finance_treasure_sp::whereRaw("'".$request->date."' BETWEEN date1 AND date2")
//            ->where('date2', '<=', $request->date)
            ->where('bank', $request->treasure)
            ->get();

//        dd($sp->toSql());

        if (count($sp) == 0){
            $data['sp'] = null;
        } else {
            $data['sp'] = $sp;
        }

        return json_encode($data);
    }

    function addsp(Request $request){
        $sp = Finance_treasure_sp::where('year', date('Y', strtotime($request->date)))
            ->where('bank', $request->treasure)
            ->orderBy('id')
            ->first();

        $his = $request->sp;
        $saldo = 0;
        $his_date = $request->spdate;
        sort($his_date);
        if (empty($sp)){
            $num = 1;
        } else {
            $paper = explode("/",$sp->num);
            $num = intval($paper[0]) + 1;
        }

        $newSp = new Finance_treasure_sp();

        $newSp->num = sprintf("%03d", $num)."/".Session::get('company_tag')."/SP/".$request->treasure."/".date('Y', strtotime($request->date));
        $newSp->year = date('Y', strtotime($request->date));
        $newSp->bank = $request->treasure;
        $newSp->date1 = $his_date[0];
        $newSp->date2 = end($his_date);
        $newSp->company_id = Session::get('company_id');
        if ($newSp->save()){
            foreach ($his as $item){
                $tre_his = Finance_treasury_history::find($item);
                $tre_his->sp_date = $newSp->id;
                $tre_his->save();
            }
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    function viewsp($id){
        $sp = Finance_treasure_sp::find($id);
        $treasury = Finance_treasury::find($sp->bank);
        $his = Finance_treasury_history::where('sp_date', $id)->get();

        return view('finance.treasury.viewsp', [
            'sp' => $sp,
            'treasury' => $treasury,
            'his' => $his
        ]);
    }

    function apprsp(Request $request){
        $sp = Finance_treasure_sp::find($request->id);

        $sp->approved_by = Auth::user()->username;
        $sp->approved_date = date('Y-m-d');

        if ($sp->save()){
            Finance_treasury_history::where('sp_date', $request->id)
                ->update([
                    'sp_app' => 1
                ]);

            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    function printsp($id){
        $sp = Finance_treasure_sp::find($id);
        $treasury = Finance_treasury::find($sp->bank);
        $his = Finance_treasury_history::where('sp_date', $id)->get();
        return view('finance.treasury.printsp', [
            'sp' => $sp,
            'treasury' => $treasury,
            'his' => $his
        ]);
    }
}
