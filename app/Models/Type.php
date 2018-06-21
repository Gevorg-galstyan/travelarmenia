<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Type extends Model
{
    use Translatable;

    protected $translatable = ['name'];

    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tour_types', 'type_id', 'tour_id');

    }

}
