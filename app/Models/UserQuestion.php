<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserQuestion extends Model
{
    protected $fillable = [
        'name', 'email', 'question',
    ];
}
