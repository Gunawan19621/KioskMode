<?php

namespace App\Models;

// use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

// class User_Kiosk extends Model
// {
//     // use HasApiTokens, HasFactory;
//     // protected $table = 'user_kiosk';
//     // protected $fillable = [
//     //     'name',
//     //     'email',
//     //     'password',
//     //     'created_at',
//     //     'updated_at'
//     // ];
//     use HasApiTokens, HasFactory, Notifiable;

//     protected $table = 'user_kiosk';

//     protected $fillable = [
//         'name',
//         'email',
//         'password',
//         'created_at',
//         'updated_at'
//     ];

//     protected $hidden = [
//         'password',
//         'remember_token',
//     ];
// }

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User_Kiosk extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'user_kiosk';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
