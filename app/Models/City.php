<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;


class City extends Model
{
    use Translatable, Resizable;

    protected $translatable = ['name', 'description'];

    public function images(){
        return $this->hasMany(Countryimage::class, 'city_id', 'id');
    }
}
