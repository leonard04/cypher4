<?php

namespace App\Http\Controllers;

use App\Models\Marketing_c_prognosis;
use App\Models\Marketing_project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class MarketingPrognosisController extends Controller
{
    function index($id){
        $project = Marketing_project::find($id);

        $tables = ["sales", "cost", "operating_expenses"];
        $num = array();
        foreach ($tables as $item){
            $pro = Marketing_c_prognosis::where('id_project', $id)
                ->where('category', $item)
                ->orderBy('RCTR', "desc")
                ->first();

            if (empty($pro)){
                $num[$item] = sprintf("%03d", 1);
            } else {
                $num[$item] = sprintf("%03d", intval(substr($pro->RCTR, -3)) + 1);
            }
        }

        $prognosis = Marketing_c_prognosis::where('id_project', $id)->get();
        $totalsales = 0;
        foreach ($prognosis as $item) {
            if ($item->category == "sales"){
                $totalsales += $item->amount;
            }
        }

        return view('prognosis.index', [
            'project' => $project,
            'tables' => $tables,
            'num' => $num,
            'prognosis' => $prognosis,
            'totalsales' => $totalsales
        ]);
    }

    function add(Request $request){
//        dd($request);
        $nProg = new Marketing_c_prognosis();
        $nProg->RCTR = $request->code_project;
        $nProg->id_project = $request->project;
        $nProg->subject = ($request->list_prognosis == null) ? strtoupper($request->subject) : strtoupper($request->list_prognosis);
        $nProg->description = ($request->list_prognosis == null) ? strtoupper($request->subject) : strtoupper($request->list_prognosis);
        $nProg->category = $request->type;
        $nProg->amount = $request->amount;
        $nProg->created_by = Auth::user()->username;
        $nProg->company_id = Session::get('company_id');
        $nProg->save();

        return redirect()->back();
    }

    function delete($id){
        Marketing_c_prognosis::find($id)->delete();
        return redirect()->back();
    }
}
