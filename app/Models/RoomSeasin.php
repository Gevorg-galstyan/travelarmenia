<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class RoomSeasin extends Model
{
    public function season(){
        return $this->belongsTo(Season::class,'seasion_id', 'id');
    }


    public function room(){
        return $this->belongsTo(Room::class,'room_id', 'id');
    }
}
