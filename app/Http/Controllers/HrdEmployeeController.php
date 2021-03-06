<?php

namespace App\Http\Controllers;

//use Faker\Provider\File;
use App\Helpers\FileManagement;
use App\Models\Hrd_employee_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;
use App\Models\Rms_divisions;
use App\Models\Hrd_employee;
use App\Models\Hrd_employee_history_edit;
use App\Models\Hrd_employee_history;
use App\Models\Hrd_employee_loan;
use App\Models\Hrd_employee_loan_payment;
use Illuminate\Support\Facades\File;

class HrdEmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getEmpGet($type=null){
        $divisions = Rms_divisions::where('id_company', Session::get('company_id'))
            ->where('name','not like','%admin%')
            ->get();
        if ($type == null){
            $employees = Hrd_employee::whereNull('expel')
                ->where('emp_type', 1)
                ->where('company_id', Session::get('company_id'))
                ->get();
        } else {
            $employees = Hrd_employee::whereNull('expel')
                ->where('emp_type', $type)
                ->where('company_id', Session::get('company_id'))
                ->get();
        }

        $divName = [];
        foreach ($divisions as $key => $val){
            $divName['name'][$val->id] = $val->name;
        }

        $emptypes = Hrd_employee_type::all();
        $emp_type = [];
        foreach ($emptypes as $key => $val){
            $emp_type[$val->id] = $val->name;
        }

        $row = [];
        $emp = [];

