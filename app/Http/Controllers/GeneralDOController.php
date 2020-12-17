<?php

namespace App\Http\Controllers;

use App\Models\Asset_item;
use App\Models\Asset_qty_wh;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Asset_wh;
use App\Models\General_do;
use App\Models\General_do_detail;
use Illuminate\Support\Facades\Auth;

class GeneralDOController extends Controller
{
    public function getWarehouse(){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $warehouses = Asset_wh::whereIn('company_id', $id_companies)->get();
//        dd($warehouses);

        $data = [];
        foreach ($warehouses as $value){
            $data[] = array(
                "id" => $value->id,
                "text" => $value->name
            );
        }
        return response()->json($data);

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
        $delOrders = General_do::join('asset_wh AS from','from.id','=','do.from_id')
            ->join('asset_wh AS to','to.id','=','do.to_id')
//            ->join('marketing_projects AS prj','prj.id','=','do.project')
            ->select('from.name AS whFromName','to.name AS whToName','do.*',DB::raw('(SELECT COUNT(do_id) FROM do_detail WHERE do_id = do.id) AS items'))
            ->whereIn('do.company_id',$id_companies)->get();

//        dd($delOrders);
        return view('do.index',[
            'dos' => $delOrders,
        ]);

    }

    public function nextDocNumber($code,$year){
        $cek = General_do::where('no_do','like','%'.$code.'%')
            ->where('deliver_date','like','%'.date('y').'-%')
            ->where('company_id', \Session::get('company_id'))
            ->whereNull('deleted_at')
            ->orderBy('id','DESC')
            ->get();

        if (count($cek) > 0){
            $frNum = $cek[0]->no_do;
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
        $do = new General_do();
        $deliver_time = $request['delivery_time'];
        $no_do = $this->nextDocNumber(strtoupper(\Session::get('company_tag')).'/DO',$deliver_time);
        $no_do_id = sprintf('%03d',$no_do).'/'.strtoupper(\Session::get('company_tag')).'/DO/'.$arrRomawi[date("n")].'/'.date("y");
        $do->no_do = $no_do_id;
        $do->company_id = \Session::get('company_id');
        $do->division = $request['division'];
        $do->notes = $request['notes'];
        $do->deliver_by = $request['deliver_by'];
        $do->deliver_date = $request['delivery_time'];
        $do->from_id = $request['from'];
        $do->to_id = $request['to'];
        $do->save();
        $last_id = $do->id;
        foreach ($request->code as $key => $itemCode){
            $do_detail = new General_do_detail();
            $do_detail->do_id = $last_id;
            $do_detail->item_id = $itemCode;
            $do_detail->qty = $request['qty'][$key];
            $do_detail->type = $request['transfer_type'][$key];
            $do_detail->save();
        }

        return redirect()->route('do.index');
    }

    public function deleteDoDetail($id,$do_id,$type=null){
        General_do_detail::where('id', $id)->delete();
        return redirect()->route('do.detail',['id' => $do_id]);
    }

    public function deleteDO($id){
        General_do::where('id', $id)->delete();
        General_do_detail::where('do_id',$id)->delete();
        return redirect()->route('do.index');
    }

    public function getDO($id,$type=null){
        $wh = Asset_wh::all();
        $do = General_do::join('asset_wh AS from','from.id','=','do.from_id')
            ->join('asset_wh AS to','to.id','=','do.to_id')
//            ->join('marketing_projects AS prj','prj.id','=','do.project')
            ->select('from.name AS whFromName','to.name AS whToName','do.*',DB::raw('(SELECT COUNT(do_id) FROM do_detail WHERE do_id = do.id) AS items'))
            ->where('do.id', $id)
            ->first();

        $do_detail = General_do_detail::join('asset_items as items','items.item_code','=','do_detail.item_id')
            ->select('do_detail.*','items.name as itemName','items.uom as itemUom')
            ->where('do_detail.do_id', $id)
            ->get();


//        dd($do_detail);
        return view('do.detail',[
            'do' => $do,
            'do_detail' => $do_detail,
            'type' => $type,
            'wh' => $wh,
        ]);
    }
    public function updateGR(Request $request){
        General_do::where('id', $request['id'])
            ->update([
                'gr_no' => $request['receive_by'],
            ]);
        return redirect()->route('do.index');
    }

    public function getItems($id_wh){
//        dd($id_wh);
        $items = Asset_item::leftJoin('asset_qty_wh as qty_wh','qty_wh.item_id','=','asset_items.id')
            ->where('asset_items.company_id', \Session::get('company_id'))
            ->where('asset_items.item_code','like','%'.$_GET['term'].'%')
            ->orWhere('asset_items.name','like','%'.$_GET['term'].'%')
            ->where('qty_wh.wh_id', $id_wh)
            ->get();
//        dd($items);
        $return_arr =[];
        foreach ($items as $key => $item){
            $row_array['item_category'] = $item->category_id;
            $row_array['item_id'] = $item->id;
            $row_array['item_name'] = $item->name;
            $row_array['item_code'] = $item->item_code;
            $row_array['item_uom'] = trim($item->uom);
            $row_array['item_qoh'] = $item->qty;
            $row_array['item_type'] = $item->type_id;


            $row_array['value'] = $item->item_code." / ".$item->name." (".trim($item->uom).")";

            array_push($return_arr, $row_array);
        }
        echo json_encode($return_arr);
    }

    public function update(Request $request){
        if ($request['type'] == 'appr'){
            $do = General_do::where('id',$request['id_do'])->first();
            $whfrom = $do->from_id;
            $whto = $do->to_id;


            $listItems = General_do_detail::where('do_id', $request['id_do'])->get();
            foreach ($listItems as $key => $value){
                $item = Asset_item::where('item_code', $value->item_id)->first();
                $item_id = $item->id;
                $qtyupdate = $value->qty;
                $qtywhfrom = Asset_qty_wh::where('item_id', $item_id)
                        ->where('wh_id', $whfrom)->first();
                $qtywhto = Asset_qty_wh::where('item_id', $item_id)
                    ->where('wh_id', $whto)->first();

                $newqtywhfrom = intval($qtywhfrom->qty) - intval($qtyupdate);
                $newqtywhto = intval($qtywhto->qty) + intval($qtyupdate);

                Asset_qty_wh::where('item_id', $item_id)
                    ->where('wh_id', $whfrom)
                    ->update([
                        'qty' => $newqtywhfrom
                    ]);

                Asset_qty_wh::where('item_id', $item_id)
                    ->where('wh_id', $whto)
                    ->update([
                        'qty' => $newqtywhto
                    ]);
            }

            General_do::where('id', $request['id_do'])
                ->update([
                    'from_id' => $request['from'],
                    'to_id' => $request['to'],
                    'division' => $request['division'],
                    'deliver_date' => $request['delivery_time'],
                    'notes' => $request['notes'],
                    'approved_by' => Auth::user()->username,
                    'approved_time' => date('Y-m-d'),
                ]);
        } else {
            General_do::where('id', $request['id_do'])
                ->update([
                    'from_id' => $request['from'],
                    'to_id' => $request['to'],
                    'division' => $request['division'],
                    'deliver_date' => $request['delivery_time'],
                    'notes' => $request['notes'],
                ]);
        }

        return redirect()->route('do.index');
    }

    public function delete($id){
        // General_do::where('id',$id)->delete();
        // return redirect()->route('do.index');
    }
}
