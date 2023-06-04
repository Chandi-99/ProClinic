<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo;

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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration data.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return  Validator::make($data, [
            'fname' => ['required', 'string', 'max:20'],
            'lname' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:50'],
            'dob' => ['required', 'date', 'before:today'],
            'gender' => ['required', 'string', 'max:10'],
            'nic' => ['required', 'string', 'min:10','max:12', 'unique:users'],
            'contact' => ['required', 'max:20', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Contact
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'usertype' => "patient",
            'password' => Hash::make($data['password']),
        ]);

        $user->save();
        $userid = DB::connection()->getPdo()->lastInsertId();
        
        $patient = Patient::create([
            'fname' => $data['fname'],
            'lname'=> $data['lname'],
            'contact'=> $data['contact'],
            'nic'=> $data['nic'],
            'address'=> $data['address'],
            'gender'=> $data['gender'],
            'dob'=> $data['dob'],
            'user_id' => $userid,
        ]);

        $patient->save();
        Session::alert('New Patient Account Created Successfully!.', 'success');
        return $user;

    }
}
