<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Translation;
use TCG\Voyager\Traits\Translatable;


class Excursion extends Model
{
    use Translatable;
    protected $translatable = ['title', 'description'];
}
