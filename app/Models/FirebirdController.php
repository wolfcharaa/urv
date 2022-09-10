<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string mac
 */

class FirebirdController extends Model
{
    protected $table = 'firebird_controller';
    protected $fillable = [
        'mac'
    ];

    public function config(): BelongsTo {
        return $this->belongsTo(Config::class);
    }
}
