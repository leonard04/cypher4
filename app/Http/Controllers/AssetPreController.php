<?php

namespace App\Http\Controllers;

use App\Models\Asset_item;
use App\Models\Asset_po;
use App\Models\Asset_po_detail;
use App\Models\Asset_pre_detail;
use App\Models\Pref_tax_config;
use App\Models\Procurement_vendor;
use Illuminate\Http\Request;
use App\Models\Asset_pre;
use App\Models\Marketing_project;
use DB;
use Illuminate\Support\Facades\URL;
use Session;
use Illuminate\Support\Facades\Auth;

class AssetPreController extends Controller
{
    public function indexFr(){
        $projects = Marketing_project::where('company_id',\Session::get('company_id'))
            ->get();
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $frwaiting = DB::table('asset_pre')
            ->join('marketing_projects as projects','projects.id','=','asset_pre.project')
            ->select('asset_pre.*','projects.prj_name as prj_name',
                DB::raw('(SELECT COUNT(asset_pre_detail.id) FROM asset_pre_detail WHERE asset_pre_detail.fr_id = asset_pre.id) AS items'),
                DB::raw('(SELECT SUM(asset_pre_detail.qty) FROM asset_pre_detail WHERE asset_pre_detail.fr_id = asset_pre.id) AS qty'),
                DB::raw('(SELECT SUM(asset_pre_detail.delivered) FROM asset_pre_detail WHERE asset_pre_detail.fr_id = asset_pre.id) AS delivered'))
            ->whereNull('asset_pre.fr_delivers')
            ->whereNull('asset_pre.fr_rejected_at')
            ->WhereNull('asset_pre.fr_division_rejected_at')
            ->whereNull('asset_pre.deleted_at')
            ->whereIn('asset_pre.company_id', $id_companies)
            ->orderBy('asset_pre.id','DESC')
            ->get();
        $frbank = DB::table('asset_pre')
            ->join('marketing_projects as projects','projects.id','=','asset_pre.project')
            ->select('asset_pre.*','projects.prj_name as prj_name',
                DB::raw('(SELECT COUNT(asset_pre_detail.id) FROM asset_pre_detail WHERE asset_pre_detail.fr_id = asset_pre.id) AS items'),
                DB::raw('(SELECT SUM(asset_pre_detail.qty) FROM asset_pre_detail WHERE asset_pre_detail.fr_id = asset_pre.id) AS qty'),
                DB::raw('(SELECT SUM(asset_pre_detail.delivered) FROM asset_pre_detail WHERE asset_pre_detail.fr_id = asset_pre.id) AS delivered'))
            ->whereNotNull('asset_pre.fr_delivers')
            ->whereNotNull('asset_pre.fr_approved_at')
            ->WhereNotNull('asset_pre.fr_division_approved_at')
            ->whereNull('asset_pre.deleted_at')
            ->whereIn('asset_pre.company_id', $id_companies)
            ->orderBy('asset_pre.id','DESC')
            ->get();
        $frreject = DB::table('asset_pre')
            ->join('marketing_projects as projects','projects.id','=','asset_pre.project')
            ->select('asset_pre.*','projects.prj_name as prj_name',
                DB::raw('(SELECT COUNT(asset_pre_detail.id) FROM asset_pre_detail WHERE asset_pre_detail.fr_id = asset_pre.id) AS items'),
                DB::raw('(SELECT SUM(asset_pre_detail.qty) FROM asset_pre_detail WHERE asset_pre_detail.fr_id = asset_pre.id) AS qty'),
                DB::raw('(SELECT SUM(asset_pre_detail.delivered) FROM asset_pre_detail WHERE asset_pre_detail.fr_id = asset_pre.id) AS delivered'))
            ->whereNotNull('asset_pre.fr_rejected_at')
            ->whereNull('asset_pre.deleted_at')
            ->whereIn('asset_pre.company_id', $id_companies)
            ->orWhereNotNull('asset_pre.fr_division_rejected_at')
            ->orderBy('asset_pre.id','DESC')
            ->get();
//        dd($fr);
//        dd($frwaiting);
        return view('fr.index',[
            'waitings' => $frwaiting,
            'banks' => $frbank,
            'rejects' => $frreject,
            'projects' => $projects,
        ]);
    }

