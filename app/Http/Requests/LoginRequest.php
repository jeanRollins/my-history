<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * The URI that users should be redirected to if validation fails.
     *
     * @var string
     */
        //protected $redirect = '/api/fail';
        //protected $redirectRoute = 'fail';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        if( $this->route()->uri === "api/auth/login" ){
            return [
                'email' => 'required|min:5|max:20',
                'password' => 'required|min:2|max:15'
            ];
        }
        elseif("api/reset"){
            return [
                'email' => 'required|min:5|max:60'
            ];
        }
        else {
            return [
                'email' => 'required|min:5|max:20',
                'password' => 'required|min:2|max:15'
            ];
        }
    }
}
