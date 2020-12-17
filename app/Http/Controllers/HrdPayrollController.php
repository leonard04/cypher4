<?php

namespace App\Http\Controllers;

use App\Models\Finance_util_salary;
use App\Models\General_travel_order;
use App\Models\Hrd_bonus;
use App\Models\Hrd_bonus_payment;
use App\Models\Hrd_config;
use App\Models\Hrd_employee;
use App\Models\Hrd_employee_history;
use App\Models\Hrd_employee_loan;
use App\Models\Hrd_employee_loan_payment;
use App\Models\Hrd_overtime;
use App\Models\Hrd_salary_archive;
use App\Models\Hrd_sanction;
use App\Models\Preference_config;
use Illuminate\Http\Request;
use Session;
use DB;

class HrdPayrollController extends Controller
{
    function signName($loc){
        switch($loc){
            case "staff":
            case "konsultan":
            case "whbin":
            case "whcil":
                $ret[0] = "HRD Manager"; $ret[1] = "Finance Manager"; $ret[2] = "Operation Director";
                break;
            case "field":
                $ret[0] = "Operation Manager"; $ret[1] = "Operation Director"; $ret[2] = "President Director";
                break;
            case "manager":
                $ret[0] = "Finance Director"; $ret[1] = "Operation Director";
                break;
            default:
                $ret[0] = "Operation Manager"; $ret[1] = "Finance Director"; $ret[2] = "Operation Director";
                break;
        }
        return $ret;
    }

    public function tableSignature($arr){
        $var1 = "<table width='827' border='1' style='border-collapse:collapse'><tr>
  			<td width='25%' align='center'>Prepared By </td>";
        if(count($arr) == 3) { $var2 = "<td colspan='2' align='center'>Approved By </td>";
            $var4 = "
    <td width='25%' align='center'><br /><br /><br />$arr[1]<br />Date: ____ </td>
    <td width='25%' align='center'><br /><br /><br />$arr[2]<br />Date: ____</td>";
        }
        if(count($arr) == 2) { $var2 = "<td align='center'>Approved By </td>";
            $var4 = "<td width='25%' align='center'><br /><br /><br />$arr[1]<br />Date: ____ </td>";
        }
        $var3 = "</tr><tr>
  <td align='center'><br /><br /><br />$arr[0]<br />Date: ____</td>";
        $var5 = "</tr></table>";
        $var6 = $var1.$var2.$var3.$var4.$var5;
        return $var6;
    }

    function index(Request $request){
        for ($m=1; $m<=12; $m++) {
            $data['month'][$m] = date('F', mktime(0,0,0,$m, 1, date('Y')));
        }

        $data['type'] = array(
            'all' => 'All',
            'staff'=> 'Staff',
            'manager'=> 'Manager',
            'marketing'=> 'Marketing',
            'bod'=> 'BOD',
            'field'=> 'Field Engineer',
            'whbin'=> 'WH Bintaro',
            'whcil'=> 'WH Cileungsi',
            'konsultan'=> 'Konsultan',
            'local'=> 'Local'
        );

        $startyear = date('Y', strtotime('-10 years'));
        for ($i = 0; $i < 20; $i++){
            $data['years'][$i] = $startyear;
            $startyear++;
        }

        return view('payroll.index', $data);
    }

    function export(Request $request){
        return view('payroll.export', [
            'type' => $request->type,
            'month' => $request->month,
            'years' => $request->years,
        ]);
    }

