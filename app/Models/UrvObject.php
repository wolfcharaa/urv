<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string name
 * @property string description
 * @property string address
 * @property FirebirdController firebird_controller
 */
class UrvObject extends Model
{
    protected $table = 'urv_objects';
    protected $fillable= [
        'name',
        'description',
        'address',
    ];

    public function config(): BelongsTo {
        return $this->belongsTo(Config::class);
    }

    public function events(): HasMany {
        return $this->hasMany(Event::class);
    }

    public function firebird_controller(): BelongsTo
    {
        return $this->belongsTo(FirebirdController::class);
    }
}
