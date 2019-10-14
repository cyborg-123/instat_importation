<?php

use Illuminate\Database\Seeder;
use App\Survey;

class SurveysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('surveys')->insert([
        	[
        		'name'=>'EDS'
        	],
        	[
        		'name'=>'EPM'
        	],
        	[
        		'name'=>'MICS'
        	],
        	[
        		'name'=>'RGPH2'
        	],
        	[
        		'name'=>'RGPH3'
        	]

       ]);

    }
}
