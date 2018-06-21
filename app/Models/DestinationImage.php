<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class DestinationImage extends Model
{
    use Translatable;
    protected $translatable = ['image_name'];


    public function destination(){
        return $this->belongsTo(Destination::class, 'destination_id', 'id');
    }
}
