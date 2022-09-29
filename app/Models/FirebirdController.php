<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/** Модель данных в таблице firebirdController
 * @property string mac
 * @property string status
 */
class FirebirdController extends Model
{
    protected $table = 'firebird_controllers';
    protected $fillable = [
        'mac',
        'status',
    ];

    /** Связь один к одному с классом Config */
    public function config(): HasOne
    {
        return $this->hasOne(Config::class);
    }

}
