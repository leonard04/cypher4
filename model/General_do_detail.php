<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class General_do_detail extends Model
{
    use SoftDeletes;
    protected $table = 'do_detail';
    protected $dates = ['deleted_at'];
}
