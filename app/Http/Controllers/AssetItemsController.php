<?php

namespace App\Http\Controllers;

use App\Models\Asset_good_receive;
use App\Models\Asset_item;
use App\Models\Asset_item_classification;
use App\Models\Asset_item_update;
use App\Models\Asset_new_category;
use App\Models\Asset_po;
use App\Models\Asset_po_detail;
use App\Models\Asset_qty_wh;
use App\Models\Asset_wh;
use App\Models\ConfigCompany;
use App\Models\General_do;
use App\Models\General_do_detail;
use App\Models\Procurement_vendor;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

class AssetItemsController extends Controller
{

    public function itemCodeFunction(Request $request){
        $code = $request->classification;
//        dd($request);
//        dd($code);
        $item = Asset_item::where('item_code','like','%'.$code.'%')
            ->orderBy('id','DESC')
            ->get();

        $countitem = count($item);
        if ($countitem >0){
            $item_code =$item[0]['item_code'];
            $lastdigit = substr($item_code, -3);
            $nextdigit = intval($lastdigit)+1;
            if($nextdigit < 10)
            {
                $nextdigit = "00".$nextdigit;
            } elseif ($nextdigit < 100 && $nextdigit >= 10){
                $nextdigit = "0".$nextdigit;

            }
            $CODE = strtoupper($code).$nextdigit;
        } else {
            $CODE = strtoupper($code)."001";
        }

        $data = [
            'data' => $CODE,
        ];
        return json_encode($data);
    }
    function indexInventory(){
        $vendor = Procurement_vendor::where('category', 'Supplier')->get();
        if (Session::get('company_child') != null){
            $childs = array();
            foreach (Session::get('company_child') as $item) {
                $childs[] = $item->id;
            }
            array_push($childs, Session::get('company_id'));
            $items = Asset_item::leftJoin('new_category as cat','cat.id','=','asset_items.category_id')
                ->select('asset_items.*','cat.name as catName')
//                ->where('asset_items.category_id', $category)
                ->whereIn('company_id', $childs)
                ->whereNull('asset_items.deleted_at')->get();
            $itemsup = Asset_item_update::where('approved_by', null)
                ->whereIn('company_id', $childs)
                ->get();
            $warehouses = Asset_wh::whereIn('company_id', $childs)->get();
        } else {
            $items = Asset_item::leftJoin('new_category as cat','cat.id','=','asset_items.category_id')
                ->select('asset_items.*','cat.name as catName')
//                ->where('asset_items.category_id', $category)
                ->where('company_id', Session::get('company_id'))
                ->whereNull('asset_items.deleted_at')->get();
            $itemsup = Asset_item_update::where('approved_by', null)
                ->where('company_id', Session::get('company_id'))
                ->get();
            $warehouses = Asset_wh::where('company_id', \Session::get('company_id'))->get();
        }
        $category = Asset_new_category::all();
        return view('items.indexInventory', [
            'vendor' => $vendor,
            'items' => $items,
            'itemsup' => count($itemsup),
            'categories' => $category,
            'warehouses' => $warehouses,
        ]);
    }

