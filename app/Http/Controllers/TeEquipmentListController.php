<?php

namespace App\Http\Controllers;

use App\Helpers\FileManagement;
use App\Models\File_Management;
use App\Models\Te_equipment_list;
use App\Models\Te_equipment_list_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class TeEquipmentListController extends Controller
{
    public function index(){
        $elCat = Te_equipment_list_category::where('company_id', Session::get('company_id'))->get();
        $el = Te_equipment_list::where('company_id', Session::get('company_id'))
            ->orderBy('serial_number', 'desc')
            ->get();
        $serial_number = array();
        foreach ($el as $item){
            $serial_number[$item->category][] = $item->serial_number;
        }

        return view('te.el.index', [
            'elCats' => $elCat,
            'serial_number' => $serial_number
        ]);
    }

    public function addCategory(Request $request){
        $elCat = new Te_equipment_list_category();
        $elCat->category_name = $request->cat_name;
        $elCat->tag = $request->tag;
        $elCat->created_by = Auth::user()->username;
        $elCat->company_id = Session::get('company_id');

        if ($elCat->save()){
            return redirect()->route('te.el.index');
        }
    }

    public function deleteCategory($id){
        $elCat = Te_equipment_list_category::find($id);

        if ($elCat->delete()){
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    public function updateCategory(Request $request){
        $elCat = Te_equipment_list_category::find($request->id_cat);
        $elCat->category_name = $request->cat_name;
        $elCat->tag = $request->tag;
        $elCat->updated_by = Auth::user()->username;

        if ($elCat->save()){
            return redirect()->route('te.el.index');
        }
    }

    public function detail($id){
        $elCat = Te_equipment_list_category::find($id);
        $el = Te_equipment_list::where('company_id', Session::get('company_id'))
            ->where('category', $id)
            ->get();

        $file = File_Management::all();
        $file_name = array();
        foreach ($file as $item){
            $file_name[$item->hash_code] = str_replace("/", "\\", $item->file_name);
        }

        return view('te.el.detail', [
            'elCat' => $elCat,
            'els' => $el,
            'json_els' => json_encode($el),
            'file_' => json_encode($file_name)
        ]);
    }

    public function add(Request $request){

//        dd($request);

        $elCount = Te_equipment_list::where('category', $request->id_category)
            ->orderBy('created_at', 'desc')
            ->first();

        $elCat = Te_equipment_list_category::find($request->id_category);

        if (empty($elCount)){
            $serial = Session::get('company_tag')."/".strtoupper($elCat->tag)."/001";
        } else {
            $ser_num_last = explode("/", $elCount->serial_number);
            $num = intval(end($ser_num_last)) + 1;
            $serial = Session::get('company_tag')."/".strtoupper($elCat->tag)."/".sprintf("%03d", $num);
        }



        $el = new Te_equipment_list();
        $el->serial_number = $serial;
        $el->subject = $request->label;
        $el->type = $request->type;
        $el->param1 = $request->param1;
        $el->coi_expiry = $request->coi_expiry;
        $el->description = $request->desc;
        $el->category = $request->id_category;
        $el->status = $request->status;
        $el->company_id = Session::get('company_id');
        $el->created_by = Auth::user()->username;

        if (isset($request->param2)){
            $el->param2 = $request->param2;
        }

        if ($elCat->tag == "SEP"){
            $json = array();
            $json['capacity_oil'] = $request->capacity_oil;
            $json['capacity_water'] = $request->capacity_water;
            $json['capacity_gas'] = $request->capacity_gas;
            $json['retention_time'] = $request->retention_time;
            $add_info = json_encode($json);

            $el->additional_information = $add_info;
        }

        if (!empty($request->file('coi_file'))){
            $hash = $this->upload_file($request->file('coi_file'));
            $el->coi = $hash;
        }

        if (!empty($request->file('thumbnail'))){
            $hash = $this->upload_file($request->file('thumbnail'));
            $el->thumbnail = $hash;
        }

        if (!empty($request->file('drawing'))){
            $hash = $this->upload_file($request->file('drawing'));
            $el->drawing = $hash;
        }

        if (!empty($request->file('datasheet'))){
            $hash = $this->upload_file($request->file('datasheet'));
            $el->data_sheet = $hash;
        }

        if ($el->save()){
            return redirect()->route('te.el.detail', $request->id_category);
        }

    }

    public function update(Request $request){

        $el = Te_equipment_list::find($request->id_el);

        $elCat = Te_equipment_list_category::find($el->category);

        $el->subject = $request->label;
        $el->type = $request->type;
        $el->param1 = $request->param1;
        $el->coi_expiry = $request->coi_expiry;
        $el->description = $request->desc;
        $el->status = $request->status;
        $el->updated_by = Auth::user()->username;

        if (isset($request->param2)){
            $el->param2 = $request->param2;
        }

        if ($elCat->tag == "SEP"){
            $json = array();
            $json['capacity_oil'] = $request->capacity_oil;
            $json['capacity_water'] = $request->capacity_water;
            $json['capacity_gas'] = $request->capacity_gas;
            $json['retention_time'] = $request->retention_time;
            $add_info = json_encode($json);

            $el->additional_information = $add_info;
        }

        if (!empty($request->file('coi_file'))){
            $hash = $this->upload_file($request->file('coi_file'));
            $el->coi = $hash;
        }

        if (!empty($request->file('thumbnail'))){
            $hash = $this->upload_file($request->file('thumbnail'));
            $el->thumbnail = $hash;
        }

        if (!empty($request->file('drawing'))){
            $hash = $this->upload_file($request->file('drawing'));
            $el->drawing = $hash;
        }

        if (!empty($request->file('datasheet'))){
            $hash = $this->upload_file($request->file('datasheet'));
            $el->data_sheet = $hash;
        }

        if ($el->save()){
            return redirect()->route('te.el.detail', $el->category);
        }
    }

    public function delete($id){
        $elCat = Te_equipment_list::find($id);

        if ($elCat->delete()){
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    function upload_file($file_up){
        $file = $file_up;
        $filename = explode(".", $file->getClientOriginalName());
        array_pop($filename);
        $filename = str_replace(" ", "_", implode("_", $filename));

        $newFile = $filename."-".date('Y_m_d_H_i_s').".".$file->getClientOriginalExtension();
        $hashFile = Hash::make($newFile);
        $hashFile = str_replace("/", "", $hashFile);
        $upload = FileManagement::save_file_management($hashFile, $file, $newFile, "media\\te\\el");

        return $hashFile;
    }

    function deleteFile($id, $type){
        $el = Te_equipment_list::find($id);
        $el[$type] = null;

        if ($el->save()){
            File_Management::where('hash_code', $el[$type])->delete();
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }
}
