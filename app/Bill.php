<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public function TaxType()
    {
       return $this->belongsTo('App\TaxType','tax_type','code');
    }
}
