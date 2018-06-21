<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;


class Transport extends Model
{
    use Translatable, Resizable;
    protected $translatable = ['name', 'description', 'short_description','seo_title','meta_description','meta_keywords'];

    public function model(){
        return $this->belongsTo(TransportModel::class,'car_mark_id', 'id');
    }

    public function type(){
        return $this->belongsTo(TransportType::class,'car_type_id', 'id');
    }

    public function pricing(){
        return $this->hasMany(TransportPricing::class,'transport_id', 'id');
    }
}
