<?php

namespace App;


class Test
{
    public function uri($t){
        
        return [
            [
                "uri"=>"1",
                "text"=>$t,
                "class"=>"btn-info"
            ],
            [
                "uri"=>"1",
                "text"=>$t+1,
                "class"=>"btn-success"
            ]
        ];
    }
}