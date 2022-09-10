<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property Carbon event_time
 * @property string name
 * @property string screen_url
 * @property string screen_path
 * @property UrvObject urv_object
 */

class Event extends Model
{
    protected $table = 'events';
    protected $fillable = [
        'event_time',
        'name',
        'screen_url',
        'screen_path',
    ];

    public function status() {
        return $this->hasOne('event_statuses');
    }

    public function urv_object(): BelongsTo {
        return $this->belongsTo(UrvObject::class);
    }


}
