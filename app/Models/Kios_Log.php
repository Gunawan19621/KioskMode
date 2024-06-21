<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kios_Log extends Model
{
    use HasFactory;
    protected $table = 'kiosk_log';
    protected $fillable = [
        'user_id',
        'email',
        'login_time',
        'logout_time',
    ];
}
