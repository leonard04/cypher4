<?php

namespace App\Http\Controllers;

use App\Models\Marketing_c_prognosis;
use Illuminate\Http\Request;
use App\Models\Marketing_project;
use App\Models\Marketing_clients;
use DB;
use Session;

class MarketingProjectsController extends Controller
{

    function encryptID($id)
    {
        $data   = base64_encode($id);
        $output = urlencode($data);
        return $output;
    }

    function decryptID($id)
    {
        $data   = urldecode($id);
        $output = base64_decode($data);
        return $output;
    }

    public function indexProjects($view=null){
        $id_companies = array();
        if (Session::get('company_child') != null){
            foreach (Session::get('company_child') as $item) {
                $id_companies[] = $item->id;
            }
            array_push($id_companies, Session::get('company_id'));
        } else {
            array_push($id_companies, Session::get('company_id'));
        }
        $arrCurrency = array('IDR' => 'Indonesian Rupiah',
            'USD' => 'American Dollar',
            'SGD' => 'Singapore Dollar',
            'AUD' => 'Australian Dollar',
            'EUR' => 'Euro',
            'GBP' => 'Great Britain Pondsterling',
            'JPY' => 'Japanese Yen',
            'CNY' => 'China Yuan'
        );
        $clients = Marketing_clients::whereIn('company_id', $id_companies)->get();

        if ($view!=null){
            $param = base64_decode($view);
            $projects = Marketing_project::where('view',$param)
                ->whereIn('company_id', $id_companies)
                ->get();
            $projectssales = Marketing_project::where('category','sales')
                ->whereIn('company_id', $id_companies)
                ->where('view',$param)
                ->get();
            $projectscost = Marketing_project::where('category','cost')
                ->whereIn('company_id', $id_companies)
                ->where('view',$param)
                ->get();
        } else{
            $projects = Marketing_project::whereIn('company_id', $id_companies)->get();
            $projectssales = Marketing_project::where('category','sales')
                ->whereIn('company_id', $id_companies)
                ->get();
            $projectscost = Marketing_project::where('category','cost')
                ->whereIn('company_id', $id_companies)
                ->get();
        }
        $cd_max = Marketing_project::max('id');

        $dataPrognosis = Marketing_c_prognosis::whereIn('company_id', $id_companies)->get();
        $prognosis = array();
        foreach ($dataPrognosis as $item){
            $prognosis[$item->id_project] = $item;
        }


        return view('projects.index',[
            'projectsall' => $projects,
            'projectscost' => $projectscost,
            'projectssales' => $projectssales,
            'clients' => $clients,
            'arrCurrency' => $arrCurrency,
            'cd_max' => $cd_max,
            'view' => $view,
            'prognosis' => $prognosis
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'prj_code' => 'required',
            'prj_name' => 'required',
            'prefix' => 'required',
            'category' => 'required',
            'prj_value' => 'required',
            // 'client' => 'required',
            'prj_start' => 'required',
            'prj_end' => 'required',
            'currency' => 'required',
            'address' => 'required',
            'quotation' => 'required',
            'agreement' => 'required',
            'agreement_title' => 'required',
            'transport' => 'required',
            'taxi' => 'required',
            'rent' => 'required',
            'airtax' => 'required',
        ]);
        $projects = new Marketing_project();

        $uploaddir = public_path('marketing\\uploads');

        if ($request->file('wo_attach')){
            $wo_attachInput = $request->file('wo_attach');
            $wo_attach   = $request->input('prj_code')."-wo_attach.".$wo_attachInput->getClientOriginalExtension();
            $wo_attachInput->move($uploaddir,$wo_attach);

            $projects->wo_attach = $wo_attach;
        }

        $projects->prj_code = $request['prj_code'];
        $projects->prj_name = $request['prj_name'];
        $projects->id_client = $request['client'];
        $projects->value = $request['prj_value'];
        $projects->agreement_number = $request['agreement'];
        $projects->agreement_title = $request['agreement_title'];
        $projects->prefix = $request['prefix'];
        $projects->address = $request['address'];
        $projects->currency = $request['currency'];
        $projects->category = $request['category'];
        $projects->transport = $request['transport'];
        $projects->taxi = $request['taxi'];
        $projects->rent = $request['rent'];
        $projects->airtax = $request['airtax'];
        $projects->start_time = $request['prj_start'];
        $projects->end_time = $request['prj_end'];
        $projects->company_id = \Session::get('company_id');
        $projects->save();

        return redirect()->route('marketing.project');

    }

    public function update(Request $request){
        $this->validate($request,[
            'prj_code' => 'required',
            'prj_name' => 'required',
            'prefix' => 'required',
            'category' => 'required',
            'prj_value' => 'required',
            'client' => 'required',
            'prj_start' => 'required',
            'prj_end' => 'required',
            'currency' => 'required',
            'address' => 'required',
            'quotation' => 'required',
            'agreement' => 'required',
            'agreement_title' => 'required',
            'transport' => 'required',
            'taxi' => 'required',
            'rent' => 'required',
            'airtax' => 'required',
        ]);

        $uploaddir = public_path('marketing\\uploads');

        if ($request->hasFile('wo_attach')) {
            $wo_attachInput = $request->file('wo_attach');
            $wo_attach = $request->input('prj_code') . "-wo_attach." . $wo_attachInput->getClientOriginalExtension();
            $wo_attachInput->move($uploaddir, $wo_attach);
        }

        Marketing_project::where('id',$request['id'])
            ->update([
                'wo_attach' => (isset($wo_attach)) ? $wo_attach:'',
                'prj_code' =>$request['prj_code'],
                'prj_name' => $request['prj_name'],
                'id_client' => $request['client'],
                'value' => $request['prj_value'],
                'agreement_number' => $request['agreement'],
                'agreement_title' => $request['agreement_title'],
                'prefix' => $request['prefix'],
                'address' => $request['address'],
                'currency' => $request['currency'],
                'category' => $request['category'],
                'transport' => $request['transport'],
                'taxi' => $request['taxi'],
                'rent' => $request['rent'],
                'airtax' => $request['airtax'],
                'start_time' => $request['prj_start'],
                'end_time' => $request['prj_end'],
        ]);
        return redirect()->route('marketing.project');
    }

}
