<?php

namespace App\Services;

use App\City;
use Ixudra\Curl\Facades\Curl;

class YandexWeather {

	const VERSION = 1.0;
	const LOCALE = 'ru_RU';

	public $city;

	protected $response = [];

	public function __construct(City $city)
	{
		$this->city = $city;
	}

	/**
	 * Return "fact" of weather object
	 *
	 * @return object|null
	 */
	public function getFact()
	{
		$this->response = $this->getResponse();
		if( $this->response->isEmpty() ) {
			return null;
		}
		return $this->response['fact'] ?? null;
	}

	/**
	 * Return weather object
	 *
	 * @return \Illuminate\Support\Collection
	 */
	protected function getResponse()
	{

		try {
			$this->response = Curl::to( $this->getUrl() )
			                      ->withHeader( sprintf("X-Yandex-API-Key: %s", env('YANDEX_WEATHER_API' )))
			                      ->asJson()
			                      ->get();
		}
		catch (\Exception $e) {
			report($e);
		}

		return collect( $this->response );

	}

	/**
	 * Return API url
	 *
	 * @return string
	 */
	protected function getUrl()
	{

		return sprintf("https://api.weather.yandex.ru/v%s/forecast?lat=%s&lon=%s&%s",
			self::VERSION,
			$this->city->lat,
			$this->city->long,
			self::LOCALE
		);

	}

}
