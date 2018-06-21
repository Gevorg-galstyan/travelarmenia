<?php

namespace App\Providers;

use App\Models\Country;
use App\Models\Partner;
use App\Models\SocialLink;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $countries = Country::get();
        $social_links = SocialLink::where('publish', 1)->get();
        $partners = Partner::get();
        View::share(compact('countries','social_links','partners'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        config([
            'laravellocalization.supportedLocales' => [
                'en' => ['name' => 'English', 'script' => 'Latn', 'native' => 'English', 'regional' => 'en_GB', 'flag' => 'USA-flag.ico'],
                'ru' => ['name' => 'Russian', 'script' => 'Cyrl', 'native' => 'Русский', 'regional' => 'ru_RU', 'flag' => 'Russian-flag.ico'],
            ],
            'laravellocalization.hideDefaultLocaleInURL' => true
        ]);
    }
}
