<?php

namespace App\Services;

use App\Models\User;

class UserService
{

    public function __construct() {

    }

    public function getUserApplicationsById(int $idUser) :array {
        $appsByUserFounded = User::select('applications.id', 'applications.name', 'applications.url')
            ->join('application_users', 'application_users.id_user', '=', 'users.id')
            ->join('applications', 'applications.id', '=', 'application_users.id_application')
            ->where('users.id',$idUser )
            ->orderBy('applications.id', 'ASC')->get();

        $keys = [
            "id"   => "id",
            "name" => "name" ,
            "url"  => "url"
        ] ;

        $data = $this->orderByFields( $appsByUserFounded ,$keys);

        return $data ;
    }

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
