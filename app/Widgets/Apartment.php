<?php

namespace App\Widgets;

use App\Models\PageSeoImage;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

class Apartment extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $image = PageSeoImage::where('page_name', 'apartment')->first();
        $image = $image->image??'images/widget-backgrounds/03.jpg';
        $count = \App\Models\Apaerment::count();
        $string = trans_choice('voyager::dimmer.page', $count);
        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-home',
            'title'  => "{$count} Квартиры",
            'text'   => 'В базе Данных '. $count .' Квартиры ',
            'button' => [
                'text' => __('Все Квартиры'),
                'link' => route('voyager.apaerments.index'),
            ],
            'image' => asset('storage/' . $image),
        ]));
    }
}
