<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;


class Room extends Model
{
    use Translatable, Resizable;

    protected $translatable = ['name', 'description'];

    public function hotel(){
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }

    public function seasons(){
        return $this->hasMany(RoomSeasin::class,'room_id','id');
    }
}
