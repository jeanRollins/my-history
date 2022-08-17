<?php

namespace App\Services;

class Services {

    protected function orderByFields( object $data , array $keys) :array {
        $dataOrder = array() ;
        foreach ($data as $key => $value){
            foreach ($keys as $kk => $val){
                $dataOrder[$key][$val] = $value[$kk] ;
            }
        }
        return  $dataOrder ;
    }
}
