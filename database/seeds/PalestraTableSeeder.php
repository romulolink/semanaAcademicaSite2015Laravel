<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class PalestraTableSeeder extends Seeder
{
    public function run()
    {
    	factory(App\Palestrantes::class, 5)->create()
    	
    	/*
    	->each(function($u) {
    		
    		
    		$u->palestra()->save(factory(App\Palestras::class)->make());
    
    	
    	} )*/ ;
    	
    	
    	
    }
}
