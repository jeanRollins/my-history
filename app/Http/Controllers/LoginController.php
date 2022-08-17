<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use App\Services\MailService;
use http\Client\Response;

class LoginController extends Controller
{
    private $loginService ;

    public function __construct(){
        $this->loginService = new LoginService();
    }

    public function index( LoginRequest $request ) {
        $email = $request->email ;
        $password = $request->password ;
        $responseAuth = $this->loginService->login($email,$password);

        return response()->json([
            "message" => ($responseAuth) ? "OK" : "Field email or password no valid.",
            "status" => $responseAuth
        ]);
    }


    public function resetPassword( LoginRequest $request ) {
        $email = $request->email ;

        if( !Helper::validateEmail($email) ) {
            return response()->json([
                "message" => "Format email not valid" ,
                "status" => false
            ]);
        }

        $isFounded = $this->loginService->validateEmail($email);

        if( !$isFounded ) {
            return response()->json([
                "message" => "Email is not register" ,
                "status" => false
            ]);
        }

        $mail = new MailService([
            "email" => $email,
            "slug" => "recovery_password"
        ]);

        if( !$mail->send() ){
            return response()->json([
                "message" => "Error to send mail" ,
                "status" => false
            ]);
        }

        return response()->json([
            "message" => "OK" ,
            "status" => true
        ]);
    }

}
