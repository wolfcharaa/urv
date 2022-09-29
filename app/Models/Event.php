<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Модель данных в таблице events
 * @property string event_time
 * @property string name
 * @property string screen_url
 * @property string screen_path
 * @property int event_status_id
 * @property UrvObject urv_object
 * @property string uid
 */

class Event extends Model
{

    protected $table = 'events';
    protected $fillable =
        [
        'event_time',
        'name',
        'screen_url',
        'screen_path',
        'uid',
        ];

    /**
     * Функция для определение статуса у объёкта
     */
    public function status()
    {
         return $this->hasOne('event_statuses');
    }

    /**
     * Обратная взаимосвязь с UrvObject
     */
    public function urv_object(): BelongsTo
    {
        return $this->belongsTo(UrvObject::class);
    }


}