    function show(Request $request){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $t = $request->type;
        $m = $request->month;
        $y = $request->years;

        $pref = Preference_config::whereIn('id_company', $id_companies)->get();
//        dd($pref->period_start);
        $prefCount = $pref->count();
        $now = date('Y-n-d');

//        dd($pref);
        if ($prefCount >0){
            $period_end = $pref[0]->period_end;
            $period_start = $pref[0]->period_start;
        } else {
            if (session()->has('company_period_end') && session()->has('company_period_start')){
                $period_end = Session::get('company_period_end');
                $period_start = Session::get('company_period_start');
            } else {
                $period_end = 27;
                $period_start = 28;
            }
        }
//        $period_end = Session::get('company_period_end');
//        $period_start = Session::get('company_period_start');
//        $thr_period = Session::get('company_thr_period');

        $thr_period = Session::get('company_thr_period');
//            dd($period_end);
        if($t == "all"){
            $emp = Hrd_employee::where('expel', null)
                ->whereIn('company_id', $id_companies)
                ->get();
        } else {
            $emp = Hrd_employee::where('emp_position', $t)
                ->where('expel', null)
                ->whereIn('company_id', $id_companies)
                ->get();
        }
        $emp_name = [];
        $emp_pos = [];
        $emp_bank = [];
        $emp_type = [];
        $type_emp = [];

        foreach ($emp as $key => $value) {
            $emp_name[$value->id] = $value->emp_name;
            $emp_pos[$value->id] = $value->emp_position;
            $emp_bank[$value->id] = $value->bank_acct;
            $emp_type[] = $value->id;
            $type_emp[$value->emp_position][] = $value->id;
        }


//        $emp_arc = Hrd_salary_archive::where('company_id',\Session::get('company_id'))->get();

        $emp_his = Hrd_employee_history::where('activity', 'in')->get();

        foreach ($emp_his as $key => $value) {
            $act_date[$value->emp_id] = $value->act_date;
        }

        $sign = $this->signName($t);

        $period_start_date = $y."-".sprintf('%02d', $m-1)."-".$period_start;
        $period_end_date = $y."-".sprintf('%02d', $m)."-".$period_end;
        $period_4 = $y."-".sprintf('%02d', $m)."-". ($period_end + 1);

        $ovt = Hrd_overtime::whereIn('company_id', $id_companies)
            ->whereBetween('ovt_date', [$period_start_date, $period_end_date])
            ->get();
//        dd($ovt);
        foreach ($ovt as $key => $value) {
            $time_in[$value->emp_id][] = $value->time_in;
            $time_out[$value->emp_id][] = $value->time_out;
        }

        $to = General_travel_order::where('status', 0)
            ->whereBetween('departure_dt', [$period_start_date, $period_end_date])
            ->orWhereBetween('departure_dt', [$period_start_date, $period_end_date])
            ->get();
//        dd($to::getQueryLog());

        foreach ($to as $key => $value) {
            $d1 = ($period_end_date > $value->return_dt) ? $value->return_dt : $period_end_date;
            $d2 = ($period_start_date > $value->departure_dt) ? $period_start_date : $value->departure_dt;

            $sum = date_diff(date_create($d1), date_create($d2));

            if ($value->travel_type == "reg") {
                if (empty($value->location_rate)) {
                    switch ($value->dest_type) {
                        case "fld" :
                            $fld_day[$value->employee_id] = $sum->format("%a");
                            break;
                        case "wh" :
                            $wh_day[$value->employee_id] = $sum->format("%a");
                            break;
                    }
                } elseif ($value->location_rate == "SWT") {
                    switch ($value->dest_type) {
                        case "fld" :
                            $fld_swt[$value->employee_id] = $sum->format("%a");
                            break;
                    }
                } elseif ($value->location_rate == "DGR") {
                    switch ($value->dest_type) {
                        case "fld" :
                            $fld_dgr[$value->employee_id] = $sum->format("%a");
                            break;
                    }
                }
            } elseif ($value->travel_type = "odo") {
                if (empty($value->location_rate)) {
                    if ($value->dest_type == "fld_bonus") {
                        $odo_day[$value->employee_id] = $sum->format("%a");
                    }
                } elseif ($value->location_rate == "SWT") {
                    if ($value->dest_type == "fld_bonus") {
                        $odo_swt[$value->employee_id] = $sum->format("%a");
                    }
                } elseif ($value->location_rate == "DGR") {
                    if ($value->dest_type == "fld_bonus") {
                        $odo_dgr[$value->employee_id] = $sum->format("%a");
                    }
                }
            }
        }

        $whereLoan = $y."-".sprintf("%02d", $m);

        $loan = Hrd_employee_loan::all();

        $loan_det = Hrd_employee_loan_payment::where('date_of_payment', "LIKE", '%' . $whereLoan . '%')->get();

        $bonus = Hrd_bonus::all();

        $bonus_pay = Hrd_bonus_payment::where('date_of_payment', "LIKE", '%' . $whereLoan . '%')->get();

        $foot['sum_salary'] = 0;
        $foot['sum_ovt'] = 0;
        $foot['sum_fld'] = 0;
        $foot['sum_wh'] = 0;
        $foot['sum_odo'] = 0;
        $foot['sum_tk'] = 0;
        $foot['sum_ks'] = 0;
        $foot['sum_jshk'] = 0;
        $foot['sum_tot_salary'] = 0;
        $foot['sum_sunction'] = 0;
        $foot['sum_absence'] = 0;
        $foot['sum_loan'] = 0;
        $foot['sum_ded_tk'] = 0;
        $foot['sum_ded_ks'] = 0;
        $foot['sum_ded_jshk'] = 0;
        $foot['sum_bonus'] = 0;
        $foot['sum_thr'] = 0;
        $foot['sum_pph21'] = 0;
        $foot['sum_prop'] = 0;
        $foot['sum_thp'] = 0;
        $foot['sum_voucher'] = 0;
        $foot['sum_ovt'] = 0;
        $foot['sum_sanction'] = 0;

        $rangeStart = $y."-".($m-1)."-".$period_start;
        $rangeEnd = $y."-".$m."-".$period_end;
        $pro_n_day = date("t", strtotime($rangeEnd));

        if (strtotime($now) > strtotime($period_end_date)) {
            foreach ($emp as $key => $value) {
                $archive = Hrd_salary_archive::where('emp_id', $value->id)
                    ->where('archive_period', $m."-".$y)
                    ->whereIn('company_id', $id_companies)->first();
                if (empty($archive) || $archive == null){
                    $row = new Hrd_salary_archive();
                    $salary_emp = base64_decode($value->salary);
                    $sunction = 0;
                    $absence_deduct = 0;
                    $bonus_amt = 0;
                    $ln_amt = 0;
                    $hours = 0;

                    $sanction = Hrd_sanction::where('emp_id', $value->id)
                        ->whereNotNull('approved_by')
                        ->whereBetween('sanction_date',[$rangeStart,$rangeEnd])
                        ->get();
                    foreach ($sanction as $key => $valSanc){
                        $sunction += intval($valSanc->sanction_amount);
                    }

                    $foot['sum_sanction'] += $sunction;

                    $allow_bpjs_tk = ($value->allow_bpjs_tk == "") ? 0 : $value->allow_bpjs_tk;
                    $allow_bpjs_kes = ($value->allow_bpjs_kes == "") ? 0 : $value->allow_bpjs_kes;
                    $allow_jshk = ($value->allow_jshk == "") ? 0 : $value->allow_jshk;

                    $foot['sum_tk'] += $allow_bpjs_tk;
                    $foot['sum_ks'] += $allow_bpjs_kes;
                    $foot['sum_jshk'] += $allow_jshk;

                    $deduc_bpjs_tk = ($value->deduc_bpjs_tk == "") ? 0 : $value->deduc_bpjs_tk;
                    $deduc_bpjs_kes = ($value->deduc_bpjs_kes == "") ? 0 : $value->deduc_bpjs_kes;
                    $deduc_jshk = ($value->deduc_jshk == "") ? 0 : $value->deduc_jshk;
                    $deduc_pph21 = ($value->deduc_pph21 == "") ? 0 : $value->deduc_pph21;

                    $foot['sum_ded_tk'] += $deduc_bpjs_tk;
                    $foot['sum_ded_ks'] += $deduc_bpjs_kes;
                    $foot['sum_ded_jshk'] += $deduc_jshk;


                    $sal = $salary_emp + base64_decode($value->transport) + base64_decode($value->meal) + base64_decode($value->house) + base64_decode($value->health);

                    if (!empty($time_in[$value->id])) {
                        for ($i=0; $i < count($time_in[$value->id]); $i++) {
                            $diff = strtotime($time_out[$value->id][$i]) - strtotime($time_in[$value->id][$i]);
                            $hours += $diff;
                        }
                    }

                    $ovt_total = $value->overtime * ceil(($hours / 3600));

                    $foot['sum_ovt'] += $ovt_total;
                    $whday = (empty($wh_day[$value->id])) ? "0" : $wh_day[$value->id];
                    $fldday = (empty($fld_day[$value->id])) ? "0" : $fld_day[$value->id];
                    $fldswtday = (empty($fld_swt[$value->id])) ? "0" : $fld_swt[$value->id];
                    $fldgrday = (empty($fld_dgr[$value->id])) ? "0" : $fld_dgr[$value->id];

                    $fld = $value->fld_bonus * $fldday;
                    $flddgr = ($value->fld_bonus + 25000) * $fldgrday;
                    $fldswt = ($value->fld_bonus + 50000) * $fldswtday;

                    $foot['sum_fld'] += $fld + $flddgr + $fldswt;

                    $wh = $value->wh_bonus * $whday;

                    $foot['sum_wh'] += $wh;

                    $ododay = (empty($odo_day[$value->id])) ? "0" : $odo_day[$value->id];
                    $odoswtday = (empty($odo_swt[$value->id])) ? "0" : $odo_swt[$value->id];
                    $odogrday = (empty($odo_dgr[$value->id])) ? "0" : $odo_dgr[$value->id];

                    $odo = $value->odo_bonus * $ododay;
                    $ododgr = ($value->odo_bonus + 25000) * $odogrday;
                    $odoswt = ($value->odo_bonus + 50000) * $odoswtday;

                    $foot['sum_odo'] += $odo + $ododgr + $odoswt;

                    foreach ($loan as $keyLoan => $valueLoan) {
                        if ($value->id == $valueLoan->emp_id) {
                            foreach ($loan_det as $keyDet => $valueDet) {
                                if ($valueLoan->id == $valueDet->loan_id) {
                                    $ln_amt += $valueDet->amount;
                                }
                            }
                        }
                    }

                    $foot['sum_loan'] += $ln_amt;

                    foreach ($bonus as $keyBonus => $valueBonus) {
                        if ($value->id == $valueBonus->emp_id) {
                            foreach ($bonus_pay as $keyBonusPay => $valueBonusPay) {
                                if ($valueBonus->id == $valueBonusPay->bonus_id) {
                                    $bonus_amt += $valueBonusPay->amount;
                                }
                            }
                        }
                    }

                    $yearly_bonus = $value->yearly_bonus * $salary_emp + $value->fx_yearly_bonus;
                    $bonus_only = $value->yearly_bonus * $salary_emp;

                    // Datatable
                    $row->emp_id = $value->id;
                    $row->archive_period = $m."-".$y;
                    $row->salary = base64_encode($sal);
                    $row->ovt_rate = $value->overtime;
                    $row->ovt_nom = $ovt_total;
                    $row->field_rate = $value->fld_bonus;
                    $row->field_nom = $fld;
                    $row->wh_rate = $value->wh_bonus;
                    $row->wh_nom = $wh;
                    $row->odo_rate = $value->odo_bonus;
                    $row->odo_nom = $odo;
                    $row->voucher = $value->voucher;
                    $row->deduction = $ln_amt;
                    $row->lateness = $sunction;
                    $row->bonus = 0;
                    $isThr = sprintf("%02d", $m)."-".$y;
                    if ($isThr == strip_tags($thr_period)){
                        $thr_total = $sal * $value->thr;
                    } else {
                        $thr_total = 0;
                    }
                    $row->thr = $thr_total;
                    $row->category = $t;
                    $row->fld_dgr = $flddgr;
                    $row->fld_swt = $fldswt;
                    $row->odo_dgr = $ododgr;
                    $row->odo_swt = $odoswt;
                    $row->allow_bpjs_tk = $allow_bpjs_tk;
                    $row->allow_bpjs_kes = $allow_bpjs_kes;
                    $row->allow_jshk = $allow_jshk;
                    $row->deduc_bpjs_tk = $deduc_bpjs_tk;
                    $row->deduc_bpjs_kes = $deduc_bpjs_kes;
                    $row->deduc_jshk = $deduc_jshk;
                    $row->deduc_pph21 = $deduc_pph21;

                    $total_sal = $sal + $ovt_total + $fld + $wh + $odo + $ododgr + $odoswt + $flddgr + $fldswt + $value->voucher + $value->allow_bpjs_tk + $value->allow_bpjs_kes + $value->allow_jshk;

                    $thp = $total_sal - $sunction - $absence_deduct - $ln_amt - $value->deduc_bpjs_tk - $value->deduc_bpjs_kes - $value->deduc_jshk - $value->deduc_pph21;
                    $xthp = $thp - $fld - $wh - $odo - $ododgr - $odoswt - $fldswt - $flddgr;
                    $pro_day = round((strtotime($act_date[$value->id]) - strtotime($rangeStart)) / 86400,0);
                    $in_date = $act_date[$value->id];
                    $zero_day = (strtotime($rangeEnd) - strtotime($act_date[$value->id])) / 86400;
                    if($pro_day > 0 && $pro_day <= $pro_n_day)
                    {
                        $pro_basis = $pro_n_day;
                        $pro_decrement = ($pro_day) / $pro_basis * $xthp;
                    }
                    //kalau hari masuk = start month gaji, pengurangan = gaji = ZERO gaji.
                    elseif($pro_day == 0)
                    {
                        // $pro_decrement = $xthp;
                        if(date('d',strtotime($in_date)) == 16)
                        {
                            $pro_decrement = 0;
                        }
                        else
                        {
                            $pro_decrement = $xthp;
                        }
                    }
                    //tidak ada pemotongan
                    else
                    {
                        $pro_decrement = 0;
                    }

                    //kalau tgl masuk baru lebih baru dari range2. ZERO gaji
                    if($zero_day <= 0)
                    {
                        $pro_decrement = $xthp;
                    }

                    if($pro_day >= 0 && $pro_day <= 30) {
                        $total_decrement = $pro_decrement;
                    } elseif($zero_day <= 0) {
                        $total_decrement = $pro_decrement;
                    } else {
                        $total_decrement = 0;
                    }

                    $row->proportional = $total_decrement; //Proportional
                    $row->company_id = Session::get('company_id');

                    $row->save();
                }

            }

            $emp_arc = Hrd_salary_archive::where('archive_period', $m."-".$y)
                ->whereIn('company_id', $id_companies)
                ->whereIn('emp_id', $emp_type)
                ->get();

            if (count($emp_arc) > 0) {
                foreach ($emp_arc as $key => $value) {
                    $row = [];
                    $salary_emp = base64_decode($value->salary);

                    $allow_bpjs_tk = ($value->allow_bpjs_tk == "") ? 0 : $value->allow_bpjs_tk;
                    $allow_bpjs_kes = ($value->allow_bpjs_kes == "") ? 0 : $value->allow_bpjs_kes;
                    $allow_jshk = ($value->allow_jshk == "") ? 0 : $value->allow_jshk;

                    $foot['sum_tk'] += $allow_bpjs_tk;
                    $foot['sum_ks'] += $allow_bpjs_kes;
                    $foot['sum_jshk'] += $allow_jshk;

                    $deduc_bpjs_tk = ($value->deduc_bpjs_tk == "") ? 0 : $value->deduc_bpjs_tk;
                    $deduc_bpjs_kes = ($value->deduc_bpjs_kes == "") ? 0 : $value->deduc_bpjs_kes;
                    $deduc_jshk = ($value->deduc_jshk == "") ? 0 : $value->deduc_jshk;

                    $foot['sum_ded_tk'] += $deduc_bpjs_tk;
                    $foot['sum_ded_ks'] += $deduc_bpjs_kes;
                    $foot['sum_ded_jshk'] += $deduc_jshk;


                    $sal = base64_decode($value->salary);

                    $hours = 0;

                    if (!empty($time_in[$value->emp_id])) {
                        for ($i=0; $i < count($time_in[$value->emp_id]); $i++) {
                            $diff = strtotime($time_out[$value->emp_id][$i]) - strtotime($time_in[$value->emp_id][$i]);
                            $hours += $diff;
                        }
                    }

                    $ovt_total = $value->ovt_nom;

                    $foot['sum_ovt'] += $ovt_total;
                    $whday = (empty($wh_day[$value->emp_id])) ? "0" : $wh_day[$value->emp_id];
                    $fldday = (empty($fld_day[$value->emp_id])) ? "0" : $fld_day[$value->emp_id];
                    $fldswtday = (empty($fld_swt[$value->emp_id])) ? "0" : $fld_swt[$value->emp_id];
                    $fldgrday = (empty($fld_dgr[$value->emp_id])) ? "0" : $fld_dgr[$value->emp_id];

                    $fld = $value->fld_nom;
                    $flddgr = ($value->fld_rate + 25000) * $fldgrday;
                    $fldswt = ($value->fld_rate + 50000) * $fldswtday;

                    $foot['sum_fld'] += $fld + $flddgr + $fldswt;

                    $wh = $value->wh_nom;

//                    $foot['sum_wh'] += $wh;

                    $ododay = (empty($odo_day[$value->emp_id])) ? "0" : $odo_day[$value->emp_id];
                    $odoswtday = (empty($odo_swt[$value->emp_id])) ? "0" : $odo_swt[$value->emp_id];
                    $odogrday = (empty($odo_dgr[$value->emp_id])) ? "0" : $odo_dgr[$value->emp_id];

                    $odo = $value->odo_nom;
                    $ododgr = ($value->odo_rate + 25000) * $odogrday;
                    $odoswt = ($value->odo_rate + 50000) * $odoswtday;

//                    $foot['sum_odo'] += $odo + $ododgr + $odoswt;

                    $ln_amt = $value->deduction;

                    $foot['sum_loan'] += $ln_amt;

                    $bonus_amt = $value->bonus;

                    // Datatable
                    $row[] = $key + 1;//
                    if (empty($emp_name) || $emp_name[$value->emp_id] == null){
                        $row[] = '';
                    } else {
                        $row[] = $emp_name[$value->emp_id]."<br>".$emp_pos[$value->emp_id]."<br><label style='font-style: italic;'>'".$emp_bank[$value->emp_id]."</label>";//

                    }

                    $row[] = number_format($sal,2);
                    $row[] = number_format($value->ovt_rate,2);
                    $row[] = floor(($hours / 3600))." hour(s) ". round(($hours%3600) / 60)." minute(s)";
                    $row[] = number_format($ovt_total,2);
                    $row[] = number_format($value->field_rate,2)."<br>". number_format(($value->field_rate + 50000),2) ."<br>".number_format(($value->field_rate + 25000),2);
                    $row[] = $fldday."<br>".$fldswtday."<br>".$fldgrday;
                    $row[] = number_format($fld,2)."<br>". number_format(($fldswt),2) ."<br>".number_format(($flddgr),2);
//                    $row[] = number_format($value->wh_rate,2);
//                    $row[] = $whday; // DAYS WH
//                    $row[] = number_format($wh,2);
//                    $row[] = number_format($value->odo_rate,2)."<br>". number_format(($value->odo_rate + 50000),2) ."<br>".number_format(($value->odo_rate + 25000),2);
//                    $row[] = $ododay."<br>".$odoswtday."<br>".$odogrday; // DAYS ODO
//                    $row[] = number_format($odo,2)."<br>". number_format(($odoswt),2) ."<br>".number_format(($ododgr),2);
                    $row[] = number_format($allow_bpjs_tk,2)."<br>". number_format($allow_bpjs_kes,2) ."<br>".number_format($allow_jshk,2);
                    $row[] = number_format($value->voucher,2);

                    $foot['sum_salary'] += $sal;
                    $foot['sum_ovt'] += $ovt_total;
                    $foot['sum_voucher'] += $value->voucher;
                    $total_sal = $sal + $ovt_total + $fld + $wh + $odo + $ododgr + $odoswt + $flddgr + $fldswt + $value->voucher + $value->allow_bpjs_tk + $value->allow_bpjs_kes + $value->allow_jshk;
                    $foot['sum_tot_salary'] += $total_sal;

                    $row[] = number_format($total_sal,2);
                    $row[] = number_format($value->lateness,2); //SUNCTION
                    $row[] = 0; //ABSENCE
                    $row[] = number_format($ln_amt, 2); //LOAN
                    $row[] = number_format($deduc_bpjs_tk,2)."<br>". number_format($deduc_bpjs_kes,2) ."<br>".number_format($deduc_jshk,2);;
                    $row[] = number_format(0, 2)."<br>B: ".number_format(0, 2)."<br>A: ".number_format(0, 2); //BONUS

                    $thr_total = $value->thr;

                    $foot['sum_thr'] += $thr_total;
                    $row[] = number_format($thr_total,2); //THR

                    $thp_total = $total_sal + $thr_total - $value->lateness;

                    $thp_total -= $value->proportional;
                    $foot['sum_thp'] += $value->proportional;

                    $row[] = ($value->deduc_pph21 == "") ? 0 : number_format($value->deduc_pph21,2); //PPH21
                    $foot['sum_pph21'] += $value->deduc_pph21;
                    $row[] = number_format($value->proportional,2); //Proportional
                    $row[] = number_format($thp_total,2); //THP
                    $empsalid[$value->emp_id] = $thp_total;
                    $foot['sum_prop'] += $value->proportional;

                    $data[] = $row;
                    $source = "Archive";


                }
                foreach ($type_emp as $keyEmp => $valueEmp){
                    $util = Finance_util_salary::where('position', strtolower($keyEmp))
                        ->where('salary_date', 'like', $y."-".$m."%")
                        ->get();

                    if (count($util) == 0){
                        $sal_total = 0;
                        foreach ($valueEmp as $itemEmp){
                            $sal_total += $empsalid[$itemEmp];
                        }

                        $nUtil = new Finance_util_salary();
                        $sdate = $y."-".$m."-28";
                        $nUtil->salary_date = $sdate;
                        $nUtil->currency = "IDR"; //default
                        $nUtil->amount = $sal_total;
                        $nUtil->plan_date = $sdate;
                        $nUtil->status = "waiting";
                        $nUtil->position = strtolower($keyEmp);
                        $nUtil->company_id = Session::get('company_id');
                        $nUtil->save();
                    }
                }

                $error = 0;
            } else {
                $error = 1;
                $data = null;
                $source = null;
            }
        } else {
            if (count($emp) > 0) {
                foreach ($emp as $key => $value) {
                    $row = [];
                    $salary_emp = base64_decode($value->salary);
                    $sunction = 0;
                    $absence_deduct = 0;
                    $bonus_amt = 0;
                    $ln_amt = 0;
                    $hours = 0;
                    $sumSanc = 0;

                    $sanction = Hrd_sanction::where('emp_id', $value->id)
                        ->whereNotNull('approved_by')
                        ->whereBetween('sanction_date',[$rangeStart,$rangeEnd])
                        ->get();

                    foreach ($sanction as $key => $valSanc){
                        $sunction += intval($valSanc->sanction_amount);
                    }


                    $allow_bpjs_tk = ($value->allow_bpjs_tk == "") ? 0 : $value->allow_bpjs_tk;
                    $allow_bpjs_kes = ($value->allow_bpjs_kes == "") ? 0 : $value->allow_bpjs_kes;
                    $allow_jshk = ($value->allow_jshk == "") ? 0 : $value->allow_jshk;

                    $foot['sum_sanction'] += $sunction;

                    $foot['sum_tk'] += $allow_bpjs_tk;
                    $foot['sum_ks'] += $allow_bpjs_kes;
                    $foot['sum_jshk'] += $allow_jshk;

                    $deduc_bpjs_tk = ($value->deduc_bpjs_tk == "") ? 0 : $value->deduc_bpjs_tk;
                    $deduc_bpjs_kes = ($value->deduc_bpjs_kes == "") ? 0 : $value->deduc_bpjs_kes;
                    $deduc_jshk = ($value->deduc_jshk == "") ? 0 : $value->deduc_jshk;

                    $foot['sum_ded_tk'] += $deduc_bpjs_tk;
                    $foot['sum_ded_ks'] += $deduc_bpjs_kes;
                    $foot['sum_ded_jshk'] += $deduc_jshk;


                    $sal = $salary_emp + base64_decode($value->transport) + base64_decode($value->meal) + base64_decode($value->house) + base64_decode($value->health);

                    if (!empty($time_in[$value->id])) {
                        for ($i=0; $i < count($time_in[$value->id]); $i++) {
                            $diff = strtotime($time_out[$value->id][$i]) - strtotime($time_in[$value->id][$i]);
                            $hours += $diff;
                        }
                    }

                    $ovt_total = $value->overtime * ceil(($hours / 3600));

                    $foot['sum_ovt'] += $ovt_total;
                    $whday = (empty($wh_day[$value->id])) ? "0" : $wh_day[$value->id];
                    $fldday = (empty($fld_day[$value->id])) ? "0" : $fld_day[$value->id];
                    $fldswtday = (empty($fld_swt[$value->id])) ? "0" : $fld_swt[$value->id];
                    $fldgrday = (empty($fld_dgr[$value->id])) ? "0" : $fld_dgr[$value->id];

                    $fld = $value->fld_bonus * $fldday;
                    $flddgr = ($value->fld_bonus + 25000) * $fldgrday;
                    $fldswt = ($value->fld_bonus + 50000) * $fldswtday;

                    $foot['sum_fld'] += $fld + $flddgr + $fldswt;

                    $wh = $value->wh_bonus * $whday;

                    $foot['sum_wh'] += $wh;

                    $ododay = (empty($odo_day[$value->id])) ? "0" : $odo_day[$value->id];
                    $odoswtday = (empty($odo_swt[$value->id])) ? "0" : $odo_swt[$value->id];
                    $odogrday = (empty($odo_dgr[$value->id])) ? "0" : $odo_dgr[$value->id];

                    $odo = $value->odo_bonus * $ododay;
                    $ododgr = ($value->odo_bonus + 25000) * $odogrday;
                    $odoswt = ($value->odo_bonus + 50000) * $odoswtday;

                    $foot['sum_odo'] += $odo + $ododgr + $odoswt;

                    foreach ($loan as $keyLoan => $valueLoan) {
                        if ($value->id == $valueLoan->emp_id) {
                            foreach ($loan_det as $keyDet => $valueDet) {
                                if ($valueLoan->id == $valueDet->loan_id) {
                                    $ln_amt += $valueDet->amount;
                                }
                            }
                        }
                    }

                    $foot['sum_loan'] += $ln_amt;

                    foreach ($bonus as $keyBonus => $valueBonus) {
                        if ($value->id == $valueBonus->emp_id) {
                            foreach ($bonus_pay as $keyBonusPay => $valueBonusPay) {
                                if ($valueBonus->id == $valueBonusPay->bonus_id) {
                                    $bonus_amt += $valueBonusPay->amount;
                                }
                            }
                        }
                    }

                    $yearly_bonus = $value->yearly_bonus * $salary_emp + $value->fx_yearly_bonus;
                    $bonus_only = $value->yearly_bonus * $salary_emp;

                    // Datatable
                    $row[] = $key + 1;//
                    $row[] = $value->emp_name."<br>".$value->emp_position."<br><label style='font-style: italic;'>'".$value->bank_acct."</label>";//
                    $row[] = number_format($sal,2);
                    $row[] = number_format($value->overtime,2);
                    $row[] = floor(($hours / 3600))." hour(s) ". round(($hours%3600) / 60)." minute(s)";
                    $row[] = number_format($ovt_total,2);
                    $row[] = number_format($value->fld_bonus,2)."<br>". number_format(($value->fld_bonus + 50000),2) ."<br>".number_format(($value->fld_bonus + 25000),2);
                    $row[] = $fldday."<br>".$fldswtday."<br>".$fldgrday;
                    $row[] = number_format($fld,2)."<br>". number_format(($fldswt),2) ."<br>".number_format(($flddgr),2);
//                    $row[] = number_format($value->wh_bonus,2);
//                    $row[] = $whday; // DAYS WH
//                    $row[] = number_format($wh,2);
//                    $row[] = number_format($value->odo_bonus,2)."<br>". number_format(($value->odo_bonus + 50000),2) ."<br>".number_format(($value->odo_bonus + 25000),2);
//                    $row[] = $ododay."<br>".$odoswtday."<br>".$odogrday; // DAYS ODO
//                    $row[] = number_format($odo,2)."<br>". number_format(($odoswt),2) ."<br>".number_format(($ododgr),2);
                    $row[] = number_format($allow_bpjs_tk,2)."<br>". number_format($allow_bpjs_kes,2) ."<br>".number_format($allow_jshk,2);
                    $row[] = number_format($value->voucher,2);

                    $foot['sum_salary'] += $sal;
                    $foot['sum_ovt'] += $ovt_total;
                    $foot['sum_voucher'] += $value->voucher;
                    $total_sal = $sal + $ovt_total + $fld + $wh + $odo + $ododgr + $odoswt + $flddgr + $fldswt + $value->voucher + $value->allow_bpjs_tk + $value->allow_bpjs_kes + $value->allow_jshk;
                    $foot['sum_tot_salary'] += $total_sal;

                    $row[] = number_format($total_sal,2);
                    $row[] = number_format($sunction,2); //SUNCTION
                    $row[] = 0; //ABSENCE
                    $row[] = number_format($ln_amt, 2); //LOAN
                    $row[] = number_format($deduc_bpjs_tk,2)."<br>". number_format($deduc_bpjs_kes,2) ."<br>".number_format($deduc_jshk,2);;
                    $row[] = number_format(0, 2)."<br>B: ".number_format(0, 2)."<br>A: ".number_format(0, 2); //BONUS

                    $isThr = sprintf("%02d", $m)."-".$y;
                    if ($isThr == strip_tags($thr_period)){
                        $thr_total = $sal * $value->thr;
                    } else {
                        $thr_total = 0;
                    }

                    $foot['sum_thr'] += $thr_total;
                    $row[] = number_format($thr_total,2); //THR

                    $thp = $total_sal - $sunction - $absence_deduct - $ln_amt - $value->deduc_bpjs_tk - $value->deduc_bpjs_kes - $value->deduc_jshk - $value->deduc_pph21;
                    $xthp = $thp - $fld - $wh - $odo - $ododgr - $odoswt - $fldswt - $flddgr;
                    $pro_day = round((strtotime($act_date[$value->id]) - strtotime($rangeStart)) / 86400,0);
                    $in_date = $act_date[$value->id];
                    $zero_day = (strtotime($rangeEnd) - strtotime($act_date[$value->id])) / 86400;
                    if($pro_day > 0 && $pro_day <= $pro_n_day)
                    {
                        $pro_basis = $pro_n_day;
                        $pro_thp = $pro_day / $pro_basis * $xthp;
                        $pro_decrement = ($pro_day) / $pro_basis * $xthp;
                    }
                    //kalau hari masuk = start month gaji, pengurangan = gaji = ZERO gaji.
                    elseif($pro_day == 0)
                    {
                        // $pro_decrement = $xthp;
                        if(date('d',strtotime($in_date)) == 16)
                        {
                            $pro_decrement = 0;
                        }
                        else
                        {
                            $pro_decrement = $xthp;
                        }
                    }
                    //tidak ada pemotongan
                    else
                    {
                        $pro_thp = 0;
                        $pro_decrement = 0;
                    }

                    //kalau tgl masuk baru lebih baru dari range2. ZERO gaji
                    if($zero_day <= 0)
                    {
                        $pro_decrement = $xthp;
                    }

                    if($pro_day >= 0 && $pro_day <= 30) {
                        $total_decrement = $pro_decrement;
                        $thp_total = $thp - $pro_decrement;
                        $foot['sum_thp'] += $thp - $pro_decrement;
                    } elseif($zero_day <= 0) {
                        $total_decrement = $pro_decrement;
                        $thp_total = $thp - $pro_decrement;
                        $foot['sum_thp'] += $thp - $pro_decrement;
                    } else {
                        $foot['sum_thp'] += $thp;
                        $thp_total = $thp;
                        $total_decrement = 0;
                    }

                    $row[] = ($value->deduc_pph21 == "") ? 0 : number_format($value->deduc_pph21,2); //PPH21
                    $foot['sum_pph21'] += $value->deduc_pph21;
                    $row[] = number_format($total_decrement,2); //Proportional
                    $row[] = number_format($thp_total,2); //THP

                    $foot['sum_prop'] += $total_decrement;

                    $data[] = $row;

                }
                $error = 0;
                $source = "EMP";
            } else {
                $error = 1;
                $data = null;
                $source = null;
            }
        }



//        DO THE ARCHIVE THING
//        if ($now > $period_end) {
//
//        }

        $val = array(
            'error' => $error,
            'data' => $data,
            'footer' => $foot,
            'table_signature' => $this->tableSignature($sign),
            'source' => $source
        );

        return json_encode($val);
    }

