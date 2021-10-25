<?php

namespace App\Providers;

use App\View\Components\faq\base;
use App\View\Components\faq\devBase;
use App\View\Components\hotel\checkPoint;
use App\View\Components\hotel\devCheckPoint;
use App\View\Components\hotel\devLists;
use App\View\Components\hotel\lists;
use App\View\Components\review\card;
use App\View\Components\review\card_02;
use App\View\Components\review\devCard;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
        //
    }

    /**
     * Bootstrap any application services.
     * 컴포넌트 등록
     *
     * @return void
     */
    public function boot(): void
    {
        Blade::component(card::class, 'review.card');
        Blade::component(card_02::class, 'review.card-02');
        Blade::component(base::class, 'faq.base');
        Blade::component(lists::class, 'hotel.lists');
        Blade::component(checkPoint::class, 'hotel.check-point');

        /*dev*/
        Blade::component(devCard::class, 'review.dev-card');
        Blade::component(devBase::class, 'faq.dev-base');
        Blade::component(devLists::class, 'hotel.dev-lists');
        Blade::component(devCheckPoint::class, 'hotel.dev-check-point');

    }
}
