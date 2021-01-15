<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller
{
	public function store(Request $request)
	{
		$role = new Role;
		$role->id_company = base64_decode($request->coid);
		$role->name = $request->name;
		$role->desc = $request->desc;
		$role->save();

		return redirect()->back();
	}

	public function update($id, Request $request)
	{
		$role = Role::find($id);
		$role->id_company = base64_decode($request->coid);
		$role->name = $request->name;
		$role->desc = $request->desc;
		$role->save();

		return redirect()->back();
	}

	public function delete($id, Request $request)
	{
		Role::find($id)->delete();

		return redirect()->back();
	}
}
