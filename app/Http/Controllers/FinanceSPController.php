<?php

namespace App\Http\Controllers;

use App\Models\Asset_po;
use App\Models\Asset_type_wo;
use App\Models\Asset_wo;
use App\Models\Finance_invoice_in;
use App\Models\Finance_invoice_in_pay;
use App\Models\Finance_leasing;
use App\Models\Finance_leasing_detail;
use App\Models\Finance_loan;
use App\Models\Finance_loan_detail;
use App\Models\Finance_schedule_payment;
use App\Models\Finance_treasury;
use App\Models\Finance_treasury_history;
use App\Models\Finance_util_criteria;
use App\Models\Finance_util_instance;
use App\Models\Finance_util_master;
use App\Models\Finance_util_salary;
use DB;
use App\Models\Procurement_vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class FinanceSPController extends Controller
{
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

        $val = array();

        $data['m'] = "";
        $data['y'] = "";

        if (isset($request->month)){
            $data['find'] = 1;
            $m = $request->month;
            $y = $request->years;
            $data['m'] = $m;
            $data['y'] = $y;
            $frst_date = "$y-".sprintf("%02d", $m)."-01";
            $lastdate = date('Y-m-t', strtotime($frst_date));

            // INVOICE PO & WO
            $inv_in = Finance_invoice_in::where('company_id', Session::get('company_id'))
                ->get();

            $vendor = Procurement_vendor::where('company_id', Session::get('company_id'))->get();
            $paper = array();
            $supplier = array();
            foreach ($vendor as $value){
                $supplier['name'][$value->id] = $value->name;
                $supplier['bank_acct'][$value->id] = $value->bank_acct;
            }

            $po = Asset_po::where('company_id', Session::get('company_id'))->get();
            $wo = Asset_wo::where('company_id', Session::get('company_id'))->get();
            foreach ($po as $value){
                $paper['paper_num']['PO'][$value->id] = $value->po_num;
                $paper['supplier'][$value->id] = $value->supplier_id;
                $paper['currency'][$value->id] = $value->currency;
                $paper['gr_date'][$value->id] = $value->gr_date;
                $paper['bgcolor']['PO'][$value->id] = "#f099ff";
            }

            foreach ($wo as $value){
                $paper['paper_num']['WO'][$value->id]= $value->wo_num;
                $paper['supplier'][$value->id] = $value->supplier_id;
                $paper['currency'][$value->id] = $value->currency;
                $paper['gr_date'][$value->id] = $value->gr_date;
                $paper['bgcolor']['WO'][$value->id] = "#fc9979";
            }

            foreach ($inv_in as $item) {
                $idPaper[$item->id] = $item->paper_id;
                $typePaper[$item->id] = $item->paper_type;
            }

//            dd($typePaper);

            $inv_pay = Finance_invoice_in_pay::whereBetween('pay_date', [$frst_date, $lastdate])->get();
            foreach ($inv_pay as $item){
                $table['id'] = $item->id;
                $table['type'] = $typePaper[$item->inv_id];
                $table['date'] = $item->pay_date;
                $table['paper'] = $paper['paper_num'][$typePaper[$item->inv_id]][$idPaper[$item->inv_id]];
                $table['amount'] = $item->amount;
                $table['status'] = ($item->paid == 1) ? 1 : 0;
                $table['description'] = $item->description;
                $table['bgcolor'] = $paper['bgcolor'][$typePaper[$item->inv_id]][$idPaper[$item->inv_id]];
                $val[] = $table;
            }

            // LOAN
            $loan = Finance_loan::where('company_id', Session::get('company_id'))->get();
            foreach ($loan as $value){
                $loan_bank[$value->id] = $value->bank;
                $loan_type[$value->id] = $value->type;
                $loan_description[$value->id] = $value->description;
            }

            $loan_detail = Finance_loan_detail::where('company_id', Session::get('company_id'))
                ->whereBetween('plan_date', [$frst_date, $lastdate])
                ->get();

            foreach ($loan_detail as $item){
                $table['id'] = $item->id;
                $table['type'] = "LOAN";
                $table['date'] = $item->plan_date;
                $table['paper'] = $loan_bank[$item->id_loan];
                $table['amount'] = $item->cicilan + $item->bunga;
                $table['status'] = ($item->status == "paid") ? 1 : 0;
                $table['description'] = $loan_description[$item->id_loan];
                $table['bgcolor'] = "#00ffdc";
                $val[] = $table;
            }
            // BR

            // LEASING
            $leasing = Finance_leasing::where('company_id', Session::get('company_id'))->get();
            foreach ($leasing as $value){
                $leasing_subject[$value->id] = $value->subject;
                $leasing_vendor[$value->id] = $value->vendor;
            }


            $leasing_detail = Finance_leasing_detail::where('company_id', Session::get('company_id'))
                ->whereBetween('plan_date', [$frst_date, $lastdate])
                ->get();

            foreach ($leasing_detail as $item){
                $table['id'] = $item->id;
                $table['type'] = "LEASING";
                $table['date'] = $item->plan_date;
                $table['paper'] = $leasing_subject[$item->id_leasing];
                $table['amount'] = $item->cicilan + $item->bunga;
                $table['status'] = ($item->status == "paid") ? 1 : 0;
                $table['description'] = $leasing_vendor[$item->id_leasing];
                $table['bgcolor'] = "#ff75a4";
                $val[] = $table;
            }

            // UTIL
            $util = Finance_util_master::where('company_id', Session::get('company_id'))
                ->where('status', 'running')
                ->get();
            $data_util = [];
            $util_id = [];
            foreach ($util as $item){
                $data_util['subject'][$item->id] = $item->subject;
                $util_id[] = $item->id;
            }

            $util_instance = Finance_util_instance::whereBetween('pay_date', [$frst_date, $lastdate])
                ->where('company_id', Session::get('company_id'))
                ->whereIn('id_master', $util_id)
                ->get();

            foreach ($util_instance as $item){
                $table['id'] = $item->id;
                $table['type'] = "UTIL";
                $table['date'] = $item->pay_date;
                $table['paper'] = $data_util['subject'][$item->id_master];
                $table['amount'] = $item->amount_back;
                $table['status'] = ($item->progress == "paid") ? 1 : 0;
                $table['description'] = $item->description;
                $table['bgcolor'] = "#7dd7ff";
                $val[] = $table;
            }

            // SALARY
            $util_salary = Finance_util_salary::whereBetween('plan_date', [$frst_date, $lastdate])
                ->where('company_id', Session::get('company_id'))
                ->get();
            foreach ($util_salary as $item){
                $table['id'] = $item->id;
                $table['type'] = "SALARY";
                $table['date'] = $item->plan_date;
                $table['paper'] = "Salary, Jamsostek, Pension of ".$item->position;
                $table['amount'] = $item->amount;
                $table['status'] = ($item->progress == "paid") ? 1 : 0;
                $table['description'] = "Salary, Jamsostek, Pension of ".$item->position." periode ".date('F Y', strtotime($y."-".sprintf("%02d", $m)));
                $table['bgcolor'] = "#64dd17";
                $val[] = $table;
            }

            usort($val, function ($a, $b){
                return strtotime($a['date']) - strtotime($b['date']);
            });
        }

        return view('finance.sp.index', [
            'data' => $data,
            'val' => $val
        ]);
    }

    function edit_date(Request $request){
        if ($request->type == "WO"){
            $wo = Asset_wo::find($request->id_item);
            $wo->pay_date = $request->date_item;
            $wo->save();
        } elseif ($request->type == "PO"){
            $wo = Asset_po::find($request->id_item);
            $wo->pay_date = $request->date_item;
            $wo->save();
        } elseif ($request->type == "LEASING"){
            $wo = Finance_leasing_detail::find($request->id_item);
            $wo->plan_date = $request->date_item;
            $wo->save();
        } elseif ($request->type == "LOAN"){
            $wo = Finance_loan_detail::find($request->id_item);
            $wo->plan_date = $request->date_item;
            $wo->save();
        } elseif ($request->type == "SALARY"){
            $wo = Finance_util_salary::find($request->id_item);
            $wo->plan_date = $request->date_item;
            $wo->save();
        }

        if ($wo){
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    function pay($date){
        // INVOICE PO & WO
        $inv_in = Finance_invoice_in::where('company_id', Session::get('company_id'))
            ->get();

        $vendor = Procurement_vendor::all();
        $paper = array();
        $supplier = array();
        foreach ($vendor as $value){
            $supplier['name'][$value->id] = $value->name;
            $supplier['bank_acct'][$value->id] = $value->bank_acct;
        }

        $po = Asset_po::where('company_id', Session::get('company_id'))->get();
        $wo = Asset_wo::where('company_id', Session::get('company_id'))->get();
        foreach ($po as $value){
            $paper['paper_num']['PO'][$value->id] = $value->po_num;
            $paper['supplier'][$value->id] = $value->supplier_id;
            $paper['currency'][$value->id] = $value->currency;
            $paper['gr_date'][$value->id] = $value->gr_date;
            $paper['bgcolor']['PO'][$value->id] = "#ab47bc";
        }

        foreach ($wo as $value){
            $paper['paper_num']['WO'][$value->id]= $value->wo_num;
            $paper['supplier'][$value->id] = $value->supplier_id;
            $paper['currency'][$value->id] = $value->currency;
            $paper['gr_date'][$value->id] = $value->gr_date;
            $paper['bgcolor']['WO'][$value->id] = "#ff7043";
        }

        foreach ($inv_in as $item) {
            $idPaper[$item->id] = $item->paper_id;
            $typePaper[$item->id] = $item->paper_type;
        }

        $treasury = Finance_treasury::where('company_id', Session::get('company_id'))->get();

//            dd($typePaper);

        $inv_pay = Finance_invoice_in_pay::where('pay_date', $date)
            ->where('paid', null)
            ->get();
        foreach ($inv_pay as $item){
            $table['id'] = $item->id;
            $table['type'] = "INVOICE IN";
            $table['date'] = $item->pay_date;
            $table['paper'] = $paper['paper_num'][$typePaper[$item->inv_id]][$idPaper[$item->inv_id]];
            $table['row1'] = $supplier['name'][$paper['supplier'][$idPaper[$item->inv_id]]];
            $table['row2'] = $supplier['bank_acct'][$paper['supplier'][$idPaper[$item->inv_id]]];
            $table['row3'] = $item->amount;
            $table['bgcolor'] = $paper['bgcolor'][$typePaper[$item->inv_id]][$idPaper[$item->inv_id]];
            $val[] = $table;
        }

        // LOAN
        $loan = Finance_loan::where('company_id', Session::get('company_id'))->get();
        foreach ($loan as $value){
            $loan_bank[$value->id] = $value->bank;
            $loan_type[$value->id] = $value->type;
            $loan_description[$value->id] = $value->description;
        }
        $loan_detail = Finance_loan_detail::where('company_id', Session::get('company_id'))
            ->where('plan_date', $date)
            ->get();

        foreach ($loan_detail as $item){
            $table['id'] = $item->id;
            $table['type'] = "LOAN";
            $table['date'] = $item->plan_date;
            $table['paper'] = $loan_bank[$item->id_loan];
            $table['row1'] = $loan_description[$item->id_loan];
            $table['row2'] = $loan_bank[$item->id_loan];
            $table['row3'] = $item->cicilan + $item->bunga;
            $table['bgcolor'] = "#00bfa5";
            $val[] = $table;
        }

        // BR

        // LEASING
        $leasing = Finance_leasing::where('company_id', Session::get('company_id'))->get();
        foreach ($leasing as $value){
            $leasing_subject[$value->id] = $value->subject;
            $leasing_vendor[$value->id] = $value->vendor;
        }
        $leasing_detail = Finance_leasing_detail::where('status', 'planned')
            ->where('plan_date', $date)
            ->get();

        foreach ($leasing_detail as $item){
            $table['id'] = $item->id;
            $table['type'] = "LEASING";
            $table['date'] = $item->plan_date;
            $table['paper'] = $leasing_subject[$item->id_leasing];
            $table['row1'] = $leasing_subject[$item->id_leasing];
            $table['row2'] = $leasing_vendor[$item->id_leasing];
            $table['row3'] = $item->cicilan + $item->bunga;
            $table['bgcolor'] = "#ff4081";
            $val[] = $table;
        }

        // UTIL
        $util_crit = Finance_util_criteria::where('company_id', Session::get('company_id'))->get();
        $crit_name = [];
        foreach ($util_crit as $item){
            $crit_name[$item->id] = $item->name;
        }
        $util = Finance_util_master::where('company_id', Session::get('company_id'))
            ->where('status', 'running')
            ->get();
        $data_util = [];
        $util_id = [];
        foreach ($util as $item){
            $data_util['subject'][$item->id] = $item->subject;
            $data_util['classification'][$item->id] = $crit_name[$item->classification];
            $util_id[] = $item->id;
        }

        $util_instance = Finance_util_instance::where('pay_date', $date)
            ->where('company_id', Session::get('company_id'))
            ->whereIn('id_master', $util_id)
            ->get();

        foreach ($util_instance as $item){
            $table['id'] = $item->id;
            $table['type'] = "UTIL";
            $table['date'] = $item->pay_date;
            $table['paper'] = $data_util['subject'][$item->id_master];
            $table['row1'] = $data_util['subject'][$item->id_master];
            $table['row2'] = $data_util['classification'][$item->id_master];
            $table['row3'] = $item->amount_back;
            $table['bgcolor'] = "#03a9f4";
            $val[] = $table;
        }

        // SALARY
        // SALARY
        $util_salary = Finance_util_salary::where('plan_date', $date)
            ->where('company_id', Session::get('company_id'))
            ->get();
        foreach ($util_salary as $item){
            $table['id'] = $item->id;
            $table['type'] = "SALARY";
            $table['date'] = $item->plan_date;
            $table['paper'] = "Salary of ".$item->position;
            $table['row1'] = "Salary, Jamsostek, Pension of ".$item->position;
            $table['row2'] = date('F Y', strtotime($item->plan_date));
            $table['row3'] = $item->amount;
            $table['bgcolor'] = "#64dd17";
            $val[] = $table;
        }

        $type = array();
        foreach ($val as $value){
            if (!in_array($value['type'], $type)){
                $type[] = $value['type'];
            }
        }

        return view('finance.sp.view', [
            'date' => $date,
            'items' => $val,
            'type' => $type,
            'source' => $treasury
        ]);
    }

    function confirm(Request $request){
//        dd($request);
        $po = Asset_po::where('company_id', Session::get('company_id'))->get();
        $wo = Asset_wo::where('company_id', Session::get('company_id'))->get();
        foreach ($po as $value){
            $paper['paper_num']['PO'][$value->id] = $value->po_num;
            $paper['supplier'][$value->id] = $value->supplier_id;
            $paper['currency'][$value->id] = $value->currency;
            $paper['gr_date'][$value->id] = $value->gr_date;
            $paper['bgcolor']['PO'][$value->id] = "#ab47bc";
        }

        foreach ($wo as $value){
            $paper['paper_num']['WO'][$value->id]= $value->wo_num;
            $paper['supplier'][$value->id] = $value->supplier_id;
            $paper['currency'][$value->id] = $value->currency;
            $paper['gr_date'][$value->id] = $value->gr_date;
            $paper['bgcolor']['WO'][$value->id] = "#ff7043";
        }

        $ids = $request->id;
        $iType = $request->type;
        $source = $request->source;
        for ($i=0; $i < count($source); $i++){
            if ($source[$i] != null){
                $amount[$i] = 0;
                $desc[$i] = "";
                $type_pay[$i] = "";
                $subject[$i] = "";
                if ($iType[$i] == "INVOICE IN"){
                    $inv_pay = Finance_invoice_in_pay::where('id', $ids[$i])->first();
                    $inv = Finance_invoice_in::find($inv_pay->inv_id);
                    $inv->amount_left = $inv->amount_left - $inv_pay->amount;
                    if ($inv->amount_left <= 0){
                        $inv->status = "paid";
                    }

                    $uInv = Finance_invoice_in_pay::find($ids[$i]);
                    $uInv->paid = 1;
                    $id_paper = $inv->paper_id;
                    $type_paper = $inv->paper_type;

                    $amount[$i] = $inv_pay->amount * -1;
                    $type = $type_paper;
                    $subject[$i] = $paper['paper_num'][$type_paper][$id_paper];
                    $desc[$i] = "[SP] Schedule Payment for " . $paper['paper_num'][$type_paper][$id_paper];

                    $uInv->save();
                    $inv->save();
                } elseif ($iType[$i] == "LEASING"){
                    $leasing_det = Finance_leasing_detail::where('id', $ids[$i])->first();
                    $leasing = Finance_leasing::find($leasing_det->id_leasing);

                    $upLeas = Finance_leasing_detail::find($ids[$i]);
                    $upLeas->status = "paid";
                    $upLeas->save();

                    $amount[$i] = $leasing_det->cicilan * -1;
                    $type = "LEASING";
                    $subject[$i] = "LEASING ".$leasing->subject;
                    $desc[$i] = "[SP] Schedule Payment for Leasing ".$leasing->subject." ".$leasing->vendor;
                } elseif ($iType[$i] == "LOAN"){
                    $leasing_det = Finance_loan_detail::where('id', $ids[$i])->first();
                    $leasing = Finance_loan::find($leasing_det->id_loan);

                    $upLeas = Finance_loan_detail::find($ids[$i]);
                    $upLeas->status = "paid";
                    $upLeas->save();

                    $amount[$i] = $leasing_det->cicilan * -1;
                    $type = "LOAN";
                    $subject[$i] = "LOAN ".$leasing->bank;
                    $desc[$i] = "[SP] Schedule Payment for Loan ".$leasing->bank;
                } elseif ($iType[$i] == "UTIL"){
                    $util_instance = Finance_util_instance::where('id', $ids[$i])->first();

                    $upUtilIns = Finance_util_instance::find($ids[$i]);
                    $upUtilIns->progress = "paid";
                    $upUtilIns->save();

                    $amount[$i] = $util_instance->amount_back * -1;
                    $type = "UTIL";
                    $subject[$i] = "UTIL ".$util_instance->subject;
                    $desc[$i] = "[SP] Schedule Payment for Utilization ".$util_instance->subject;
                } elseif ($iType[$i] == "SALARY"){
                    $util_salary = Finance_util_salary::find($ids[$i]);

                    $util_salary->status = "paid";
                    $util_salary->save();
                    $amount[$i] = $util_salary->amount * -1;
                    $type = "SALARY";
                    $subject[$i] = "Salary, jamsostek, pension of ".$util_salary->position." periode ".date('F Y', strtotime($util_salary->plan_date));
                    $desc[$i] = "[SP] Salary, jamsostek, pension of ".$util_salary->position." periode ".date('F Y', strtotime($util_salary->plan_date));
                }

                $tre_his = new Finance_treasury_history();
                $tre_his->id_treasure = $source[$i];
                $tre_his->date_input = $request->date_input;
                $tre_his->description = $desc[$i];
                $tre_his->IDR = $amount[$i];
                $tre_his->PIC = Auth::user()->username;
                $tre_his->save();

                $tre = Finance_treasury::find($source[$i]);
                $tre->IDR = $tre->IDR + $amount[$i];
                $tre->save();

                $sp = new Finance_schedule_payment();
                $sp->input_time = date('Y-m-d');
                $sp->payment_type = $type;
                $sp->sp_date = $request->date_input;
                $sp->description = $subject[$i];
                $sp->IDR = $amount[$i];
                $sp->PIC = Auth::user()->username;
                $sp->save();
            }
        }

        return redirect()->route('sp.index');
    }

    public function getSalaryFinancing(){
        $salaryfins = Finance_util_salary::orderBy('id','desc')
            ->where('company_id', \Session::get('company_id'))
            ->get();

        return view('finance.salary_financing.index',[
            'salaryfins' => $salaryfins,
        ]);
    }

    public function paySalaryFinancing(Request $request){
        Finance_util_salary::where('id', $request['id'])
            ->update([
                'plan_date' => $request['plan_date'],
                'status' => 'paid',
            ]);

        return redirect()->route('salfin.index');
    }

    public function getSalaryFinancingStat(){
        $salaryfinstat = Finance_util_salary::select(
            DB::raw('currency'),
            DB::raw('YEAR(salary_date) as year'),
            DB::raw('SUM(amount) as sum_amount'),
            DB::raw('SUM(jamsostek) as sum_jam'),
            DB::raw('SUM(health_insurance) as sum_health'),
            DB::raw('SUM(pension) as sum_pension')
        )
            ->groupBy('year','currency')
            ->get();

        return view('finance.salary_financing.stat',[
            'salaryfinstats' => $salaryfinstat
        ]);
    }

}
