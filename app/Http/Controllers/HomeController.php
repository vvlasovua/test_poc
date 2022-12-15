<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use RakibDevs\Weather\Weather;
use Illuminate\Support\Facades\Cache;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{
    public function index(){
        $ip = $_SERVER['REMOTE_ADDR'];
        $infoLocation = Location::get($ip);
        $cityName = $infoLocation->countryName ?? 'Kiev' ;
        $key = 'user_' .auth()->user()->id. '_city_' .$cityName;

        $dataWeather = Cache::store('redis')->remember($key, now()->addMinutes(10), function () use ($cityName) {
            $wt = new Weather();
            $info = $wt->getCurrentByCity($cityName);
            return $info->main;
        });

        $user = Auth::user()->toArray();
        return view('home', ['data' => ['user' => $user, 'main' => $dataWeather]]);
    }
}
