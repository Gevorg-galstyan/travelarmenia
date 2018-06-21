<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Spatial;
use TCG\Voyager\Traits\Translatable;


class Apaerment extends Model
{
    use Spatial, Translatable, Resizable;
    protected $spatial = ['coordinates'];
    protected $translatable = ['title', 'description', 'short_description', 'address'];

    public function images(){
        return $this->hasMany(ApartmenImage::class, 'apartmen_id', 'id');
    }

    public function rooms(){
        return $this->hasMany(ApartmentRoom::class, 'apartment_id', 'id');
    }
    public function pricing(){
        return $this->hasMany(ApartmentPricing::class, 'apartment_id', 'id');
    }

}