    function getItemWh($id_wh){
        $wh = Asset_wh::where('id', $id_wh)->first();
        $assetQtyWH= Asset_qty_wh::where('wh_id',$id_wh)->get();
        $itemsQty = [];
        $itemsId = [];
        foreach ($assetQtyWH as $Key => $value){
            $itemsQty[$value->item_id]['qty'] = $value->qty;
            $itemsId[] = $value->item_id;
        }
        if (Session::get('company_child') != null){
            $childs = array();
            foreach (Session::get('company_child') as $item) {
                $childs[] = $item->id;
            }
            array_push($childs, Session::get('company_id'));
            $items = Asset_item::leftJoin('new_category as cat','cat.id','asset_items.category_id')
                ->select('asset_items.*', 'cat.name as catName')
                ->whereIn('asset_items.company_id', $childs)
                ->get();
        } else {
            $items = Asset_item::leftJoin('new_category as cat','cat.id','asset_items.category_id')
                ->select('asset_items.*', 'cat.name as catName')
                ->where('asset_items.company_id', \Session::get('company_id'))
                ->get();
        }

        $item_name = [];
        $item_category = [];
        $item_code = [];
        $item_type = [];
        $item_uom = [];
        $item_comp_id = [];

        foreach ($items as $key => $val){
            $item_name[$val->id]['name'] = $val->name;
            $item_category[$val->id]['cat'] = $val->catName;
            $item_code[$val->id]['code'] = $val->item_code;
            $item_type[$val->id]['type'] = $val->type_id;
            $item_uom[$val->id]['uom'] = $val->uom;
            $item_comp_id[$val->id]['comp_id'] = $val->company_id;
        }

        $companies = ConfigCompany::all();
        $company = [];
        foreach ($companies as $key => $value){
            $company[$value->id]['comp_name'] = $value->tag;
        }
//        dd($itemsId);
        return view('wh.item_wh',[
            'item_name' => $item_name,
            'item_category' => $item_category,
            'item_code' => $item_code,
            'item_type' => $item_type,
            'itemsQty' => $itemsQty,
            'itemsId' => $itemsId,
            'item_uom' => $item_uom,
            'company' => $company,
            'wh' => $wh,
            'item_comp_id' => $item_comp_id,
        ]);
    }

