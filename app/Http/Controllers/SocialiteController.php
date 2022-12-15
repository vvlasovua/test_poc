<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    protected $providers = [ "google" ];

    public function loginRegister () {
        return view("login-register");
    }

    public function redirect (Request $request) {

        $provider = $request->provider;

        if (in_array($provider, $this->providers)) {
            return Socialite::driver($provider)->redirect();
        }
        abort(404);
    }

    public function callback (Request $request) {

        $provider = $request->provider;

        if (in_array($provider, $this->providers)) {

            $data = Socialite::driver($request->provider)->user();

            $user = $this->createUser($data, $provider);
            Auth::login($user);

            return redirect()->route('home');
        }
        abort(404);
    }

    protected function createUser($data, $provider)
    {

        $user = User::where('provider_id', '=', $data->id)->first();

        if (!$user) {
            $user = User::create([
                'name'     => $data->name,
                'email'    => $data->email,
                'password' => Hash::make(Str::random(24)),
                'email_verified_at' => Carbon::now()->timestamp,
                'provider' => $provider,
                'provider_id' => $data->id
            ]);
            return $user;
        }

        $user->email_verified_at =  Carbon::now()->timestamp;
        $user->provider =  $provider;
        $user->provider_id =  $data->id;
        $user->save();

        return $user;
    }
}
