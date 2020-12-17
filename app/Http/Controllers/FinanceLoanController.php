<?php

namespace App\Http\Controllers;

use App\Models\Finance_loan;
use App\Models\Finance_loan_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Session;

class FinanceLoanController extends Controller
{
    function index(){
        $loan = Finance_loan::where('company_id', Session::get('company_id'))->get();
        $plan_date = array();
        $loan_det = Finance_loan_detail::all();
        foreach ($loan_det as $item) {
            $id_det[$item->id_loan] = $item->id;
            if ($item->status == 'paid'){
                $plan_date[$item->id_loan]['paid'][] = $item->plan_date;
            } else {
                $plan_date[$item->id_loan]['planned'][] = $item->plan_date;
            }
        }

        return view('finance.loan.index', [
            'loans' => $loan,
            'plan_date' => $plan_date
        ]);
    }

    function add(Request $request){
//        dd($request);
        $loan = new Finance_loan();
        $loan->bank = $request->bank_name;
        $loan->value = $request->loan_amount;
        $loan->bunga = $request->int_percentage;
        $loan->start = $request->loan_start;
        $loan->period = $request->loan_duration;
        $loan->type = $request->loan_type;
        $loan->currency = $request->currency;
        $loan->cicil_start = $request->loan_installment;
        $loan->description = $request->description;
        $loan->created_by = Auth::user()->username;
        $loan->company_id = Session::get('company_id');
        $loan->save();

        return redirect()->route('loan.index');
    }

    function detail($id){
        $loan = Finance_loan::where('id', $id)->first();

        $per_bayar = array();
        $bulan_now = date('m', strtotime($loan->start));
        $YY = date('Y', strtotime($loan->start));

        for ($i = 1; $i <= $loan->period; $i++) {
            if($bulan_now > 12) { $bulan_now = 1; $YY = $YY+1;}
            $DD = date('d', strtotime($loan->start));
            if ($DD >= 31){
                $DD = date('t', strtotime($YY."-".$bulan_now."-01"));
            } else {
                $DD = date('d', strtotime($loan->start));
            }
            // $per_bayar[$i] = $YY . "-" . str_pad($bulan_now, 2, "0", STR_PAD_LEFT) . "-" . str_pad($DD, 2, "0", STR_PAD_LEFT);
            $per_bayar[$i] = $DD . "-" . str_pad($bulan_now, 2, "0", STR_PAD_LEFT) . "-" . str_pad($YY, 2, "0", STR_PAD_LEFT);
            // $per_bayar[$i] = date('d M Y', strtotime($per_bayar[$i]));
            $bulan_now     = $bulan_now + 1;
        }

        $loan_det = Finance_loan_detail::where('id_loan', $id)->get();

        return view('finance.loan.view', [
            'loan' => $loan,
            'perbayar' => $per_bayar,
            'loan_item' => $loan_det
        ]);
    }

    function save_plan(Request $request){
        $plan_date = $request->plan_date;
        $cicilan = $request->installment;
        $rate = $request->rate;
        $bunga = $request->interest;

        foreach ($plan_date as $key => $value){
            $loan_det = new Finance_loan_detail();
            $loan_det->id_loan = $request->loan;
            $loan_det->cicilan = $cicilan[$key];
            $loan_det->bunga_rate = $rate[$key];
            $loan_det->bunga = $bunga[$key];
            $loan_det->status = "planned";
            $loan_det->n_cicil = $key;
            $loan_det->plan_date = $value;
            $loan_det->created_by = Auth::user()->username;
            $loan_det->company_id = Session::get('company_id');
            $loan_det->save();
        }

        return redirect()->route('loan.detail', $request->loan);
    }

    function update_plan(Request $request){
        $id_detail = $request->id_det;
        $plan_date = $request->plan_date;
        $cicilan = $request->installment;
        $rate = $request->rate;
        $bunga = $request->interest;
        foreach ($id_detail as $value){
            $loan_det = Finance_loan_detail::find($value);
            $loan_det->cicilan = $cicilan[$value];
            $loan_det->bunga_rate = $rate[$value];
            $loan_det->bunga = $bunga[$value];
            $loan_det->updated_by = Auth::user()->username;
            $loan_det->save();
        }

        return redirect()->route('loan.detail', $request->loan);
    }

    function edit_plan($id){
        $loan = Finance_loan::where('id', $id)->first();

        $loan_det = Finance_loan_detail::where('id_loan', $id)->get();

        return view('finance.loan.edit', [
            'loan' => $loan,
            'loan_item' => $loan_det
        ]);
    }

    function delete(Request $request){
        $id = $request->val;
        Finance_loan::find($id)->delete();
        Finance_loan_detail::where('id_loan', $id)->delete();
        $data['error'] = 0;
        return json_encode($data);
    }
}
