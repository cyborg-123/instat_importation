<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    protected $guarded = [];

    public function survey()
    {
    	return $this->belongsTo('App\Survey','id_survey');

    }


     public function resultglobal()
    {
    	return $this->belongsTo('App\ResultGlobal','id_indicator');
    	
    }


    public function resultregion()
    {
    	return $this->belongsTo('App\ResultRegion','id_indicator');
    	
    }
}
