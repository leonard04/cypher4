<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Qhse_mcu_main extends Model
{
    use SoftDeletes;
    protected $table = 'mcu_main';
    protected $dates = ['deleted_at'];

    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected static $logOnlyDirty = true;

    protected static $logName = 'mcu_main';

    public function getDescriptionForEvent(string $eventName): string {
        return "This model has been $eventName";
    }
}