    public function needsec(){
        return view('payroll.needsec');
    }
    public function submitNeedsec(Request $request){
        $this->validate($request,[
            'searchInput' => 'required'
        ]);
        if ($request['searchInput'] == 'koi999'){
            Session::put('seckey_payroll', 99);
            return redirect()->back()->with('message_needsec_success', 'Access Granted! Please re-access the payroll menu');
        } else {
            return redirect()->back()->with('message_needsec_fail', 'Access Denied! Please enter the correct code');
        }
    }

    public function print_btl(Request $request){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $t = $request->t;
        $m = $request->m;
        $y = $request->y;

        $pref = Preference_config::whereIn('id_company', $id_companies)->get();
//        dd($pref->period_start);
        $prefCount = $pref->count();
        $now = date('Y-n-d');

//        dd($pref);
        if ($prefCount >0){
            $period_end = $pref[0]->period_end;
            $period_start = $pref[0]->period_start;
        } else {
            if (session()->has('company_period_end') && session()->has('company_period_start')){
                $period_end = Session::get('company_period_end');
                $period_start = Session::get('company_period_start');
            } else {
                $period_end = 27;
                $period_start = 28;
            }
        }

        $thr_period = Session::get('company_thr_period');
//            dd($period_end);
        if($t == "all"){
            $emp = Hrd_employee::where('expel', null)
                ->whereIn('company_id', $id_companies)
                ->get();
        } else {
            $emp = Hrd_employee::where('emp_position', $t)
                ->where('expel', null)
                ->whereIn('company_id', $id_companies)
                ->get();
        }
        $emp_name = [];
        $emp_pos = [];
        $emp_bank = [];
        $emp_type = [];
        $data_emp = [];

        foreach ($emp as $key => $value) {
            $emp_name[$value->id] = $value->emp_name;
            $emp_pos[$value->id] = $value->emp_position;
            $emp_bank[$value->id] = $value->bank_acct;
            $emp_type[] = $value->id;
            $data_emp[$value->id] = $value;
        }

        $emp_arc = Hrd_salary_archive::whereIn('company_id',$id_companies)->get();

        $emp_his = Hrd_employee_history::where('activity', 'in')->get();

        foreach ($emp_his as $key => $value) {
            $act_date[$value->emp_id] = $value->act_date;
        }

        $sign = $this->signName($t);

        $period_start_date = $y."-".sprintf('%02d', $m-1)."-".$period_start;
        $period_end_date = $y."-".sprintf('%02d', $m)."-".$period_end;

        $ovt = Hrd_overtime::whereIn('company_id', $id_companies)
            ->whereBetween('ovt_date', [$period_start_date, $period_end_date])
            ->get();
//        dd($ovt);
        foreach ($ovt as $key => $value) {
            $time_in[$value->emp_id][] = $value->time_in;
            $time_out[$value->emp_id][] = $value->time_out;
        }

        $to = General_travel_order::where('status', 0)
            ->whereBetween('departure_dt', [$period_start_date, $period_end_date])
            ->orWhereBetween('departure_dt', [$period_start_date, $period_end_date])
            ->get();
//        dd($to::getQueryLog());

        foreach ($to as $key => $value) {
            $d1 = ($period_end_date > $value->return_dt) ? $value->return_dt : $period_end_date;
            $d2 = ($period_start_date > $value->departure_dt) ? $period_start_date : $value->departure_dt;

            $sum = date_diff(date_create($d1), date_create($d2));

            if ($value->travel_type == "reg") {
                if (empty($value->location_rate)) {
                    switch ($value->dest_type) {
                        case "fld" :
                            $fld_day[$value->employee_id] = $sum->format("%a");
                            break;
                        case "wh" :
                            $wh_day[$value->employee_id] = $sum->format("%a");
                            break;
                    }
                } elseif ($value->location_rate == "SWT") {
                    switch ($value->dest_type) {
                        case "fld" :
                            $fld_swt[$value->employee_id] = $sum->format("%a");
                            break;
                    }
                } elseif ($value->location_rate == "DGR") {
                    switch ($value->dest_type) {
                        case "fld" :
                            $fld_dgr[$value->employee_id] = $sum->format("%a");
                            break;
                    }
                }
            } elseif ($value->travel_type = "odo") {
                if (empty($value->location_rate)) {
                    if ($value->dest_type == "fld_bonus") {
                        $odo_day[$value->employee_id] = $sum->format("%a");
                    }
                } elseif ($value->location_rate == "SWT") {
                    if ($value->dest_type == "fld_bonus") {
                        $odo_swt[$value->employee_id] = $sum->format("%a");
                    }
                } elseif ($value->location_rate == "DGR") {
                    if ($value->dest_type == "fld_bonus") {
                        $odo_dgr[$value->employee_id] = $sum->format("%a");
                    }
                }
            }
        }

        $whereLoan = $y."-".sprintf("%02d", $m);

        $loan = Hrd_employee_loan::all();

        $loan_det = Hrd_employee_loan_payment::where('date_of_payment', "LIKE", '%' . $whereLoan . '%')->get();

        $bonus = Hrd_bonus::all();

        $bonus_pay = Hrd_bonus_payment::where('date_of_payment', "LIKE", '%' . $whereLoan . '%')->get();

        $foot['sum_salary'] = 0;
        $foot['sum_ovt'] = 0;
        $foot['sum_fld'] = 0;
        $foot['sum_wh'] = 0;
        $foot['sum_odo'] = 0;
        $foot['sum_tk'] = 0;
        $foot['sum_ks'] = 0;
        $foot['sum_jshk'] = 0;
        $foot['sum_tot_salary'] = 0;
        $foot['sum_sunction'] = 0;
        $foot['sum_absence'] = 0;
        $foot['sum_loan'] = 0;
        $foot['sum_ded_tk'] = 0;
        $foot['sum_ded_ks'] = 0;
        $foot['sum_ded_jshk'] = 0;
        $foot['sum_bonus'] = 0;
        $foot['sum_thr'] = 0;
        $foot['sum_pph21'] = 0;
        $foot['sum_prop'] = 0;
        $foot['sum_thp'] = 0;
        $foot['sum_voucher'] = 0;
        $foot['sum_sanction'] = 0;

        $rangeStart = $y."-".($m-1)."-".$period_start;
        $rangeEnd = $y."-".$m."-".$period_end;
        $pro_n_day = date("t", strtotime($rangeEnd));

        if (strtotime($now) > strtotime($period_end_date)){
            $emp_arc = Hrd_salary_archive::where('archive_period', $m."-".$y)
                ->whereIn('company_id', $id_companies)
                ->whereIn('emp_id', $emp_type)
                ->get();

            if (count($emp_arc) > 0) {
                foreach ($emp_arc as $key => $value) {
                    $row = [];
                    $salary_emp = base64_decode($value->salary);

                    $allow_bpjs_tk = ($value->allow_bpjs_tk == "") ? 0 : $value->allow_bpjs_tk;
                    $allow_bpjs_kes = ($value->allow_bpjs_kes == "") ? 0 : $value->allow_bpjs_kes;
                    $allow_jshk = ($value->allow_jshk == "") ? 0 : $value->allow_jshk;

                    $foot['sum_tk'] += $allow_bpjs_tk;
                    $foot['sum_ks'] += $allow_bpjs_kes;
                    $foot['sum_jshk'] += $allow_jshk;

                    $deduc_bpjs_tk = ($value->deduc_bpjs_tk == "") ? 0 : $value->deduc_bpjs_tk;
                    $deduc_bpjs_kes = ($value->deduc_bpjs_kes == "") ? 0 : $value->deduc_bpjs_kes;
                    $deduc_jshk = ($value->deduc_jshk == "") ? 0 : $value->deduc_jshk;

                    $foot['sum_ded_tk'] += $deduc_bpjs_tk;
                    $foot['sum_ded_ks'] += $deduc_bpjs_kes;
                    $foot['sum_ded_jshk'] += $deduc_jshk;


                    $sal = base64_decode($value->salary);

                    $hours = 0;

                    if (!empty($time_in[$value->emp_id])) {
                        for ($i=0; $i < count($time_in[$value->emp_id]); $i++) {
                            $diff = strtotime($time_out[$value->emp_id][$i]) - strtotime($time_in[$value->emp_id][$i]);
                            $hours += $diff;
                        }
                    }

                    $ovt_total = $value->ovt_nom;

                    $foot['sum_ovt'] += $ovt_total;
                    $whday = (empty($wh_day[$value->emp_id])) ? "0" : $wh_day[$value->emp_id];
                    $fldday = (empty($fld_day[$value->emp_id])) ? "0" : $fld_day[$value->emp_id];
                    $fldswtday = (empty($fld_swt[$value->emp_id])) ? "0" : $fld_swt[$value->emp_id];
                    $fldgrday = (empty($fld_dgr[$value->emp_id])) ? "0" : $fld_dgr[$value->emp_id];

                    $fld = $value->fld_nom;
                    $flddgr = ($value->fld_rate + 25000) * $fldgrday;
                    $fldswt = ($value->fld_rate + 50000) * $fldswtday;

                    $foot['sum_fld'] += $fld + $flddgr + $fldswt;

                    $wh = $value->wh_nom;

                    $foot['sum_wh'] += $wh;

                    $ododay = (empty($odo_day[$value->emp_id])) ? "0" : $odo_day[$value->emp_id];
                    $odoswtday = (empty($odo_swt[$value->emp_id])) ? "0" : $odo_swt[$value->emp_id];
                    $odogrday = (empty($odo_dgr[$value->emp_id])) ? "0" : $odo_dgr[$value->emp_id];

                    $odo = $value->odo_nom;
                    $ododgr = ($value->odo_rate + 25000) * $odogrday;
                    $odoswt = ($value->odo_rate + 50000) * $odoswtday;

                    $foot['sum_odo'] += $odo + $ododgr + $odoswt;

                    $ln_amt = $value->deduction;

                    $foot['sum_loan'] += $ln_amt;

                    $bonus_amt = $value->bonus;

                    // Datatable
//                    $row[] = $key + 1;//
//                    if (empty($emp_name) || $emp_name[$value->emp_id] == null){
//                        $row[] = '';
//                    } else {
//                        $row[] = $emp_name[$value->id]."<br>".$emp_pos[$value->id]."<br><label style='font-style: italic;'>'".$emp_bank[$value->id]."</label>";//
//
//                    }

                    $row['bank_account'] = $data_emp[$value->emp_id]->bank_acct;
                    $row['bank_code'] = $data_emp[$value->emp_id]->bank_code;
                    $row['emp_name'] = $data_emp[$value->emp_id]->emp_name;
                    $row['position'] = $data_emp[$value->emp_id]->emp_position;
//                    $row[] = number_format($value->ovt_rate,2);
//                    $row[] = floor(($hours / 3600))." hour(s) ". round(($hours%3600) / 60)." minute(s)";
//                    $row[] = number_format($ovt_total,2);
//                    $row[] = number_format($value->field_rate,2)."<br>". number_format(($value->field_rate + 50000),2) ."<br>".number_format(($value->field_rate + 25000),2);
//                    $row[] = $fldday."<br>".$fldswtday."<br>".$fldgrday;
//                    $row[] = number_format($fld,2)."<br>". number_format(($fldswt),2) ."<br>".number_format(($flddgr),2);
//                    $row[] = number_format($value->wh_rate,2);
//                    $row[] = $whday; // DAYS WH
//                    $row[] = number_format($wh,2);
//                    $row[] = number_format($value->odo_rate,2)."<br>". number_format(($value->odo_rate + 50000),2) ."<br>".number_format(($value->odo_rate + 25000),2);
//                    $row[] = $ododay."<br>".$odoswtday."<br>".$odogrday; // DAYS ODO
//                    $row[] = number_format($odo,2)."<br>". number_format(($odoswt),2) ."<br>".number_format(($ododgr),2);
//                    $row[] = number_format($allow_bpjs_tk,2)."<br>". number_format($allow_bpjs_kes,2) ."<br>".number_format($allow_jshk,2);
//                    $row[] = number_format($value->voucher,2);

                    $foot['sum_salary'] += $sal;
                    $foot['sum_ovt'] += $ovt_total;
                    $foot['sum_voucher'] += $value->voucher;
                    $total_sal = $sal + $ovt_total + $fld + $wh + $odo + $ododgr + $odoswt + $flddgr + $fldswt + $value->voucher + $value->allow_bpjs_tk + $value->allow_bpjs_kes + $value->allow_jshk;
                    $foot['sum_tot_salary'] += $total_sal;
                    $thp_total = $total_sal + $value->thr ;

//                    $row[] = number_format($total_sal,2);
//                    $row[] = 0; //SUNCTION
//                    $row[] = 0; //ABSENCE
//                    $row[] = number_format($ln_amt, 2); //LOAN
//                    $row[] = number_format($deduc_bpjs_tk,2)."<br>". number_format($deduc_bpjs_kes,2) ."<br>".number_format($deduc_jshk,2);;
//                    $row[] = number_format(0, 2)."<br>B: ".number_format(0, 2)."<br>A: ".number_format(0, 2); //BONUS

                    $thr_total = $value->thr;

                    $foot['sum_thr'] += $thr_total;
//                    $row[] = number_format($thr_total,2); //THR

                    $thp_total -= $value->proportional;
                    $foot['sum_thp'] += $value->proportional;

//                    $row[] = ($value->deduc_pph21 == "") ? 0 : number_format($value->deduc_pph21,2); //PPH21
                    $foot['sum_pph21'] += $value->deduc_pph21;
//                    $row[] = number_format($value->proportional,2); //Proportional
                    $row['thp'] = number_format($thp_total,2); //THP

                    $foot['sum_prop'] += $value->proportional;

                    $data[] = $row;
                    $source = "Archive";

                }
                $error = 0;
            } else {
                $error = 1;
                $data = null;
                $source = null;
            }
        } else {
            if (count($emp) > 0) {
                foreach ($emp as $key => $value) {
                    $row = [];
                    $salary_emp = base64_decode($value->salary);
                    $sunction = 0;
                    $absence_deduct = 0;
                    $bonus_amt = 0;
                    $ln_amt = 0;
                    $hours = 0;

                    $allow_bpjs_tk = ($value->allow_bpjs_tk == "") ? 0 : $value->allow_bpjs_tk;
                    $allow_bpjs_kes = ($value->allow_bpjs_kes == "") ? 0 : $value->allow_bpjs_kes;
                    $allow_jshk = ($value->allow_jshk == "") ? 0 : $value->allow_jshk;

                    $foot['sum_tk'] += $allow_bpjs_tk;
                    $foot['sum_ks'] += $allow_bpjs_kes;
                    $foot['sum_jshk'] += $allow_jshk;

                    $deduc_bpjs_tk = ($value->deduc_bpjs_tk == "") ? 0 : $value->deduc_bpjs_tk;
                    $deduc_bpjs_kes = ($value->deduc_bpjs_kes == "") ? 0 : $value->deduc_bpjs_kes;
                    $deduc_jshk = ($value->deduc_jshk == "") ? 0 : $value->deduc_jshk;

                    $foot['sum_ded_tk'] += $deduc_bpjs_tk;
                    $foot['sum_ded_ks'] += $deduc_bpjs_kes;
                    $foot['sum_ded_jshk'] += $deduc_jshk;


                    $sal = $salary_emp + base64_decode($value->transport) + base64_decode($value->meal) + base64_decode($value->house) + base64_decode($value->health);

                    if (!empty($time_in[$value->id])) {
                        for ($i=0; $i < count($time_in[$value->id]); $i++) {
                            $diff = strtotime($time_out[$value->id][$i]) - strtotime($time_in[$value->id][$i]);
                            $hours += $diff;
                        }
                    }

                    $ovt_total = $value->overtime * ceil(($hours / 3600));

                    $foot['sum_ovt'] += $ovt_total;
                    $whday = (empty($wh_day[$value->id])) ? "0" : $wh_day[$value->id];
                    $fldday = (empty($fld_day[$value->id])) ? "0" : $fld_day[$value->id];
                    $fldswtday = (empty($fld_swt[$value->id])) ? "0" : $fld_swt[$value->id];
                    $fldgrday = (empty($fld_dgr[$value->id])) ? "0" : $fld_dgr[$value->id];

                    $fld = $value->fld_bonus * $fldday;
                    $flddgr = ($value->fld_bonus + 25000) * $fldgrday;
                    $fldswt = ($value->fld_bonus + 50000) * $fldswtday;

                    $foot['sum_fld'] += $fld + $flddgr + $fldswt;

                    $wh = $value->wh_bonus * $whday;

                    $foot['sum_wh'] += $wh;

                    $ododay = (empty($odo_day[$value->id])) ? "0" : $odo_day[$value->id];
                    $odoswtday = (empty($odo_swt[$value->id])) ? "0" : $odo_swt[$value->id];
                    $odogrday = (empty($odo_dgr[$value->id])) ? "0" : $odo_dgr[$value->id];

                    $odo = $value->odo_bonus * $ododay;
                    $ododgr = ($value->odo_bonus + 25000) * $odogrday;
                    $odoswt = ($value->odo_bonus + 50000) * $odoswtday;

                    $foot['sum_odo'] += $odo + $ododgr + $odoswt;

                    foreach ($loan as $keyLoan => $valueLoan) {
                        if ($value->id == $valueLoan->emp_id) {
                            foreach ($loan_det as $keyDet => $valueDet) {
                                if ($valueLoan->id == $valueDet->loan_id) {
                                    $ln_amt += $valueDet->amount;
                                }
                            }
                        }
                    }

                    $foot['sum_loan'] += $ln_amt;

                    foreach ($bonus as $keyBonus => $valueBonus) {
                        if ($value->id == $valueBonus->emp_id) {
                            foreach ($bonus_pay as $keyBonusPay => $valueBonusPay) {
                                if ($valueBonus->id == $valueBonusPay->bonus_id) {
                                    $bonus_amt += $valueBonusPay->amount;
                                }
                            }
                        }
                    }

                    $yearly_bonus = $value->yearly_bonus * $salary_emp + $value->fx_yearly_bonus;
                    $bonus_only = $value->yearly_bonus * $salary_emp;

                    // Datatable
                    $row['bank_account'] = $value->bank_acct;//
                    $row['bank_code'] = $value->bank_code;
                    $row['emp_name'] = $value->emp_name;
                    $row['position'] = $value->emp_position;
//                    $row[] = number_format($sal,2);
//                    $row[] = number_format($value->overtime,2);
//                    $row[] = floor(($hours / 3600))." hour(s) ". round(($hours%3600) / 60)." minute(s)";
//                    $row[] = number_format($ovt_total,2);
//                    $row[] = number_format($value->fld_bonus,2)."<br>". number_format(($value->fld_bonus + 50000),2) ."<br>".number_format(($value->fld_bonus + 25000),2);
//                    $row[] = $fldday."<br>".$fldswtday."<br>".$fldgrday;
//                    $row[] = number_format($fld,2)."<br>". number_format(($fldswt),2) ."<br>".number_format(($flddgr),2);
////                    $row[] = number_format($value->wh_bonus,2);
////                    $row[] = $whday; // DAYS WH
////                    $row[] = number_format($wh,2);
////                    $row[] = number_format($value->odo_bonus,2)."<br>". number_format(($value->odo_bonus + 50000),2) ."<br>".number_format(($value->odo_bonus + 25000),2);
////                    $row[] = $ododay."<br>".$odoswtday."<br>".$odogrday; // DAYS ODO
////                    $row[] = number_format($odo,2)."<br>". number_format(($odoswt),2) ."<br>".number_format(($ododgr),2);
//                    $row[] = number_format($allow_bpjs_tk,2)."<br>". number_format($allow_bpjs_kes,2) ."<br>".number_format($allow_jshk,2);
//                    $row[] = number_format($value->voucher,2);

                    $foot['sum_salary'] += $sal;
                    $foot['sum_ovt'] += $ovt_total;
                    $foot['sum_voucher'] += $value->voucher;
                    $total_sal = $sal + $ovt_total + $fld + $wh + $odo + $ododgr + $odoswt + $flddgr + $fldswt + $value->voucher + $value->allow_bpjs_tk + $value->allow_bpjs_kes + $value->allow_jshk;
                    $foot['sum_tot_salary'] += $total_sal;

//                    $row[] = number_format($total_sal,2);
//                    $row[] = 0; //SUNCTION
//                    $row[] = 0; //ABSENCE
//                    $row[] = number_format($ln_amt, 2); //LOAN
//                    $row[] = number_format($deduc_bpjs_tk,2)."<br>". number_format($deduc_bpjs_kes,2) ."<br>".number_format($deduc_jshk,2);;
//                    $row[] = number_format(0, 2)."<br>B: ".number_format(0, 2)."<br>A: ".number_format(0, 2); //BONUS

                    $isThr = sprintf("%02d", $m)."-".$y;
                    if ($isThr == strip_tags($thr_period)){
                        $thr_total = $sal * $value->thr;
                    } else {
                        $thr_total = 0;
                    }

                    $foot['sum_thr'] += $thr_total;
//                    $row[] = number_format($thr_total,2); //THR

                    $thp = $total_sal - $sunction - $absence_deduct - $ln_amt - $value->deduc_bpjs_tk - $value->deduc_bpjs_kes - $value->deduc_jshk - $value->deduc_pph21;
                    $xthp = $thp - $fld - $wh - $odo - $ododgr - $odoswt - $fldswt - $flddgr;
                    $pro_day = round((strtotime($act_date[$value->id]) - strtotime($rangeStart)) / 86400,0);
                    $in_date = $act_date[$value->id];
                    $zero_day = (strtotime($rangeEnd) - strtotime($act_date[$value->id])) / 86400;
                    if($pro_day > 0 && $pro_day <= $pro_n_day)
                    {
                        $pro_basis = $pro_n_day;
                        $pro_thp = $pro_day / $pro_basis * $xthp;
                        $pro_decrement = ($pro_day) / $pro_basis * $xthp;
                    }
                    //kalau hari masuk = start month gaji, pengurangan = gaji = ZERO gaji.
                    elseif($pro_day == 0)
                    {
                        // $pro_decrement = $xthp;
                        if(date('d',strtotime($in_date)) == 16)
                        {
                            $pro_decrement = 0;
                        }
                        else
                        {
                            $pro_decrement = $xthp;
                        }
                    }
                    //tidak ada pemotongan
                    else
                    {
                        $pro_thp = 0;
                        $pro_decrement = 0;
                    }

                    //kalau tgl masuk baru lebih baru dari range2. ZERO gaji
                    if($zero_day <= 0)
                    {
                        $pro_decrement = $xthp;
                    }

                    if($pro_day >= 0 && $pro_day <= 30) {
                        $total_decrement = $pro_decrement;
                        $thp_total = $thp - $pro_decrement;
                        $foot['sum_thp'] += $thp - $pro_decrement;
                    } elseif($zero_day <= 0) {
                        $total_decrement = $pro_decrement;
                        $thp_total = $thp - $pro_decrement;
                        $foot['sum_thp'] += $thp - $pro_decrement;
                    } else {
                        $foot['sum_thp'] += $thp;
                        $thp_total = $thp;
                        $total_decrement = 0;
                    }

//                    $row[] = ($value->deduc_pph21 == "") ? 0 : number_format($value->deduc_pph21,2); //PPH21
                    $foot['sum_pph21'] += $value->deduc_pph21;
//                    $row[] = number_format($total_decrement,2); //Proportional
                    $row['thp'] = number_format($thp_total,2); //THP

                    $foot['sum_prop'] += $total_decrement;

                    $data[] = $row;

                }
                $error = 0;
                $source = "EMP";
            } else {
                $error = 1;
                $data = null;
                $source = null;
            }
        }

        $rep_bank_code = array("002" => "BRI","008" => "MANDIRI","009" => "BNI","120" => "SUMSEL","014" => "BCA");

        $val = array(
            'error' => $error,
            'data' => $data,
            't' => $t,
            'periode' => date('F Y', strtotime($y."-".$m)),
            'bank_code' => $rep_bank_code,
            'source' => $source
        );

        return view('payroll.btl', [
            'data' => $val
        ]);
    }
}
