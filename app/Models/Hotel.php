<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Spatial;
use TCG\Voyager\Traits\Translatable;


class Hotel extends Model
{
    use Spatial, Translatable, Resizable;

    protected $spatial = ['coordinates'];
    protected $translatable = ['name', 'description', 'price_description', 'short_description', 'addres'];

    public function rooms(){
        return $this->hasMany(Room::class, 'hotel_id', 'id');
    }

    public function seasons(){
        return $this->hasMany(Season::class, 'hotel_id', 'id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id', 'id');
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id', 'id');
    }

    public function images(){
        return $this->hasMany(Hotelgallery::class,'hotel_id', 'id');
    }
}
