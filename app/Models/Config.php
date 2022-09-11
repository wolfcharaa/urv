<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int id
 * @property string server_ip
 * @property int server_port
 * @property string sdk_password
 * @property int rtsp_port
 * @property string cam_guid
 * @property string database_ip
 * @property int firebird_port
 * @property string firebird_login
 * @property string firebird_password
 * @property int screen_delta_second
 * @property int max_events_count
 * @property-read UrvObject urv_object
 * @property FirebirdController firebird_controller
 */
class Config extends Model
{
    protected $table = 'configs';
    protected $fillable = [
        'server_ip',
        'server_port',
        'sdk_password',
        'rtsp_port',
        'cam_guid',
        'database_ip',
        'firebird_port',
        'firebird_login'.
        'firebird_password',
        'screen_delta_second',
        'max_events_count',
    ];

    public function urv_object(): BelongsTo
    {
        return $this->belongsTo(UrvObject::class);
    }

    public function firebird_controller(): BelongsTo
    {
        return $this->belongsTo(FirebirdController::class);
    }
}
