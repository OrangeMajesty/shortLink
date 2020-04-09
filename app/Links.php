<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    protected $fillable = ['short', 'full'];

    public function setShortLink($val)
    {
    	$this->attributes['short'] = $val;
    }
}
