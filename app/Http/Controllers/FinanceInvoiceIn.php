<?php

namespace App\Http\Controllers;

use App\Models\Asset_item;
use App\Models\Asset_po;
use App\Models\Asset_po_detail;
use App\Models\Asset_wo;
use App\Models\Asset_wo_detail;
use App\Models\Finance_invoice_in;
use App\Models\Finance_invoice_in_pay;
use App\Models\Marketing_project;
use App\Models\Pref_tax_config;
use App\Models\Procurement_vendor;
use Session;
use Illuminate\Http\Request;

class FinanceInvoiceIn extends Controller
{

    private $id_companies = array();
    function __construct()
    {
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $this->id_companies[] = $item->id;
            }
            array_push($this->id_companies, Session::get('company_id'));
        } else {
            array_push($this->id_companies, Session::get('company_id'));
        }

    }

    function index(){
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $this->id_companies[] = $item->id;
            }
            array_push($this->id_companies, Session::get('company_id'));
        } else {
            array_push($this->id_companies, Session::get('company_id'));
        }
        $inv_in = Finance_invoice_in::where('company_id', Session::get('company_id'))->get();
        $vendor = Procurement_vendor::whereIn('company_id', $this->id_companies)->get();
        $data = array();
        $paper = array();
        $supplier = array();
        foreach ($vendor as $value){
            $data['id'][] = $value->id;
            $data['name'][$value->id] = $value->name;
            $data['address'][$value->id] = preg_replace(['/\n/', '/\r/'], ['', ' '], $value->address);
            $data['telephone'][$value->id] = $value->telephone;
            $data['bank_acct'][$value->id] = $value->bank_acct;
            $data['web'][$value->id] = $value->web;
            $data['pic'][$value->id] = $value->pic;
            $supplier[$value->id]['name'] = $value->name;
            $supplier[$value->id]['bank_acct'] = $value->bank_acct;
        }

        $po = Asset_po::where('company_id', Session::get('company_id'))->get();
        $wo = Asset_wo::where('company_id', Session::get('company_id'))->get();
        foreach ($po as $value){
            $paper['paper_num']['PO'][$value->id] = $value->po_num;
            $paper['supplier'][$value->id] = $value->supplier_id;
            $paper['currency'][$value->id] = $value->currency;
            $paper['gr_date'][$value->id] = $value->gr_date;
        }

        foreach ($wo as $value){
            $paper['paper_num']['WO'][$value->id]= $value->wo_num;
            $paper['supplier'][$value->id] = $value->supplier_id;
            $paper['currency'][$value->id] = $value->currency;
            $paper['gr_date'][$value->id] = $value->gr_date;
        }

        $project = Marketing_project::where('company_id', Session::get('company_id'))->get();
        $prj_name = array();
        foreach ($project as $value){
            $prj_name[$value->id] = $value->prj_name;
        }
        return view('finance.inv_in.index', [
            'jsonvendor' => json_encode($data),
            'jsonprjname' => json_encode($prj_name),
            'inv_in' => $inv_in,
            'paper' => $paper,
            'supplier' => $supplier
        ]);
    }

    function search_paper(Request $request){
        $paper = explode("/", $request->key);
        if (isset($paper[2])){
            if ($paper[2] == "WO" || $paper[2] == "PO"){
                $tax = Pref_tax_config::where('company_id', Session::get('company_id'))->get();
                foreach ($tax as $value){
                    $tax_name[$value->id] = $value->tax_name;
                    $tax_formula[$value->id] = $value->formula;
                }
                if ($paper[2] == "WO"){
                    $data = Asset_wo::where('wo_num', $request->key)->first();
                    $detail = Asset_wo_detail::where('wo_id', $data->id)->get();
                    $subtotal = 0;
                    $ppn = json_decode($data->ppn);
                    $val['table'] = "<table class='table table-bordered display' style=\"width: 100%\"><thead><tr><th class='text-center'>No</th><th>Job Description</th><th class='text-center'>Qty</th><th class='text-right'>Unit Price</th><th class='text-right'>Amount</th></tr></thead>";
                    foreach ($detail as $key => $value){
                        $amount = $value->qty * $value->unit_price;
                        $subtotal += $amount;
                        $val['table'] .= "<tbody><tr><td align='center'>".($key + 1)."</td><td >".$value->job_desc."</td><td align='center'>".$value->qty."</td><td align='right'>".$value->unit_price."</td><td align='right'>".$amount."</td></tr></tbody>";
                    }
                    $val['table'] .= "<tfoot><tr>";
                    $val['table'] .= "<td rowspan='".(6 + count($ppn))."'></td><td rowspan='".(6 + count($ppn))."' colspan='2'><b>Requirements for payment, please attach:</b><ol><li>Original Work Order that has been signed and stamped by the company.</li><li>Bank account number for payment</li><li>Minutes of handover / Timesheets of work & tool usage</li><li>Original Tax Invoice</li></ol><br><b>A. Term Condition</b><ul><li>".strip_tags($data->terms)."</li></ul><br><b>B. Term of Payment</b><ul><li>".strip_tags($data->terms_payment)."</li></ul></td>";
                    $val['table'] .= "<td align='right'>SUB TOTAL</td>";
                    $val['table'] .= "<td align='right'>".number_format($subtotal, 2)."</td></tr>";
                    $val['table'] .= "<tr><td align='right'>DISCOUNT</td><td align='right'>".number_format($data->discount, 2)."</td></tr>";
                    $net = $subtotal - $data->discount;
                    $val['table'] .= "<tr><td align='right'>NET INCLUDE DISCOUNT</td><td align='right'>".number_format($net, 2)."</td></tr>";
                    //Tax
                    $ppn_sum = 0;
                    foreach ($ppn as $p){
                        $sum = $net;
                        $pval = eval('return '.$tax_formula[$p].';');
                        $ppn_sum += $pval;
                        $val['table'] .= "<tr><td align='right'>".$tax_name[$p]."</td><td align='right'>".number_format($pval, 2)."</td></tr>";
                    }
                    $net_tax = $net + $ppn_sum;
                    $val['table'] .= "<tr><td align='right'>TOTAL AFTER TAX</td><td align='right'>".number_format($net_tax, 2)."</td></tr>";
                    $val['table'] .= "<tr><td align='right'>DOWN PAYMENT</td><td align='right'>".number_format($data->dp, 2)."</td></tr>";
                    $total_due = $net_tax - $data->dp;
                    $val['table'] .= "<tr><td align='right'>TOTAL DUE</td><td align='right'>".number_format($total_due, 2)."</td></tr>";
                    $val['table'] .= "</tfoot>";
                    $val['table'] .= "</table>";
                    $val['amount'] = $net_tax;
                    $val['type'] = "WO";
                } else {
                    $data = Asset_po::where('po_num', $request->key)->first();
                    $detail = Asset_po_detail::where('po_num', $data->id)->get();
                    $item = Asset_item::all();
                    foreach ($item as $valItem){
                        $item_name[$valItem->item_code] = "[".$valItem->item_code."] ".$valItem->name;
                        $item_uom[$valItem->item_code] = $valItem->uom;
                    }
                    $subtotal = 0;
                    if (!empty($data->ppn)){
                        $ppn = json_decode($data->ppn);
                    } else {
                        $ppn = array();
                    }
                    $val['table'] = "<table class='table table-bordered display' style=\"width: 100%\"><thead><tr><th class='text-center'>No</th><th>Item</th><th class='text-center'>UoM</th><th class='text-center'>Qty</th><th class='text-right'>Unit Price</th><th class='text-right'>Amount</th></tr></thead>";
                    foreach ($detail as $key => $value){
                        $amount = $value->qty * $value->price;
                        $subtotal += $amount;
                        $val['table'] .= "<tbody><tr><td align='center'>".($key + 1)."</td><td >".$item_name[$value->item_id]."</td><td align='center'>".$item_uom[$value->item_id]."</td><td align='center'>".$value->qty."</td><td align='right'>".$value->price."</td><td align='right'>".$amount."</td></tr></tbody>";
                    }
                    $val['table'] .= "<tfoot><tr>";
                    $val['table'] .= "<td rowspan='".(6 + count($ppn))."'></td><td rowspan='".(6 + count($ppn))."' colspan='3'><b>Requirements for payment, please attach:</b><ol><li>Original Purchase Order that has been signed and stamped by the company.</li><li>Bank account number for payment</li><li>Minutes of handover / Timesheets of work & tool usage</li><li>Original Tax Invoice</li></ol><br><b>A. Term Condition</b><ul><li>".strip_tags($data->terms)."</li></ul><br><b>B. Term of Payment</b><ul><li>".strip_tags($data->payment_term)."</li></ul></td>";
                    $val['table'] .= "<td align='right'>SUB TOTAL</td>";
                    $val['table'] .= "<td align='right'>".number_format($subtotal, 2)."</td></tr>";
                    $val['table'] .= "<tr><td align='right'>DISCOUNT</td><td align='right'>".number_format($data->discount, 2)."</td></tr>";
                    $net = $subtotal - $data->discount;
                    $val['table'] .= "<tr><td align='right'>NET INCLUDE DISCOUNT</td><td align='right'>".number_format($net, 2)."</td></tr>";
                    //Tax
                    $ppn_sum = 0;
                    foreach ($ppn as $p){
                        $sum = $net;
                        $pval = eval('return '.$tax_formula[$p].';');
                        $ppn_sum += $pval;
                        $val['table'] .= "<tr><td align='right'>".$tax_name[$p]."</td><td align='right'>".number_format($pval, 2)."</td></tr>";
                    }
                    $net_tax = $net + $ppn_sum;
                    $val['table'] .= "<tr><td align='right'>TOTAL AFTER TAX</td><td align='right'>".number_format($net_tax, 2)."</td></tr>";
                    $val['table'] .= "<tr><td align='right'>DOWN PAYMENT</td><td align='right'>".number_format($data->dp, 2)."</td></tr>";
                    $total_due = $net_tax - $data->dp;
                    $val['table'] .= "<tr><td align='right'>TOTAL DUE</td><td align='right'>".number_format($total_due, 2)."</td></tr>";
                    $val['table'] .= "</tfoot>";
                    $val['table'] .= "</table>";
                    $val['amount'] = $net_tax;
                    $val['type'] = "PO";
                }

                if (!empty($data)){
                    $paper_id = $data->id;
                    $inv_in = Finance_invoice_in::where('paper_type', strtoupper($paper[2]))
                        ->where('paper_id', $paper_id)
                        ->first();
                    if (!empty($inv_in)){
                        $val['status'] = 2;
                        $val['messages'] = "Paper has already inserted in invoice in";
                    } else {
                        $val['status'] = 1;
                        $val['messages'] = "Paper is ready";
                        $val['data'] = json_encode($data);
                    }
                } else {
                    $val['status'] = 3;
                    $val['messages'] = "The paper number that you looking for is not exist";
                }
            } else {
                $val['status'] = 4;
                $val['messages'] = "You entered the wrong format, please try again";
            }
        } else {
            $val['status'] = 4;
            $val['messages'] = "You entered the wrong format, please try again";
        }


        return json_encode($val);
    }
    function add(Request $request){
        $iFin = new Finance_invoice_in();
        $iFin->paper_id = $request->id_p;
        $iFin->paper_type = $request->t;
        $iFin->amount = $request->amount;
        $iFin->amount_left = $request->amount - $request->dp;
        $iFin->app_date = date('Y-m-d');
        $iFin->status = "input";
        $iFin->project = $request->p;
        $iFin->company_id = Session::get('company_id');
        if ($request->cod != null){
            $iFin->pay_date = date('Y-m-d H:i:s');
        } else {
            $iFin->pay_date = null;
        }

        $iFin->save();

        if ($request->dp > 0){
            $iPay = new Finance_invoice_in_pay();
            $iPay->inv_id = $iFin->id;
            $iPay->pay_num = 1;
            $iPay->amount = $request->dp;
            $iPay->pay_date = date('Y-m-d');
            $iPay->description = "Down Payment";
            $iPay->save();
        }

        return redirect()->route('inv_in.index');
    }

    function duedate(Request $request){
        $iFin = Finance_invoice_in::find($request->id);
        $iFin->pay_date = $request->tgl;
        $iFin->save();

        return redirect()->route('inv_in.index');
    }

    function view($id){
        $paper = array();
        $vPay = Finance_invoice_in_pay::where('inv_id', $id)->get();
        $paid = 0;
        if (count($vPay) > 0){
            foreach ($vPay as $value){
                $paid += $value->amount;
            }
        }
        $po = Asset_po::where('company_id', Session::get('company_id'))->get();
        $wo = Asset_wo::where('company_id', Session::get('company_id'))->get();
        foreach ($po as $value){
            $paper['paper_num']['PO'][$value->id] = $value->po_num;
            $paper['supplier'][$value->id] = $value->supplier_id;
            $paper['currency'][$value->id] = $value->currency;
            $paper['gr_date'][$value->id] = $value->gr_date;
        }

        foreach ($wo as $value){
            $paper['paper_num']['WO'][$value->id]= $value->wo_num;
            $paper['supplier'][$value->id] = $value->supplier_id;
            $paper['currency'][$value->id] = $value->currency;
            $paper['gr_date'][$value->id] = $value->gr_date;
        }
        $inv = Finance_invoice_in::where('id', $id)->first();
        return view('finance.inv_in.view', [
            'inv' => $inv,
            'ipay' => $vPay,
            'paper' => $paper,
            'paid' => $paid
        ]);
    }

    function pay(Request $request){
        $iPay = new Finance_invoice_in_pay();

        $iPay->inv_id = $request->id;
        $iPay->pay_num = $request->pay_num;
        $iPay->amount = $request->amount;
        $iPay->pay_date = $request->pay_date;
        $iPay->description = $request->description;

        $iPay->save();
        return redirect()->route('inv_in.view', $request->id);
    }

    function delete_pay(Request $request){
        $iPay = Finance_invoice_in_pay::find($request->id)->delete();
        if ($iPay){
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    function delete(Request $request){
        $iPay = Finance_invoice_in::find($request->id)->delete();
        $pay = Finance_invoice_in_pay::where('inv_id', $request->id)->delete();
        if ($iPay){
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }
}
