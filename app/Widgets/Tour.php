<?php

namespace App\Widgets;

use App\Models\PageSeoImage;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

class Tour extends AbstractWidget
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
        $image = PageSeoImage::where('page_name', 'tour')->first();
        $image = $image->image??'images/widget-backgrounds/03.jpg';
        $count = \App\Models\Tour::count();
        $string = trans_choice('voyager::dimmer.page', $count);
        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-paper-plane',
            'title'  => "{$count} Тора",
            'text'   => 'В базе Данных '. $count .' Тора ',
            'button' => [
                'text' => __('Все туры'),
                'link' => route('voyager.tours.index'),
            ],
            'image' => 'storage/'.$image,
        ]));
    }
}
