<?php

namespace App\Http\Controllers;

use App\Models\Finance_coa_history;
use Illuminate\Http\Request;
use App\Models\Finance_coa;
use Session;

class FinanceCOAController extends Controller
{
    public function index(){
        $coa = Finance_coa::whereNull('deleted_at')
            ->orderBy('code','ASC')->get();
        $parent_name = [];
        $id_parent = [];
        $code=[];
        foreach ($coa as $key => $value){
            $parent_name[$value->code] = $value->name;
            $id_parent[$value->code] = $value->parent_id;
            $code[] = $value->code;
        }
//        dd($code);
        return view('coa.index',[
            'coa' => $coa,
            'parents' => $parent_name,
            'id_parents' => $id_parent,
            'code' => $code,
        ]);
    }

    function getCoa(){
        $t = $_GET['term'];
        $val = [];
        $coa = Finance_coa::select('id','code','name')
            ->where('code', 'like', "%".$t."%")
            ->where('status', 1)
            ->orWhere('name', 'like', "%".$t."%")
            ->whereNull('deleted_at')->get();
        foreach ($coa as $value){
            $val[] = "[".$value->code."] ".$value->name;
        }
        return json_encode($val);
    }

    function view($x){
        $coa = Finance_coa::where('code', $x)->first();

        return view('coa.view', [
            'coa' => $coa
        ]);
    }

    function find(Request $request){
//        dd($request);
        $coa = Finance_coa::where('parent_id', $request->code)
            ->where('status', 1)
            ->get();
        $list_coa = [];
        $list_coa[] = $request->code;
        foreach ($coa as $item){
            $list_coa[] = $item->code;
        }
        $coa_his = Finance_coa_history::whereBetween('coa_date', [$request->start, $request->end])
            ->whereIn('no_coa', $list_coa)
            ->whereNotNull('approved_at')
            ->where('company_id', Session::get('company_id'))
            ->get();
        $val = [];
        $data = [];
        foreach ($coa_his as $key => $item){
            $row = [];
            $row[] = $key+1;
            $row[] = $item->coa_date;
            $row[] = $item->description;
            $row[] = number_format($item->credit, 2);
            $row[] = number_format($item->debit, 2);
            $data[] = $row;
        }

        $val['data'] = $data;

        return json_encode($val);
    }

    public function store(Request $request){
        if (isset($request['edit'])){
            Finance_coa::where('id', $request['id'])
                ->update([
                    'code' =>$request['newcode'],
                    'name' =>$request['name'],
                ]);
            if (isset($request['parentcode'])){
                Finance_coa::where('id', $request['id'])
                    ->update([
                        'parent_id' => $request['parentcode'],
                    ]);
            } else {
                Finance_coa::where('id', $request['id'])
                    ->update([
                        'parent_id' =>null,
                    ]);
            }
        } else {
            $coa = new Finance_coa();
            $coa->code = $request['newcode'];
            $coa->name = $request['name'];

            if (isset($request['parentcode'])){
                $coa->parent_id = $request['parentcode'];
            } else {
                $coa->parent_id = null;
            }
            $coa->save();
        }


        return redirect()->route('coa.index');

    }

    public function delete($id){
        Finance_coa::where('id',$id)->delete();
        Finance_coa::where('parent_id',$id)->delete();

        return redirect()->route('coa.index');
    }

    function update(Request $request){
        $coa = Finance_coa::find($request->id);
        if ($request->act == "active"){
            $coa->status = 0;
            $data['status'] = "inactive";
        } else {
            $coa->status = 1;
            $data['status'] = "active";
        }

        if ($coa->save()){
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

}
