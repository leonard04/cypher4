<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hrd_employee;
use App\Models\Hrd_employee_type;


class SalaryListController extends Controller
{
    public function index(){
        $type = Hrd_employee_type::all();

        return view('ha.salarylist.index',[
            'types' => $type,
        ]);
    }
}
