<?php

namespace App\Providers;

use App\Services\YandexWeather;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
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

    	// Collection pagination
	    if ( ! Collection::hasMacro('paginate') ) {
		    Collection::macro('paginate',
			    function ($perPage = 25, $page = null, $options = []) {
				    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
				    return (new LengthAwarePaginator(
					    $this->forPage($page, $perPage), $this->count(), $perPage, $page, $options))
					    ->withPath('');
			    });
	    }

	    \App\Order::observe(\App\Observers\OrderObserver::class );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
	    $this->app->bind(YandexWeather::class);
    }

}
