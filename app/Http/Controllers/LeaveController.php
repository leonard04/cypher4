<?php

namespace App\Http\Controllers;

use App\Models\Absen2;
use App\Models\Absen_Alasan;
use App\Models\Cuti;
use App\Models\Hrd_employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Session;

class LeaveController extends Controller
{
    function index(){
        $leave = Cuti::all();
        $employee = Hrd_employee::where('company_id',\Session::get('company_id'))->get();
        return view('leave.index', [
            'leave' => $leave,
            'emp' => $employee
        ]);
    }

    function request_form(){
        $absen_bobot = Absen_Alasan::where('bobot', 0)->first();
        $employee    = Hrd_employee::where('company_id',\Session::get('company_id'))->get();
        return view('leave.form', [
            'absen_bobot' => $absen_bobot,
            'employee'    => $employee
        ]);
    }

    function submit(Request $request){
//        dd($request);
        $emp_id = $request->emp_id;
        $cuticheck = explode("-", $request->cuticheck);
        $start_leave = $request->start_date;
        $end_leave = $request->end_date;
        $reason = $request->reason;

        $diff = date_diff(date_create($start_leave), date_create($end_leave));

        $diff_num = $diff->format('%a') + 1;

        if (!empty($request->emp_id)){
            $employee = Hrd_employee::where('id', $emp_id)->first();
            $emp_type = $employee->emp_type;
        }

        $emps = Hrd_employee::all();


//        print_r($cuticheck);

        if (empty($request->cuticheck)) {
            $cuti = new Cuti;
            $cuti->request_at = date('Y-m-d');
            $cuti->c_id = null;
            $cuti->id_emp = $emp_id;
            $cuti->awal = $start_leave;
            $cuti->akhir = $end_leave;
            $cuti->keterangan = $reason;
            $cuti->status = "0";
            $cuti->save();
        } else {
            if (count($cuticheck) > 1) {
                foreach ($emps as $value){
                    $cuti = new Cuti;
                    $cuti->request_at = date('Y-m-d');
                    $cuti->c_id = null;
                    $cuti->id_emp = $value->id;
                    $cuti->awal = $start_leave;
                    $cuti->akhir = $end_leave;
                    $cuti->keterangan = $reason;
                    $cuti->status = 5;
                    $cuti->save();

                    $absen2 = new Absen2;
                    $absen2->a_id = null;
                    $absen2->id = $value->id;
                    $absen2->date = $start_leave;
                    $absen2->absen_alasan_id = $cuticheck[0];
                    $absen2->save();

                    $emp = Hrd_employee::find($value->id);
                    $emp->cuti = $value->cuti - $diff_num;
                    $emp->save();
                }
            } else {
                $cuti = new Cuti;
                $cuti->request_at = date('Y-m-d');
                $cuti->c_id = null;
                $cuti->id_emp = $emp_id;
                $cuti->awal = $start_leave;
                $cuti->akhir = $end_leave;
                $cuti->keterangan = $reason;
                $cuti->status = "0";
                $cuti->save();
            }
        }

        return \redirect()->route('leave.index');
    }

    function checkcuti(Request $request){
        $id = $request->id;
        $employee = Hrd_employee::where('id', $id)
            ->where('company_id',\Session::get('company_id'))
            ->first();
        $data['jumlah_cuti'] = $employee->cuti;

        return json_encode($data);
    }

    function approve(Request $request){
        if ($request->appr == "div"){
            $leave = Cuti::where('c_id', $request->id)
                ->update([
                    'div_by' => Auth::user()->username,
                    'div_date' => date('Y-m-d')
                ]);
        } else {
            $leave = Cuti::where('c_id', $request->id)
                ->update([
                    'hrd_by' => Auth::user()->username,
                    'hrd_date' => date('Y-m-d')
                ]);
        }

        if ($leave){
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    function delete($id){
        $leave = Cuti::where('c_id', $id)->delete();
        if ($leave){
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }
}
