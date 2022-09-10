<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string mac
 * @property string status
 * @property-read UrvObject urv_object
 *
 */

class FirebirdController extends Model
{
    protected $table = 'firebird_controller';
    protected $fillable = [
        'mac',
        'status',
    ];

    public function urv_object(): HasOne
    {
        return $this->hasOne(UrvObject::class);
    }
}
