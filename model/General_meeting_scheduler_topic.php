<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class General_meeting_scheduler_topic extends Model
{
    use SoftDeletes;
    protected $table = 'rv_topic';
    protected $dates = ['deleted_at'];
}
