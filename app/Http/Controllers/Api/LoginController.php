<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\ConfigCompany;
use App\Models\RoleDivision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends BaseController
{
    public function login(Request $request){
        $username = $request->username;
//        $password = md5($request->password);
        $user = User::where('username', $username)->first();
        $password = Hash::check($request->password,$user->password);

        if($user){
            if ($password){
                $_user = User::where('username', $username)->first();
                $roles = RoleDivision::where(['id' =>$_user->id_rms_roles_divisions,'id_company' => $_user->company_id])->first();
                $company = ConfigCompany::where('id', $_user->company_id)->first();
                $data = [
                    'user' => $_user,
                    'roles' => $roles,
                    'company' => $company,
                ];
                return $this->sendResponse($_user, 'User login Successfully');
//                return $this->sendResponse($_user, 'User login Successfully');
            } else {
                return $this->sendError('Invalid Credentials (Password)');
            }
        } else {
            return $this->sendError('Invalid Credentials (Username)');
        }

    }

    public function getCompany(){
        $company = ConfigCompany::all();
        if ($company){
            return $this->sendResponse($company, 'Success');
        } else {
            return $this->sendError('Failed');

        }
    }

}
