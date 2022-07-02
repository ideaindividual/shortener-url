<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'email' => 'master',
            'password' => Hash::make('url_shortener_master')

        ]);

        DB::table('authentication_api')->insert([
            'api_key' => 'C8QZpNfxGumdaILL8VoB7QKCIBSa1hC9do78VlExfWROtk5ovsDJWdwUhuDi',
            'user_id' => 1

        ]);
    }
}
