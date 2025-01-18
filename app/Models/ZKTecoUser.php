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
        'userid',
        'name',
        'password',
        'role',
        'cardno',
    ];
}
