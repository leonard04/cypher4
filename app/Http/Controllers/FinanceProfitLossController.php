<?php

namespace App\Http\Controllers;

use App\Models\Finance_coa;
use App\Models\Finance_coa_history;
use App\Models\Finance_profit_loss_setting;
use Illuminate\Http\Request;
use Session;

class FinanceProfitLossController extends Controller
{
    function index(){
        $coa = Finance_coa::all();
        $setting = Finance_profit_loss_setting::where('company_id', Session::get('company_id'))->first();
        return view('finance.pl.index', [
            'coa' => $coa,
            'setting' => $setting
        ]);
    }

    function setting(Request $request){
        $opi = json_encode($request->oi);
        $ope = json_encode($request->oe);
        $oti = json_encode($request->oti);
        $ote = json_encode($request->ote);

        $setting = Finance_profit_loss_setting::where('company_id', Session::get('company_id'))->first();
        if ($setting == null){
            $iSetting = new Finance_profit_loss_setting();
            $iSetting->operating_income = $opi;
            $iSetting->operating_expense = $ope;
            $iSetting->other_income = $oti;
            $iSetting->other_expense = $ote;
            $iSetting->tax = $request->tax;
            $iSetting->company_id = Session::get('company_id');
            $iSetting->save();
        } else {
            $setting->operating_income = $opi;
            $setting->operating_expense = $ope;
            $setting->other_income = $oti;
            $setting->other_expense = $ote;
            $setting->tax = $request->tax;
            $setting->save();
        }

        return redirect()->route('pl.index');
    }

