<?php

namespace App\Widgets;

use App\Models\PageSeoImage;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

class Transport extends AbstractWidget
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
        $image = PageSeoImage::where('page_name', 'transport')->first();
        $image = $image->image??'images/widget-backgrounds/03.jpg';
        $count = \App\Models\Transport::count();
        $string = trans_choice('voyager::dimmer.page', $count);
        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'fas fa-car',
            'title'  => "{$count} Транспорта",
            'text'   => 'В базе Данных '. $count .' Транспорта ',
            'button' => [
                'text' => __('Все Транспорты'),
                'link' => route('voyager.transports.index'),
            ],
            'image' => asset('storage/' . $image),
        ]));
    }
}
