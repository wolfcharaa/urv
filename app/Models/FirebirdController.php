<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string mac
 * @property string status
 *
 */

class FirebirdController extends Model
{
    /**
     * Создание модели данных в базе
     */
    protected $table = 'firebird_controllers';
    protected $fillable = [
        'mac',
        'status',
    ];

    public function config(): HasOne
    {
        /** Связь один к одному с классом Config */
        return $this->hasOne(Config::class);
    }

}
