<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class General_meeting_scheduler_book extends Model
{
    use SoftDeletes;
    protected $table = 'rv_book';
    protected $dates = ['deleted_at'];
}
