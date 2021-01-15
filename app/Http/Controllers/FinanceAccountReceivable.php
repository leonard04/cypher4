<?php

namespace App\Http\Controllers;

use App\Models\Finance_invoice_out;
use App\Models\Finance_invoice_out_detail;
use App\Models\Finance_invoice_out_print;
use App\Models\Finance_treasury;
use App\Models\Finance_treasury_history;
use App\Models\Marketing_clients;
use App\Models\Marketing_leads;
use App\Models\Marketing_project;
use App\Models\Pref_tax_config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class FinanceAccountReceivable extends Controller
{
    function index(){
        $inv_out = Finance_invoice_out::where('company_id', Session::get('company_id'))->get();
        $inv_detail = Finance_invoice_out_detail::all();
        $i_activity = [];
        $i_date = [];
        $i_value_d = [];
        $i_approved = [];
        foreach ($inv_detail as $item){
            $i_activity[$item->id_inv][] = $item->activity;
            $i_date[$item->id_inv][] = $item->date;
            $i_value_d[$item->id_inv][] = $item->value_d;
            if ($item->status == "approved"){
                $i_approved[$item->id_inv][] = $item->value_d;
            }
        }

        $project = Marketing_project::where('company_id', Session::get('company_id'))->get();
        $leads = Marketing_leads::where('company_id', Session::get('company_id'))->get();

        $prj_name = [];
        $leads_name = [];
        foreach ($project as $item){
            $prj_name[$item->id] = $item->prj_name;
        }

        foreach ($leads as $item){
            $leads_name[$item->id] = $item->leads_name;
        }

        $clients = Marketing_clients::where('company_id', Session::get('company_id'))->get();
        $client_name = [];
        foreach ($clients as $item){
            $client_name[$item->id] = $item->company_name;
        }

        return view('finance.account_receivable.index', [
            'clients' => $clients,
            'invs' => $inv_out,
            'prj_name' => $prj_name,
            'leads_name' => $leads_name,
            'i_date' => $i_date,
            'i_value_d' => $i_value_d,
            'i_activity' => $i_activity,
            'i_approved' => $i_approved
        ]);
    }

    function getProjectLeads($id){
        $project = Marketing_project::where('id_client', $id)->get();
        $leads = Marketing_leads::where('id_client', $id)->get();
        $data = [];
        $val = [];
        foreach ($project as $item){
            $data['id'] = $item->id."-project";
            $data['text'] = $item->prj_name."-[project]";
            $val[] = (object) $data;
        }

        foreach ($leads as $item){
            $data['id'] = $item->id."-leads";
            $data['text'] = $item->leads_name."-[leads]";
            $val[] = (object) $data;
        }

        usort($val, function ($a, $b) {
            return strcmp($a->text, $b->text);
        });

        $response = [
            'results' => $val,
            'pagination' => ["more" => true]
        ];

        return json_encode($response);
    }

    function check_inv($id){
        $x = explode("-", $id);
        $data['id'] = $x[0];
        $data['type'] = $x[1];
        $title = json_encode($data);
//        dd($title);

        $inv_out = Finance_invoice_out::where('title', 'like', "%".$title."%")->get();
//        dd(count($inv_out));

        return count($inv_out);
    }

    function add(Request $request){
        $pl = explode("-", $request->project_leads);
        $data['id'] = $pl[0];
        $data['type'] = $pl[1];
        $data['tag'] = strtoupper($request->inv_code);

        $inv_out = new Finance_invoice_out();
        $inv_out->title = json_encode($data);
        $inv_out->created_by = Auth::user()->username;
        $inv_out->company_id = Session::get('company_id');
        $inv_out->save();

        return redirect()->route('ar.index');
    }

    function view($id){
        $inv_out = Finance_invoice_out::where('id_inv', $id)->first();

        $project = Marketing_project::where('company_id', Session::get('company_id'))->get();
        $leads = Marketing_leads::where('company_id', Session::get('company_id'))->get();

        $det = Finance_invoice_out_detail::where('id_inv', $id)->get();

        $prj_name = [];
        $leads_name = [];
        foreach ($project as $item){
            $prj_name[$item->id] = $item->prj_name;
        }

        foreach ($leads as $item){
            $leads_name[$item->id] = $item->leads_name;
        }

        $bank = Finance_treasury::where('company_id', Session::get('company_id'))->get();
        $bank_name = [];
        foreach ($bank as $item){
            $bank_name[$item->id] = "[".$item->currency."] ".$item->source;
        }
        $taxes = Pref_tax_config::where('company_id', Session::get('company_id'))->get();
        $tax_name = [];
        $tax_formula = [];
        foreach ($taxes as $item){
            $tax_name[$item->id] = $item->tax_name;
            $tax_formula[$item->id] = $item->formula;
        }

        return view('finance.account_receivable.view', [
            'inv' => $inv_out,
            'prj_name' => $prj_name,
            'leads_name' => $leads_name,
            'banks' => $bank,
            'taxes' => $taxes,
            'details' => $det,
            'bank_name' => $bank_name,
            'tax_name' => $tax_name,
            'tax_formula' => $tax_formula
        ]);
    }

    function delete($id){
        if (Finance_invoice_out::where('id_inv',$id)->delete()){
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    function addEntry(Request $request){
        $arrRomawi	= array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $num = Finance_invoice_out_detail::where('year_id_inv', date('Y'))
            ->where('id_inv', $request->id_inv)
            ->orderBy('no_id_inv', 'desc')
            ->limit(1)
            ->first();
        if (!empty($num)){
            $no_num = $num->no_id_inv + 1;
        } else {
            $no_num = 1;
        }
        $inv = Finance_invoice_out::where('id_inv', $request->id_inv)->first();
        $title = json_decode($inv->title);
        $m = date("n", strtotime($request->date));
        $inv_num = sprintf("%03d", $no_num)."/INV-".Session::get('company_tag')."/".$title->tag."/".$arrRomawi[$m]."/".date("Y", strtotime($request->date));
//        dd($inv_num);
        $inv_detail = new Finance_invoice_out_detail();
        $inv_detail->year_id_inv = date('Y');
        $inv_detail->no_id_inv = $no_num;
        $inv_detail->no_inv = $inv_num;
        $inv_detail->id_inv = $request->id_inv;
        $inv_detail->activity = $request->activity;
        $inv_detail->date = $request->date;
        $inv_detail->payment_account = $request->bank_src;
        $inv_detail->taxes = json_encode($request->tax);
        $inv_detail->value_d = 0;
        $inv_detail->created_by = Auth::user()->username;
        $inv_detail->company_id = Session::get('company_id');
        if (isset($request->wapu)){
            $inv_detail->wapu = $request->wapu;
        }

        if ($inv_detail->save()){
            return redirect()->route('ar.view', $request->id_inv);
        }
    }

    function delete_entry($id){
        if (Finance_invoice_out_detail::find($id)->delete()){
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    function input_entry($id){
        $inv_detail = Finance_invoice_out_detail::find($id);
        $inv = Finance_invoice_out::where('id_inv', $inv_detail->id_inv)->first();

        $project = Marketing_project::where('company_id', Session::get('company_id'))->get();
        $leads = Marketing_leads::where('company_id', Session::get('company_id'))->get();

        $prj_name = [];
        $prj_client = [];
        $leads_name = [];
        $leads_client = [];
        foreach ($project as $item){
            $prj_name[$item->id] = $item->prj_name;
            $prj_client[$item->id] = $item->id_client;
        }

        foreach ($leads as $item){
            $leads_name[$item->id] = $item->leads_name;
            $leads_client[$item->id] = $item->id_client;
        }

        $title = json_decode($inv->title);

        $id_client = ($title->type == "project") ? $prj_client[$title->id] : $leads_client[$title->id];
        $title_name = ($title->type == "project") ? $prj_name[$title->id] : $leads_name[$title->id];

        $clients = Marketing_clients::where('company_id', Session::get('company_id'))->get();
        $client_address = [];
        $client_pic = [];
        foreach ($clients as $item){
            $client_address[$item->id] = $item->address;
            $client_pic[$item->id] = $item->pic;
        }
        $taxes = Pref_tax_config::where('company_id', Session::get('company_id'))->get();
        $tax_name = [];
        $tax_formula = [];
        $isWapu = [];
        foreach ($taxes as $item){
            $tax_name[$item->id] = $item->tax_name;
            $tax_formula[$item->id] = $item->formula;
            $isWapu[$item->id] = $item->is_wapu;
        }

        return view('finance.account_receivable.input', [
            'inv_detail' => $inv_detail,
            'client_address' => $client_address[$id_client],
            'client_pic' => $client_pic[$id_client],
            'title_name' => $title_name,
            'taxes' => $taxes,
            'tax_name' => $tax_name,
            'tax_formula' => $tax_formula,
            'isWapu' => $isWapu
        ]);
    }

    function view_entry($id, $act){
        $inv_detail = Finance_invoice_out_detail::find($id);
        $inv = Finance_invoice_out::where('id_inv', $inv_detail->id_inv)->first();
        $print = Finance_invoice_out_print::where('id_inv_out_detail', $id)->get();

        $project = Marketing_project::where('company_id', Session::get('company_id'))->get();
        $leads = Marketing_leads::where('company_id', Session::get('company_id'))->get();

        $prj_name = [];
        $prj_client = [];
        $leads_name = [];
        $leads_client = [];
        foreach ($project as $item){
            $prj_name[$item->id] = $item->prj_name;
            $prj_client[$item->id] = $item->id_client;
        }

        foreach ($leads as $item){
            $leads_name[$item->id] = $item->leads_name;
            $leads_client[$item->id] = $item->id_client;
        }

        $title = json_decode($inv->title);

        $id_client = ($title->type == "project") ? $prj_client[$title->id] : $leads_client[$title->id];
        $title_name = ($title->type == "project") ? $prj_name[$title->id] : $leads_name[$title->id];

        $clients = Marketing_clients::where('company_id', Session::get('company_id'))->get();
        $client_address = [];
        $client_pic = [];
        foreach ($clients as $item){
            $client_address[$item->id] = $item->address;
            $client_pic[$item->id] = $item->pic;
        }
        $taxes = Pref_tax_config::where('company_id', Session::get('company_id'))->get();
        $tax_name = [];
        $tax_formula = [];
        $isWapu = [];
        foreach ($taxes as $item){
            $tax_name[$item->id] = $item->tax_name;
            $tax_formula[$item->id] = $item->formula;
            $isWapu[$item->id] = $item->is_wapu;
        }
//        return view('finance.account_receivable.detail', [
//            'inv_detail' => $inv_detail,
//            'client_address' => $client_address[$id_client],
//            'client_pic' => $client_pic[$id_client],
//            'title_name' => $title_name,
//            'taxes' => $taxes,
//            'tax_name' => $tax_name,
//            'tax_formula' => $tax_formula,
//            'inv_prints' => $print,
//            'act' => $act
//        ]);
        if ($act == 'print'){
            $titleinv = json_decode($inv->title);
            $prj = Marketing_project::where('id',$titleinv->id)->first();
            $data_client = Marketing_clients::where('id', $prj->id_client)->first();
            $payment_account = Finance_treasury::where('id',$inv_detail->payment_account)->first();
//            dd($payment_account);
            return view('finance.account_receivable.print', [
                'inv_detail' => $inv_detail,
                'client_address' => $client_address[$id_client],
                'client_pic' => $client_pic[$id_client],
                'title_name' => $title_name,
                'taxes' => $taxes,
                'tax_name' => $tax_name,
                'tax_formula' => $tax_formula,
                'inv_prints' => $print,
                'act' => $act,
                'data_client' => $data_client,
                'payment_account' => $payment_account,
                'isWapu' => $isWapu
            ]);
        } else {
            return view('finance.account_receivable.detail', [
                'inv_detail' => $inv_detail,
                'client_address' => $client_address[$id_client],
                'client_pic' => $client_pic[$id_client],
                'title_name' => $title_name,
                'taxes' => $taxes,
                'tax_name' => $tax_name,
                'tax_formula' => $tax_formula,
                'inv_prints' => $print,
                'act' => $act,
                'isWapu' => $isWapu
            ]);
        }
    }

    function appr_manager(Request $request){
        $inv_detail = Finance_invoice_out_detail::find($request->id_detail);
        $inv_detail->fin_approved_date = date('Y-m-d');
        $inv_detail->fin_approved_by = Auth::user()->username;
        $inv_detail->fin_approved_note = $request->notes;
        $inv_detail->save();
        return redirect()->route('ar.view', $inv_detail->id_inv);
    }

    function appr_finance(Request $request){
        $inv_detail = Finance_invoice_out_detail::find($request->id_detail);
        $inv_detail->ceo_app_date = date('Y-m-d');
        $inv_detail->ceo_app_by = Auth::user()->username;
        $inv_detail->ceo_app_note = $request->notes;
        $inv_detail->status = "approved";

        // input to treasure history

        $inv = Finance_invoice_out::where('id_inv', $inv_detail->id_inv)->first();
        $project = Marketing_project::where('company_id', Session::get('company_id'))->get();
        $leads = Marketing_leads::where('company_id', Session::get('company_id'))->get();

        $prj_name = [];
        $prj_client = [];
        $leads_name = [];
        $leads_client = [];
        foreach ($project as $item){
            $prj_name[$item->id] = $item->prj_name;
            $prj_client[$item->id] = $item->id_client;
        }

        foreach ($leads as $item){
            $leads_name[$item->id] = $item->leads_name;
            $leads_client[$item->id] = $item->id_client;
        }

        $title = json_decode($inv->title);

        $title_name = ($title->type == "project") ? $prj_name[$title->id] : $leads_name[$title->id];

        $tre_his = new Finance_treasury_history();
        $tre_his->id_treasure = $inv_detail->payment_account;
        $tre_his->date_input = date('Y-m-d');
        $tre_his->description = "Invoice out Payment: ".$inv_detail->activity."[".$title_name."]";
        $tre_his->IDR = $inv_detail->value_d;
        $tre_his->PIC = Auth::user()->username;
        $tre_his->company_id = Session::get('company_id');
        $tre_his->save();

        $inv_detail->save();
        return redirect()->route('ar.view', $inv_detail->id_inv);
    }

    function revise(Request $request){
        $inv_detail = Finance_invoice_out_detail::find($request->id_detail);
        $inv_detail->req_revise_by = Auth::user()->username;
        $inv_detail->req_revise_date = date('Y-m-d');
        $inv_detail->req_revise_note = $request->notes;
        $inv_detail->save();

        return redirect()->route('ar.view', $inv_detail->id_inv);
//        $new = $inv_detail->replicate();
//        $new->revise = ($inv_detail->revise_number == null) ? 1 : $inv_detail->revise_number + 1;
//        $new->save();
    }

    function add_input(Request $request){
        $desc = $request->description;
        $qty = $request->qty;
        $uom = $request->uom;
        $price = $request->price;
        $discount = $request->discount;
        $amount = 0;
        for ($i = 0; $i < count($qty); $i++){
            $print = new Finance_invoice_out_print();
            $print->id_inv_out_detail = $request->id_detail;
            $print->description = $desc[$i];
            $print->unit_price = $price[$i];
            $print->qty = $qty[$i];
            $print->uom = $uom[$i];
            $print->created_by = Auth::user()->username;
            $print->company_id = Session::get('company_id');
            $amount += $qty[$i] * $price[$i];
            $print->save();
        }

        $inv_det = Finance_invoice_out_detail::find($request->id_detail);
        $inv_det->value_d = $amount;
        $inv_det->discount = $discount;
        $inv_det->updated_by = Auth::user()->username;
        $inv_det->save();

        return redirect()->route('ar.view', $inv_det->id_inv);
    }
}
