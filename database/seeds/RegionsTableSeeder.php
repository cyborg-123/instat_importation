<?php

use Illuminate\Database\Seeder;
use App\Region;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->insert([
        	[
        		'name'=>'ANALAMANGA'
        	],
        	[
        		'name'=>'VAKINANKARATRA'
        	],
        	[
        		'name'=>'ITASY'
        	],
        	[
        		'name'=>'BONGOLAVA'
        	],
        	[
        		'name'=>'HAUTE MATSIATRA'
        	],

        	[
        		'name'=>'AMORON\'I MANIA'
        	],
        	[
        		'name'=>'VATOVAVY FITOVINANY'
        	],
        	[
        		'name'=>'IHOROMBE'
        	],
        	[
        		'name'=>'ATSIMO ATSINANANA'
        	],
        	[
        		'name'=>'ATSINANANA'
        	],

            [
        		'name'=>'ANALANJIROFO'
        	],
        	[
        		'name'=>'ALAOTRA MANGORO'
        	],
        	[
        		'name'=>'BOENY'
        	],
        	[
        		'name'=>'SOFIA'
        	],

        	[
        		'name'=>'BETSIBOKA'
        	],
        	[
        		'name'=>'MELAKY'
        	],
        	[
        		'name'=>'ATSIMO ANDREFANA'
        	],

        	[
        		'name'=>'ANDROY'
        	],
        	[
        		'name'=>'ANOSY'
        	],

        	[
        		'name'=>'MENABE'
        	],
        	[
        		'name'=>'DIANA'
        	],
        	[
        		'name'=>'SAVA'
        	]

        ]);
    }
}
