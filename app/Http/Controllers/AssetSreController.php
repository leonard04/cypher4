<?php

namespace App\Http\Controllers;

use App\Models\Asset_sre;
use App\Models\Asset_sre_detail;
use App\Models\Asset_type_wo;
use App\Models\Asset_wo;
use App\Models\Asset_wo_detail;
use App\Models\Marketing_project;
use App\Models\Pref_tax_config;
use App\Models\Procurement_vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Session;

class AssetSreController extends Controller
{
    function so_index(){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $so = Asset_sre::whereIn('company_id', $id_companies)->get();
        $so_det = Asset_sre_detail::all();
        $det = array();
        foreach ($so_det as $item){
            $det[$item->so_id][] = $item->id;
        }
        $type_wo = Asset_type_wo::all();
        $project = Marketing_project::whereIn('company_id', $id_companies)->get();
        $pro_name = array();
        foreach ($project as $item){
            $pro_name[$item->id] = $item->prj_name;
        }
        return view('so.index', [
            'so' => $so,
            'type_wo' => $type_wo,
            'project' => $project,
            'pro_name' => $pro_name,
            'det' => $det
        ]);
    }

    function so_add(Request $request){
        $arrRomawi	= array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $sre = new Asset_sre();

        $request_date = date("Y-m-d", strtotime($request['request_date']));
        $so_num = Asset_sre::where('created_at', 'like', ''.date('Y')."-%")
            ->where('so_num', 'like', "%".Session::get('company_id')."%")
            ->first();
        if (!empty($so_num)) {
            $last_num = explode("/", $so_num->so_num);
            $num = sprintf("%03d", (intval($last_num[0]) + 1));
        } else {
            $num = sprintf("%03d", 1);
        }
        $so_num_id = sprintf('%03d',$num).'/'.strtoupper(\Session::get('company_tag')).'/SO/'.$arrRomawi[date("n")].'/'.date("y");

        $sre->so_type = $request->so_type;
        $sre->so_num = $so_num_id;
        $sre->division = $request->division;
        $sre->project = $request->project;
        $sre->so_date = date('Y-m-d H:i:s');
        $sre->reference = $request->reference;
        $sre->so_notes = $request->notes;
        $sre->deliver_to = $request->d_to;
        $sre->deliver_time = $request->d_time;
        $sre->company_id = Session::get('company_id');
        if (isset($request->payment_method)){
            $sre->bd = 1;
        } else {
            $sre->bd = 0;
        }
        $sre->created_by = Auth::user()->username;

        $sre->save();
        $job_name = $request->name;
        $job_qty = $request->qty;
        foreach ($job_name as $i => $v){
            $sre_det = new Asset_sre_detail();

            $sre_det->so_id = $sre->id;
            $sre_det->job_desc = $v;
            $sre_det->qty = $job_qty[$i];
            $sre_det->created_by = Auth::user()->username;

            $sre_det->save();
        }

        return redirect()->route('general.so');
    }

    function so_view($id){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $so = Asset_sre::where('id', $id)->first();
        $project = Marketing_project::whereIn('company_id', $id_companies)->get();
        foreach ($project as $item){
            $pro_name[$item->id] = $item->prj_name;
        }
        $so_det = Asset_sre_detail::where('so_id', $id)->get();

        return view('so.view', [
            'so' => $so,
            'pro' => $pro_name,
            'so_det' => $so_det
        ]);
    }

    public function nextDocNumber($code,$year){
        $cek = Asset_sre::where('so_num','like','%'.$code.'%')
            ->where('so_date','like','%'.date('y').'-%')
            ->where('company_id', \Session::get('company_id'))
            ->whereNull('deleted_at')
            ->orderBy('id','DESC')
            ->get();

//        dd($cek);
        if (count($cek) > 0){
            $frNum = $cek[0]->fr_num;
            $frDate = $cek[0]->fr_date;
            $str = explode('/', $frNum);
//            dd(date('y',strtotime($year)));
            if (date('y',strtotime($year)) == date('y')){
                $number = intval($str[0]);
                $number+=1;
                if ($number > 99){
                    $no = strval($number);
                } elseif ($number > 9) {
                    $no = "0".strval($number);
                } else {
                    $no = "00".strval($number);
                }
            } else {
                $no = "001";
            }
        } else {
            $no = "001";
        }
        return $no;
    }

