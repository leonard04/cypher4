<?php

namespace App\Http\Controllers;

use App\Models\ConfigCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;
use App\Models\User;
use App\Models\Module;
use App\Models\Action;
use App\Models\UserPrivilege;
use App\Models\RolePrivilege;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function getCompany(){
        $users = ConfigCompany::all();
        $data = [];
        foreach ($users as $value){
            $data[] = array(
                "id" => $value->id,
                "text" => $value->company_name
            );
        }
        return response()->json($data);
    }

    public function getUsers($id_company){
        $arr = array(
            'company_id' => $id_company,
        );

        $users = User::where($arr)->get();
        $data = [];
        foreach ($users as $value){
            $data[] = array(
                "id" => $value->id,
                "text" => $value->name
            );
        }
        return response()->json($data);
    }

    public function getDetailUser($id){
        $user = User::where('id',$id)->first();
        return view('users.detail',[
            'user' => $user,
        ]);
    }

    public function updatePasswordAccount(Request $request){
        $this->validate($request,[
            'password' => 'required'
        ]);

        User::where('id',$request['id'])
            ->update([
                'password' => Hash::make($request['password']),
            ]);

            Auth::logout();
            return redirect()->route('home');
    }

    public function updateAccountInfo(Request $request){
        $uploaddir = public_path('theme\\assets\\media\\users');

        $pictureInput = $request->file('user_img');
        if ($pictureInput!= null) {
            $picture = $request['id'] . "-profile." . $pictureInput->getClientOriginalExtension();


            $path = $uploaddir . '\\' . $picture;
            if (file_exists($path)) {
                @unlink($path);
            }
            $pictureInput->move($uploaddir, $picture);
            $emp_picture = $picture;
            User::where('id', $request['id'])
                ->update([
                    'user_img' => $emp_picture,
                ]);
        }
        return redirect()->route('account.info',['id'=>$request['id']]);
    }

    function add(Request $request){
        if (isset($request->export)){
//            dd(base64_decode($request->coid));
//            dd($request);
            $user = User::where('id', $request->user_company)->first();
//            dd($user);
            $userNew = new User();
            $userNew->name = $user->name;
            $userNew->password = $user->password;
            $userNew->username = $user->username;
            $userNew->email = $user->email;
            $userNew->company_id = base64_decode($request->coid);
//            $userNew->ein = $user->ein;
            $userNew->id_rms_roles_divisions = $user->id_rms_roles_divisions;
            $userNew->save();

        } else {
            $name = $request->name;
            $email = $request->email;
            $username = $request->username;
            $password = Hash::make($request->password);
            // $position = $request->position;
            $id = base64_decode($request->coid);

            $user = new User;
            $user->name = $name;
            $user->email = $email;
            $user->username = $username;
            $user->password = $password;
            // $user->position = $position;
            $user->id_rms_roles_divisions = $request->userRoleAdd;
            $user->company_id = $id;
            $user->save();

            //Add user privilege based on position
            $roleDivPriv = RolePrivilege::select('id_rms_modules', 'id_rms_actions')
                ->where('id_rms_roles_divisions', $request->userRoleAdd)
                ->get();
            foreach ($roleDivPriv as $key => $valDivPriv)
            {
                $addUserRole = new UserPrivilege;
                $addUserRole->id_users = $user->id;
                $addUserRole->id_rms_modules = $valDivPriv->id_rms_modules;
                $addUserRole->id_rms_actions = $valDivPriv->id_rms_actions;
                $addUserRole->save();
            }
        }

        return redirect()->route('company.detail', ['id' => $request->coid]);
    }

    function edit(Request $request){
        $user = User::find($request->id_u);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        if (!empty($request->password) || $request->password != ""){
            $user->password = Hash::make($request->password);
        }
        // $user->position = $request->position;
        $user->save();

        // Change user position
        if($request->userRoleEdit != $request->userRoleEditOld)
        {
            $userRole = User::find($request->id_u);
            $userRole->id_rms_roles_divisions = $request->userRoleEdit;
            $userRole->save();

            //Delete existing user privilege
            UserPrivilege::where('id_users', $request->id_u)->forceDelete();

            //Edit user privilege based on new position
            $roleDivPriv = RolePrivilege::select('id_rms_modules', 'id_rms_actions')
            ->where('id_rms_roles_divisions', $request->userRoleEdit)
            ->get();

            foreach ($roleDivPriv as $key => $valDivPriv)
            {
                $editUserRole = new UserPrivilege;
                $editUserRole->id_users = $request->id_u;
                $editUserRole->id_rms_modules = $valDivPriv->id_rms_modules;
                $editUserRole->id_rms_actions = $valDivPriv->id_rms_actions;
                $editUserRole->save();
            }
        }

        return redirect()->route('company.detail', ['id' => $request->coid]);
    }
    function delete(Request $request){
        $user = User::find($request->id);

        if ($user->delete()){
            $data['del'] = 1;
        } else {
            $data['del'] = 0;
        }

        return json_encode($data);
    }

    public function getUserPrivilege($id){
        $user = User::where('id',$id)->first();
        $companyId = base64_encode($user->company_id);
        $moduleList = Module::orderBy('name','asc')->pluck('name', 'id');
        $actionList = Action::pluck('name', 'id');

        return view('users.privilege',compact('companyId','user','actionList','moduleList'));
    }

    public function updatePrivilege($id, Request $request){
        if($request->privilege)
        {
            UserPrivilege::where('id_users', $id)->forceDelete();
            foreach($request->privilege as $moduleId => $actionList)
            {
                foreach($actionList as $actionId => $value)
                {
                    $privilege = new UserPrivilege;
                    $privilege->id_users = $id;
                    $privilege->id_rms_modules = $moduleId;
                    $privilege->id_rms_actions = $actionId;
                    $privilege->save();
                }
            }
        }
        else
        {
            UserPrivilege::where('id_users', $id)->forceDelete();
        }

        return redirect()->route('user.privilege', $id);
    }
}