    function indexClassification($category){
        if ($category == null){
            $classification = Asset_item_classification::leftJoin('new_category as cat','cat.id','=','asset_items_classification.id_category')
                ->select('asset_items_classification.*','cat.name as catName')
                ->get();
            $categories = Asset_new_category::all();
            $cat = '';
        } else {
            $classification = Asset_item_classification::leftJoin('new_category as cat','cat.id','=','asset_items_classification.id_category')
                ->select('asset_items_classification.*','cat.name as catName')
                ->where('asset_items_classification.id_category', $category)
                ->get();
            $categories = Asset_new_category::where('id', $category)->get();
            $cat = Asset_new_category::where('id', $category)->first();
        }

//        dd($classification);
        return view('item_class.index',[
            'classifications' => $classification,
            'categories' => $categories,
            'cat_id' => $category,
            'category' => $cat
        ]);

    }
    function index($category,$classification){
        
        $vendor = Procurement_vendor::where('category', 'Supplier')->get();
        
        $childs = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $childs[] = $item->id;
            }
            array_push($childs, Session::get('company_id'));
        }

        $_comp = ConfigCompany::select('id_parent')
            ->whereNotNull('id_parent')
            ->whereNotNull('inherit')
            ->where('id', Session::get('company_id'))
            ->get();
        foreach ($_comp as $item){
            $childs[] = $item->id_parent;
        }
        

        $items = Asset_item::leftJoin('new_category as cat','cat.id','=','asset_items.category_id')
            ->select('asset_items.*','cat.name as catName')
            ->where('asset_items.category_id', $category)
            ->where('asset_items.class_id', $classification)
            ->whereIn('company_id', $childs)
            ->whereNull('asset_items.deleted_at')->get();
        $itemsup = Asset_item_update::where('approved_by', null)
            ->whereIn('company_id', $childs)
            ->get();
        $warehouses = Asset_wh::whereIn('company_id', $childs)->get();


        $cat = Asset_new_category::where('id', $category)->first();
        $class = Asset_item_classification::all();

        return view('items.index', [
            'vendor' => $vendor,
            'items' => $items,
            'itemsup' => count($itemsup),
            'categories' => $cat,
            'warehouses' => $warehouses,
            'classification' => $class,
            'class' => $classification,
        ]);
    }

    function revision(){
        $vendor = Procurement_vendor::where('category', 'Supplier')->get();
        $items = Asset_item::all();
        foreach ($items as $item) {
            $data[$item->id]['name'] = $item->name;
            $data[$item->id]['type_id'] = $item->type_id;
            $data[$item->id]['item_code'] = $item->item_code;
            $data[$item->id]['minimal_stock'] = $item->minimal_stock;
            $data[$item->id]['uom'] = $item->uom;
        }
        if (Session::get('company_child') != null){
            $childs = array();
            foreach (Session::get('company_child') as $item) {
                $childs[] = $item->id;
            }
            array_push($childs, Session::get('company_id'));
            $itemsup = Asset_item_update::where('approved_by', null)
                ->whereIn('company_id', $childs)
                ->get();
        } else {
            $itemsup = Asset_item_update::where('approved_by', null)
                ->where('company_id', Session::get('company_id'))
                ->get();
        }

        return view('items.revision', [
            'vendor' => $vendor,
            'data' => $data,
            'itemsup' => $itemsup
        ]);
    }

    function revision_detail($id_item){
        $vendor = Procurement_vendor::where('category', 'Supplier')->get();
        foreach ($vendor as $value) {
            $vendor_name[$value->id] = $value->name;
        }
        $id = explode("-", base64_decode($id_item));
        $itemsup = Asset_item_update::where('id', end($id))->first();
        $item = Asset_item::where('id', $itemsup->id_item)->first();

        return view('items.revision_detail', [
            'vendor' => $vendor_name,
            'item' => $item,
            'itemsup' => $itemsup
        ]);
    }

    function revision_update(Request $request){
        $id = explode("-", base64_decode($request->item_id));
        $itemsup = Asset_item_update::where('id', end($id))->first();
        $items = Asset_item::find($itemsup->id_item);
        $items->name = $itemsup->name;
        $items->item_code = $itemsup->item_code;
        $items->item_series = $itemsup->item_series;
        $items->supplier = $itemsup->supplier;
        $items->price = $itemsup->price;
        $items->serial_number = $itemsup->serial_number;
        $items->type_id = $itemsup->type_id;
        $items->minimal_stock = $itemsup->minimal_stock;
        $items->uom = $itemsup->uom;
        $items->notes = $itemsup->notes;
        $items->specification = $itemsup->specification;
        if ($itemsup->picture == "del") {
            $items->picture = null;
        } elseif ($itemsup->picture != "" && !empty($itemsup->picture) && $itemsup->picture != "del") {
            $items->picture = $itemsup->picture;
        }

        Asset_item_update::where('id', end($id))
            ->update([
                'approved_at' => date('Y-m-d'),
                'approved_by' => Auth::user()->username
            ]);

        $items->save();

        return redirect()->route('items.revision');
    }

    function revision_delete(Request $request){
        $item = Asset_item_update::find($request->id);
        if ($item->delete()){
            $data['del'] = 1;
        } else {
            $item['del'] = 0;
        }

        return json_encode($data);
    }

    function addItem(Request $request){
//        dd($request);
        $items = new Asset_item();

        $file = $request->file('pict');

        $uploaddir = public_path('media/asset');


        $items->name = $request->item_name;
        $items->item_code = $request->item_code;
        $items->category_id = $request->category;
        $items->item_series = $request->item_series;
        $items->supplier = (isset($request->supplier))? $request->supplier : null;
//        $items->price = $request->price;
        $items->serial_number = $request->serial_number;
        $items->type_id = $request->type;
        $items->class_id = $request->classification;
        $items->minimal_stock = $request->min_stock;
        $items->uom = $request->uom;
        $items->notes = $request->notes;
        $items->specification = $request->specification;
        $items->company_id = Session::get('company_id');
        if (isset($file)) {
            $newName = $request->item_code."-".date('Y_m_d').".".$file->getClientOriginalExtension();
            $items->picture = $newName;
        }

        if ($items->save()) {

            if (isset($file)) {
                $file->move($uploaddir, $newName);
            }
            $item_id = $items->id;
            $warehouses = Asset_wh::where('company_id',\Session::get('company_id'))->get();
            foreach ($warehouses as $key => $value){
                $qty_wh = new Asset_qty_wh();
                $qty_wh->item_id = $item_id;
                $qty_wh->wh_id = $value->id;
                $qty_wh->qty = 0;
                $qty_wh->created_at = date('Y-m-d H:i:s');
                $qty_wh->save();
            }

        }

        return redirect()->back();
    }

    function delete(Request $request){
        $item = Asset_item::find($request->id);
        if ($item->delete()){
            $data['del'] = 1;
        } else {
            $item['del'] = 0;
        }

        return json_encode($data);
    }

    function find_item(Request $request) {
        $item = Asset_item::where('id', $request->id)->first();

        $warehouse = Asset_qty_wh::where('item_id', $request->id)->get();
        $qtywh = array();
        foreach ($warehouse as $key => $value){
            $qtywh[$value->wh_id] = $value->qty;
        }

        $val = array('item' => $item,'qtywh' => $qtywh);

        return json_encode($val);
    }

    function find_transaction($id){
        $items = Asset_item::find($id);
        $do_details = General_do_detail::where('item_id', $items->item_code)->get();
        $dataDo = General_do::all();
        $whData = Asset_wh::all();
        $wh = array();
        $data = array();
        foreach ($whData as $item){
            $wh[$item->id] = $item;
        }
        $do = array();
        foreach ($dataDo as $item){
            $do[$item->id] = $item;
        }

        $poData = Asset_po::all();
        foreach ($poData as $item){
            $po[$item->id] = $item;
        }

        $poDetailData = Asset_po_detail::where('item_id', $items->item_code)->get();

        $grData = Asset_good_receive::all();
        foreach ($grData as $item){
            $gr[$item->po_num] = $item;
        }

        foreach ($poDetailData as $item){
            $iGr = (isset($gr[$po[$item->po_num]->po_num])) ? $gr[$po[$item->po_num]->po_num] : null;
            if (!empty($iGr)){
                $row['no'] = "";
                $row['date'] = $iGr->gr_date;
                $row['description'] = "Good Received";
                $row['paper'] = $iGr->po_num;
                $row['warehouse'] = $wh[$iGr->wh_id]->name;
                $row['amount'] = $item->qty;
                $data[] = $row;
            }
        }

        foreach ($do_details as $item){
            $description = ($item->type == "Transfer") ? "Transfer" : "Use";
            $row['no'] = "";
            $row['date'] = $do[$item->do_id]->deliver_date;
            $row['description'] = "DO - ".$description;
            $row['paper'] = $do[$item->do_id]->no_do;
            $row['warehouse'] = $wh[$do[$item->do_id]->from_id]->name;
            $row['amount'] = $item->qty*-1;
            $data[] = $row;
            if ($item->type == "Transfer"){
                $row['no'] = "";
                $row['date'] = $do[$item->do_id]->deliver_date;
                $row['description'] = "DO - ".$description;
                $row['paper'] = $do[$item->do_id]->no_do;
                $row['warehouse'] = $wh[$do[$item->do_id]->to_id]->name;
                $row['amount'] = $item->qty;
                $data[] = $row;
            }
        }

        if (count($data) > 0){
            usort($data, function ($a, $b){
                if ($a["date"] == $b["date"])
                    return (0);
                return (($a["date"] > $b["date"]) ? -1 : 1);
            });
        }

        $val = array(
            "data" => $data
        );

        return json_encode($val);
    }

    function edit_item(Request $request){
//        dd($request->wh);

        $items = new Asset_item_update();
        $file = $request->file('pict');
        $uploaddir = public_path('media/asset');
        $itemup = Asset_item_update::where('id_item', $request->id_item)->get();
        if (count($itemup) == 0) {
            $count = 1;
        } else {
            $count = count($itemup) + 1;
        }
        $del_pict = $request->del_pict;
        if (isset($del_pict)) {
            $items->picture = "del";
        } else {
            if (isset($file)) {
                $newName = $request->item_code."-".date('Y_m_d')."(".$count.").".$file->getClientOriginalExtension();
                $items->picture = $newName;
            }
        }

        $items->id_item = $request->id_item;
        $items->name = $request->item_name;
//        $items->item_code = $request->item_code;
        $items->item_series = $request->item_series;
        $items->supplier = $request->supplier;
        $items->price = $request->price;
        $items->serial_number = $request->serial_number;
        $items->type_id = $request->type;
        $items->minimal_stock = $request->min_stock;
        $items->uom = $request->uom;
        $items->notes = $request->notes;
        $items->specification = $request->specification;
        $items->company_id = Session::get('company_id');
        $items->created_by = Auth::user()->username;

        if ($items->save()) {
            $warehouses = $request->wh;
            if (isset($file)) {
                $file->move($uploaddir, $newName);
            }
            foreach ($warehouses as $key => $value){
                Asset_qty_wh::where('item_id', $request->id_item)
                    ->where('wh_id',$key)
                    ->update([
                        'qty' => $value
                    ]);
            }
        }

        return redirect()->back();
    }
}
