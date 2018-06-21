<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Video extends Model
{
    use Translatable;
    protected $translatable = ['text_1', 'text_2'];
}
