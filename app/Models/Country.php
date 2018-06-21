<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;


class Country extends Model
{
    use Translatable, Resizable;

    protected $translatable = ['name', 'description'];

    public function cities(){
        return $this->hasMany(City::class,'country_id', 'id');
    }

    public function hotels(){
        return $this->hasMany(Hotel::class,'country_id', 'id');
    }

    public function images(){
        return $this->hasMany(Countryimage::class,'country_id', 'id');
    }


}