        foreach ($employees as $key => $value){
            $status = substr($value->emp_id,4,1);
            $emp['no'] = ($key+1);
            $emp['emp_name'] = "<a href='".route('employee.detail',['id'=>$value->id])."' class='btn btn-primary btn-sm'>".$value->emp_name."</a>";
            $emp['emp_type'] = $emp_type[$value->emp_type];
            $emp['emp_id'] = $value->emp_id;
            $emp['emp_position'] = $value->emp_position;
            $emp['division'] = (isset($divName['name'][$value->division])) ? $divName['name'][$value->division] : "";
            if ($status != 'K' && $status != 'C'){
                $emp['status'] = "<center><label class='text-center text-success'>Pegawai Tetap</label></center>";
            } else {
                if ($value->expire == null){
                    $emp['status'] = "<center>
                                            <button type='button' data-target=''#modalcontract-".$value->id."' data-toggle='modal' class='btn btn-sm btn-success'>
                                                <i class='fa fa-plus icon-nm'></i> [add contract]
                                            </button>
                                        </center>

                                        <div class='modal fade' id='modalcontract-".$value->id."' tabindex='-1' role='dialog' aria-labelledby='modalcontract-".$value->id."' aria-hidden='true'>
                                            <div class='modal-dialog modal-dialog-centered modal-xl' role='document'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='exampleModalLabel'>Add Contract</h5>
                                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                            <i aria-hidden='true' class='ki ki-close'></i>
                                                        </button>
                                                    </div>
                                                    <form method='post' action='".route('employee.addcontract')."' enctype='multipart/form-data'>
                                                        ".csrf_token()."
                                                        <input type='hidden' name='id' value='".$value->id."'>
                                                        <div class='modal-body'>
                                                            <br>
                                                            <h4>Upload a contract for {{$value->emp_name}}</h4><hr>
                                                            <div class='row'>
                                                                <div class='form col-md-12'>
                                                                    <div class='form-group'>
                                                                        <label>Document</label>
                                                                        <input type='hidden' name='MAX_FILE_SIZE' value='200000' />
                                                                        <input type='file' class='form-control' name='contract_file' id='contract_file' placeholder=''>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>This contract expires on</label>
                                                                        <input type='date' class='form-control' name='date_exp' placeholder='' />
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label></label>
                                                                        <label or='as' class='control-label'>
                                                                            <input type='radio' name='opt' value='1' id='opt' checked />
                                                                            Renew Contract
                                                                        </label>
                                                                        &nbsp;&nbsp;
                                                                        <label for='int' class='control-label'>
                                                                            <input type='radio' name='opt' value='2' id='opt' />
                                                                            Permanent Employee
                                                                        </label>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class='modal-footer'>
                                                            <button type='button' class='btn btn-light-primary font-weight-bold' data-dismiss='modal'>Close</button>
                                                            <button type='submit' name='submit' value='1' class='btn btn-primary font-weight-bold'>
                                                                <i class='fa fa-check'></i>
                                                                Add Contract</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        ";
                } else {
                    $date2 = date('Y-m-d', strtotime('-1 month', strtotime($value->expire)));
                    $date1 = date('Y-m-d');

                    $diff = abs(strtotime($date2) - strtotime($date1));
                    $years = floor($diff / (365*60*60*24));
                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                    $emp['status'] = "<center>
                                            <label class='text-danger font-weight-bolder'>exp: ".$value->expire."</label>
                                            <a href='".route('download',$value->contract_file)."' class='btn btn-xs btn-icon btn-light-success' target='_blank'><i class='fa fa-download'></i></a>
                                        </center> &nbsp;";
                    if ($months <= 1){
                        $emp['status'] .= "<center>
                                                <button type='button' data-target='#modalrenewcontract-".$value->id."' data-toggle='modal' class='btn btn-sm btn-success'>
                                                    <i class='fa fa-plus icon-nm'></i> [renew contract]
                                                </button>
                                            </center>

                                            <div class='modal fade' id='modalrenewcontract-".$value->id."' tabindex='-1' role='dialog' aria-labelledby='modalrenewcontract-".$value->id."' aria-hidden='true'>
                                                <div class='modal-dialog modal-dialog-centered modal-xl' role='document'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <h5 class='modal-title' id='exampleModalLabel'>Renew Contract</h5>
                                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                                <i aria-hidden='true' class='ki ki-close'></i>
                                                            </button>
                                                        </div>
                                                        <form method='post' action='".route('employee.addcontract')."' enctype='multipart/form-data'>
                                                            <input type='hidden' name='_token' value='".csrf_token()."'>
                                                            <input type='hidden' name='id' value='".$value->id."'>
                                                            <div class='modal-body'>
                                                                <br>
                                                                <h4>Upload a contract for ".$value->emp_name."</h4><hr>
                                                                <div class='row'>
                                                                    <div class='form col-md-12'>
                                                                        <div class='form-group'>
                                                                            <label>Document</label>
                                                                            <input type='hidden' name='MAX_FILE_SIZE' value='200000' />
                                                                            <input type='file' class='form-control' name='contract_file' id='contract_file' placeholder=''>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <label>This contract expires on</label>
                                                                            <input type='date' class='form-control' name='date_exp' placeholder='' />
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <label></label>
                                                                            <label or='as' class='control-label'>
                                                                                <input type='radio' name='opt' value='1' id='opt' checked />
                                                                                Renew Contract
                                                                            </label>
                                                                            &nbsp;&nbsp;
                                                                            <label for='int' class='control-label'>
                                                                                <input type='radio' name='opt' value='2' id='opt' />
                                                                                Permanent Employee
                                                                            </label>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class='modal-footer'>
                                                                <button type='button' class='btn btn-light-primary font-weight-bold' data-dismiss='modal'>Close</button>
                                                                <button type='submit' name='submit' value='1' class='btn btn-primary font-weight-bold'>
                                                                    <i class='fa fa-check'></i>
                                                                    Add Contract</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            ";
                    }
                }
            }
            $emp['cv'] = "<a href='".route('employee.detail',['id'=>$value->id])."' class='btn btn-success btn-sm'><i class='fa fa-cog icon-nm'></i> manage</a>";
            $emp['document'] = "<a href='".route('employee.detail',['id'=>$value->id])."' class='btn btn-success btn-sm'><i class='fa fa-cog icon-nm'></i> manage</a>";
            $emp['quit'] = "<a href='".route('employee.expel',['id' =>$value->id])."' class='btn btn-sm btn-danger' onclick='return confirm(\"Pegawai ini DIPECAT?\"); '><i class='fa fa-times icon-nm'></i> Fired</a>";
            $emp['training_point'] = " <a href='' class='btn btn-light-dark btn-icon btn-sm'><i class='fa fa-eye text-white icon-nm'></i></a>";
            $emp['action'] = "<form method='post' action='".route('employee.delete',['id'=>$value->id])."'>
                                   <input type='hidden' name='_token' value='".csrf_token()."'>
                                    <button type='submit' class='btn btn-sm btn-icon btn-default' onclick='return confirm(\"Hapus data pegawai?\");'>
                                        <i class='fa fa-trash text-danger'></i>
                                    </button>
                              </form>";
            $row[] = $emp;
        }
        $data = [
            'data' => $row,
        ];
//        dd($data);
        return json_encode($data);
    }

    public function getEmp(Request $request){
//        dd($request);
        $divisions = Rms_divisions::where('id_company', Session::get('company_id'))
            ->where('name','not like','%admin%')
            ->get();
        if ($request->type == null){
            $employees = Hrd_employee::whereNull('expel')
                ->where('emp_type', 1)
                ->where('company_id', Session::get('company_id'))
                ->get();
        } elseif ($request->type == 0){
            $employees = Hrd_employee::whereNull('expel')
                ->where('company_id', Session::get('company_id'))
                ->get();
        } else {
            $employees = Hrd_employee::whereNull('expel')
                ->where('emp_type', $request->type)
                ->where('company_id', Session::get('company_id'))
                ->get();
        }

        $divName = [];
        foreach ($divisions as $key => $val){
            $divName['name'][$val->id] = $val->name;
        }

        $emptypes = Hrd_employee_type::all();
        $emp_type = [];
        foreach ($emptypes as $key => $val){
            $emp_type[$val->id] = $val->name;
        }

        $row = [];
        $emp = [];

        foreach ($employees as $key => $value){
            $status = substr($value->emp_id,4,1);
            $emp['no'] = ($key+1);
            $emp['emp_name'] = "<a href='".route('employee.detail',['id'=>$value->id])."' class='btn btn-primary btn-sm'>".$value->emp_name."</a>";
            $emp['emp_type'] = $emp_type[$value->emp_type];
            $emp['emp_id'] = $value->emp_id;
            $emp['emp_position'] = $value->emp_position;
            $emp['division'] = (isset($divName['name'][$value->division])) ? $divName['name'][$value->division] : "";
            if ($status != 'K' && $status != 'C'){
                $emp['status'] = "<center><label class='text-center text-success'>Pegawai Tetap</label></center>";
            } else {
                if ($value->expire == null){
                    $emp['status'] = "<center>
                                            <button type='button' data-target=''#modalcontract-".$value->id."' data-toggle='modal' class='btn btn-sm btn-success'>
                                                <i class='fa fa-plus icon-nm'></i> [add contract]
                                            </button>
                                        </center>

                                        <div class='modal fade' id='modalcontract-".$value->id."' tabindex='-1' role='dialog' aria-labelledby='modalcontract-".$value->id."' aria-hidden='true'>
                                            <div class='modal-dialog modal-dialog-centered modal-xl' role='document'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='exampleModalLabel'>Add Contract</h5>
                                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                            <i aria-hidden='true' class='ki ki-close'></i>
                                                        </button>
                                                    </div>
                                                    <form method='post' action='".route('employee.addcontract')."' enctype='multipart/form-data'>
                                                        ".csrf_token()."
                                                        <input type='hidden' name='id' value='".$value->id."'>
                                                        <div class='modal-body'>
                                                            <br>
                                                            <h4>Upload a contract for {{$value->emp_name}}</h4><hr>
                                                            <div class='row'>
                                                                <div class='form col-md-12'>
                                                                    <div class='form-group'>
                                                                        <label>Document</label>
                                                                        <input type='hidden' name='MAX_FILE_SIZE' value='200000' />
                                                                        <input type='file' class='form-control' name='contract_file' id='contract_file' placeholder=''>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label>This contract expires on</label>
                                                                        <input type='date' class='form-control' name='date_exp' placeholder='' />
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <label></label>
                                                                        <label or='as' class='control-label'>
                                                                            <input type='radio' name='opt' value='1' id='opt' checked />
                                                                            Renew Contract
                                                                        </label>
                                                                        &nbsp;&nbsp;
                                                                        <label for='int' class='control-label'>
                                                                            <input type='radio' name='opt' value='2' id='opt' />
                                                                            Permanent Employee
                                                                        </label>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class='modal-footer'>
                                                            <button type='button' class='btn btn-light-primary font-weight-bold' data-dismiss='modal'>Close</button>
                                                            <button type='submit' name='submit' value='1' class='btn btn-primary font-weight-bold'>
                                                                <i class='fa fa-check'></i>
                                                                Add Contract</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        ";
                } else {
                    $date2 = date('Y-m-d', strtotime('-1 month', strtotime($value->expire)));
                    $date1 = date('Y-m-d');

                    $diff = abs(strtotime($date2) - strtotime($date1));
                    $years = floor($diff / (365*60*60*24));
                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                    $emp['status'] = "<center>
                                            <label class='text-danger font-weight-bolder'>exp: ".$value->expire."</label>
                                            <a href='".route('download',$value->contract_file)."' class='btn btn-xs btn-icon btn-light-success' target='_blank'><i class='fa fa-download'></i></a>
                                        </center> &nbsp;";
                    if ($months <= 1){
                        $emp['status'] .= "<center>
                                                <button type='button' data-target='#modalrenewcontract-".$value->id."' data-toggle='modal' class='btn btn-sm btn-success'>
                                                    <i class='fa fa-plus icon-nm'></i> [renew contract]
                                                </button>
                                            </center>

                                            <div class='modal fade' id='modalrenewcontract-".$value->id."' tabindex='-1' role='dialog' aria-labelledby='modalrenewcontract-".$value->id."' aria-hidden='true'>
                                                <div class='modal-dialog modal-dialog-centered modal-xl' role='document'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <h5 class='modal-title' id='exampleModalLabel'>Renew Contract</h5>
                                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                                <i aria-hidden='true' class='ki ki-close'></i>
                                                            </button>
                                                        </div>
                                                        <form method='post' action='".route('employee.addcontract')."' enctype='multipart/form-data'>
                                                            <input type='hidden' name='_token' value='".csrf_token()."'>
                                                            <input type='hidden' name='id' value='".$value->id."'>
                                                            <div class='modal-body'>
                                                                <br>
                                                                <h4>Upload a contract for ".$value->emp_name."</h4><hr>
                                                                <div class='row'>
                                                                    <div class='form col-md-12'>
                                                                        <div class='form-group'>
                                                                            <label>Document</label>
                                                                            <input type='hidden' name='MAX_FILE_SIZE' value='200000' />
                                                                            <input type='file' class='form-control' name='contract_file' id='contract_file' placeholder=''>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <label>This contract expires on</label>
                                                                            <input type='date' class='form-control' name='date_exp' placeholder='' />
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <label></label>
                                                                            <label or='as' class='control-label'>
                                                                                <input type='radio' name='opt' value='1' id='opt' checked />
                                                                                Renew Contract
                                                                            </label>
                                                                            &nbsp;&nbsp;
                                                                            <label for='int' class='control-label'>
                                                                                <input type='radio' name='opt' value='2' id='opt' />
                                                                                Permanent Employee
                                                                            </label>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class='modal-footer'>
                                                                <button type='button' class='btn btn-light-primary font-weight-bold' data-dismiss='modal'>Close</button>
                                                                <button type='submit' name='submit' value='1' class='btn btn-primary font-weight-bold'>
                                                                    <i class='fa fa-check'></i>
                                                                    Add Contract</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            ";
                    }
                }
            }
            $emp['cv'] = "<a href='".route('employee.detail',['id'=>$value->id])."' class='btn btn-success btn-sm'><i class='fa fa-cog icon-nm'></i> manage</a>";
            $emp['document'] = "<a href='".route('employee.detail',['id'=>$value->id])."' class='btn btn-success btn-sm'><i class='fa fa-cog icon-nm'></i> manage</a>";
            $emp['quit'] = "<a href='".route('employee.expel',['id' =>$value->id])."' class='btn btn-sm btn-danger' onclick='return confirm(\"Pegawai ini DIPECAT?\"); '><i class='fa fa-times icon-nm'></i> Fired</a>";
            $emp['training_point'] = " <a href='' class='btn btn-light-dark btn-icon btn-sm'><i class='fa fa-eye text-white icon-nm'></i></a>";
            $emp['action'] = "<form method='post' action='".route('employee.delete',['id'=>$value->id])."'>
                                   <input type='hidden' name='_token' value='".csrf_token()."'>
                                    <button type='submit' class='btn btn-sm btn-icon btn-default' onclick='return confirm(\"Hapus data pegawai?\");'>
                                        <i class='fa fa-trash text-danger'></i>
                                    </button>
                              </form>";
            $row[] = $emp;
        }
        $data = [
            'data' => $row,
        ];
//        dd($data);
        return json_encode($data);

    }
    public function index(){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }

        $divisions = Rms_divisions::whereIn('id_company', $id_companies)
            ->where('name','not like','%admin%')
            ->get();
        $employees = Hrd_employee::whereNull('expel')
            ->whereIn('company_id', $id_companies)
            ->get();
        $divName = [];
        foreach ($divisions as $key => $val){
            $divName['name'][$val->id] = $val->name;
        }
