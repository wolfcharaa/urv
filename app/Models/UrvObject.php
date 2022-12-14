<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/** Модель данных в таблице urvObject
 * @property int id
 * @property string name
 * @property string description
 * @property string address
 * @property Config config
 */
class UrvObject extends Model
{
    protected $table = 'urv_objects';
    protected $fillable= [
        'name',
        'description',
        'address',
    ];


    /**
     * Связь один к одному с классом Config
     */
    public function config(): HasOne
    {
        return $this->hasOne(Config::class);
    }

    /**
     * Связь один ко многим с классом Event
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
