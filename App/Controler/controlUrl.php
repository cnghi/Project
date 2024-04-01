<?php
namespace App\Controler;
class controlUrl{
    public function getUrl($url){
        $arrayUrl=explode('?', $url);
    return $arrayUrl[0];
    }
    public function back($url){
        $arrayUrl=explode('/', $url);
        return $arrayUrl[3];
    }
}