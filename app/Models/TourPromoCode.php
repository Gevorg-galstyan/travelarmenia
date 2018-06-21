<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class TourPromoCode extends Model
{
    protected $fillable = [
        'tour_id', 'details',
    ];
}
