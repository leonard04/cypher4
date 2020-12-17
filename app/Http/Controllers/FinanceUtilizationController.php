<?php

namespace App\Http\Controllers;

use App\Models\Finance_util_criteria;
use App\Models\Finance_util_instance;
use App\Models\Finance_util_master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class FinanceUtilizationController extends Controller
{
    function index(){
        $criteria = Finance_util_criteria::where('company_id', Session::get('company_id'))->get();
        $crit_name = [];
        foreach ($criteria as $item){
            $crit_name[$item->id] = $item->name;
        }

        for ($m=1; $m<=12; $m++) {
            $month[$m] = date('F', mktime(0,0,0,$m, 1, date('Y')));
        }

        $util = Finance_util_master::where('company_id', Session::get('company_id'))->get();
        if (count($util) > 0){
            foreach ($util as $item){
                $up = false;
                list($y, $m, $d) = explode("-", $item->recurrent_date);
                $pay_date = date('Y-m', strtotime($item->recurrent_date));
                if ($item->status == "running"){
                    while ($pay_date <= date('Y-m')){
                        if ($item->recurrent_type == "monthly"){
                            if ($d > date('t', strtotime($pay_date))){
                                $new_date = $pay_date."-".date('t', strtotime($pay_date));
                            } else {
                                $new_date = $pay_date."-".$d;
                            }
                        } elseif ($item->recurrent_type == "yearly"){
                            $new_date = date("Y")."-$m-$d";
                        } elseif ($item->recurrent_type == "custom"){
                            $n = $item->n_date;
                            $pay_date = date("Y-m-d", strtotime("+$n month", strtotime($item->recurrent_date)));
                            if (date('Y-m-d') > $item->last_date){
                                $new_date = $pay_date;
                                $up = true;
                            } else {
                                $new_date = $item->last_date;
                                $up = false;
                            }
                        }

                        if ($up){
                            Finance_util_master::where('id', $item->id)
                                ->update([
                                    'last_date' => $new_date
                                ]);
                        }

                        $util_ins = Finance_util_instance::where('id_master', $item->id)
                            ->where('pay_date', $new_date)->get();
                        if (count($util_ins) == 0){
                            $amount_back = 0;
                            switch ($item->type){
                                case "FIXED":
                                    $amount_back = $item->amount;
                                    break;
                                case "VARIABLE" :
                                    $amount_back = 0;
                                    break;
                            }

                            $iUtilIns = new Finance_util_instance();
                            //`id_master`, `subject`, `description`, `pay_date`, `amount`, `amount_back`, `progress`, `currency`
                            $iUtilIns->id_master = $item->id;
                            $iUtilIns->subject = $item->subject;
                            $iUtilIns->description = $item->description;
                            $iUtilIns->pay_date = $new_date;
                            $iUtilIns->amount = $item->amount;
                            $iUtilIns->amount_back = $amount_back;
                            $iUtilIns->progress = 'created';
                            $iUtilIns->currency = $item->currency;
                            $iUtilIns->company_id = Session::get('company_id');
                            $iUtilIns->save();

                        }

                        $pay_date = date("Y-m", strtotime("+1 month", strtotime($pay_date)));
                    }
                }
            }
        }

        return view('finance.utilization.index', [
            'criteria' => $criteria,
            'months' => $month,
            'utils' => $util,
            'criteria_name' => $crit_name
        ]);
    }

    function getDateMonth($date){
        $n = date("t", strtotime(date("Y")."-".$date));
        for ($i=1; $i<= $n; $i++){
            $data['id'] = $i;
            $data['text'] = $i;
            $val[] = $data;
        }

        $response = [
            'results' => $val,
            'pagination' => ["more" => true]
        ];

        return json_encode($response);
    }

    //`subject`, `description`, `recurrent_date`, `recurrent_type`, `type`, `amount`, `currency`, `status`, `last_date`, `n_date`, `classification`

    function add(Request $request){
        $util = new Finance_util_master();
        $util->subject = $request->util_name;
        $util->description = $request->description;
        $util->recurrent_date = date('Y')."-".$request->rmonth."-".$request->rdate;
        $util->recurrent_type = $request->rtype;
        $util->type = $request->utilization;
        $util->amount = $request->amount;
        $util->currency = $request->currency;
        $util->status = 'ready';
        $util->last_date = date('Y')."-".$request->rmonth."-".$request->rdate;
        if ($request->rtype == "custom"){
            $util->n_date = $request->cmonth;
        }
        $util->classification = $request->type;
        $util->company_id = Session::get('company_id');

        if ($util->save()){
            return redirect()->route('util.index');
        }
    }

    function view($id){
        $util = Finance_util_master::find($id);

        $util_ins = Finance_util_instance::where('id_master', $id)
            ->orderBy('pay_date', 'DESC')
            ->get();

        return view('finance.utilization.view', [
            'util' => $util,
            'items' => $util_ins
        ]);
    }

    function update_status($id){
        $util = Finance_util_master::find($id);
        if ($util->status == "ready"){
            $util->status = "running";
        } else {
            $util->status = "ready";
        }

        if ($util->save()){
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    function change_amount(Request $request){
        $util = Finance_util_master::find($request->id);
        $util->amount = $request->amount;

        if ($util->save()){
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    function change_amount_instance(Request $request){
        $util = Finance_util_instance::find($request->id);
        $util->amount_back = $request->amount;

        if ($util->save()){
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    function addCriteria(Request $request){
        $criteria = new Finance_util_criteria();
        $criteria->name = $request->category_name;
        $criteria->content = $request->description;
        $criteria->author = Auth::user()->username;
        $criteria->created_by = Auth::user()->username;
        $criteria->company_id = Session::get('company_id');
        $criteria->save();

        return redirect()->route('util.index');
    }

    function deleteCriteria($id){
        Finance_util_criteria::find($id)->delete();

        return redirect()->route('util.index');
    }

    function deleteInstance($id){
        $util = Finance_util_instance::find($id);
        $id_master = $util->id_master;
        $util->delete();

        return redirect()->route('util.view', $id_master);
    }

    function delete(Request $request){
        $master = Finance_util_master::find($request->val);
        $util = Finance_util_instance::find($master->id);
        $id_master = $util->id_master;
        $util->delete();

        if ($master->delete()){
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }
}
