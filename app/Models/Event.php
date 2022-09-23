<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property Carbon event_time
 * @property string name
 * @property string screen_url
 * @property string screen_path
 * @property int event_status_id
 * @property UrvObject urv_object
 */

class Event extends Model
{
    /**
     * Создание модели данных в базе
     */
    protected $table = 'events';
    protected $fillable = [
        'event_time',
        'name',
        'screen_url',
        'screen_path',
    ];

    public function status()
    {
        /**
         * Функция для определение статуса у объёкта
         */
        return $this->hasOne('event_statuses');
    }

    public function urv_object(): BelongsTo
    {
        /**
         * Обратная взаимосвязь с UrvObject
         */
        return $this->belongsTo(UrvObject::class);
    }


}
