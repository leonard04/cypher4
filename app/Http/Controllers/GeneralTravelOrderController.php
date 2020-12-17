<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\General_travel_order;
use App\Models\Hrd_employee;
use App\Models\Marketing_project;
use DB;
use Session;
use Illuminate\Support\Facades\Auth;

class GeneralTravelOrderController extends Controller
{
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
        $to = DB::table('general_to')
            ->select('general_to.*', 'employee.emp_name as emp_name','prj.prj_name as prj_name')
            ->join('hrd_employee as employee','employee.id','=','general_to.employee_id')
            ->join('marketing_projects as prj', 'prj.id','=','general_to.project')
            ->whereIn('employee.company_id', $id_companies)
            ->whereIn('general_to.company_id',$id_companies)
            ->whereIn('prj.company_id',$id_companies)
            ->whereNull('employee.expel')
            ->whereNull('general_to.deleted_at')
            ->get();
        $emp = Hrd_employee::whereNull('expel')
            ->where('company_id',\Session::get('company_id'))
            ->whereNull('hrd_employee.expel')
            ->get();
        $prj = Marketing_project::where('company_id', \Session::get('company_id'))
            ->get();
        return view('to.index', [
            'emp' => $emp,
            'prj' => $prj,
            'to' => $to,
        ]);
    }

    public function delete($id){
        General_travel_order::where('id',$id)->delete();
        return redirect()->route('to.index');
    }
    public function addFirst(Request $request){
        $emp_detail = Hrd_employee::where('id', $request['emp'])->first();
        $prj_detail = Marketing_project::where('id', $request['project'])->first();

        return view('to.add_detail',[
            'emp' => $emp_detail,
            'prj' => $prj_detail,
            'type' => $request['type_travel'],
        ]);
    }
    public function nextDocNumber($code,$year){
        $cek = General_travel_order::where('doc_num','like','%'.$code.'%')
            ->whereNull('deleted_at')
            ->where('company_id',\Session::get('company_id'))
            ->orderBy('id','DESC')
            ->get();

        if (count($cek) > 0){
            $frNum = $cek[0]->doc_num;
            $str = explode('/', $frNum);
            if (date('y',strtotime($year)) == date('y')){
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
            $no = "001";
        }
        return $no;
    }

    public function store(Request $request){

        $arrRomawi	= array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $to_num = $this->nextDocNumber(strtoupper(\Session::get('company_tag'))."/TO",date('Y-m-d H:i:s'));
        $tag = strtoupper(\Session::get('company_tag'));
        $doc_num = str_pad($to_num, 3, '0', STR_PAD_LEFT) . '/' . $tag . '/TO/' . $arrRomawi[date("n")] . '/' . date("y");

        $to = new General_travel_order();
        $to->employee_id =  $request['emp_id'];
        $to->doc_num = $doc_num;
        $to->doc_date = date('Y-m-d');
        $to->destination = $request['destination'];
        $to->dest_type = $request['destination_type'];
        $to->departure_dt = $request['departs_on'];
        $to->return_dt = $request['returns_on'];
        $to->purpose = $request['purpose'];
        $to->location_rate = $request['working_environment_condition'];
        $to->travel_type = $request['type_travel'];
        $to->type_of_travel = $request['type_of_travel'];
        $to->project = $request['project'];
        $to->sppd_type = $request['sppd_type'];
        $to->location = $request['from_airport'];
        $to->tolocation = $request['to_airport'];
        $to->duration = $request['duration'];
        $to->created_by = Auth::user()->username;
        $to->created_at = date('Y-m-d H:i:s');
        $to->status = 3;
        $to->to_cektransport = $request['to_transport'];
        $to->company_id = \Session::get('company_id');

        if ($request['to_transport'] == "1"){
            $to->to_transport = $request['to_transport_train_val'];
        } elseif ($request['to_transport'] == "2"){
            $to->to_transport = $request['to_transport_air_val'];
        } elseif ($request['to_transport'] == "3"){
            $to->to_transport = $request['to_transport_bus_val'];
        } elseif ($request['to_transport'] == "4"){
            $to->to_transport = $request['to_transport_cil_val'];
        }
        if (isset($request['to_spending'])){
            $to->to_cekspending = 1;
            $to->to_spending = $request['to_spending_val'];
        }

        if (isset($request['to_overnight'])){
            $to->to_cekovernight = 1;
            $to->to_overnight = $request['to_overnight_val'];
        }
        if (isset($request['to_meal'])){
            $to->to_cekmeal = 1;
            $to->to_meal = $request['to_meal_val'];
        }
        if (isset($request['travel_boat'])){
            $to->transport = $request['travel_boat_val'];
        }
        if (isset($request['taxi'])){
            $to->taxi = $request['taxi_val'];
        }
        if (isset($request['rent'])){
            $to->rent = $request['rent_val'];
        }
        if (isset($request['airtax'])){
            $to->airtax = $request['airtax_val'];
        }
        $to->save();

        return redirect()->route('to.index');
    }

    public function edit($id){
        $to_detail = General_travel_order::where('id',$id)->first();
        $prj_detail = Marketing_project::where('id', $to_detail->project)->first();
        $emp_detail = Hrd_employee::where('id',$to_detail->employee_id)->first();

        return view('to.edit_detail',[
            'emp' => $emp_detail,
            'prj' => $prj_detail,
            'to' => $to_detail,
            'type' => $to_detail->type_of_travel
        ]);
    }

    public function update(Request $request){
        General_travel_order::where('id', $request['id_to'])
            ->update([
                'departure_dt' => $request['departs_on'],
                'return_dt' => $request['returns_on'],
                'duration' => $request['duration'],
                'location' => $request['from_airport'],
                'tolocation' => $request['to_airport'],
                'destination' => $request['destination'],
                'dest_type' => $request['destination_type'],
                'travel_type' => $request['type_travel'],
                'location_rate' => $request['working_environment_condition'],
            ]);

        if ($request['to_transport'] == "1"){
            General_travel_order::where('id', $request['id_to'])
                ->update([
                    'to_transport' => $request['to_transport_train_val'],
                ]);
        } elseif ($request['to_transport'] == "2"){
            General_travel_order::where('id', $request['id_to'])
                ->update([
                    'to_transport' => $request['to_transport_air_val'],
                ]);
        } elseif ($request['to_transport'] == "3"){
            General_travel_order::where('id', $request['id_to'])
                ->update([
                    'to_transport' => $request['to_transport_bus_val'],
                ]);
        } elseif ($request['to_transport'] == "4"){
            General_travel_order::where('id', $request['id_to'])
                ->update([
                    'to_transport' => $request['to_transport_cil_val'],
                ]);
        }

        if (isset($request['to_spending'])){
            General_travel_order::where('id', $request['id_to'])
                ->update([
                    'to_cekspending' => 1,
                    'to_spending' => $request['to_spending_val']
                ]);
        } else {
            General_travel_order::where('id', $request['id_to'])
                ->update([
                    'to_cekspending' => 0,
                    'to_spending' => 0
                ]);
        }

        if (isset($request['to_overnight'])){
            General_travel_order::where('id', $request['id_to'])
                ->update([
                    'to_cekovernight' => 1,
                    'to_overnight' => $request['to_overnight_val']
                ]);
        } else {
            General_travel_order::where('id', $request['id_to'])
                ->update([
                    'to_cekovernight' => 0,
                    'to_overnight' => 0
                ]);
        }

        if (isset($request['to_meal'])){
            General_travel_order::where('id', $request['id_to'])
                ->update([
                    'to_cekmeal' => 1,
                    'to_meal' => $request['to_meal_val']
                ]);
        } else {
            General_travel_order::where('id', $request['id_to'])
                ->update([
                    'to_cekmeal' => 0,
                    'to_meal' => 0
                ]);
        }
        if (isset($request['travel_boat'])){
            General_travel_order::where('id', $request['id_to'])
                ->update([
                    'transport' => $request['travel_boat_val']
                ]);
        } else {
            General_travel_order::where('id', $request['id_to'])
                ->update([
                    'transport' => 0
                ]);
        }
        if (isset($request['taxi'])){
            General_travel_order::where('id', $request['id_to'])
                ->update([
                    'taxi' => $request['taxi_val']
                ]);
        } else {
            General_travel_order::where('id', $request['id_to'])
                ->update([
                    'taxi' => 0
                ]);
        }
        if (isset($request['rent'])){
            General_travel_order::where('id', $request['id_to'])
                ->update([
                    'rent' => $request['rent_val']
                ]);
        } else {
            General_travel_order::where('id', $request['id_to'])
                ->update([
                    'rent' => 0
                ]);
        }
        if (isset($request['airtax'])){
            General_travel_order::where('id', $request['id_to'])
                ->update([
                    'airtax' => $request['airtax_val']
                ]);
        } else {
            General_travel_order::where('id', $request['id_to'])
                ->update([
                    'airtax' => 0
                ]);
        }

        return redirect()->route('to.index');
    }

    public function getFTdetail($id){
        $to_detail = General_travel_order::where('id',$id)->first();
        $prj_detail = Marketing_project::where('id', $to_detail->project)->first();
        $emp_detail = Hrd_employee::where('id',$to_detail->employee_id)->first();

        return view('to.ft_detail',[
            'emp' => $emp_detail,
            'prj' => $prj_detail,
            'to' => $to_detail,
        ]);
    }

    public function getTimeSheetAppr($id,$code){
        $to_detail = General_travel_order::where('id',$id)->first();
        $prj_detail = Marketing_project::where('id', $to_detail->project)->first();
        $emp_detail = Hrd_employee::where('id',$to_detail->employee_id)->first();

        return view('to.time_sheet_appr',[
            'emp' => $emp_detail,
            'prj' => $prj_detail,
            'to' => $to_detail,
            'code' => $code,
        ]);
    }
    public function doTSAppr(Request $request){
        General_travel_order::where('id',$request['id_to'])
            ->update([
                'action' => $request['action'],
                'action_by' => Auth::user()->username,
                'action_time' => date('Y-m-d H:i:s'),
                'action_notes' => $request['action_notes'],
                'status' => 0
            ]);

        return redirect()->route('to.index');
    }

    public function doCheckAppr(Request $request){
        $rt_date = strtotime($request['returns']);
        $dp_date = strtotime( $request['departs']);
        $date_diff = $rt_date - $dp_date;
        $duration = round($date_diff / (60 * 60 * 24));

        General_travel_order::where('id',$request['id_to'])
            ->update([
                'departure_dt' => $request['departs'],
                'return_dt' => $request['returns'],
                'status' => 3,
                'admin_time' => date("Y-m-d H:i:s"),
                'admin' => Auth::user()->username,
                'action' => null,
                'action_by' => null,
                'action_time' => null,
                'action_notes' => null,
                'duration' => $duration,
            ]);
        if (isset($request['spending_half'])){
            General_travel_order::where('id',$request['id_to'])
                ->update([
                    'to_cekspending' => '1',
                    'to_spending' => $request['to_spending'],
                ]);
        }
        return redirect()->route('to.index');
    }

    public function doPayAppr(Request $request){
        General_travel_order::where('id',$request['id'])
            ->update([
                'paid_by'=> Auth::user()->username,
                'paid_time' => date("Y-m-d H:i:s"),
                'last_payment' => $request['sum'],
            ]);

        return redirect()->route('to.index');
    }
}
