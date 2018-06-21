<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;


class Tour extends Model
{
    use Translatable, Resizable;

    protected $translatable = ['title', 'short_description', 'description', 'price_description', ];

    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function destinations(){
        return $this->hasMany(Destination::class, 'tour_id', 'id');
    }

    public function types(){
        return $this->belongsToMany(Type::class,'tour_types');
    }
    public function pricing(){
        return $this->hasOne(TourPricing::class,'tour_id', 'id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'tour_id', 'id');
    }

    public function expert(){
        return $this->belongsTo(Expert::class, 'expert_id', 'id');
    }
}
