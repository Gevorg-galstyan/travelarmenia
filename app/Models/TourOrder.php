<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class TourOrder extends Model
{
    protected $fillable = [
        'tour_id', 'first_name', 'last_name', 'email', 'phone', 'abult', 'child', 'child_age', 'promo_code', 'note', 'hotel_name', 'hotel_slug', 'people', 'change_total', 'original_total','selected_currency'
    ];
}
