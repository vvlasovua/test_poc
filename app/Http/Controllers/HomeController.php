<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RakibDevs\Weather\Weather;

class HomeController extends Controller
{
    public function index(){

        $wt = new Weather();
        $info = $wt->getCurrentByCity('Kiev');
        $user = Auth::user()->toArray();

        return response()->json(['user' => $user, 'main' => $info->main]);

        return view('home');
    }
}
