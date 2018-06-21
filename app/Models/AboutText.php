<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class AboutText extends Model
{
    use Translatable;
    protected $translatable = ['title', 'text'];

    public function items(){
        return $this->hasMany(AboutItem::class, 'about_text_id', 'id');
    }
}
