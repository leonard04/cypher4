<?php

namespace App\Http\Controllers;

use App\Models\Asset_po;
use App\Models\Asset_po_detail;
use App\Models\Asset_sre;
use App\Models\Asset_type_po;
use App\Models\Asset_type_wo;
use App\Models\Asset_wo;
use App\Models\Asset_wo_detail;
use App\Models\Finance_invoice_in;
use App\Models\Finance_invoice_in_pay;
use App\Models\Ha_paper_permit;
use App\Models\Marketing_project;
use App\Models\Pref_tax_config;
use App\Models\Procurement_vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AssetWoController extends Controller
{
    function index(){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $po = Asset_wo::whereIn('company_id', $id_companies)->get();
        $pro = Marketing_project::whereIn('company_id', $id_companies)->get();
        $pro_name = array();
        foreach ($pro as $value){
            $pro_name[$value->id] = $value->prj_name;
        }

        $vendor = Procurement_vendor::whereIn('company_id', $id_companies)->get();
        $vendor_name = array();
        foreach ($vendor as $item) {
            $vendor_name[$item->id] = $item->name;
        }

        $po_det = Asset_wo_detail::all();
        $qty = array();
        $price = array();
        foreach ($po_det as $value){
            $qty[$value->po_num][] = $value->qty;
            $price[$value->po_num][] = $value->price;
        }

        $id_tax = [];
        $conflict = [];
        $formula = [];

        $tax = Pref_tax_config::whereIn('company_id', $id_companies)->get();
        foreach ($tax as $key => $value){
            $id_tax[] = $value->id;
            $conflict[$value->id] = json_decode($value->conflict_with);
            $formula[$value->id] = $value->formula;
        }

        $wo_type = Asset_type_wo::all();

        return view('wo.index', [
            'po' => $po,
            'pro_name' => $pro_name,
            'vendor_name' => $vendor_name,
            'formula' => $formula,
            'qty_det' => $qty,
            'price_det' => $price,
            'wo_type' => $wo_type,
            'tax' => $tax
        ]);
    }

    function detail($id){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $po = Asset_wo::where('id', $id)->first();
        $po_detail = Asset_wo_detail::where('wo_id', $id)->get();

        $vendor = Procurement_vendor::all();
        foreach ($vendor as $item) {
            $vendor_name[$item->id] = $item->name;
        }

        $tax = Pref_tax_config::all();
        foreach ($tax as $key => $value){
            $id_tax[] = $value->id;
            $tax_name[$value->id] = $value->tax_name;
            $conflict[$value->id] = json_decode($value->conflict_with);
            $formula[$value->id] = $value->formula;
        }

        $pro = Marketing_project::all();
        foreach ($pro as $value){
            $pro_name[$value->id] = $value->prj_name;
        }


        return view('wo.view', [
            'po' => $po,
            'po_detail' => $po_detail,
            'pro_name' => $pro_name,
            'vendor_name' => $vendor_name,
            'formula' => $formula,
            'tax_name' => $tax_name,
            'tax' => $tax,
        ]);
    }

    function appr($id){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $po = Asset_wo::where('id', $id)->first();
        $po_detail = Asset_wo_detail::all();

        $vendor = Procurement_vendor::all();
        foreach ($vendor as $item) {
            $vendor_name[$item->id] = $item->name;
        }

        $tax = Pref_tax_config::all();
        foreach ($tax as $key => $value){
            $id_tax[] = $value->id;
            $tax_name[$value->id] = $value->tax_name;
            $conflict[$value->id] = json_decode($value->conflict_with);
            $formula[$value->id] = $value->formula;
        }

        $pro = Marketing_project::all();
        foreach ($pro as $value){
            $pro_name[$value->id] = $value->prj_name;
        }


        return view('wo.appr', [
            'po' => $po,
            'po_detail' => $po_detail,
            'pro_name' => $pro_name,
            'vendor_name' => $vendor_name,
            'formula' => $formula,
            'tax_name' => $tax_name,
            'tax' => $tax,
        ]);
    }

    function approve(Request $request){
        $po = Asset_wo::find($request->id);
        $po->approved_by = Auth::user()->username;
        $po->approved_time = date('Y-m-d H:i:s');
        $po->appr_notes = $request->notes;

        $po_data = Asset_wo::where('id', $request->id)->first();

        $total_val = str_replace(",", "", $request->val);

//        $inv_in = new Finance_invoice_in();
//        $inv_in->paper_id = $request->id;
//        $inv_in->paper_type = "WO";
//        $inv_in->amount = $total_val;
//        $inv_in->amount_left = (int)$total_val - $po_data->dp;
//        $inv_in->pay_date = date('Y-m-d');
//        $inv_in->app_date = date('Y-m-d');
//        $inv_in->status = 'input';
//        $inv_in->project = $po_data->project;
//
//        $inv_in->save();
//        if ($po_data->dp > 0){
//            $in_pay = new Finance_invoice_in_pay();
//            $in_pay->inv_id = $inv_in->id;
//            $in_pay->pay_num = 1;
//            $in_pay->amount = $po_data->dp;
//            $in_pay->pay_date = date('Y-m-d');
//            $in_pay->description = "Down Payment";
//            $in_pay->save();
//        }

        if ($po->save()){
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    function reject(Request $request){
        $po = Asset_wo::find($request->id);
        $po->rejected_by = Auth::user()->username;
        $po->rejected_time = date('Y-m-d H:i:s');



        if ($po->save()){
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    function revise(Request $request){
        $po = Asset_wo::find($request->id);
        $po->rejected_by = Auth::user()->username;
        $po->rejected_time = date('Y-m-d H:i:s');

        $po_data = Asset_wo::where('id', $request->id)->first();

        Asset_sre::where('se_num', $po_data->reference)
            ->update([
                'se_rejected_notes' => $request->notes,
                'se_approved_by' => null,
                'se_approved_at' => null,
                'se_approved_notes' => null,
                'se_input_at' => null,
                'se_input_by' => null,
                'ack_by' => null,
                'ack_time' => null
            ]);

        if ($po->save()){
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    function addInstant(Request $request){

        $po_type = Asset_type_wo::find($request->wo_type);

        $ipo = new Asset_wo();
        $ipo->supplier_id = $request->supplier;
        $ipo->wo_type = $po_type->name;
        // WO NUM
        $po_num = Asset_wo::where('created_at', 'like', ''.date('Y')."-%")
            ->orderBy('created_at', 'desc')
            ->first();
//        dd($po_num);
        if (!empty($po_num)) {
            $last_num = explode("/", $po_num->wo_num);
            $num = sprintf("%03d", (intval($last_num[0]) + 1));
        } else {
            $num = sprintf("%03d", 1);
        }

        $arrRomawi	= array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $ipo->wo_num = $num."/".strtoupper(Session::get('company_tag'))."/WO/".$arrRomawi[date('n')]."/".date('y');

        $ipo->req_date = $request->date;
        $ipo->project = $request->project;
        $ipo->deliver_to = $request->d_to;
        $ipo->deliver_time = $request->d_time;
        $ipo->reference = $request->paper_code;
        $ipo->currency = $request->currency;
        $ipo->discount = $request->discount;
        $ipo->dp = $request->dp;

        $tax = array();
        if (isset($request->tax)){
            foreach ($request->tax as $item){
                $tax[] = $item;
            }
            $ipo->ppn = json_encode($tax);
        }

        $cat = (isset($request->category) && $request->category != null) ? "|".$request->category : "";

        $ipo->terms_payment = $request->p_terms;
        $ipo->terms = $request->terms;
        $ipo->notes = $request->notes;
        $ipo->created_by = Auth::user()->username.$cat;
        $ipo->company_id = Session::get('company_id');

        if ($ipo->save()){
            $qty = $request->qty;
            $price = $request->price;
            foreach ($request->desc_item as $key => $item){
                $detail = new Asset_wo_detail();
                $detail->wo_id = $ipo->id;
                $detail->job_desc = $item;
                $detail->qty = $qty[$key];
                $detail->unit_price = $price[$key];
                $detail->created_by = Auth::user()->username;
                $detail->company_id = Session::get('company_id');
                $detail->save();
            }

            $paper = Ha_paper_permit::where('kode', $request->paper_code)->first();
            $paper->issued_date = date('Y-m-d');
            $paper->issued_by = Auth::user()->username;
            $paper->updated_by = Auth::user()->username;
            $paper->paper_num = $ipo->wo_num;
            $paper->save();
        }

        return redirect()->route('general.wo');
    }
}
