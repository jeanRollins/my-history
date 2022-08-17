<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginService  {

    private $email ;
    private $password ;

    public function __construct( array $user = []) {
        if( count($user) > 0 ){
            $this->email = $user["email"] ;
        }
    }

    public function login(string $email,string $password) : bool {
        $user = [
            "email" => $email,
            "password" => $password
        ];
        return $this->auth($user) ;
    }

    private function auth(array $user) : bool {
        return Auth::attempt($user);
    }

    public function validateEmail( $email ) :bool {
        $usersFounded = User::where('email', $email )->get() ;
        return count( $usersFounded ) > 0 ;
    }

}
