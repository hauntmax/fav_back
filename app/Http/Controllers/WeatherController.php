<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class WeatherController
{
    const WEATHER_API_KEY = '77097d379d42d020a3091f3c6d509fcf';

    public function weather(Request $request)
    {
        $q = $request->get('q') ?? 'Saint%20Petersburg';
        $lang = $request->get('lang') ?? 'ru';
        $tz = $request->get('tz') ?? 'Europe/Moscow';
        $format = $request->get('format') ?? 'd-m-Y H:i:s';
        $weatherApiKey = self::WEATHER_API_KEY;

        $weatherApiUrl = "https://api.openweathermap.org/data/2.5/weather?q=$q&appid=$weatherApiKey&units=metric&lang=$lang";
        $timeApiUrl = route('datetime', compact('tz', 'format'));

        return view('weather.index', compact('weatherApiUrl', 'timeApiUrl'));
    }

    public function datetime(Request $request)
    {
        $tz = $request->get('tz') ?? 'Europe/Moscow';
        $format = $request->get('format') ?? 'd-m-Y H:i:s';

        return response()->json([
            'timestamp' => Carbon::now()->timestamp,
            'formatted' => Carbon::now()->tz($tz)->format($format),
        ]);
    }
}