    function so_appr($id){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $so = Asset_sre::where('id', $id)->first();
        $project = Marketing_project::whereIn('company_id', $id_companies)->get();
        foreach ($project as $item){
            $pro_name[$item->id] = $item->prj_name;
        }
        $so_det = Asset_sre_detail::where('so_id', $id)->get();

        return view('so.appr', [
            'so' => $so,
            'pro' => $pro_name,
            'so_det' => $so_det
        ]);
    }

    function so_approve(Request $request){
        $so = Asset_sre::find($request->id);
        $so->so_approved_by = Auth::user()->username;
        $so->so_approved_at = date('Y-m-d H:i:s');
        $so->so_approved_notes = $request->notes;

        $so_data = Asset_sre::where('id', $request->id)->first();

        $so_num = $so_data->so_num;
        $so->rfq_so_num = str_replace("SO", "RFQSO", $so_num);
        $so->rfq_so_date = date('Y-m-d H:i:s');

        if ($so->save()){
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    function so_reject(Request $request){
        $so = Asset_sre::find($request->id);
        $so->so_rejected_by = Auth::user()->username;
        $so->so_rejected_at = date('Y-m-d H:i:s');
        $so->so_rejected_notes = $request->notes;

        if ($so->save()){
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    // SR

    function sr_index(){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $sr = Asset_sre::whereIn('company_id', $id_companies)->get();
        $sr_det = Asset_sre_detail::all();
        $det = array();
        foreach ($sr_det as $item){
            $det[$item->so_id][] = $item->id;
        }
        $type_wo = Asset_type_wo::all();
        $project = Marketing_project::whereIn('company_id', $id_companies)->get();
        $pro_name = array();
        foreach ($project as $item){
            $pro_name[$item->id] = $item->prj_name;
        }
        return view('sr.index', [
            'sr' => $sr,
            'type_wo' => $type_wo,
            'project' => $project,
            'pro_name' => $pro_name,
            'det' => $det
        ]);
    }

    function sr_appr($id){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $so = Asset_sre::where('id', $id)->first();
        $project = Marketing_project::whereIn('company_id', $id_companies)->get();
        foreach ($project as $item){
            $pro_name[$item->id] = $item->prj_name;
        }
        $so_det = Asset_sre_detail::where('so_id', $id)->get();

        return view('sr.appr', [
            'so' => $so,
            'pro' => $pro_name,
            'so_det' => $so_det
        ]);
    }

    function sr_view($id){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $so = Asset_sre::where('id', $id)->first();
        $project = Marketing_project::whereIn('company_id', $id_companies)->get();
        foreach ($project as $item){
            $pro_name[$item->id] = $item->prj_name;
        }
        $so_det = Asset_sre_detail::where('so_id', $id)->get();

        return view('sr.view', [
            'so' => $so,
            'pro' => $pro_name,
            'so_det' => $so_det
        ]);
    }

    function sr_approve(Request $request){
        $so = Asset_sre::find($request->id);
        $so->rfq_approved_by = Auth::user()->username;
        $so->rfq_approved_at = date('Y-m-d H:i:s');
        $so->rfq_approved_notes = $request->notes;

        $so_data = Asset_sre::where('id', $request->id)->first();

        $so_num = $so_data->rfq_so_num;
        $so->se_num = str_replace("RFQSO", "SE", $so_num);
        $so->se_date = date('Y-m-d H:i:s');
        $items = $request->id_item;
        $qty = $request->qty;
        for ($i=0; $i < count($items); $i++){
            $so_det = Asset_sre_detail::find($items[$i]);
            $so_det->qty_appr = $qty[$i];
            $so_det->save();
        }

        if ($so->save()){
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    function sr_reject(Request $request){
        $so = Asset_sre::find($request->id);
        $so->rfq_rejected_by = Auth::user()->username;
        $so->rfq_rejected_at = date('Y-m-d H:i:s');
        $so->rfq_rejected_notes = $request->notes;

        if ($so->save()){
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    function se_index(){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $sr = Asset_sre::whereIn('company_id', $id_companies)->get();
        $sr_det = Asset_sre_detail::all();
        $det = array();
        foreach ($sr_det as $item){
            $det[$item->so_id][] = $item->id;
        }
        $type_wo = Asset_type_wo::all();
        $project = Marketing_project::whereIn('company_id', $id_companies)->get();
        $pro_name = array();
        foreach ($project as $item){
            $pro_name[$item->id] = $item->prj_name;
        }
        return view('se.index', [
            'sr' => $sr,
            'type_wo' => $type_wo,
            'project' => $project,
            'pro_name' => $pro_name,
            'det' => $det
        ]);
    }

    function se_appr($id){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $so = Asset_sre::where('id', $id)->first();
        if (empty($so->se_input_at) && empty($so->se_approved_at)){
            $link = URL::route('se.input_post');
            $status = "input";
        } elseif (empty($so->se_approved_at) ){
            $link = URL::route('se.dir_post');
            $status = "dir";
        }  else {
            $link = "";
            $status = "";
        }
        $pro = Marketing_project::all();
        foreach ($pro as $value){
            $pro_name[$value->id] = $value->prj_name;
        }

        $so_detail = Asset_sre_detail::where('so_id', $id)->get();


        $tax = Pref_tax_config::all();
        foreach ($tax as $key => $value){
            $id_tax[] = $value->id;
            $conflict[$value->id] = json_decode($value->conflict_with);
            $formula[$value->id] = $value->formula;
        }

        $vendor = Procurement_vendor::all();

        return view('se.appr', [
            'so' => $so,
            'pro' => $pro_name,
            'vendors' => $vendor,
            'items' => $so_detail,
            'taxes' => $tax,
            'conflict' => json_encode($conflict),
            'formula' => json_encode($formula),
            'link_post' => $link,
            'id_tax' => $id_tax,
            'status' => $status
        ]);
    }

    function se_view($id){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $so = Asset_sre::where('id', $id)->first();
        if (empty($so->se_input_at) && empty($so->ack_time) && empty($so->se_approved_at)){
            $link = URL::route('se.input_post');
            $status = "input";
        } elseif (empty($so->ack_time) && empty($so->se_approved_at)){
            $link = URL::route('se.ack_post');
            $status = "ack";
        } elseif (empty($so->se_approved_at) ){
            $link = URL::route('se.dir_post');
            $status = "dir";
        }  else {
            $link = "";
            $status = "";
        }
        $pro = Marketing_project::all();
        foreach ($pro as $value){
            $pro_name[$value->id] = $value->prj_name;
        }

        $so_detail = Asset_sre_detail::where('so_id', $id)->get();


        $tax = Pref_tax_config::all();
        foreach ($tax as $key => $value){
            $id_tax[] = $value->id;
            $conflict[$value->id] = json_decode($value->conflict_with);
            $formula[$value->id] = $value->formula;
        }

        $vendor = Procurement_vendor::all();

        return view('se.view', [
            'so' => $so,
            'pro' => $pro_name,
            'vendors' => $vendor,
            'items' => $so_detail,
            'taxes' => $tax,
            'conflict' => json_encode($conflict),
            'formula' => json_encode($formula),
            'link_post' => $link,
            'id_tax' => $id_tax,
            'status' => $status
        ]);
    }

    function se_approve(Request $request){
        $id = $request->id_fr;
        $pre = Asset_sre::find($id);

        $dir = public_path('media/asset/');

        $pre->suppliers = json_encode($request->vendor);
        $pre->ppns = (empty($request->tax)) ? null : json_encode($request->tax);
        $pre->dps = json_encode($request->dp);
        $pre->discs = json_encode($request->discount);
        $pre->tops = json_encode($request->terms_pay);
        $pre->notes = json_encode($request->notes);
        $pre->currencies = json_encode($request->currency);
        $pre->delivers = json_encode($request->d_to);
        $pre->deliver_times = json_encode($request->d_time);
        $pre->terms = json_encode($request->terms);
        $quot = $request->file('file_quot');
        if ($request->status == "input"){
            $pre->se_input_at = date('Y-m-d H:i:s');
            $pre->se_input_by = Auth::user()->username;
        } elseif ($request->status == "ack"){
            $pre->ack_by = Auth::user()->username;
            $pre->ack_time = date('Y-m-d H:i:s');
        } elseif ($request->status == "dir"){
            $pre->se_approved_by = Auth::user()->username;
            $pre->se_approved_at = date('Y-m-d H:i:s');
            $pre->se_approved_notes = $request->pev_notes;
            $paper = explode("/", $pre->se_num);
            $tag = $paper[1];

            // save to PO
            $pre_data = Asset_sre::where('id', $id)->first();
            $arr_idx = $request->radio;
            $d_to = $request->d_to;
            $d_time = $request->d_time;
            $curr_po = $request->currency;
            $disc_po = $request->discount;
            $dp_po = $request->dp;
            $ppn_po = $request->tax;
            $pay_term = $request->terms_pay;
            $term_po = $request->terms;
            $notes_po = $request->notes;
            $up_po = $request->unit_price;
            $qty_po = $request->qty;
//            dd($request->radio);
            $arrRomawi	= array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
            foreach ($arr_idx as $key => $value){
                $newidx = explode("-", $value);
                $newpo[end($newidx)][] = $key;
            }
//            dd($data);

            foreach ($newpo as $x => $pox){
                $po_num = Asset_wo::where('created_at', 'like', ''.date('Y')."-%")
                    ->where('wo_num', 'like', "%".$tag."%")
                    ->orderBy('id', 'desc')
                    ->first();
                if (!empty($po_num)) {
                    $last_num = explode("/", $po_num->wo_num);
                    $num = sprintf("%03d", (intval($last_num[0]) + 1));
                } else {
                    $num = sprintf("%03d", 1);
                }

                $supp_po = $request->vendor;

                $po = new Asset_wo();


                $po->created_by = $pre_data->created_by;
                $po->wo_type = $pre_data->so_type;
                $po->supplier_id = $supp_po[$x];
                $po->req_date = date('Y-m-d');
                $po->wo_num = $num."/".strtoupper($tag)."/WO/".$arrRomawi[date('n')]."/".date('y');
                $po->project = $pre_data->project;
                $po->division = $pre_data->division;
                $po->reference = $pre_data->se_num;
                $po->deliver_to = $d_to[$x];
                $po->deliver_time = $d_time[$x];
                $po->currency = $curr_po[$x];
                $po->discount = $disc_po[$x];
                $po->dp = $dp_po[$x];
                if (isset($ppn_po[$x])){
                    $po->ppn = json_encode($ppn_po[$x]);
                }
                $po->terms_payment = $pay_term[$x];
                $po->terms = $term_po[$x];
                $po->notes = $notes_po[$x];
                $po->so_note = $pre_data->so_notes;
                $po->company_id = $pre->company_id;
                $po->save();
                foreach ($pox as $idpo => $itempo){
                    $po_det = new Asset_wo_detail();
                    $det = Asset_sre_detail::where('id', $itempo)->first();

                    $po_det->job_desc = $det->job_desc;
                    $po_det->qty = $qty_po[$itempo];
                    $po_det->unit_price = $up_po[$itempo][$x];
                    $po_det->wo_id = $po->id;
                    $po_det->save();
                }
            }

        }
        if (!empty($quot)){
            for ($i = 0; $i < count($quot); $i++){
                if (isset($quot[$i])) {
                    $newName = "quotation_WO(".$id.")(".$i.").".$quot[$i]->getClientOriginalExtension();
                    $file_quot[] = $newName;
                    $quot[$i]->move($dir, $newName);
                } else {
                    $file_quot[] = null;
                }
            }
            $pre->attach1 = json_encode($file_quot);
        }
        $pre->save();

        $rad = $request->radio;
        $ids = $request->id_item;
        $up = $request->unit_price;
        for ($i=0; $i < count($ids); $i++){
            $pre_det = Asset_sre_detail::find($ids[$i]);
            $pre_det->unit_price = json_encode($up[$ids[$i]]);
            $idx = (!empty($rad[$ids[$i]])) ? explode("-", $rad[$ids[$i]]) : null;
            $pre_det->supp_idx = (!empty($rad[$ids[$i]])) ? end($idx) : null;
            $pre_det->save();
        }

        return redirect()->route('se.index');
    }

    function se_reject(Request $request){
        $id = $request->id;
        $pre = Asset_sre::find($id);
        $pre->se_rejected_by = Auth::user()->username;
        $pre->se_rejected_time = date('Y-m-d H:i:s');
        if ($pre->save()){
            $data['del'] = 1;
        } else {
            $data['del'] = 0;
        }

        return json_encode($data);
    }
}
