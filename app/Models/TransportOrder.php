<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class TransportOrder extends Model
{
    protected $fillable = [
        'transport_id', 'first_name', 'last_name',
        'phone', 'email', 'check_in', 'check_out',
        'attributes', 'note', 'selected_currency',
        'change_total', 'original_total'
    ];
}
