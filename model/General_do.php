<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class General_do extends Model
{
    use SoftDeletes;
    protected $table = 'do';
    protected $dates = ['deleted_at'];
}
