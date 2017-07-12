<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

use App\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     /**
     * Redirect the user to the google authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from google.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        
        try{ 
            $google = Socialite::driver('google')->stateless()->user(); 
        }catch(Exception $e){ 
            return redirect()->intended('/'); 
        }

        $authUser = User::where('email', $google->getEmail())->first();

        if(!$authUser){ 
            $authUser = User::create([ 
                'name' => $google->getName(), 
                'email' => $google->getEmail(), 
                'password' => bcrypt('123456'), 
            ]);
        }

        //auth()->login($authUser);
        Auth::login($authUser, true);
        return redirect()->intended('/'); 

        /*
            Para o erro de Curl
            If someone is still looking for a solution, there is an easy fix:

            Go to http://curl.haxx.se/ca/cacert.pem and download the pem file and save in your php installation directory ( make sure while saving it retains the extension and not saved as a text file )

            Now, open your php.ini file, scroll to the bottom and add the following line:

            [cURL] 
            curl.cainfo="D:\xampp\php\cacert.pem"

            Replace D:\xampp\php\cacert.pem with the actual path.

            Tutoriais -
            https://github.com/laravel/socialite
            https://laracasts.com/discuss/channels/laravel/how-to-solve-curl-error-60-ssl-certificate-in-laravel-5-while-facebook-authentication
            https://www.youtube.com/watch?v=0y0N75gkLb4 -- Laravel 5.4 | Login with google | Socialite #3 
            https://www.youtube.com/watch?v=OLCL69CEHp0 -- Instalando o Socialite - 004 - Login com Redes Sociais no Laravel
            https://www.youtube.com/watch?v=HJGrDZmTTow -- Laravel5.4 Login With Google using Socialite Package 
            https://www.youtube.com/watch?v=z0K3a3fxoE0 -- Autenticando o Usuário com Github - 005 - Login com Redes Sociais no Laravel 
            https://console.kim.sg/google-oauth-with-socialite-in-laravel-5-3/
            https://scotch.io/tutorials/laravel-social-authentication-with-socialite
        */
    }
}
