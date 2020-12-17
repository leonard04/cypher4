<?php

namespace App\Http\Controllers;

use App\Models\General_travel_order_plan;
use App\Models\Marketing_project;
use Illuminate\Http\Request;
use App\Models\General_travel_order;
use App\Models\Hrd_employee_type;
use App\Models\Hrd_employee;
use DB;
use Session;

class GeneralCrewLocationController extends Controller
{
    public function index(){
        //kru off
        $spandays=[];
        $assigndate=[];
        $projectsplan = [];
        $remark = [];

        $datato = General_travel_order::where('company_id', \Session::get('company_id'))->get();
        $projects = Marketing_project::where('company_id', \Session::get('company_id'))->get();
        $kruoff = Hrd_employee::where('emp_type',2)
            ->whereNull('expel')
            ->orderBy('emp_name')
            ->get();

        $toplan = General_travel_order_plan::all();

        foreach ($kruoff as $key => $value){
            foreach ($datato as $key2 => $value2){
                if ($value->id == $value2->employee_id){
                    $spandays[$value->id][] = $value2->return_dt;
                }
            }
        }
        //Local kru off
        $localkruoff = Hrd_employee::where('emp_type',8)
            ->whereNull('expel')
            ->orderBy('emp_name')
            ->get();

        return view('crewloc.index',[
            'datato' => $datato,
            'projects' => $projects,
            'kruoff' => $kruoff,
            'localkruoff' => $localkruoff,
            'spandays' => $spandays,
            'to_plan' => $toplan,
        ]);
    }

    public function addToPlan(Request $request){
        $cekto_plan = General_travel_order_plan::where('emp_id',$request['emp_id'])->first();
        if ($cekto_plan === null){
            $to_plan = new General_travel_order_plan();
            $to_plan->emp_id = $request['emp_id'];
            $to_plan->assign_date = $request['date_assign'];
            $to_plan->project = $request['project'];
            $to_plan->remark = $request['remark'];
            $to_plan->created_at = date('Y-m-d H:i:s');
            $to_plan->save();
        } else {
            General_travel_order_plan::where('emp_id', $request['emp_id'])
                ->update([
                    'assign_date' => $request['date_assign'],
                    'project' => $request['project'],
                    'remark' => $request['remark'],
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        }

        return redirect()->route('crewloc.index');
    }
}
