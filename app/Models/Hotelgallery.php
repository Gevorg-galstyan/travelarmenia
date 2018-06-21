<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Hotelgallery extends Model
{
    use Translatable;
    protected $translatable = ['image_name'];
}
