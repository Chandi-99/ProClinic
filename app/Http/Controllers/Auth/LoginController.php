<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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

    protected $redirectTo;

    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectTo()
    {
        switch(Auth::user()->usertype){
            case 'admin':
            $this->redirectTo = 'admin';
            return $this->redirectTo;
                break;
            case 'staff':
                    $this->redirectTo = 'staff';
                return $this->redirectTo;
                break;
            case 'patient':
                $this->redirectTo = 'home';
                return $this->redirectTo;
                break;
            case 'doctor':
                $this->redirectTo = 'doctor';
                return $this->redirectTo;
                break;
            default:
                $this->redirectTo = 'login';
                return $this->redirectTo;
        }

         
        // return $next($request);
    } 

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


}
