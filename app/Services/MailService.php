<?php

namespace App\Services;

use App\Mail\RecoveyPasswordMail;
use Illuminate\Support\Facades\Mail;

class MailService
{
    private $email ;
    private $slug ;
    private $resource ;

    public function __construct( array $config ) {
        if( count($config) > 0 ){
            $this->email = $config["email"] ;
            $this->slug  = $config["slug"] ;
        }
    }


    private function setResource() : void{
        switch ($this->slug){
            case "recovery_password" :
                $this->resource = new RecoveyPasswordMail() ; break ;
            default : $this->resource = null ;
        }
    }

    public function send():bool{
        $this->setResource();
        if( $this->resource === null ) return false ;

        if( $this->email === null ) return false ;

        Mail::to($this->email)->send($this->resource);

        return true ;
    }

}
