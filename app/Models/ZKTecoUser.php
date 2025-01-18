<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZKTecoUser extends Model
{
    use HasFactory;

    protected $table = 'zkteco_users';

    protected $fillable = [
        'uid',
        'user_id',
        'device_name',
        'real_name',
        'password',
        'role',
        'card_no',
    ];
}
