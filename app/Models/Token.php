<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    protected $fillable = [
        'access_token',
        'expires_in',
        'expiry_time',
        'token_type',
        'scope'
    ];
}