    public function getItems(){
       $items = Asset_item::where('company_id', \Session::get('company_id'))
           ->where('item_code','like','%'.$_GET['term'].'%')
           ->orWhere('name','like','%'.$_GET['term'].'%')
           ->get();
       $return_arr =[];
       foreach ($items as $key => $item){
           $row_array['item_category'] = $item->category_id;
           $row_array['item_id'] = $item->id;
           $row_array['item_name'] = $item->name;
           $row_array['item_code'] = $item->item_code;
           $row_array['item_uom'] = trim($item->uom);

           $row_array['value'] = $item->item_code." / ".$item->name." (".trim($item->uom).")";

           array_push($return_arr, $row_array);
       }
        echo json_encode($return_arr);
    }

    public function getProject($cat){
        $arr = array(
            'category' => $cat,
        );

        $projects = Marketing_project::where('company_id',\Session::get('company_id'))
            ->where($arr)->get();

        $data = [];
        foreach ($projects as $value){
            $data[] = array(
                "id" => $value->id,
                "text" => $value->prj_name
            );
        }
        return response()->json($data);

    }

    public function nextDocNumber($code,$year){
        $cek = Asset_pre::where('fr_num','like','%'.$code.'%')
            ->where('fr_date','like','%'.date('y').'-%')
            ->where('company_id', \Session::get('company_id'))
            ->whereNull('deleted_at')
            ->orderBy('id','DESC')
            ->get();

        if (count($cek) > 0){
            $frNum = $cek[0]->fr_num;
            $frDate = $cek[0]->fr_date;
            $str = explode('/', $frNum);
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

    public function addFr(Request $request){
        $iRequest = new Asset_pre();

        $arrRomawi	= array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
//        echo '<pre>'.print_r($request->id_item,1).'</pre>';
        $request_date = date("Y-m-d", strtotime($request['request_date']));
        $fr_num = $this->nextDocNumber(strtoupper(\Session::get('company_tag')).'/FR',$request_date);
//        dd($fr_num);
        $fr_num_id = sprintf('%03d',$fr_num).'/'.strtoupper(\Session::get('company_tag')).'/FR/'.$arrRomawi[date("n")].'/'.date("y");
        $iRequest->fr_num = $fr_num_id;
        $iRequest->request_by = Auth::user()->username;

        $iRequest->request_at = $request_date;
        $iRequest->fr_date = date("Y-m-d", strtotime($request['request_date']));
        $iRequest->due_date = date("Y-m-d", strtotime($request['due_date']));
        $iRequest->project = $request['project'];
        $iRequest->division = $request['division'];
        $iRequest->fr_type = $request['fr_type'];
        $iRequest->fr_notes = $request['notes'];
        $iRequest->company_id = \Session::get('company_id');
        if (isset($request['bd'])){
            $iRequest->bd = 1;
        } else {
            $iRequest->bd = 0;
        }
        $iRequest->company_id = \Session::get('company_id');

        $uploaddir  = public_path('media\\asset');
        $justiInput = $request->file('justification');
        if (!empty($justiInput)){
            $justi      = $fr_num_id."-justification.".$justiInput->getClientOriginalExtension();
            $iRequest->justification = $justi;
            $justiInput->move($uploaddir,$justi);
        }


        $iRequest->save();
        $last_id = $iRequest->id;

        foreach ($request->code as $key => $itemCode){
            $iRequestDetail = new Asset_pre_detail();
            $iRequestDetail->fr_id = $last_id;
            $iRequestDetail->item_id = $itemCode;
            $iRequestDetail->qty = $request['qty'][$key];
            $iRequestDetail->save();
        }

        return redirect()->route('fr.index');

    }

    public function frView($id,$code=null){
        $fr = Asset_pre::where('id',$id)->first();
        $fr_detail = DB::table('asset_pre_detail')
            ->join('asset_items as items','items.item_code','=','asset_pre_detail.item_id')
            ->select('asset_pre_detail.*','items.name as itemName','items.uom as uom')
            ->where('asset_pre_detail.fr_id',$fr->id)->get();
            //Asset_pre_detail::where('fr_id',$fr->fr_id)->get();
        $project = Marketing_project::where('id',$fr->project)->first();

        return view('fr.frview',[
           'fr' => $fr,
           'fr_detail' => $fr_detail,
           'project' => $project,
           'code' => base64_decode($code),
        ]);
    }

    public function prView($id,$code=null){
        $pr = Asset_pre::where('id',$id)->first();
        $pr_detail = DB::table('asset_pre_detail')
            ->join('asset_items as items','items.item_code','=','asset_pre_detail.item_id')
            ->select('asset_pre_detail.*','items.name as itemName','items.uom as uom')
            ->where('asset_pre_detail.fr_id',$pr->id)->get();

        $project = Marketing_project::where('id',$pr->project)->first();
        return view('pr.prview',[
            'pr' => $pr,
            'pr_detail' => $pr_detail,
            'project' => $project,
            'code' => base64_decode($code),
        ]);
    }

    public function apprDiv(Request $request){
        if ($request['submit'] == 'Approve'){
            Asset_pre::where('id', $request['fr_id'])
                ->update([
                    'fr_division_approved_by' => Auth::user()->username,
                    'fr_division_approved_at' => date('Y-m-d H:i:s'),
                    'fr_approved_notes' => $request['notes']
                ]);
        }
        if ($request['submit'] == 'Reject'){
            Asset_pre::where('id', $request['fr_id'])
                ->update([
                    'fr_division_rejected_by' => Auth::user()->username,
                    'fr_division_rejected_at' => date('Y-m-d H:i:s'),
                    'fr_rejected_notes' => $request['notes']
                ]);
        }

        return redirect()->route('fr.index');
    }

    public function apprDir(Request $request){
        if ($request['submit'] == 'Approve'){
            $frnum = $request['fr_num'];
            $pev_num = str_replace("FR","PEV",$frnum);
            Asset_pre::where('id', $request['id'])
                ->update([
                    'pev_num' => $pev_num,
                    'pre_approved_by' => Auth::user()->username,
                    'pre_approved_at' => date('Y-m-d H:i:s'),
                    'pre_approved_notes' => $request['notes'],
                    'pre_notes' => $request['notes']
                ]);
            foreach ($request['qty_appr'] as $key => $qtyAppr){
                Asset_pre_detail::where('fr_id',$request['id'])
                    ->update([
                        'pev_num' => $pev_num,
                        'pre_id' => $request['id'],
                        'item_id' => $request['item'][$key],
                        'qty_appr' =>$request['qty_appr'][$key],
                    ]);
            }
        }
        if ($request['submit'] == 'Reject'){
            Asset_pre::where('id', $request['id'])
                ->update([
                    'pre_rejected_by' => Auth::user()->username,
                    'pre_rejected_at' => date('Y-m-d H:i:s'),
                    'pre_rejected_notes' => $request['notes']
                ]);
        }

        return redirect()->route('pr.index');
    }

    public function apprAsset(Request $request){
        if ($request['submit'] == 'Approve'){
            $frnum = $request['fr_num'];
            $pre_num = str_replace("FR","PRE",$frnum);
            Asset_pre::where('id', $request['fr_id'])
                ->update([
                    'fr_approved_by' => Auth::user()->username,
                    'fr_approved_at' => date('Y-m-d H:i:s'),
                    'fr_approved_notes' => $request['notes'],
                    'pre_num' => $pre_num,
                    'pre_date' => date('Y-m-d'),
                ]);
            if(!empty(array_filter($request['qty_buy']))) {
                foreach ($request['qty_buy'] as $key => $qty_buy){
                    Asset_pre_detail::where('id',$request['fr_detail_id'][$key])
                        ->update([
                            'item_id' => $request['fr_detail_code'][$key],
                            'qty_req' => $qty_buy,
                            'pre_num' => $pre_num,
                        ]);
                }
            }
            if(!empty(array_filter($request['qty_deliver']))){
                foreach($request['qty_deliver'] as $key => $qty_deliver) {
                    Asset_pre_detail::where('id',$request['fr_detail_id'][$key])
                        ->update([
                            'delivered' => $qty_deliver,
                            'qty_deliver' => $qty_deliver,
                        ]);
                }
            }
        }
        if ($request['submit'] == 'Reject'){
            Asset_pre::where('id', $request['fr_id'])
                ->update([
                    'fr_rejected_by' => Auth::user()->username,
                    'fr_rejected_at' => date('Y-m-d H:i:s'),
                    'fr_rejected_notes' => $request['notes']
                ]);
        }

        return redirect()->route('fr.index');
    }

    public function apprDeliver(Request $request){
        if ($request['submit'] == 'Approve'){
            foreach($request['remnant'] as $key => $remnant){
                $delivered = $remnant;
                $sisa = intval($request['qty_remnant'][$key]) - intval($delivered);
                if ($sisa >= 0){
                    Asset_pre_detail::where('id',$request['fr_detail_id'][$key])
                        ->update([
                            'delivered' => intval($request['qty_deliver'][$key])+intval($remnant),
                        ]);

                    if ($sisa == 0){
                        Asset_pre::where('id',$request['fr_id'])
                            ->update([
                                'fr_delivers' => 'delivered',
                                'fr_deliver_times' => date('Y-m-d H:i:s'),
                            ]);
                    }
                }
            }
        }
        return redirect()->route('fr.index');
    }

    public function indexPr(){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $prwaiting = DB::table('asset_pre')
            ->join('marketing_projects as projects','projects.id','=','asset_pre.project')
            ->select('asset_pre.*','projects.prj_name as prj_name',
                DB::raw('(SELECT COUNT(asset_pre_detail.id) FROM asset_pre_detail WHERE asset_pre_detail.fr_id = asset_pre.id) AS items'),
                DB::raw('(SELECT SUM(asset_pre_detail.qty) FROM asset_pre_detail WHERE asset_pre_detail.fr_id = asset_pre.id) AS qty'),
                DB::raw('(SELECT SUM(asset_pre_detail.delivered) FROM asset_pre_detail WHERE asset_pre_detail.fr_id = asset_pre.id) AS delivered'))
            ->where('asset_pre.request_at','like','%'.date('Y').'%')
            ->whereNotNull('asset_pre.fr_approved_at')
            ->whereNotNull('asset_pre.fr_approved_by')
            ->whereNull('asset_pre.pre_approved_at')
            ->whereNull('asset_pre.pre_rejected_at')
            ->whereNull('asset_pre.deleted_at')
            ->whereIn('asset_pre.company_id', $id_companies)
            ->orderBy('asset_pre.id','DESC')
            ->get();
        $prbank = DB::table('asset_pre')
            ->join('marketing_projects as projects','projects.id','=','asset_pre.project')
            ->select('asset_pre.*','projects.prj_name as prj_name',
                DB::raw('(SELECT COUNT(asset_pre_detail.id) FROM asset_pre_detail WHERE asset_pre_detail.fr_id = asset_pre.id) AS items'),
                DB::raw('(SELECT SUM(asset_pre_detail.qty) FROM asset_pre_detail WHERE asset_pre_detail.fr_id = asset_pre.id) AS qty'),
                DB::raw('(SELECT SUM(asset_pre_detail.delivered) FROM asset_pre_detail WHERE asset_pre_detail.fr_id = asset_pre.id) AS delivered'))
            ->where('asset_pre.request_at','like','%'.date('Y').'%')
            ->whereNotNull('asset_pre.fr_approved_at')
            ->whereNotNull('asset_pre.fr_approved_by')
            ->whereNotNull('asset_pre.pre_approved_at')
            ->whereNull('asset_pre.pre_rejected_at')
            ->whereNull('asset_pre.deleted_at')
            ->whereIn('asset_pre.company_id', $id_companies)
            ->orderBy('asset_pre.id','DESC')
            ->get();
        $prreject = DB::table('asset_pre')
            ->join('marketing_projects as projects','projects.id','=','asset_pre.project')
            ->select('asset_pre.*','projects.prj_name as prj_name',
                DB::raw('(SELECT COUNT(asset_pre_detail.id) FROM asset_pre_detail WHERE asset_pre_detail.fr_id = asset_pre.id) AS items'),
                DB::raw('(SELECT SUM(asset_pre_detail.qty) FROM asset_pre_detail WHERE asset_pre_detail.fr_id = asset_pre.id) AS qty'),
                DB::raw('(SELECT SUM(asset_pre_detail.delivered) FROM asset_pre_detail WHERE asset_pre_detail.fr_id = asset_pre.id) AS delivered'))
            ->whereNotNull('asset_pre.fr_approved_at')
            ->whereNotNull('asset_pre.fr_approved_by')
            ->whereNotNull('asset_pre.pre_rejected_at')
            ->whereNull('asset_pre.deleted_at')
            ->whereIn('asset_pre.company_id', $id_companies)
            ->orderBy('asset_pre.id','DESC')
            ->get();

        return view('pr.index',[
            'waitings' => $prwaiting,
            'banks' => $prbank,
            'rejects' => $prreject,
        ]);
    }

    public function delete($id,$code){
        Asset_pre::where('id',$id)->delete();
        Asset_pre_detail::where('fr_id',$id)->delete();
        if ($code == 'fr'){
            return redirect()->route('fr.index');
        } else {
            return redirect()->route('pr.index');
        }
    }

    // PEV
    function indexPev(){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $pev = Asset_pre::where('pev_num', '!=', null)
            ->whereIn('company_id', $id_companies)
            ->get();
        $pev_detail = Asset_pre_detail::all();
        $pev_items = array();
        foreach ($pev_detail as $value){
            $pev_items[$value->fr_id][] = $value->qty;
        }
        $pro = Marketing_project::whereIn('company_id', $id_companies)->get();
        $pro_name = array();
        foreach ($pro as $value){
            $pro_name[$value->id] = $value->prj_name;
        }
        return view('pe.index', [
            'pev' => $pev,
            'pro' => $pro_name,
            'items' => $pev_items
        ]);
    }

    function pc_apprPev($id){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $pev = Asset_pre::where('id', $id)->first();
        if (empty($pev->pev_date) && empty($pev->pev_approved_at)){
            $link = URL::route('pe.input_post');
            $status = "input";
        } elseif (empty($pev->pev_approved_at)){
            $link = URL::route('pe.dir_post');
            $status = "dir";
        } else {
            $link = "";
            $status = "";
        }
        $pro = Marketing_project::whereIn('company_id', $id_companies)->get();
        $pro_name = array();
        foreach ($pro as $value){
            $pro_name[$value->id] = $value->prj_name;
        }

        $pev_detail = Asset_pre_detail::where('fr_id', $id)->get();

        $items = Asset_item::all();
        foreach ($items as $item) {
            $item_name[$item->item_code] = $item->name;
            $item_uom[$item->item_code] = $item->uom;
        }

        $po_det = Asset_po_detail::orderBy('id', 'DESC')->get();
        $price = array();
        foreach ($po_det as $item) {
            $price[$item->item_id][] = $item->price;
        }

        $tax = Pref_tax_config::whereIn('company_id', $id_companies)->get();
        foreach ($tax as $key => $value){
            $id_tax[] = $value->id;
            $conflict[$value->id] = json_decode($value->conflict_with);
            $formula[$value->id] = $value->formula;
        }

        $vendor = Procurement_vendor::whereIn('company_id', $id_companies)->get();

        return view('pe.pc_appr', [
            'pev' => $pev,
            'pro' => $pro_name,
            'vendors' => $vendor,
            'items' => $pev_detail,
            'item_name' => $item_name,
            'uom' => $item_uom,
            'prices' => $price,
            'taxes' => $tax,
            'conflict' => json_encode($conflict),
            'formula' => json_encode($formula),
            'link_post' => $link,
            'id_tax' => $id_tax,
            'status' => $status
        ]);
    }

    function pev_view($id){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $pev = Asset_pre::where('id', $id)->first();
        if (empty($pev->pev_date) && empty($pev->pc_time) && empty($pev->pev_division_approved_at) && empty($pev->pev_approved_at)){
            $link = URL::route('pe.input_post');
            $status = "input";
        } elseif (empty($pev->pc_time) && empty($pev->pev_division_approved_at) && empty($pev->pev_approved_at)){
            $link = URL::route('pe.pc_post');
            $status = "pc";
        } elseif (empty($pev->pev_division_approved_at) && empty($pev->pev_approved_at)){
            $link = URL::route('pe.div_post');
            $status = "div";
        } elseif (empty($pev->pev_approved_at)){
            $link = URL::route('pe.dir_post');
            $status = "dir";
        } else {
            $link = "";
            $status = "";
        }
        $pro = Marketing_project::whereIn('company_id', $id_companies)->get();
        foreach ($pro as $value){
            $pro_name[$value->id] = $value->prj_name;
        }

        $pev_detail = Asset_pre_detail::where('fr_id', $id)->get();

        $items = Asset_item::all();
        foreach ($items as $item) {
            $item_name[$item->item_code] = $item->name;
            $item_uom[$item->item_code] = $item->uom;
        }

        $po_det = Asset_po_detail::orderBy('id', 'DESC')->get();
        $price = array();
        foreach ($po_det as $item) {
            $price[$item->item_id][] = $item->price;
        }

        $tax = Pref_tax_config::all();
        foreach ($tax as $key => $value){
            $id_tax[] = $value->id;
            $conflict[$value->id] = json_decode($value->conflict_with);
            $formula[$value->id] = $value->formula;
        }

        $vendor = Procurement_vendor::all();

        return view('pe.view', [
            'pev' => $pev,
            'pro' => $pro_name,
            'vendors' => $vendor,
            'items' => $pev_detail,
            'item_name' => $item_name,
            'uom' => $item_uom,
            'prices' => $price,
            'taxes' => $tax,
            'conflict' => json_encode($conflict),
            'formula' => json_encode($formula),
            'link_post' => $link,
            'id_tax' => $id_tax,
            'status' => $status
        ]);
    }

    function pc_postPev(Request $request){
//        dd($request);
        $id = $request->id_fr;
        $pre = Asset_pre::find($id);

        $dir = public_path('media/asset/');

        $pre->pev_date = date('Y-m-d H:i:s');
        $pre->suppliers = json_encode($request->vendor);
        $pre->ppns = (empty($request->tax)) ? null : json_encode($request->tax);
        $pre->dps = json_encode($request->dp);
        $pre->discs = json_encode($request->discount);
        $pre->tops = json_encode($request->terms_pay);
        $pre->pev_notes = json_encode($request->notes);
        $pre->currencies = json_encode($request->currency);
        $pre->delivers = json_encode($request->d_to);
        $pre->deliver_times = json_encode($request->d_time);
        $pre->terms = json_encode($request->terms);
        $quot = $request->file('file_quot');
        if ($request->status == "pc"){
            $pre->pc_by = Auth::user()->username;
            $pre->pc_time = date('Y-m-d H:i:s');
        } elseif ($request->status == "div"){
            $pre->pev_division_approved_by = Auth::user()->username;
            $pre->pev_division_approved_at = date('Y-m-d H:i:s');
        } elseif ($request->status == "dir"){
            $pre->pev_approved_by = Auth::user()->username;
            $pre->pev_approved_at = date('Y-m-d H:i:s');
            $pre->pev_approved_notes = $request->pev_notes;
            $paper = explode("/", $pre->pev_num);
            $tag = $paper[1];

            // save to PO
            $pre_data = Asset_pre::where('id', $id)->first();
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
            $arrRomawi	= array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
            foreach ($arr_idx as $key => $value){
                $newidx = explode("-", $value);
                $newpo[end($newidx)][] = $key;
            }
//            dd($newpo);

            foreach ($newpo as $x => $pox){
                $po_num = Asset_po::where('created_at', 'like', ''.date('Y')."-%")
                    ->where('po_num', 'like', "%".$tag."%")
                    ->orderBy('id', 'desc')
                    ->first();
                if (!empty($po_num)) {
                    $last_num = explode("/", $po_num->po_num);
                    $num = sprintf("%03d", (intval($last_num[0]) + 1));
                } else {
                    $num = sprintf("%03d", 1);
                }

                $supp_po = $request->vendor;

                $po = new Asset_po;


                $po->request_by = $pre_data->request_by;
                $po->supplier_id = $supp_po[$x];
                $po->po_date = date('Y-m-d');
                $po->po_type = $pre_data->fr_type;
                $po->po_num = $num."/".strtoupper($tag)."/PO/".$arrRomawi[date('n')]."/".date('y');
                $po->project = $pre_data->project;
                $po->division = $pre_data->division;
                $po->reference = $pre_data->pev_num;
                $po->deliver_to = $d_to[$x];
                $po->deliver_time = $d_time[$x];
                $po->currency = $curr_po[$x];
                $po->discount = $disc_po[$x];
                $po->dp = $dp_po[$x];
                if (isset($ppn_po[$x])){
                    $po->ppn = json_encode($ppn_po[$x]);
                }
                $po->payment_term = $pay_term[$x];
                $po->terms = $term_po[$x];
                $po->notes = $notes_po[$x];
                $po->fr_note = $pre_data->fr_approved_notes;
                $po->company_id = $pre->company_id;
                $po->save();
                foreach ($pox as $idpo => $itempo){
                    $po_det = new Asset_po_detail();
                    $det = Asset_pre_detail::where('id', $itempo)->first();

                    $po_det->item_id = $det->item_id;
                    $po_det->qty = $qty_po[$itempo];
                    $po_det->price = $up_po[$itempo][$x];
                    $po_det->po_num = $po->id;
                    $po_det->save();
                }
            }

        }
        if (!empty($quot)){
            for ($i = 0; $i < count($quot); $i++){
                if (isset($quot[$i])) {
                    $newName = "quotation(".$id.")(".$i.").".$quot[$i]->getClientOriginalExtension();
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
            $pre_det = Asset_pre_detail::find($ids[$i]);
            $pre_det->price = json_encode($up[$ids[$i]]);
            $idx = (!empty($rad[$ids[$i]])) ? explode("-", $rad[$ids[$i]]) : null;
            $pre_det->supp_idx = (!empty($rad[$ids[$i]])) ? end($idx) : null;
            $pre_det->save();
        }

        return redirect()->route('pe.index');
    }

    function rejectPev(Request $request){
        $id = $request->id;
        $pre = Asset_pre::find($id);
        $pre->pev_rejected_by = Auth::user()->username;
        $pre->pev_rejected_time = date('Y-m-d H:i:s');
        if ($pre->save()){
            $data['del'] = 1;
        } else {
            $data['del'] = 0;
        }

        return json_encode($data);
    }

}
