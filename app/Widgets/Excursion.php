<?php

namespace App\Widgets;

use App\Models\PageSeoImage;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

class Excursion extends AbstractWidget
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
        $image = PageSeoImage::where('page_name', 'excursions')->first();
        $image = $image->image??'images/widget-backgrounds/03.jpg';
        $count = \App\Models\Excursion::count();
        $string = trans_choice('voyager::dimmer.page', $count);
        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'fas fa-ship',
            'title'  => "{$count} Экскурсии",
            'text'   => 'В базе Данных '. $count .' Экскурсии ',
            'button' => [
                'text' => __('Все Экскурсии'),
                'link' => route('voyager.excursions.index'),
            ],
            'image' => asset('storage/' . $image),
        ]));
    }
}
