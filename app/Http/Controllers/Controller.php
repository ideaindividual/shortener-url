<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use App\Models\Authentication;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    
    public function authorization(Request $request){

        if($request->hasHeader('api_token')) {

            $api_token = $request->header('api_token');
            $api_data = Authentication::where('api_key', $api_token)->first();
            
            return $api_data;
        }

        return false;
    }
}
