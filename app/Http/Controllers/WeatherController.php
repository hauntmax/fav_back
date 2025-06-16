<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherController
{
    const WEATHER_API_KEY = '77097d379d42d020a3091f3c6d509fcf';

    public function get(Request $request)
    {
        $q = $request->get('q') ?? 'Saint%20Petersburg';
        $lang = $request->get('lang') ?? 'ru';
        $tz = $request->get('tz') ?? 'Europe/Moscow';
        $weatherApiKey = self::WEATHER_API_KEY;

        $weatherApiUrl = "https://api.openweathermap.org/data/2.5/weather?q=$q&appid=$weatherApiKey&units=metric&lang=$lang";
        $timeApiUrl = "https://tools.aimylogic.com/api/now?tz=$tz";

        return view('weather.index', compact('weatherApiUrl', 'timeApiUrl'));
    }
}