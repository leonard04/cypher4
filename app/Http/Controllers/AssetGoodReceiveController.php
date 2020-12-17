<?php

namespace App\Http\Controllers;

use App\Models\Asset_good_receive;
use App\Models\Asset_item;
use App\Models\Asset_po;
use App\Models\Asset_po_detail;
use App\Models\Asset_qty_wh;
use App\Models\Asset_type_po;
use App\Models\Asset_wh;
use App\Models\Marketing_project;
use App\Models\Pref_tax_config;
use App\Models\Procurement_vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AssetGoodReceiveController extends Controller
{
    public function index(){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $po = Asset_po::whereIn('company_id', $id_companies)->get();
        $po_det = Asset_po_detail::all();
        $price = array();
        $qty = array();
        foreach ($po_det as $value){
            $qty[$value->po_num][] = $value->qty;
            $price[$value->po_num][] = $value->price;
        }
        $po_type = Asset_type_po::all();
        $id_tax = [];
        $conflict = [];
        $formula = [];

        $tax = Pref_tax_config::all();
        foreach ($tax as $key => $value){
            $id_tax[] = $value->id;
            $conflict[$value->id] = json_decode($value->conflict_with);
            $formula[$value->id] = $value->formula;
        }
        $pro = Marketing_project::all();
        $pro_name = array();
        foreach ($pro as $value){
            $pro_name[$value->id] = $value->prj_name;
        }

        $vendor = Procurement_vendor::all();
        $vendor_name = array();
        foreach ($vendor as $item) {
            $vendor_name[$item->id] = $item->name;
        }

        return view('gr.index',[
            'po' => $po,
            'pro_name' => $pro_name,
            'vendor_name' => $vendor_name,
            'formula' => $formula,
            'qty_det' => $qty,
            'price_det' => $price,
            'po_type' => $po_type,
            'tax' => $tax
        ]);
    }

    public function getDetail($id, $type =null){
        $wh = Asset_wh::where('company_id', \Session::get('company_id'))->get();
        $po = Asset_po::where('id', $id)->first();
        $po_detail = Asset_po_detail::all();

        $vendor = Procurement_vendor::all();
        foreach ($vendor as $item) {
            $vendor_name[$item->id] = $item->name;
        }
        $items = Asset_item::all();
        $item_name =[];
        $item_code =[];
        $item_uom =[];
        foreach ($items as $item) {
            $item_name[$item->item_code] = $item->name;
            $item_code[$item->item_code] = $item->item_code;
            $item_uom[$item->item_code] = $item->uom;
        }

        $vendor = Procurement_vendor::all();
        $vendor_name = [];
        foreach ($vendor as $item) {
            $vendor_name[$item->id] = $item->name;
        }
        $pro_name = [];

        $pro = Marketing_project::all();
        foreach ($pro as $value){
            $pro_name[$value->id] = $value->prj_name;
        }


        return view('gr.detail',[
            'po' => $po,
            'po_detail' => $po_detail,
            'item_name' => $item_name,
            'item_code' => $item_code,
            'item_uom' => $item_uom,
            'vendor_name' => $vendor_name,
            'pro_name' => $pro_name,
            'type' => $type,
            'whs' => $wh,
        ]);
    }

    public function approveGR(Request $request){
//         dd($request);
        Asset_po::where('id',$request['po_id'])
            ->update([
                'gr_date' => $request['receive_date'],
            ]);

        $gr = new Asset_good_receive();
        $gr->po_num = $request['po_num'];
        $gr->gr_date = $request['receive_date'];
        $gr->wh_id = $request['warehouse'];
        $gr->gr_by = Auth::user()->username;
        $gr->notes = $request['notes'];
        $gr->created_at = date('Y-m-d H:i:s');
        $gr->save();

        $po_details = Asset_po_detail::where('po_num', $request['po_id'])->get();
        foreach ($po_details as $key => $val){
            $item = Asset_item::where('item_code', $val->item_id)->first();
            $qtywh = Asset_qty_wh::where('wh_id', $request['warehouse'])
                ->where('item_id', $item->id)->get();
            if (count($qtywh)>0){
                $qtyold = intval($qtywh[0]->qty);
                $qtynew = intval($val->qty) + $qtyold;
                Asset_qty_wh::where('wh_id', $request['warehouse'])
                    ->where('item_id', $item->id)
                    ->update([
                        'qty' => $qtynew
                    ]);
            }
//            dd(count($qtywh));
        }

        return redirect()->route('gr.index');
    }
}
