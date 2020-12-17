<?php

namespace App\Http\Controllers;

use App\Models\ConfigCompany;
use App\Models\Hrd_config;
use App\Models\Preference_config;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use League\Flysystem\Config;
use phpseclib\Crypt\Hash;
use Session;
use App\Helpers\FileManagement;

use App\Models\RoleDivision;
use App\Models\Role;
use App\Models\Division;
use App\Models\Module;
use App\Models\Action;
use App\Models\RolePrivilege;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
//    function index(){
//        $data = ConfigCompany::all();
//        return view('company.index', [
//            'company' => $data
//        ]);
//    }

    function index(){
        $data = ConfigCompany::all();
        $level = array();
        foreach ($data as $value){
            $hasParent[$value->id] = $value->id_parent;
            if ($value->id_parent == null){
                $level[$value->id]= 1;
            } elseif ($value->id_parent != null){
                if ($hasParent[$value->id_parent] == null){
                    $level[$value->id]= 2;
                } else {
                    $level[$value->id]= 3;
                }
            }
        }

        return view('company.index', [
            'company' => $data,
            'level' => $level
        ]);
    }

    function add(Request $request){
//        dd($request);

        $company = new ConfigCompany();

        $plogo = $request->file('p_logo');
        $applogo = $request->file('app_logo');

        $tujuan_upload = public_path('images');

        $p_logo   = "p_logo_".$request->company_tag.".".$plogo->getClientOriginalExtension();
        $app_logo = "app_logo_".$request->company_tag.".".$applogo->getClientOriginalExtension();

        // upload file
        $hash_plogo = \Illuminate\Support\Facades\Hash::make($p_logo);
        $hash_applogo = \Illuminate\Support\Facades\Hash::make($app_logo);
        FileManagement::save_file_management($hash_plogo, $plogo, $p_logo, "images");
        FileManagement::save_file_management($hash_applogo, $applogo, $app_logo, "images");

        $company->id_parent = $request->parent;
        $company->company_name = $request->company_name;
        $company->tag = $request->company_tag;
        $company->npwp = $request->npwp;
        $company->address = $request->address;
        $company->phone = $request->phone;
        $company->email = $request->email;
        $company->created_at = date('Y-m-d H:i:s');
        $company->created_by = "admin";
        $company->bgcolor = $request->bgcolor;
        $company->p_logo = $p_logo;
        $company->app_logo = $app_logo;

        $company->save();

        $hrd_conf = Hrd_config::all();
        foreach ($hrd_conf as $key => $value){
            $json_data = json_decode($value->opt_value);
            switch ($value->opt_name) {
                case "period_start":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_period_start');
                    array_push($json_data, $data);
                    break;
                case "period_end":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_period_end');
                    array_push($json_data, $data);
                    break;
                case "absence_deduction":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_absence_deduction');
                    array_push($json_data, $data);
                    break;
                case "bonus_period":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_bonus_period');
                    array_push($json_data, $data);
                    break;
                case "thr_period":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_thr_period');
                    array_push($json_data, $data);
                    break;
                case "odo_rate":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_odo_rate');
                    array_push($json_data, $data);
                    break;
                case "penalty_amt":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_penalty_amt');
                    array_push($json_data, $data);
                    break;
                case "penalty_period":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_penalty_period');
                    array_push($json_data, $data);
                    break;
                case "penalty_start":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_penalty_start');
                    array_push($json_data, $data);
                    break;
                case "penalty_stop":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_penalty_stop');
                    array_push($json_data, $data);
                    break;
                case "performa_period":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_performa_period');
                    array_push($json_data, $data);
                    break;
                case "performa_start":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_performa_start');
                    array_push($json_data, $data);
                    break;
                case "performa_end":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_performa_end');
                    array_push($json_data, $data);
                    break;
                case "approval_start":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_approval_start');
                    array_push($json_data, $data);
                    break;
                case "btl_col":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_btl_col');
                    array_push($json_data, $data);
                    break;
                case "performa_amt1":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_performa_amt1');
                    array_push($json_data, $data);
                    break;
                case "performa_amt2":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_performa_amt2');
                    array_push($json_data, $data);
                    break;
                case "performa_amt3":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_performa_amt3');
                    array_push($json_data, $data);
                    break;
                case "performa_amt4":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_performa_amt4');
                    array_push($json_data, $data);
                    break;
                case "performa_amt5":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_performa_amt5');
                    array_push($json_data, $data);
                    break;
                case "wo_signature":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_wo_signature');
                    array_push($json_data, $data);
                    break;
                case "po_signature":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_po_signature');
                    array_push($json_data, $data);
                    break;
                case "to_signature":
                    $data['id'] = $company->id;
                    $data['value'] = Session::get('company_to_signature');
                    array_push($json_data, $data);
                    break;
            }
            Hrd_config::where('opt_name', $value->opt_name)
                ->update([
                    'opt_value' => json_encode($json_data)
                ]);
        }

        return redirect()->route('company.index');
    }

    public function edit(Request $request){
        $tujuan_upload = public_path('images');

        $company = ConfigCompany::find($request['id']);

        if ($request->hasFile('p_logo')){
            $plogo = $request->file('p_logo');
            $p_logo   = "p_logo_".$request->company_tag.".".$plogo->getClientOriginalExtension();
            // upload file
            $plogo->move($tujuan_upload,$p_logo);

            $company->p_logo = $p_logo;
        }
        if ($request->hasFile('app_logo')){
            $applogo = $request->file('app_logo');
            $app_logo = "app_logo_".$request->company_tag.".".$applogo->getClientOriginalExtension();
            // upload file
            $applogo->move($tujuan_upload,$app_logo);
            $company->app_logo = $app_logo;
        }

        $company->id_parent = $request->parent;
        $company->company_name = $request->company_name;
        $company->tag = $request->company_tag;
        $company->npwp = $request->npwp;
        $company->address = $request->address;
        $company->phone = $request->phone;
        $company->email = $request->email;
        $company->updated_at = date('Y-m-d H:i:s');
        $company->updated_by = Auth::user()->username;
        $company->bgcolor =$request->bgcolor;
        if (isset($request->inherit)){
            $company->inherit = $request->inherit;
            Session::put('company_child', ConfigCompany::select('id')
                ->where('id_parent', Session::get('company_id'))
                ->whereNotNull('inherit')
                ->get());
        }
        $company->save();

        return redirect()->route('company.detail',['id' => base64_encode($request['id'])]);
    }

    function switch(Request $request){
//        dd($request);
        $config_company = ConfigCompany::where('id',$request->id)->first();

        Session::put('company_id', $config_company->id);
        Session::put('company_name_parent',$config_company->company_name);
        Session::put('company_address',$config_company->address);
        Session::put('company_npwp',$config_company->npwp);
        Session::put('company_phone',$config_company->phone);
        Session::put('company_email',$config_company->email);
        Session::put('company_tag',$config_company->tag);
        Session::put('company_bgcolor',$config_company->bgcolor);
        Session::put('company_p_logo',$config_company->p_logo);
        Session::put('company_app_logo',$config_company->app_logo);
        Session::put('company_bgcolor', $config_company->bgcolor);

        Session::put('company_child', ConfigCompany::select('id')
            ->where('id_parent', $config_company->id)
            ->whereNotNull('inherit')
            ->get());

        $pref = Preference_config::where('id_company', $config_company->id)->first();
        if (!empty($pref)){
            Session::put('company_period_start', $pref->period_start);
            Session::put('company_period_end', $pref->period_end);
            Session::put('company_absence_deduction', $pref->absence_deduction);
            Session::put('company_bonus_period', $pref->bonus_period);
            Session::put('company_thr_period', $pref->thr_period);
            Session::put('company_odo_rate', $pref->odo_rate);
            Session::put('company_penalty_amt', $pref->penalty_amt);
            Session::put('company_penalty_period', $pref->penalty_period);
            Session::put('company_penalty_start', $pref->penalty_start);
            Session::put('company_penalty_stop', $pref->penalty_stop);
            Session::put('company_performa_period', $pref->performa_period);
            Session::put('company_performa_start', $pref->performa_start);
            Session::put('company_performa_end', $pref->performa_end);
            Session::put('company_approval_start', $pref->approval_start);
            Session::put('company_btl_col', $pref->btl_col);
            Session::put('company_performa_amt1', $pref->performa_amt1);
            Session::put('company_performa_amt2', $pref->performa_amt2);
            Session::put('company_performa_amt3', $pref->performa_amt3);
            Session::put('company_performa_amt4', $pref->performa_amt4);
            Session::put('company_performa_amt5', $pref->performa_amt5);
            Session::put('company_wo_signature', $pref->wo_signature);
            Session::put('company_po_signature', $pref->po_signature);
            Session::put('company_to_signature', $pref->to_signature);
        } else {
            $hrd_config = Hrd_config::all();
            foreach ($hrd_config as $key => $value) {
                $opt_val = json_decode($value->opt_value);
                $count_opt = count(json_decode($value->opt_value));
                for ($i = 0; $i < $count_opt; $i++) {
                    if ($opt_val[$i]->id == $config_company->id) {
                        switch ($value->opt_name) {
                            case "period_start":
                                Session::put('company_period_start', $opt_val[$i]->value);
                                break;
                            case "period_end":
                                Session::put('company_period_end', $opt_val[$i]->value);
                                break;
                            case "absence_deduction":
                                Session::put('company_absence_deduction', $opt_val[$i]->value);
                                break;
                            case "bonus_period":
                                Session::put('company_bonus_period', $opt_val[$i]->value);
                                break;
                            case "thr_period":
                                Session::put('company_thr_period', $opt_val[$i]->value);
                                break;
                            case "odo_rate":
                                Session::put('company_odo_rate', $opt_val[$i]->value);
                                break;
                            case "penalty_amt":
                                Session::put('company_penalty_amt', $opt_val[$i]->value);
                                break;
                            case "penalty_period":
                                Session::put('company_penalty_period', $opt_val[$i]->value);
                                break;
                            case "penalty_start":
                                Session::put('company_penalty_start', $opt_val[$i]->value);
                                break;
                            case "penalty_stop":
                                Session::put('company_penalty_stop', $opt_val[$i]->value);
                                break;
                            case "performa_period":
                                Session::put('company_performa_period', $opt_val[$i]->value);
                                break;
                            case "performa_start":
                                Session::put('company_performa_start', $opt_val[$i]->value);
                                break;
                            case "performa_end":
                                Session::put('company_performa_end', $opt_val[$i]->value);
                                break;
                            case "approval_start":
                                Session::put('company_approval_start', $opt_val[$i]->value);
                                break;
                            case "btl_col":
                                Session::put('company_btl_col', $opt_val[$i]->value);
                                break;
                            case "performa_amt1":
                                Session::put('company_performa_amt1', $opt_val[$i]->value);
                                break;
                            case "performa_amt2":
                                Session::put('company_performa_amt2', $opt_val[$i]->value);
                                break;
                            case "performa_amt3":
                                Session::put('company_performa_amt3', $opt_val[$i]->value);
                                break;
                            case "performa_amt4":
                                Session::put('company_performa_amt4', $opt_val[$i]->value);
                                break;
                            case "performa_amt5":
                                Session::put('company_performa_amt5', $opt_val[$i]->value);
                                break;
                            case "wo_signature":
                                Session::put('company_wo_signature', $opt_val[$i]->value);
                                break;
                            case "po_signature":
                                Session::put('company_po_signature', $opt_val[$i]->value);
                                break;
                            case "to_signature":
                                Session::put('company_to_signature', $opt_val[$i]->value);
                                break;
                        }
                    }
                }
            }
        }

        return redirect()->route('home');
    }
    function detail($id){
        $id = base64_decode($id);
        $company = ConfigCompany::where('id', $id)->first();
        $companies = ConfigCompany::all();

        // dd($id);

        //User
        // $users = User::where('company_id', $id)->get();
        $users = User::select('users.*', 'users.id_rms_roles_divisions AS userRoleDivId', 'rms_roles_divisions.id_rms_roles AS userRoleId', 'rms_roles_divisions.id_rms_divisions AS userDivId', 'rms_roles.name AS roleName', 'rms_divisions.name AS divName')
        ->leftJoin('rms_roles_divisions', 'rms_roles_divisions.id', '=', 'users.id_rms_roles_divisions')
        ->leftJoin('rms_roles', 'rms_roles.id', '=', 'rms_roles_divisions.id_rms_roles')
        ->leftJoin('rms_divisions', 'rms_divisions.id', '=', 'rms_roles_divisions.id_rms_divisions')
        ->where('company_id', $id)
        ->orderBy('users.username', 'ASC')
        ->get();
//        dd($users);

        $roleHasPriv = [];

        $roleDivsPriv = RolePrivilege::select('id_rms_roles_divisions')->groupBy('id_rms_roles_divisions')->get();
        foreach ($roleDivsPriv as $value)
        {
            $roleHasPriv []= $value->id_rms_roles_divisions;
        }

        //Only select roles_divisions that have privilege
        $roleDivsList = RoleDivision::select('rms_roles.name AS roleName', 'rms_divisions.name AS divName', 'rms_roles_divisions.id AS id', 'rms_roles.id AS roleId', 'rms_divisions.id AS divId')
        ->leftJoin('rms_roles', 'rms_roles.id', '=', 'rms_roles_divisions.id_rms_roles')
        ->leftJoin('rms_divisions', 'rms_divisions.id', '=', 'rms_roles_divisions.id_rms_divisions')
        ->whereIn('rms_roles_divisions.id', $roleHasPriv)
        ->orderBy('rms_roles.name', 'ASC')
        ->get();

        //Position
        $numberPosition = 1;
        $roleList = Role::where('id_company',$id)->pluck('name', 'id');
        $divList = Division::where('id_company',$id)->pluck('name', 'id');
        $parentLists = RoleDivision::where('id_company',$id)->get();
        $roleDivsList = RoleDivision::select('rms_roles.name AS roleName', 'rms_divisions.name AS divName', 'rms_roles.id AS roleId', 'rms_divisions.id AS divId', 'rms_roles_divisions.*')
        ->leftJoin('rms_roles', 'rms_roles.id', '=', 'rms_roles_divisions.id_rms_roles')
        ->leftJoin('rms_divisions', 'rms_divisions.id', '=', 'rms_roles_divisions.id_rms_divisions')
        ->where('rms_roles_divisions.id_company',$id)
        ->get();

//        $parentPosition = [];
//        foreach ($roleDivsList as $roleDivList)
//        {
//            $parentPosition [$roleDivList->id] = RoleDivision::find($roleDivList->id_rms_roles_divisions_parent);
//        }

        $parentPosition = [];
        foreach ($roleDivsList as $roleDivList){
            $hasParent[$roleDivList->id] = $roleDivList->id_rms_roles_divisions_parent;
        }

        $level_role = [];

        foreach ($roleDivsList as $roleDivList)
        {
            $parentPosition [$roleDivList->id] = RoleDivision::find($roleDivList->id_rms_roles_divisions_parent);
            if ($roleDivList->id_rms_roles_divisions_parent == null){
                $level_role[$roleDivList->id] = 1;
            } elseif ($roleDivList->id_rms_roles_divisions_parent != null) {
                if ($hasParent[$roleDivList->id_rms_roles_divisions_parent] == null){
                    $level_role[$roleDivList->id] = 2;
                } else {
                    $level_role[$roleDivList->id] = 3;
                }
            }
        }

//        dd($hasParent);

        //Role
        $numberRole = 1;
        $roles = Role::where('id_company',$id)->get();

        //Division
        $numberDivision = 1;
        $divisions = Division::where('id_company',$id)->get();

        //Module
        $numberModule = 1;
        $modules = Module::all();

        //Action
        $numberAction = 1;
        $actions = Action::all();
        $preferences = Preference_config::where('id_company', $id)->first();

        return view('company.detail', compact('company','users','roleDivsList','companies','level_role','numberPosition','roleDivsList', 'roleList', 'divList', 'parentLists','parentPosition','numberRole','roles','numberDivision','divisions','numberModule','modules','numberAction','actions', 'preferences'));
    }

    function role_controll($id){
        $id = base64_decode($id);
        $company = ConfigCompany::where('id', $id)->first();
        $companies = ConfigCompany::all();

        // dd($id);

        //User
        // $users = User::where('company_id', $id)->get();
        $users = User::select('users.*', 'users.id_rms_roles_divisions AS userRoleDivId', 'rms_roles_divisions.id_rms_roles AS userRoleId', 'rms_roles_divisions.id_rms_divisions AS userDivId', 'rms_roles.name AS roleName', 'rms_divisions.name AS divName')
            ->leftJoin('rms_roles_divisions', 'rms_roles_divisions.id', '=', 'users.id_rms_roles_divisions')
            ->leftJoin('rms_roles', 'rms_roles.id', '=', 'rms_roles_divisions.id_rms_roles')
            ->leftJoin('rms_divisions', 'rms_divisions.id', '=', 'rms_roles_divisions.id_rms_divisions')
            ->where('company_id', $id)
            ->orderBy('users.username', 'ASC')
            ->get();
//        dd($users);

        $roleHasPriv = [];

        $roleDivsPriv = RolePrivilege::select('id_rms_roles_divisions')->groupBy('id_rms_roles_divisions')->get();
        foreach ($roleDivsPriv as $value)
        {
            $roleHasPriv []= $value->id_rms_roles_divisions;
        }

        //Only select roles_divisions that have privilege
        $roleDivsList = RoleDivision::select('rms_roles.name AS roleName', 'rms_divisions.name AS divName', 'rms_roles_divisions.id AS id', 'rms_roles.id AS roleId', 'rms_divisions.id AS divId')
            ->leftJoin('rms_roles', 'rms_roles.id', '=', 'rms_roles_divisions.id_rms_roles')
            ->leftJoin('rms_divisions', 'rms_divisions.id', '=', 'rms_roles_divisions.id_rms_divisions')
            ->whereIn('rms_roles_divisions.id', $roleHasPriv)
            ->orderBy('rms_roles.name', 'ASC')
            ->get();

        //Position
        $numberPosition = 1;
        $roleList = Role::where('id_company',$id)->pluck('name', 'id');
        $divList = Division::where('id_company',$id)->pluck('name', 'id');
        $parentLists = RoleDivision::where('id_company',$id)->get();
        $roleDivsList = RoleDivision::select('rms_roles.name AS roleName', 'rms_divisions.name AS divName', 'rms_roles.id AS roleId', 'rms_divisions.id AS divId', 'rms_roles_divisions.*')
            ->leftJoin('rms_roles', 'rms_roles.id', '=', 'rms_roles_divisions.id_rms_roles')
            ->leftJoin('rms_divisions', 'rms_divisions.id', '=', 'rms_roles_divisions.id_rms_divisions')
            ->where('rms_roles_divisions.id_company',$id)
            ->get();

//        $parentPosition = [];
//        foreach ($roleDivsList as $roleDivList)
//        {
//            $parentPosition [$roleDivList->id] = RoleDivision::find($roleDivList->id_rms_roles_divisions_parent);
//        }

        $parentPosition = [];
        foreach ($roleDivsList as $roleDivList){
            $hasParent[$roleDivList->id] = $roleDivList->id_rms_roles_divisions_parent;
        }

        $level_role = [];

        foreach ($roleDivsList as $roleDivList)
        {
            $parentPosition [$roleDivList->id] = RoleDivision::find($roleDivList->id_rms_roles_divisions_parent);
            if ($roleDivList->id_rms_roles_divisions_parent == null){
                $level_role[$roleDivList->id] = 1;
            } elseif ($roleDivList->id_rms_roles_divisions_parent != null) {
                if ($hasParent[$roleDivList->id_rms_roles_divisions_parent] == null){
                    $level_role[$roleDivList->id] = 2;
                } else {
                    $level_role[$roleDivList->id] = 3;
                }
            }
        }

//        dd($hasParent);

        //Role
        $numberRole = 1;
        $roles = Role::where('id_company',$id)->get();

        //Division
        $numberDivision = 1;
        $divisions = Division::where('id_company',$id)->get();

        //Module
        $numberModule = 1;
        $modules = Module::all();

        //Action
        $numberAction = 1;
        $actions = Action::all();
        $preferences = Preference_config::where('id_company', $id)->first();

        return view('company.role_controll', compact('company','users','roleDivsList','companies','level_role','numberPosition','roleDivsList', 'roleList', 'divList', 'parentLists','parentPosition','numberRole','roles','numberDivision','divisions','numberModule','modules','numberAction','actions', 'preferences'));
    }

    function delete(Request $request){
        $company = ConfigCompany::find($request->id);

        if ($company->delete()){
            $data['del'] = 1;
        } else {
            $data['del'] = 0;
        }

        return json_encode($data);
    }

}
