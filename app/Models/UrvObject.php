<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
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

    public function config(): HasOne {
        return $this->hasOne(Config::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
