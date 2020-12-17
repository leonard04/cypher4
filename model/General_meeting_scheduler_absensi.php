<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class General_meeting_scheduler_absensi extends Model
{
    use SoftDeletes;
    protected $table = 'rv_absensi';
    protected $dates = ['deleted_at'];
}
