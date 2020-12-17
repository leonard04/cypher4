<?php

namespace App\Http\Controllers;

use App\Models\Asset_po_detail;
use Illuminate\Http\Request;

class ProcurementPriceListController extends Controller
{
    public function index(){
        $pricelists = Asset_po_detail::join('asset_po as po','po.id','=','asset_po_detail.po_num')
            ->join('asset_items as item','item.item_code','=','asset_po_detail.item_id')
            ->join('asset_organization as vendor','vendor.id','=','po.supplier_id')
            ->join('new_category as cat', 'cat.id','=','item.category_id')
            ->join('marketing_projects as prj','prj.id','=','po.project')
            ->select('asset_po_detail.*','po.po_num as poNum','item.name as itemName','vendor.name as vendorName','cat.name as catName','item.price as itemPrice','item.uom as itemUom')
//            ->groupBy('item.item_code')
            ->get();

//        dd($pricelists);

        return view('pricelist.index',[
            'pricelists' => $pricelists,
        ]);
    }

}
