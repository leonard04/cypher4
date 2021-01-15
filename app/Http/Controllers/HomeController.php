<?php

namespace App\Http\Controllers;

use App\Models\Asset_po;
use App\Models\Asset_pre;
use App\Models\Asset_sre;
use App\Models\Asset_wo;
use App\Models\Cuti;
use App\Models\General_meeting_scheduler_book;
use App\Models\General_meeting_scheduler_room;
use App\Models\General_meeting_scheduler_timecheck;
use App\Models\General_meeting_scheduler_topic;
use App\Models\General_travel_order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (get_config() == 0){
            return redirect()->route('install');
        }
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $po = Asset_po::whereNull('approved_time')->get();
        $wo = Asset_wo::whereNull('approved_time')->get();
        $to = General_travel_order::whereNull('paid_time')->get();
        $pe = Asset_pre::whereNotNull('pev_num')
            ->whereNull('pev_approved_at')->get();
        $se = Asset_sre::whereNotNull('se_num')
            ->whereNull('se_approved_at')->get();
        $leave = Cuti::whereNotNull('div_date')
            ->whereNull('hrd_date')->get();
        $data = array(
            "po" => array(
                "label" => "Purchase Order need approval",
                "count" => count($po),
                "route" => "po.index",
                'bg' => "primary"
            ),
            "wo" => array(
                "label" => "Work Order need approval",
                "count" => count($wo),
                "route" => "general.wo",
                'bg' => "warning"
            ),
            "to" => array(
                "label" => "Travel Order need approval",
                "count" => count($to),
                "route" => "to.index",
                'bg' => "success"
            ),
            "pe" => array(
                "label" => "Purchase Evaluation need approval",
                "count" => count($pe),
                "route" => "pe.index",
                'bg' => "info"
            ),
            "se" => array(
                "label" => "Service Evaluation need approval",
                "count" => count($se),
                "route" => "se.index",
                'bg' => "danger"
            ),
            "leave" => array(
                "label" => "Work leaves need approval",
                "count" => count($leave),
                "route" => "leave.index",
                'bg' => "light-dark"
            )
        );

        $meeting = General_meeting_scheduler_book::where('tanggal','<',date('Y-m-d'))->get();
        $topic = General_meeting_scheduler_topic::all();
        $time = General_meeting_scheduler_timecheck::all();
        $room = General_meeting_scheduler_room::all();
        $detail_meeting = array();
        foreach ($room as $value){
            $detail_meeting['room'][$value->id] = $value;
        }
        foreach ($time as $value){
            $detail_meeting['time'][$value->id_book][] = $value;
        }
        foreach ($topic as $value){
            $detail_meeting['topic'][$value->id_book] = $value;
        }

        return view('home', compact('data','meeting', 'detail_meeting'));
    }
}
