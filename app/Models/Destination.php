<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Destination extends Model
{
    use Translatable;
    protected $translatable = ['title', 'description'];

    public function images(){
        return $this->hasMany(DestinationImage::class, 'destination_id', 'id');
    }

    public function city(){
        return $this->belongsTo(City::class, 'citi_id', 'id');
    }
}
