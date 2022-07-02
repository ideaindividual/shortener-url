<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Authentication;

class AuthenticationController extends Controller
{
    // Method to store user on db
    public function create_user() {

        User::create([
            'email' => 'master',
            'password' => Hash::make('url_shortener_master')

        ]);
    }

    // Method for user authentication
    public function auth(Request $auth_data) {

        if (isset($auth_data->all()[0])) {
            $data = json_decode($auth_data->all()[0]);
            $user = User::where('email', $data->email)->first();

            if ($user && $user->email == $data->email) {

                if (Hash::check($data->password, $user->password)) {

                    $api_sec = Authentication::where('user_id', $user->id)->first();

                    if (!$api_sec) {

                        $api_sec = Authentication::create([
                            'user_id' => $user->id,
                            'api_key' => Str::random(60),
                        ]);
                    }

                    return response()->json(['token', $api_sec->api_key]);
                } else {

                    error_log("Contraseña incorrecta");
                }
            } else {
                error_log("Usuario no existe");
            }
        } else {
            echo 'No autorizado.';
            error_log('no autorizado para usar la api');
        }
    }
}
