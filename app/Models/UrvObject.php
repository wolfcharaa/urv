<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string name
 * @property string description
 * @property string adress
 */
class UrvObject extends Model
{
    protected $table = 'objects';
    protected $fillable= [
        'name',
        'description',
        'adress',
    ];

    public function config(): BelongsTo {
        return $this->belongsTo(Config::class);
    }
}
