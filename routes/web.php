<?php

use Illuminate\Support\Facades\Route;
use Magarrent\LaravelUrlShortener\Models\UrlShortener;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/{code}', function ($code) {
    
    $shortUrls = UrlShortener::all();
    $url = DB::table("url_shorteners")->where('url_key', $code)->get();

    try {
        
        if(sizeof($url)>0){

            $views = $url[0]->views_count + 1;
            DB::table("url_shorteners")->where('id', $url->id)->update('views_count', $view);
    
            $url[0]->update(['views_count' => $views]);
            Route::redirect($url[0]->url_key, $url[0]->to_url, 301);
    
        }else{
    
            echo "Not found";
        }

    } catch (\Throwable $th) {

        throw $th;
    }

    


});


