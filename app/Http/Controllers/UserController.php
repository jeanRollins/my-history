<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new UserController instance.
     *
     * @return void
     */
    private $userService ;
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['createGet']]);
        $this->userService = new UserService() ;
    }

    public function createGet( Request $request, Response $response ){

        return $response->json([
                "name" => $request->username
        ]);
    }

    public function getUserApplications() {
        $idUser = (int) request('idUser') ;

        $appsByUserFounded = $this->userService->getUserApplicationsById($idUser);

        return response()->json([
            'message' => 'OK',
            'status' => true ,
            'data' => $appsByUserFounded
        ], 200);

    }

}
