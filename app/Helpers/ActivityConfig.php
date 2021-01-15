<?php


namespace App\Helpers;


use App\Models\Hrd_point;
use App\Models\Pref_activity_point;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class ActivityConfig
{
    public static function store_point($modul, $action){
        $iModul = DB::table('pref_activity_label')
            ->where('name', $modul)
            ->first();
        $iPoint = Pref_activity_point::where('company_id', Session::get('company_id'))
            ->where('id_modul', $iModul->id)
            ->where('action', $action)
            ->first();

            $tes = null;

        if (!empty($iPoint)){
            // save to point
            $point = new Hrd_point();
            $point->id_p = Auth::id();
            $point->gp = $iPoint->point;
            $point->keterangan = $action." ".$modul;
            $point->status = 2;
            $point->date_of_case = date("Y-m-d");
            $point->bod_approved_by = "system";
            $point->bod_approved_at = date("Y-m-d H:i:s");
            $point->created_by = "system";
            $point->company_id = Session::get('company_id');
            $point->save();
            $tes = $iPoint;
        }

        return $tes;
    }
}
