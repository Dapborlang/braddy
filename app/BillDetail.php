<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    public function Bill()
    {
       return $this->belongsTo('App\Bill');
    }
}
