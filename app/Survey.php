<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $guarded = [];

    public function indicators()
    {
    	return $this->hasMany('App\Indicator','id_survey');
    }
}
