<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class General_meeting_scheduler_timecheck extends Model
{
    use SoftDeletes;
    protected $table = 'rv_time_check';
    protected $dates = ['deleted_at'];
}
