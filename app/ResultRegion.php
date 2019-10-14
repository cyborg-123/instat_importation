<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultRegion extends Model
{
    protected $guarded = [];
    
    public function indicator()
    {
    	return $this->belongsTo('App\Indicator','id_indicator');
    }
}
