<?php

namespace App\Http\Controllers;

use mysql_xdevapi\Exception;
use Redirect;

class WeatherController extends Controller
{
    public function index()
    {
        try {
            $url = "https://api.weather.yandex.ru/v1/informers?";
            $client = new \GuzzleHttp\Client([
                'headers' => [
                    'X-Yandex-API-Key' => env('X_YANDEX_API_KEY'),
                ]
            ]);
            $response = $client->request('GET', $url, [
                'query' => [
                    'lat' => '53.25350803391633',
                    'lon' => '34.36293314573497',
                    'lang' => 'ru_RU',
                ]
            ]);
            $content = $response->getBody();
            $content = json_decode($content, true);
            return view('weather.index', [
                'content' => $content
            ]);
        } catch (\Exception $e) {
            return Redirect::to('/')->with('error','Превышен лимит запросов к API на сегодняшний день. Попробуйте завтра.');
        }
    }
}
