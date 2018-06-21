<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ExcursionOrder extends Model
{
    protected $fillable = [
        'excursion__id', 'first_name', 'last_name', 'email', 'phone','abult','child','child_age', 'check_in', 'check_out', 'note', 'selected_currency', 'original_total', 'change_total','price_per_person','original_price_per_person'
    ];
}
