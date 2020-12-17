<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset_wh;
use DB;
use Session;
use Illuminate\Support\Facades\Auth;

class AssetWarehouseController extends Controller
{
    public function index(){
        $all = Asset_wh::where('company_id', \Session::get('company_id'))->get();

//        dd($all);
        return view('wh.index',[
            'whs' => $all,
        ]);
    }
    public function delete($id){
        Asset_wh::where('id',$id)->update([
            'deleted_by' => Auth::user()->username,
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
        Asset_wh::where('id',$id)->delete();

        return redirect()->route('wh.index');
    }

    public function store(Request $request){
        $wh = new Asset_wh();
        $wh->name = $request->name;
        $wh->address = $request->address;
        $wh->telephone = $request->telephone;
        $wh->pic = $request->pic;
        $wh->created_at = date('Y-m-d H:i:s');
        $wh->company_id = \Session::get('company_id');
        $wh->save();
        return redirect()->route('wh.index');
    }

    public function update(Request $request){
        Asset_wh::where('id', $request->id)->update([
            'name' => $request->name,
            'address' => $request->address,
            'telephone' => $request->telephone,
            'pic' => $request->pic,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()->route('wh.index');
    }
}
