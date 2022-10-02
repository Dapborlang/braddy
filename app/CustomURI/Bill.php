<?php

namespace App\CustomURI;
use Rdmarwein\Formbuilder\Http\Controllers\FormId;
use Auth;

class Bill
{
  public function uri($id)
  {
    $ff=new FormId;
    return[
      [
        "uri"=>"formgen/edit/".$ff->getFormId('Bill')->id."/".$id,
        "text"=>"Edit Subject",
        "class"=>"btn-secondary"
      ],
      [
        "uri"=>"formgen/create/".$ff->getFormId('Bill Detail')->id."?master_key=".$id,
        "text"=>"Edit Items",
        "class"=>"btn-info"
      ],
      [
        "uri"=>"print/".$ff->getFormId('Bill Detail')->id."/".$id,
        "text"=>"Print",
        "class"=>"btn-primary"
      ]
    ];
  }
}