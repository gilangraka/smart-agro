<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetCodePassword extends Model
{
    protected $fillable = [
        'email',
        'code',
        'created_at',
    ];

    public $timestamps = false;
}
