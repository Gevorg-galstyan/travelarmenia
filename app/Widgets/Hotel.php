<?php

namespace App\Widgets;

use App\Models\PageSeoImage;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

class Hotel extends AbstractWidget
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
        $image = PageSeoImage::where('page_name', 'hotel')->first();
        $image = $image->image??'images/widget-backgrounds/03.jpg';
        $count = \App\Models\Hotel::count();
        $string = trans_choice('voyager::dimmer.page', $count);
        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'fas fa-building',
            'title'  => "{$count} Гостиницы",
            'text'   => 'В базе Данных '. $count .' Гостиницы ',
            'button' => [
                'text' => __('Все гостиницы'),
                'link' => route('voyager.hotels.index'),
            ],
            'image' => asset('storage/' . $image),
        ]));
    }
}
