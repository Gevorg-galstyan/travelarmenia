<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class HotelOrder extends Model
{
    protected $fillable = [
        'hotel_id', 'first_name', 'last_name', 'email', 'phone', 'check_in', 'check_out', 'room_count', 'abult', 'child', 'child_age', 'note', 'room_id', 'room_name', 'selected_currency', 'change_total', 'original_total'
    ];
}
