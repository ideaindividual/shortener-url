<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Magarrent\LaravelUrlShortener\Models\UrlShortener;
use App\Models\UrlData;
use Illuminate\Support\Facades\DB;

class UrlShortenerController extends Controller
{
    
    public function short_url(Request $data) {
      

        if (!$this->authorization($data)) {
            return response()->json("No tienen permisos");
            die;
        }

        $url = $data->all()['url'];

        if(!$url)  return response()->json(["La URL es obligatoria"]);

        try {

            $new_url = UrlShortener::generateShortUrl($url);

            return response()->json("New url => ".$new_url);

        } catch (\Throwable $th) {

            error_log('Error al acorrtar la URL');
            error_log(json_encode($th));

            return response()->json([$th]);

        }

    }

    public function track_urls(){

        $urls = UrlShortener::all();

        foreach($urls as $key => $url){

            $page = file_get_contents($url->to_url);
            $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $page, $match) ? $match[1] : null;

            $url_data = UrlData::where('url_shortened_id', $url->id)->get();

            if(sizeof($url_data)>0) die('Ya existe');

            UrlData::create([

                'url_shortened_id' => $url->id,
                'url_page_title' => $title

            ]);

            return resonse()->json($title);
        }

    }

    
    public function frequently_visited_url(){

        $urls = DB::table('url_shorteners')
                          ->join('url_data', 'url_shorteners.id', '=', 'url_data.url_shortened_id')
                          ->orderBy('views_count', 'desc')
                          ->limit(100)
                          ->get();

        return response()->json([$urls]);

    }
}
