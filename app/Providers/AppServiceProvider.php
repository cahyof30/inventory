<?php

namespace App\Providers;

use App\Livewire\Items\MobileCardList;
use App\Models\Item;
use App\Observers\ItemObserver;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Item::observe(ItemObserver::class);
        Livewire::component('items.mobile-card-list', MobileCardList::class);

    }
}
