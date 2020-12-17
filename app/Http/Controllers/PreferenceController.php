<?php

namespace App\Http\Controllers;

use App\Models\ConfigCompany;
use App\Models\Pref_activity_point;
use App\Models\Preference_config;
use App\Models\Template_files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class PreferenceController extends Controller
{
    public function index($id_company){
        $id = base64_decode($id_company);

        $isPref = Preference_config::where('id_company', $id)->first();
        if ($isPref == null){
            $newPref = new Preference_config();
            $comp = ConfigCompany::find($id);
            if ($comp->id_parent != null){
                $parentPref = Preference_config::where('id_company', $comp->id_parent)->first();
                $newPref->penalty_amt = $parentPref->penalty_amt;
                $newPref->penalty_period = $parentPref->penalty_period;
                $newPref->penalty_start = $parentPref->penalty_start;
                $newPref->penalty_stop = $parentPref->penalty_stop;
                $newPref->period_start = $parentPref->period_start;
                $newPref->period_end = $parentPref->period_end;
                $newPref->absence_deduction = $parentPref->absence_deduction;
                $newPref->bonus_period = $parentPref->bonus_period;
                $newPref->thr_period = $parentPref->thr_period;
                $newPref->odorate = $parentPref->odorate;
                $newPref->overtime_period = $parentPref->overtime_period;
                $newPref->overtime_start = $parentPref->overtime_start;
                $newPref->overtime_amt = $parentPref->overtime_amt;
                $newPref->performa_period = $parentPref->performa_period;
                $newPref->performa_start = $parentPref->performa_start;
                $newPref->performa_end = $parentPref->performa_end;
                $newPref->performa_amt1 = $parentPref->performa_amt1;
                $newPref->performa_amt2 = $parentPref->performa_amt2;
                $newPref->performa_amt3 = $parentPref->performa_amt3;
                $newPref->performa_amt4 = $parentPref->performa_amt4;
                $newPref->performa_amt5 = $parentPref->performa_amt5;
                $newPref->approval_start = $parentPref->approval_start;
                $newPref->btl_col = $parentPref->btl_col;
                $newPref->wo_signature = null;
                $newPref->po_signature = null;
                $newPref->to_signature = null;
                $newPref->id_company = $id;
                $newPref->save();
            }
        }

        $preferences = Preference_config::where('id_company', $id)->first();
        $template_files = Template_files::where('company_id', $id)->get();


        $br["dirut"] = "President Director";
        $br["dir"] = "Sec. of President Director";
        $br["dif"] = "Finance Director";
        $br["gm"] = "General Manager";
        $br["dops"] = "Operation Manager";
        $br["ops"] = "Operation";
        $br["mar"] = "Marketing";
        $br["fin"] = "Finance";
        $br["pro"] = "Procurement";
        $br["it"] = "IT";
        $br["ast"] = "Asset";
        $br["wh"] = "Warehouse";

        $company = ConfigCompany::where('id', $id)->first();

        $label = DB::table('pref_activity_label')->get();
        $action = DB::table('pref_activity_action')->get();

        $pref_action_point = Pref_activity_point::where('company_id', $company->id)->get();
        $data_point = array();
        foreach ($pref_action_point as $item){
            $data_point[$item->id_modul][$item->action] = $item->point;
        }


        for ($m=1; $m<=12; $m++) {
            $month[$m] = date('F', mktime(0,0,0,$m, 1, date('Y')));
        }
//        dd($preferences);
        return view('preference.index',[
            'company' => $company,
            'preferences' => $preferences,
            'template_files' => $template_files,
            'br_list' => $br,
            'months' => $month,
            'label' => $label,
            'action' => $action,
            'data_point' => $data_point
        ]);
    }

    public function savePref(Request $request){
        $pref = Preference_config::where('id_company',$request['id_company'])->first();
        if ($pref === null){
            if (isset($request['saveAttendance'])){
                $prefNew = new Preference_config();
                $prefNew->penalty_amt = $request['penalty_amt'];
                $prefNew->penalty_period = $request['penalty_period'];
                $prefNew->penalty_start = $request['penalty_start'];
                $prefNew->penalty_stop = $request['penalty_stop'];
                $prefNew->id_company = $request['id_company'];
                $prefNew->save();
            }
            if (isset($request['savePayrollPeriod'])){
                $prefNew = new Preference_config();
                $prefNew->period_start = $request['period_start'];
                $prefNew->period_end = $request['period_end'];
                $prefNew->id_company = $request['id_company'];
                $prefNew->save();
            }
            if (isset($request['saveDeduction'])){
                $prefNew = new Preference_config();
                $prefNew->absence_deduction = $request['absence_deduction'];
                $prefNew->id_company = $request['id_company'];
                $prefNew->save();
            }
        } else {
            if (isset($request['saveAttendance'])){
                Preference_config::where('id',$request['id'])
                    ->update([
                        'penalty_amt' => $request['penalty_amt'],
                        'penalty_period' => $request['penalty_period'],
                        'penalty_start' => $request['penalty_start'],
                        'penalty_stop' => $request['penalty_stop'],
                    ]);
            }
            if (isset($request['savePayrollPeriod'])){
                Preference_config::where('id',$request['id'])
                    ->update([
                        'period_start' => $request['period_start'],
                        'period_end' => $request['period_end'],
                    ]);
            }
            if (isset($request['saveDeduction'])){
                Preference_config::where('id',$request['id'])
                    ->update([
                        'absence_deduction' => $request['absence_deduction'],
                    ]);
            }
        }


        return redirect()->route('preference',['id_company'=>base64_encode($request['id_company'])]);
    }

    function store_pr(Request $request){
        $pref = Preference_config::where('id_company', $request->id)->first();
        $pref->performa_period = $request->performa_period;
        $pref->performa_start = $request->performa_start;
        $pref->performa_end = $request->performa_end;
        $pref->performa_amt1 = $request->performa_amt1;
        $pref->performa_amt2 = $request->performa_amt2;
        $pref->performa_amt3 = $request->performa_amt3;
        $pref->performa_amt4 = $request->performa_amt4;
        $pref->performa_amt5 = $request->performa_amt5;

        Session::put('company_performa_period', $request->performa_period);
        Session::put('company_performa_start', $request->performa_start);
        Session::put('company_performa_end', $request->performa_end);
        Session::put('company_performa_amt1', $request->performa_amt1);
        Session::put('company_performa_amt2', $request->performa_amt2);
        Session::put('company_performa_amt3', $request->performa_amt3);
        Session::put('company_performa_amt4', $request->performa_amt4);
        Session::put('company_performa_amt5', $request->performa_amt5);

        $pref->save();

        return redirect()->route('preference', base64_encode($request->id));

    }

    function store_ac(Request $request){
//        dd($request);
        $point = $request->point;
        foreach ($point as $key => $item){
            foreach ($item as $keyItem => $value){
                $iPoint = Pref_activity_point::where('company_id', Session::get('company_id'))
                    ->where('id_modul', $key)
                    ->where('action', $keyItem)
                    ->first();
                if (empty($iPoint)){
                    $nPoint = new Pref_activity_point();
                    $nPoint->id_modul = $key;
                    $nPoint->action = $keyItem;
                    $nPoint->point = $value;
                    $nPoint->created_by = Auth::user()->username;
                    $nPoint->company_id = Session::get('company_id');
                    $nPoint->save();
                } else {
                    $nPoint = Pref_activity_point::find($iPoint->id);
                    $nPoint->point = $value;
                    $nPoint->updated_by = Auth::user()->username;
                    $nPoint->save();
                }
            }
        }

        return redirect()->back();
    }
}
