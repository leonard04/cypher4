<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Asset_sre_detail extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected static $logOnlyDirty = true;

    protected static $logName = 'asset_sre_detail';

    public function getDescriptionForEvent(string $eventName): string {
        return "This model has been $eventName";
    }
    protected $table = 'asset_sre_detail';
    protected $dates = ['deleted_at'];
}
