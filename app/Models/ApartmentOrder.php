<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ApartmentOrder extends Model
{
    protected $fillable = [
        'apartment_id', 'first_name', 'last_name', 'email', 'phone', 'check_in', 'check_out', 'note', 'selected_currency', 'original_total', 'change_total'
    ];
}
