<?php

namespace App\Http\Controllers;

use App\Bill;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function print($id,$cid)
    {
        $bill=Bill::findOrFail($cid);
        return view('print.bill', compact('bill'));   
    }
}
