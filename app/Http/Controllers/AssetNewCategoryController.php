<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset_new_category;

class AssetNewCategoryController extends Controller
{

    public function getCategory(){
        $category = Asset_new_category::all();
        $data = [];
        foreach ($category as $value){
            $data[] = array(
                "id" => $value->id,
                "text" => $value->name.'/'.$value->code,
            );
        }
        return response()->json($data);
    }
    public function index(){
        $category = Asset_new_category::all();
        $parent_name = [];
        $id_parent = [];
        foreach ($category as $key => $value){
            $parent_name[$value->id] = $value->name;
            $id_parent[$value->id] = $value->id_parent;
        }

        return view('category.index',[
            'categories' => $category,
            'parents' => $parent_name,
            'id_parents' => $id_parent,
        ]);
    }

    public function loadData(Request $request)
    {
        $t = $_GET['term'];
        $data = Asset_new_category::select('id','name')
            ->where('id', 'like', "%".$t."%")
            ->where('name', 'like', "%".$t."%")
            ->whereNull('deleted_at')->get();
        foreach ($data as $value){
            $val[] = "[".$value->id."] ".$value->name;
        }
        return json_encode($val);
    }

    public function store(Request $request){
        $category = new Asset_new_category();
        $category->id_parent = $request['id_parent'];
        $category->name = $request['name'];
        $category->code = $request['code'];
        $category->save();
        return redirect()->route('category.index');

    }

    public function update(Request $request){
        Asset_new_category::where('id', $request['id'])
            ->update([
                'name' => $request['name'],
                'code' => $request['code'],
                'id_parent' => $request['id_parent']
            ]);

        return redirect()->route('category.index');
    }
    public function delete($id){
        Asset_new_category::where('id',$id)->delete();
        Asset_new_category::where('id_parent', $id)->delete();
        return redirect()->route('category.index');
    }
}