//        dd($employees);

//        dd($divName);
        $emptypes = Hrd_employee_type::all();
        $emp_type = [];
        foreach ($emptypes as $key => $val){
            $emp_type[$val->id] = $val->name;
        }

        return view('employee.index',[
            'employees' => $employees,
            'emptypes' => $emptypes,
            'divisions' => $divisions,
            'divName' => $divName,
            'emp_type' => $emp_type,
        ]);
    }

    public function getIndexEmployeeLoan(){
////        $loan = Hrd_employee_loan::where('company_id', Session::get('company_id'))->get();
//        $loan = DB::table('hrd_employee_loan')
//            ->select('hrd_employee_loan.*', 'employee.emp_name as emp_name')
//            ->join('hrd_employee as employee','employee.id','=','hrd_employee_loan.emp_id')
//            ->where('employee.company_id', \Session::get('company_id'))
//            ->where('hrd_employee_loan.company_id', \Session::get('company_id'))
//            ->whereNull('employee.expel')
//            ->whereNull('hrd_employee_loan.deleted_at')
////            ->orderBy('date_given','DESC')
//            ->get();

        $loan_payment = Hrd_employee_loan_payment::orderBy('date_of_payment','DESC')
            ->whereNull('hrd_employee_loan_payment.deleted_at')
            ->get();

        $employees = Hrd_employee::where('company_id', \Session::get('company_id'))
            ->whereNull('expel')
            ->whereNull('deleted_at')
            ->get();
        $payment = array();
        foreach ($loan_payment as $item){
            $payment[$item->company_id][$item->loan_id][] = $item->amount;
        }
//        dd($employees);
        $data_emp = array();
        foreach ($employees as $item){
            if (!empty($item->old_id)){
                $data_emp[$item->old_id] = $item;
                $id[] = $item->old_id;
            } else {
                $data_emp[$item->id] = $item;
                $id[] = $item->id;
            }
        }

        $loan = Hrd_employee_loan::where('company_id', \Session::get('company_id'))
            ->whereIn('emp_id', $id)
            ->get();

        return view('employee.loan',[
            'employees' => $employees,
            'loans' => $loan,
            'payments' => $payment,
            'data_emp' => $data_emp,
        ]);
    }
    public function loandelete($id){
        Hrd_employee_loan::find($id)->delete();
        Hrd_employee_loan_payment::where('loan_id',$id)->delete();
        return redirect()->route('employee.loan');

    }

    public function submitNeedsec(Request $request){
        $this->validate($request,[
            'searchInput' => 'required'
        ]);
        if ($request['searchInput'] == 'koi999'){
            Session::put('seckey_empfin', 99);
            return redirect()->back()->with('message_needsec_success_empfin', 'Access Granted!');
        } else {
            return redirect()->back()->with('message_needsec_fail_empfin', 'Access Denied!');
        }
    }

    public function nextDocNumber($code,$db){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        if ($db == "loan"){
            $cek = Hrd_employee_loan::where('loan_id','like','%'.$code.'%')
                ->whereIn('company_id', $id_companies)
                ->whereNull('deleted_at')
                ->orderBy('id','DESC')
                ->get();

            if (count($cek) > 0){
                $loanId = $cek[0]->loan_id;
                $str = explode('/', $loanId);
                $number = intval($str[0]);
                $number+=1;
                if ($number > 99){
                    $no = strval($number);
                } elseif ($number > 9) {
                    $no = "0".strval($number);
                } else {
                    $no = "00".strval($number);
                }
            } else {
                $no = "001";
            }
        } else {
            $cek = Hrd_employee_loan_payment::where('payment_id','like','%'.$code.'%')
                ->whereIn('company_id', $id_companies)
                ->whereNull('deleted_at')
                ->orderBy('id','DESC')
                ->get();

            if (count($cek) > 0){
                $payId = $cek[0]->payment_id;
                $str = explode('/', $payId);
                $number = intval($str[0]);
                $number+=1;
                if ($number > 99){
                    $no = strval($number);
                } elseif ($number > 9) {
                    $no = "0".strval($number);
                } else {
                    $no = "00".strval($number);
                }
            } else {
                $no = "001";
            }
        }
        return $no;

    }

    function monthDiff($date1, $date2) {
        $ts1 = strtotime($date1);
        $ts2 = strtotime($date2);

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);

        $diff = (($year2 - $year1) * 12) + ($month2 - $month1);

        return $diff;
    }

    public function addContract(Request $request){
        $emp = Hrd_employee::where('id', $request['id'])->first();
        if ($request->hasFile('contract_file')){
            $file = $request->file('contract_file');

            $newFile = $emp->emp_name.'_'.date('Y_m_d_H_i_s')."-contract_file.".$file->getClientOriginalExtension();
            $hashFile = Hash::make($newFile);
            $hashFile = str_replace("/", "", $hashFile);

            $upload = FileManagement::save_file_management($hashFile, $file, $newFile, "media/employee_attachment");
            if ($upload == 1){
                Hrd_employee::where('id',$request['id'])
                    ->update([
                        'expire' =>$request['date_exp'],
                        'contract_file' => $hashFile,
                    ]);
            }
        }

        if ($request['opt'] == '2'){
            $str = explode('-',$emp->emp_id);

            $status = substr($emp->emp_id,4,1);
            $str1_new = str_replace($status,'',$str[1]);
            $new_empid = $str[0].'-'.$str1_new;
            Hrd_employee::where('id',$request['id'])
                ->update([
                    'emp_id' => $new_empid,
                ]);
        }


        return redirect()->route('employee.index');
    }

    public function addLoan(Request $request){
        $this->validate($request,[
            'employee' => 'required',
            'start' => 'required',
            'end'=> 'required',
            'amount' => 'required'
        ]);
        $arrRomawi	= array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $loan_num = $this->nextDocNumber("LN","loan");
        $loanID = str_pad($loan_num, 3, '0', STR_PAD_LEFT).'/'.strtoupper(\Session::get('company_tag')).'/LN/'.$arrRomawi[date("n")].'/'.date("y");

        $loan = new Hrd_employee_loan();
        $loan->loan_id = $loanID;
        $loan->emp_id = $request['employee'];
        $loan->loan_amount = $request['amount'];
        $loan->loan_start = $request['start'];
        $loan->loan_end = $request['end'];
        $loan->notes = ($request['notes']!=null) ? $request['notes']:'';
        $loan->given_by = Auth::user()->username;
        $loan->given_time = date('Y-m-d H:i:s');
        $loan->date_given = date('Y-m-d');
        $loan->company_id = \Session::get('company_id');
        $loan->save();

        if (isset($request['autopay'])){
            list($d1, $m1, $y1) = explode('-', $request['start']);
            list($d2, $m2, $y2) = explode('-', $request['end']);

            $bonusStart = sprintf("%s-%02s-%02s", $y1, $m1, $d1);
            $bonusEnd = sprintf("%s-%02s-%02s", $y2, $m2, $d2);
            $monthDiff = $this->monthDiff($bonusStart, $bonusEnd);

            for ($i = 0; $i < $monthDiff; $i++){
                $payment_num = $this->nextDocNumber("LNPAY","loan_payment");
                $id_loan = $loan->id;
                $payment_id = str_pad($payment_num, 3, '0', STR_PAD_LEFT).'/'.strtoupper(\Session::get('company_tag')).'/LNPAY/'.$arrRomawi[date("n")].'/'.date("y");
                $date_of_payment_repeat = strtotime($bonusStart);
                $dates = date('Y-m-d', strtotime("+".$i." month", $date_of_payment_repeat));
                $dates2 = explode('-',$dates);
                $date_of_payment = $dates2[0].'-'.$dates2[1].'-17';
//                echo $date_of_payment."<br>";
                $amount = $request['amount']/$monthDiff;

                $loan_pay = new Hrd_employee_loan_payment();
                $loan_pay->loan_id = $id_loan;
                $loan_pay->amount = round($amount);
                $loan_pay->payment_id = $payment_id;
                $loan_pay->date_of_payment = $date_of_payment;
                $loan_pay->remark = 'insert by autopay';
                $loan_pay->receive_by = Auth::user()->username;
                $loan_pay->receive_time = date('Y-m-d H:i:s');
                $loan_pay->company_id = \Session::get('company_id');
                $loan_pay->save();
            }
        }
        return redirect()->route('employee.loan');
    }

    public function getDetailLoan($id){
        $loan = Hrd_employee_loan::where('id',$id)
            ->whereNull('deleted_at')
            ->first();

        $emps = Hrd_employee::where('company_id', \Session::get('company_id'))
            ->get();
        $data_emp = array();
        foreach ($emps as $item){
            if (!empty($item->old_id)){
                $data_emp[$item->old_id] = $item;
            } else {
                $data_emp[$item->id] = $item;
            }
        }

        $emp = $data_emp[$loan->emp_id];

        $loan_balance = intval($loan->loan_amount);

        $id_loan = (empty($loan->old_id)) ? $id : $loan->old_id;

        $loan_payments = Hrd_employee_loan_payment::where('loan_id', $id_loan)
            ->where('company_id', \Session::get('company_id'))
            ->whereNull('deleted_at')
            ->get();

        foreach ($loan_payments as $key => $val){
            $loan_balance -= intval($val->amount);
        }

        return view('employee.loan_payment',[
            'emp' => $emp,
            'payments' => $loan_payments,
            'balance' => $loan_balance,
            'loan' => $loan
        ]);
    }

    public function storeLoanPayment(Request $request){
        $this->validate($request,[
            'amount' => 'required',
            'date_of_payment' => 'required',
        ]);

        $arrRomawi	= array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $payment_num = $this->nextDocNumber("LNPAY","loan_payment");
        $id_loan = $request['loan_id'];
        $payment_id = str_pad($payment_num, 3, '0', STR_PAD_LEFT).'/'.strtoupper(\Session::get('company_tag')).'/LNPAY/'.$arrRomawi[date("n")].'/'.date("y");
        $loan_pay = new Hrd_employee_loan_payment();
        $loan_pay->amount = $request['amount'];
        $loan_pay->payment_id = $payment_id;
        $loan_pay->loan_id = $id_loan;
        $loan_pay->date_of_payment = $request['date_of_payment'];
        $loan_pay->receive_by = Auth::user()->username;
        $loan_pay->receive_time = date('Y-m-d H:i:s');
        $loan_pay->remark = 'insert by '.Auth::user()->username;
        $loan_pay->company_id = \Session::get('company_id');
        $loan_pay->save();
//        echo $request['bonus_id'];

        return redirect()->route('employee.loan.detail',[$request['loan_id']]);
    }

    public function store(Request $request){
//        dd($request);
        if (isset($request['submit'])){
            $this->validate($request,[
                'full_name' => 'required',
                'email' => 'required|email',
                'emp_status' => 'required',
                'address' => 'required',
                'religion' => 'required',
                'phone_1' => 'required',
                'date_birth' => 'required',
                'emp_id' => 'required',
                'emp_type' => 'required',
                'position' => 'required',
                'bankCode' => 'required',
                'account' => 'required',
                'picture' => 'required',
                'ktp' => 'required',
                'serti1' => 'required',
                'thp' => 'required',
            ]);
            $uploaddir = public_path('hrd\\uploads');
            $employee = new Hrd_employee();
            $employee_history = new Hrd_employee_history();

            if ($request->hasFile('picture')){
                $file = $request->file('picture');
                $newFile = stripslashes($request->input('emp_id'))."-picture.".$file->getClientOriginalExtension();
                $hashFile = Hash::make($newFile);
                $hashFile = str_replace("/", "", $hashFile);

                $upload = FileManagement::save_file_management($hashFile, $file, $newFile, "media/employee_attachment");
                if ($upload == 1){
                    $employee->picture = $newFile;
                }
            }

            if ($request->hasFile('ktp')){
                $file = $request->file('ktp');
                $newFile = stripslashes($request->input('emp_id'))."-ktp.".$file->getClientOriginalExtension();
                $hashFile = Hash::make($newFile);
                $hashFile = str_replace("/", "", $hashFile);

                $upload = FileManagement::save_file_management($hashFile, $file, $newFile, "media/employee_attachment");
                if ($upload == 1){
                    $employee->ktp = $newFile;
                }
            }

            if ($request->hasFile('serti1')){
                $file = $request->file('serti1');
                $newFile = stripslashes($request->input('emp_id'))."-serti1.".$file->getClientOriginalExtension();
                $hashFile = Hash::make($newFile);
                $hashFile = str_replace("/", "", $hashFile);

                $upload = FileManagement::save_file_management($hashFile, $file, $newFile, "media/employee_attachment");
                if ($upload == 1){
                    $employee->serti1 = $newFile;
                }
            }

            $employee->emp_id = stripslashes($request->input('emp_id'));
            $employee->emp_name = stripslashes($request->input('full_name'));


            $thp       = $request->input('thp');
            $SAL       = intval($thp*0.4);
            $HEALTH    = intval($thp*0.15);
            $TRANSPORT = intval($thp*0.15);
            $MEAL      = intval($thp*0.20);
            $HOUSE     = intval($thp*0.10);

            $employee->phoneh                = $request->input('phone_home');
            $employee->salary                = base64_encode($SAL);
            $employee->transport             = base64_encode($TRANSPORT);
            $employee->meal                  = base64_encode($MEAL);
            $employee->house                 = base64_encode($HOUSE);
            $employee->health                = base64_encode($HEALTH);
            $employee->emp_position          = $request->input('position');
            $employee->pension               = ($request->input('pensi')) ? $request->input('pensi') : 0;
            $employee->health_insurance      = ($request->input('hi')) ? $request->input('hi') : 0;
            $employee->jamsostek             = ($request->input('jam')) ? $request->input('jam') : 0;
            $employee->emp_type              = $request->input('emp_type');
            $employee->religion              = $request->input('religion');
            $employee->company_id            = Session::get('company_id');
            $employee->tax_status            = 0;
            $employee->fld_bonus             = ($request->input('fld_bonus')) ? $request->input('fld_bonus') : 0;
            $employee->division              = ($request->input('division')) ? $request->input('division') : 0;
            $employee->odo_bonus             = ($request->input('odo_bonus')) ? $request->input('odo_bonus') : 0;
            $employee->wh_bonus              = ($request->input('wh_bonus')) ? $request->input('wh_bonus') : 0;
            $employee->overtime              = $request->input('overtime');
            $employee->voucher               = $request->input('voucher');
            $employee->yearly_bonus          = ($request->input('yb')) ? $request->input('yb') : 0;
            $employee->allowance_office      = ($request->input('pa')) ? $request->input('pa') : 0;
            $employee->dom_meal              = $request->input('dom_meal');
            $employee->dom_spending          = $request->input('dom_spending');
            $employee->dom_overnight         = $request->input('dom_overnight');
            $employee->ovs_meal              = $request->input('ovs_meal');
            $employee->ovs_spending          = $request->input('ovs_spending');
            $employee->ovs_overnight         = $request->input('ovs_overnight');
            $employee->dom_transport_train   = $request->input('dom_transport_train');
            $employee->dom_transport_airport = $request->input('dom_transport_airport');
            $employee->dom_transport_bus     = $request->input('dom_transport_bus');
            $employee->dom_transport_cil     = $request->input('dom_transport_cil');
            $employee->ovs_transport_train   = $request->input('ovs_transport_train');
            $employee->ovs_transport_airport = $request->input('ovs_transport_airport');
            $employee->ovs_transport_bus     = $request->input('ovs_transport_bus');
            $employee->ovs_transport_cil     = $request->input('ovs_transport_cil');

            $employee->cuti_flag             = 0;
            $employee->max_loan              = 0;
            $employee->others                = 0;
            $employee->bank_code             = $request->input('bankCode');
            $employee->bank_acct             = $request->input('account');

            $employee->phone                 = $request->input('phone_1');
            $employee->phone2                = $request->input('phone_2');
            $employee->address               = $request->input('address');
            $employee->email                 = $request->input('email');
            $employee->emp_lahir             = $request->input('date_birth');

            $employee->save();

            $employee_history->emp_id        = $employee->id;
            $employee_history->activity      = "in";
            $employee_history->act_date      = date("Y-m-d");
            $employee_history->act_by        = Auth::user()->username;
            $employee_history->company_id    = \Session::get('company_id');

            $employee_history->save();

            return redirect()->route('employee.index');
        }


    }

    public function nikFunction(Request $request){
        $emp_status = $request->emp_status;
        switch($emp_status) {
            case "tetap": $type = ""; break;
            case "kontrak": $type = "K"; break;
            case "konsultan": $type = "C"; break;
        }
        $date = explode("-",date("Y-m-d"));
        $nik_exist = strtoupper(Session::get('company_tag'))."-".$type.$date[2].$date[1].$date[0];
        $r_s1 = Hrd_employee::select('emp_id')
            ->where('emp_id','like','%'.$nik_exist.'%')
            ->whereNull('expel')
            ->orderBy('id','DESC')
            ->get();

//        echo $nik_exist." like this ".$r_s1[0]['emp_id']."<br>";

        $count_emp_id = $r_s1->count();
//        echo $count_emp_id;
        if ($count_emp_id > 0){
            $emp_id =$r_s1[0]['emp_id'];
            $lastdigit = substr($emp_id, -2);
            $nextdigit = intval($lastdigit)+1;
//            echo $nextdigit;
            if($nextdigit < 10)
            {
                $nextdigit = "0".$nextdigit;
            }
            $NIK = strtoupper(Session::get('company_tag'))."-".$type.$date[2].$date[1].$date[0].$nextdigit;

        } else {
            $NIK = strtoupper(Session::get('company_tag'))."-".$type.$date[2].$date[1].$date[0]."01";
        }
        $data = [
            'data' => $NIK,
        ];
        return json_encode($data);
    }

    public function thpBreakdown(Request $request){
        $thp = $request->thp;
        $SAL = (intval($thp*0.4));
        $HEALTH = (intval($thp*0.15));
        $TRANSPORT = (intval($thp*0.15));
        $MEAL = (intval($thp*0.20));
        $HOUSE = (intval($thp*0.10));

        $data = [
//            'sal' => $SAL,
//            'health' => $HEALTH,
//            'transport' => $TRANSPORT,
//            'meal' => $MEAL,
//            'house' => $HOUSE,
            'data' => "<br>
                        <table class='table table-hover' width='20%'>
                            <thead>
                                <tr>
                                    <th class='text-center' colspan='3'><b>Break Down</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class='text-left' width='20px'>Salary</td>
                                    <td class='text-center'>&nbsp;:&nbsp;&nbsp;</td>
                                    <td class='text-right'>".number_format($SAL)."</td>
                                </tr>
                                <tr>
                                    <td class='text-left' width='20px'>Health</td>
                                    <td class='text-center'>&nbsp;:&nbsp;&nbsp;</td>
                                    <td class='text-right'>".number_format($HEALTH)."</td>
                                </tr>
                                <tr>
                                    <td class='text-left' width='20px'>Transport</td>
                                    <td class='text-center'>&nbsp;:&nbsp;&nbsp;</td>
                                    <td class='text-right'>".number_format($TRANSPORT)."</td>
                                </tr>
                                <tr>
                                    <td class='text-left' width='20px'>Meal</td>
                                    <td class='text-center'>&nbsp;:&nbsp;&nbsp;</td>
                                    <td class='text-right'>".number_format($MEAL)."</td>
                                </tr>
                                <tr>
                                    <td class='text-left' width='20px'>House</td>
                                    <td class='text-center'>&nbsp;:&nbsp;&nbsp;</td>
                                    <td class='text-right'>".number_format($HOUSE)."</td>
                                </tr>
                            </tbody>
                        </table>",
        ];

        return json_encode($data);
    }

    public function getDetail($id){
        $id_companies = array();
        $emptypes = Hrd_employee_type::all();

        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $getDetailData = Hrd_employee::where('id', $id)->first();
        if (empty($getDetailData->old_id)){
            $getDetailData_history = Hrd_employee_history::where('emp_id',$id)->first();
        } else {
            $getDetailData_history = Hrd_employee_history::where('emp_id',$getDetailData->old_id)
                ->where('company_id', $getDetailData->company_id)
                ->first();
        }
//        dd($getDetailData);
        $status = substr($getDetailData->emp_id,4,1);
        $divisions = Rms_divisions::whereIn('id_company', $id_companies)
            ->where('name','not like','%admin%')
            ->get();

        return view('employee.detail',[
            'emptypes' => $emptypes,
            'emp_detail' => $getDetailData,
            'emp_detail_history' => $getDetailData_history,
            'status' => $status,
            'divisions' => $divisions
        ]);

    }
    public function delete($id){
        $emp = Hrd_employee::where('id',$id)->first();
        $pict_path = "/hrd/uploads/".$emp->picture;
        $ktp_path = "/hrd/uploads/".$emp->ktp;
        $serti1_path = "/hrd/uploads/".$emp->serti1;
        if (File::exists($pict_path)){
            File::delete($pict_path);
        }
        if (File::exists($ktp_path)){
            File::delete($ktp_path);
        }
        if (File::exists($serti1_path)){
            File::delete($serti1_path);
        }
        Hrd_employee::find($id)->delete();
        return redirect()->route('employee.index');
    }

    public function update(Request $request,$id){
        Hrd_employee::where('id',$id)
            ->update([
                'emp_name' => $request->input('emp_name'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'religion' => $request->input('religion'),
                'emp_lahir' => $request->input('lahir'),
                'phone' => $request->input('phone'),
                'phone2' => $request->input('phone2'),
                'phoneh' => $request->input('phoneh'),
                'bank_code' => $request->input('bankCode'),
                'bank_acct' => $request->input('bank_acct'),
                'emp_id' => $request->input('emp_id'),
                'emp_position' => $request->input('emp_position'),
                'emp_type' => $request->input('emp_type'),
                'division' => $request->input('division'),
            ]);

        return redirect()->route('employee.detail',['id'=>$id]);
    }
    public function updateAttach(Request $request,$id){

        $employee = Hrd_employee::find($id);
        $employee = Hrd_employee::where('id',$id)->first();

        if ($request->hasFile('picture')){
            $file = $request->file('picture');

            $newFile = $employee->emp_id."-picture.".$file->getClientOriginalExtension();
            $hashFile = Hash::make($newFile);
            $hashFile = str_replace("/", "", $hashFile);

            $upload = FileManagement::save_file_management($hashFile, $file, $newFile, "media/employee_attachment");
            if ($upload == 1){
                Hrd_employee::where('id',$id)
                    ->update([
                        'picture' =>$newFile,
                    ]);
            }
        }

        if ($request->hasFile('ktp')){
            $file = $request->file('ktp');

            $newFile = $employee->emp_id."-ktp.".$file->getClientOriginalExtension();
            $hashFile = Hash::make($newFile);
            $hashFile = str_replace("/", "", $hashFile);

            $upload = FileManagement::save_file_management($hashFile, $file, $newFile, "media/employee_attachment");
            if ($upload == 1){
                Hrd_employee::where('id',$id)
                    ->update([
                        'ktp' =>$newFile,
                    ]);
            }
        }

        if ($request->hasFile('serti1')){
            $file = $request->file('serti1');

            $newFile = $employee->emp_id."-serti1.".$file->getClientOriginalExtension();
            $hashFile = Hash::make($newFile);
            $hashFile = str_replace("/", "", $hashFile);

            $upload = FileManagement::save_file_management($hashFile, $file, $newFile, "media/employee_attachment");
            if ($upload == 1){
                Hrd_employee::where('id',$id)
                    ->update([
                        'serti1' =>$newFile,
                    ]);
            }
        }

        return redirect()->route('employee.detail',['id'=>$id]);
    }

    public function updateJoinDate(Request $request, $id){
        Hrd_employee_history::where('emp_id',$id)
            ->update([
                'act_date' => $request['date']
            ]);
        return redirect()->route('employee.detail',['id'=>$id]);
    }
    public function updateFinMan(Request $request){
        $thp       = $request->input('thp');
        $SAL       = intval($thp*0.4);
        $HEALTH    = intval($thp*0.15);
        $TRANSPORT = intval($thp*0.15);
        $MEAL      = intval($thp*0.20);
        $HOUSE     = intval($thp*0.10);

        Hrd_employee::where('id',$request['id'])
            ->update([
                'salary' => base64_encode($SAL),
                'transport' => base64_encode($TRANSPORT),
                'meal' => base64_encode($MEAL),
                'house' => base64_encode($HOUSE),
                'health' =>base64_encode($HEALTH),
                'pension' => ($request->input('pensi')) ? $request->input('pensi') : 0,
                'health_insurance' => ($request->input('hi')) ? $request->input('hi') : 0,
                'jamsostek' => ($request->input('jam')) ? $request->input('jam') : 0,
                'overtime' => $request->input('overtime'),
                'yearly_bonus' => ($request->input('yb')) ? $request->input('yb') : 0,
                'allowance_office' => ($request->input('pa')) ? $request->input('pa') : 0,
            ]);
        return redirect()->route('employee.detail',['id'=>$request['id']]);
    }
}
