<?php

namespace App\Http\Controllers;

use App\Models\Finance_business;
use App\Models\Finance_business_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class FinanceBusinessController extends Controller
{
    function index(){
        $business = Finance_business::where('company_id', Session::get('company_id'))->get();
        return view('finance.business.index', [
            'business' => $business
        ]);
    }

    function add(Request $request){
//        dd($request);
        $nBusiness = new Finance_business();
        $nBusiness->bank = $request->prj_name;
        $nBusiness->description = $request->partner_name;
        $nBusiness->value = $request->amount;
        $nBusiness->bunga = $request->percentage;
        $nBusiness->start = $request->start_at;
        $nBusiness->moneydrop = $request->given_at;
        $nBusiness->period = $request->duration;
        $nBusiness->type = $request->proportional;
        $nBusiness->currency = $request->currency;
        $nBusiness->cicil_start = $request->cicil_start;
        $nBusiness->own_amount = $request->own_amount;
        $nBusiness->own_remarks = $request->own_remarks;
        $nBusiness->company_id = Session::get('company_id');
        $nBusiness->created_by = Auth::user()->username;
        $nBusiness->save();

        $cicil_pokok = $request->amount / $request->duration;
        $bungaAmt = $cicil_pokok * ($request->percentage / 100);
        $cicilAmt = $cicil_pokok + $bungaAmt;

        $datetime1 = date_create($request->given_at);
        $datetime2 = date_create($request->start_at);

        $interval = date_diff($datetime1, $datetime2);

        $datediff = $interval->format('%a');

        if($request->proportional == "PRO"){
            $periodSum = $request->duration + 1;
            $n[0] = (($request->amount / $request->duration) * ($datediff/30));
        } else { // LUMPSUM
            $periodSum = $request->duration;
            $n[0] = (($request->amount / $request->duration));
        }

        $bungaMulti = (1 + $request->percentage / 100);
        $bungaRate = $request->percentage;
        $balanceNow = $request->amount;

        list($yStart,$mStart,$dStart) = explode("-",$request->start_at);
        for($i = 0; $i < $periodSum; $i++){
            $cicilDraft = ($request->amount / $request->duration);
            if($i == 0)	{
                $cicilNow = $n[0];
            } elseif($balanceNow >= $cicilDraft) {
                $cicilNow = $cicilDraft;
            } elseif($balanceNow < $cicilDraft) {
                $cicilNow = $balanceNow;
            } else {
                $cicilNow = 0;
            }
            // $cicilNow = floor($cicilNow);
            $cicilNow = round($cicilNow,0,PHP_ROUND_HALF_UP);
            $balanceNow = $balanceNow - $cicilNow;
            $bungaNow = $request->amount * ($bungaMulti - 1);
            $bungaNow = round($bungaNow,0,PHP_ROUND_HALF_UP);
            $tanggalNow = $yStart."-".(str_pad($mStart, 2, "0", STR_PAD_LEFT))."-".$dStart;
            $nDetail = new Finance_business_detail();
            $nDetail->id_business = $nBusiness->id;
            $nDetail->cicilan = $cicilNow;
            $nDetail->bunga_rate = $bungaRate;
            $nDetail->bunga = $bungaNow;
            $nDetail->status = 'Planned';
            $nDetail->n_cicil = ($i+1);
            $nDetail->plan_date = $tanggalNow;
            $nDetail->company_id = Session::get('company_id');
            $nDetail->created_by = Auth::user()->username;
            $nDetail->save();

            $mStart++;
            if($mStart > 12){
                $mStart = 1;
                $yStart++;
            }
        }

        return redirect()->back();
    }

    function edit($id){
        $business = Finance_business::find($id);
        return view('finance.business.edit', [
            'business' => $business
        ]);
    }

    function update(Request $request){
        $nBusiness = Finance_business::find($request->id_business);
        $nBusiness->bank = $request->prj_name;
        $nBusiness->description = $request->partner_name;
        $nBusiness->value = $request->amount;
        $nBusiness->bunga = $request->percentage;
        $nBusiness->start = $request->start_at;
        $nBusiness->moneydrop = $request->given_at;
        $nBusiness->period = $request->duration;
        $nBusiness->type = $request->proportional;
        $nBusiness->currency = $request->currency;
        $nBusiness->cicil_start = $request->cicil_start;
        $nBusiness->own_amount = $request->own_amount;
        $nBusiness->own_remarks = $request->own_remarks;
        $nBusiness->save();

        $cicil_pokok = $request->amount / $request->duration;
        $bungaAmt = $cicil_pokok * ($request->percentage / 100);

        $datetime1 = date_create($request->given_at);
        $datetime2 = date_create($request->start_at);

        $interval = date_diff($datetime1, $datetime2);

        $datediff = $interval->format('%a');

        if($request->proportional == "PRO"){
            $n[0] = (($request->amount / $request->duration) * ($datediff/30));
        } else { // LUMPSUM
            $n[0] = (($request->amount / $request->duration));
        }

        Finance_business_detail::where('id_business', $request->id_business)
            ->update([
                'cicilan' => $n[0],
                'bunga_rate' => $request->percentage,
                'bunga' => $bungaAmt
            ]);

        return redirect()->back();
    }

    function delete($id){
        Finance_business::find($id)->delete();
        Finance_business_detail::where('id_business')->delete();
        $data['error'] = 0;
        return json_encode($data);
    }

    function addInvestor(Request $request){
//        dd($request);
        $business = Finance_business::find($request->id_business);
        $json = (empty($business->investors)) ? array() : json_decode($business->investors);
        $detail['name'] = $request->investor_name;
        $detail['amount'] = $request->amount;
        $detail['percentage'] = $request->profit_rate;
        $json[] = $detail;

        $business->investors = json_encode($json);
        $business->save();

        return redirect()->back();
    }

    function updateRate(Request $request){
//        dd($request);
        $business = Finance_business::find($request->business);
        if ($request->type == "company"){
            $business->own_percent = $request->profit_rate;
        } else {
            $investor = json_decode($business->investors);
            $investor[$request->index]->percentage = $request->profit_rate;
            $business->investors = json_encode($investor);
        }
        $business->save();
        return redirect()->back();
    }

    function updateText(Request $request){
//        dd($request);
        $business = Finance_business::find($request->business);
        $investor = json_decode($business->investors);
        $investor[$request->index]->unusedText = $request->unusedText;
//        dd($investor);

        $business->investors = json_encode($investor);
        $business->save();

        return redirect()->back();
    }

    function addInvesment(Request $request){
//        dd($request);
        $business = Finance_business::find($request->business);
        if ($request->type == "company"){
            $company = json_decode($business->company);
            $detail['currency'] = $request->currency;
            $detail['amount'] = $request->amount;
            $idr = $request->amount * $request->rate;
            $detail['IDR'] = $idr;
            $detail['exchange'] = $request->rate;
            $company[] = $detail;
            $business->company = json_encode($company);
        } else {
            $investor = json_decode($business->investors);
            $detail['currency'] = $request->currency;
            $detail['amount'] = $request->amount;
            $idr = $request->amount * $request->rate;
            $detail['IDR'] = $idr;
            $detail['exchange'] = $request->rate;
            $investor[$request->index]->details[] = $detail;
            $business->investors = json_encode($investor);
        }
        $business->save();
        return redirect()->back();
    }

    function detail($id){
        $business = Finance_business::find($id);
        $detail = Finance_business_detail::where('id_business', $id)->get();
        $field = ["month#", "payment_date", "interest_rate", "balance", "installment", "profit", "penalty", "total_amount", "grand_total"];

        return view('finance.business.detail', [
            'business' => $business,
            'details' => $detail,
            'fields' => $field
        ]);
    }

    function investor($id){
        $business = Finance_business::find($id);
        $detail = Finance_business_detail::where('id_business', $id)->get();
        $field = ["month#", "payment_date", "interest_rate", "balance", "installment", "profit", "penalty", "total_amount", "grand_total"];
        $fieldInvestor = ["month#", "payment_date", "interest_rate", "balance", "installment", "profit", "total_amount", "status"];

        return view('finance.business.investor', [
            'business' => $business,
            'details' => $detail,
            'fields' => $field,
            'fieldInvestor' => $fieldInvestor
        ]);
    }

    function pay($id){
        $detail = Finance_business_detail::find($id);

        return view('finance.business.pay', [
            'detail' => $detail
        ]);
    }

    function payConfirm(Request $request){
        $detail = Finance_business_detail::find($request->id);
        $detail->penalty_paid = $request->penalty;
        $detail->status = "Paid";
        $detail->save();
        return redirect()->back();
    }

    function print($id, Request $request){
//        dd($request);
        $business = Finance_business::find($id);
        $detail = Finance_business_detail::where('id_business', $id)->get();
        $balance = $business->value;
        $total = 0;
        $nCicil = 0;
        $nProfit = 0;
        $nPenalty = 0;
        $field = json_decode(base64_decode($request->c));
//        dd($field);
        $row = array();
        foreach ($detail as $key => $item){
            $bunga = $item->cicilan + $item->bunga;
            if ($key == count($detail) - 1){
                $cicil = $balance;
            } else {
                $cicil = $item->cicilan;
            }
            $bunga1 = $bunga - $cicil;
            $total += $cicil + $bunga1;
            $data['month#'] = $key + 1;
            $data['payment_date'] = date("d F Y", strtotime($item->plan_date));
            $data['interest_rate'] = $item->bunga_rate;
            $data['balance'] = number_format($balance, 2)."-value";
            $data['installment'] = number_format($cicil, 2)."-value";
            $data['profit'] = number_format($bunga1, 2)."-value";
            $data['penalty'] = number_format($item->penalty_paid, 2)."-value";
            $data['total_amount'] = number_format($cicil + $bunga1, 2)."-value";
            $data['grand_total'] = number_format($total, 2)."-value";
            $row[] = $data;
            $balance -= $cicil;
            $nCicil += $cicil;
            $nProfit += $bunga;
            $nPenalty += $item->penalty_paid;
        }

        $total = [
            'installment' => number_format($nCicil, 2),
            'profit' => number_format($nProfit, 2),
            'penalty' => number_format($nPenalty, 2),
            'total' => number_format($total, 2)
        ];

        return view('finance.business.print', [
            'business' => $business,
            'details' => $detail,
            'fields' => $field,
            'data' => $row,
            'foot' => $total
        ]);
    }

    function deleteInvestor(Request $request){
        $business = Finance_business::find($request->b);
        $investor = json_decode($business->investors);
        array_splice($investor, $request->i, 1);
//        dd($investor);
        $business->investors = json_encode($investor);
        $business->save();
        return redirect()->back();
    }

    function deleteInvesment(Request $request){
//        dd($request);
        $business = Finance_business::find($request->b);
        if ($request->t == "i"){
            $investor = json_decode($business->investors);
            $detail = $investor[$request->i]->details;
            array_splice($detail, $request->p, 1);
            $investor[$request->i]->details = $detail;
            $business->investors = json_encode($investor);
        } else {
            $detail = json_decode($business->company);
            array_splice($detail, $request->p, 1);
            $business->company = json_encode($detail);
        }

        $business->save();
        return redirect()->back();
    }

    function investorPay(Request $request){
        $business = Finance_business::find($request->b);
        if ($request->t == "i"){
            $investor = json_decode($business->investors);
            $i = $request->i;
            $investor[$i]->payments[$request->p] = date('Y-m-d');
            $business->investors = json_encode($investor);
        } else {
            $archive = json_decode($business->archive_by);
            $i = $request->i;
            $archive[$i] = date('Y-m-d');
            $business->archive_by = json_encode($archive);
        }

        $business->save();
        return redirect()->back();
    }
}