    function find(Request $request){
        $setting = Finance_profit_loss_setting::where('company_id', Session::get('company_id'))->first();

        $data['data'] = [];

        $coa_oi = $this->find_coa_code(json_decode($setting->operating_income));
        $coa_oe = $this->find_coa_code(json_decode($setting->operating_expense));
        $coa_oti = $this->find_coa_code(json_decode($setting->other_income));
        $coa_ote = $this->find_coa_code(json_decode($setting->other_expense));

        array_push($data['data'], $this->find_coa_his($coa_oi, "Operating Income"));
        array_push($data['data'], $this->find_coa_his($coa_oe, "Operating Expense"));
        array_push($data['data'], $this->find_coa_his($coa_oti, "Other Incomes"));
        array_push($data['data'], $this->find_coa_his($coa_ote, 'Other Expenses'));

        $opi = $this->find_coa_his($coa_oi, "Operational Income");
        $ope = $this->find_coa_his($coa_oe, "Operational Expense");
        $oti = $this->find_coa_his($coa_oti, "Other Incomes");
        $ote = $this->find_coa_his($coa_ote, 'Other Expenses');

        $num = 0;
        $sumopi = 0;
        $sumope = 0;
        $sumoti = 0;
        $sumote = 0;
        $type = "";

        $type = "Operational Income";

        foreach ($opi as $value){
            $row[$num][] = "<center>".$value['code']."</center>";
            $row[$num][] = number_format(array_sum($value['amount']), 2);
            $row[$num][] = $value['type'];
            $row[$num][] = "";
            $sumopi = $sumopi + array_sum($value['amount']);
            $num++;
        }

        $row[$num][] = "Total ".$type;
        $row[$num][] = "";
        $row[$num][] = $type;
        $row[$num][] = "<b>".number_format($sumopi)."</b>";
        $num++;

        $type = "Operational Expense";

        foreach ($ope as $value){
            $row[$num][] = "<center>".$value['code']."</center>";
            $row[$num][] = number_format(array_sum($value['amount']), 2);
            $row[$num][] = $value['type'];
            $row[$num][] = "";
            $sumope = $sumope + array_sum($value['amount']);
            $num++;
        }

        $row[$num][] = "Total ".$type;
        $row[$num][] = "";
        $row[$num][] = $type;
        $row[$num][] = "<b>".number_format($sumope)."</b>";
        $num++;

        $sumpl = $sumopi - $sumope;

        if ($sumpl > 0){
            $type = "Operational Profit";
        } else {
            $type = "Operational Loss";
        }
        $row[$num][] = "Total ".$type;
        $row[$num][] = "";
        $row[$num][] = $type;
        $row[$num][] = "<b>".number_format($sumpl)."</b>";
        $num++;

        $type = "Other Incomes";

        foreach ($oti as $value){
            $row[$num][] = "<center>".$value['code']."</center>";
            $row[$num][] = number_format(array_sum($value['amount']), 2);
            $row[$num][] = $value['type'];
            $row[$num][] = "";
            $sumoti = $sumoti + array_sum($value['amount']);
            $num++;
        }

        $row[$num][] = "Total ".$type;
        $row[$num][] = "";
        $row[$num][] = $type;
        $row[$num][] = "<b>".number_format($sumoti)."</b>";
        $num++;

        $xi = $sumpl + $sumoti;

        $row[$num][] = $type;
        $row[$num][] = "";
        $row[$num][] = $type;
        $row[$num][] = "<b>".number_format($xi)."</b>";
        $num++;

        $type = "Other Expenses";

        foreach ($ote as $value){
            $row[$num][] = "<center>".$value['code']."</center>";
            $row[$num][] = number_format(array_sum($value['amount']), 2);
            $row[$num][] = $value['type'];
            $row[$num][] = "";
            $sumote = $sumote + array_sum($value['amount']);
            $num++;
        }

        $row[$num][] = "Total ".$type;
        $row[$num][] = "";
        $row[$num][] = $type;
        $row[$num][] = "<b>".number_format($sumote)."</b>";
        $num++;

        $xe = $xi - $sumote;

        $row[$num][] = $type;
        $row[$num][] = "";
        $row[$num][] = $type;
        $row[$num][] = "<b>".number_format($xe)."</b>";
        $num++;

        $type = "Net Before Tax";

        $row[$num][] = "Total ".$type;
        $row[$num][] = "";
        $row[$num][] = $type;
        $row[$num][] = "<b>".number_format($xe)."</b>";
        $num++;

        $type = "Tax";

        $tax = $xe * ($setting->tax / 100);

        $row[$num][] = "Total ".$type;
        $row[$num][] = "";
        $row[$num][] = $type;
        $row[$num][] = "<b>".number_format($tax)."</b>";
        $num++;

        $type = "Net profit";

        $net = $xe - $tax;

        $row[$num][] = "Total ".$type;
        $row[$num][] = "";
        $row[$num][] = $type;
        $row[$num][] = "<b>".number_format($net)."</b>";
        $num++;


        $val = array(
            'data' => $row,
        );


        return json_encode($val);
    }

    function find_coa_his($x, $y){
        $c = Finance_coa::all();
        $coa_name = [];
        foreach ($c as $item){
            $coa_name[$item->code] = $item->name;
        }
        $his = Finance_coa_history::whereIn('no_coa', $x)->get();
        $coa = [];
        foreach ($his as $item){
            $sum = 0;
            $coa[$item->no_coa]['code'] = "[".$item->no_coa."] ".$coa_name[$item->no_coa];
            if ($item->debit != null || $item->debit != 0){
                $sum = $item->debit;
            } else {
                $sum = $item->credit * -1;
            }
            $coa[$item->no_coa]['type'] = $y;
            $coa[$item->no_coa]['amount'][] = $sum;
        }

        return $coa;
    }

    function find_coa_code($x){
        $c = Finance_coa::all();
        $coa_code = [];
        $cc = [];
        $coa_oi = [];
        foreach ($c as $item){
            $coa_code[$item->parent_id][] = $item->code;
            $cc[$item->id] = $item->code;
        }

        $coa = [];
        foreach ($x as $item){
            $code = str_replace("0", "", $cc[$item]);
            $coa = Finance_coa::where('parent_id', 'like', $code."%")->get();
            $coa_oi[] = $cc[$item];
            foreach ($coa as $value){
                if (!in_array($value->code, $coa_oi)){
                    $coa_oi[] = $value->code;
                }
            }
        }


        return array_unique($coa_oi);
    }
}
