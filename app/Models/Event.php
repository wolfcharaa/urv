<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Carbon event_time
 * @property string name
 * @property string screen_url
 * @property string screen_path
 */

class Event extends Model
{
    protected $table = 'events';
    protected $fillable = [
        'event_time',
        'name',
        'screen_url',
        'screen_path',
    ];

}
