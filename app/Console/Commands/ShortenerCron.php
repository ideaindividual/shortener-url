<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Magarrent\LaravelUrlShortener\Models\UrlShortener;
use App\Models\UrlData;
use Illuminate\Support\Facades\DB;

class ShortenerCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shortener:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        
        \Log::info("Cron is working fine!");

        $urls = UrlShortener::all();

        foreach($urls as $key => $url){

            try {

                $page = file_get_contents($url->to_url);
                $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $page, $match) ? $match[1] : null;

                $url_data = UrlData::where('url_shortened_id', $url->id)->get();
    
                if(!sizeof($url_data)>0){
    
                    UrlData::create([
    
                        'url_shortened_id' => $url->id,
                        'url_page_title' => $title
        
                    ]);
        
                }

            } catch (\Throwable $th) {
                throw $th;
            }
           


        }
    }
}
