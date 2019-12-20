<?php

namespace App\Helpers\Weather;

/**
 * Class Weather
 * @package App\Helpers\Weather
 */
class Yandex {
    const informers = 'https://api.weather.yandex.ru/v1/informers?';

    /**
     * @param $lat
     * @param $lon
     * @param $lang
     * @return mixed|string
     */
    public static function getInformers($lat, $lon, $lang) {
        try {
            $client = new \GuzzleHttp\Client([
                'headers' => ['X-Yandex-API-Key' => env('X_YANDEX_API_KEY')]
            ]);
            $response = $client->request('GET', self::informers, [
                'query' => ['lat' => $lat, 'lon' => $lon, 'lang' => $lang]
            ]);
            $content = json_decode($response->getBody(), true);
            return (isset($content) ? $content : '');
        } catch (\Exception $e) {
            return '';
        }
    }
}