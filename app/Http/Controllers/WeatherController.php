<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use YandexWeather;

class WeatherController extends Controller
{
    public function index()
    {
        try {
            return view('weather.index', [
                'content' => YandexWeather::getInformers('53.25350803391633', '34.36293314573497', 'ru_RU')
            ]);
        } catch (\Exception $e) {
            new CustomException('Превышен лимит запросов к API на сегодняшний день. Попробуйте завтра.', 403);
        }
    }
}
