<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Division;

class DivisionController extends Controller
{
	public function store(Request $request)
	{
		$division = new Division;
		$division->id_company = base64_decode($request->coid);
		$division->name = $request->name;
		$division->desc = $request->desc;
		$division->save();

		return redirect()->route('company.detail', $request->coid);
	}

	public function update($id, Request $request)
	{
		$division = Division::find($id);
		$division->id_company = base64_decode($request->coid);
		$division->name = $request->name;
		$division->desc = $request->desc;
		$division->save();

		return redirect()->route('company.detail', $request->coid);
	}

	public function delete($id, Request $request)
	{
		Division::find($id)->delete();

		return redirect()->route('company.detail', $request->coid);
	}
}
