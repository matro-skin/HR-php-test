<?php

namespace App\Http\Controllers;

use App\City;
use App\Services\YandexWeather;
use Illuminate\Support\Facades\Cache;

class WeatherController extends Controller
{

	/**
	 * Display the specified resource.
	 *
	 * @param  \Illuminate\Database\Eloquent\Model $city
	 * @return \Illuminate\View\View
	 */
    public function __invoke(City $city)
    {

    	// use cache, we shouldn't touch api every time - it has limits and not free
	    $fact = Cache::remember('api_weather_' . $city->id,300, function () use ($city) {
		    $api = new YandexWeather( $city );
	        return $api->getFact();
	    });

    	return view('pages.weather', compact('city','fact'));

    }

}
