<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Referal;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Http\Controllers\MailController;


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
    protected $redirectTo = '/login';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'ref_by' => ['required', 'string', 'max:60'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'same:password_confirmation']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $generator = 50000;
        $ref_by = $data['ref_by'];
        $ref_code = $data['name'].'-'.random_int(10, $generator);

        //Check if referal code is valid
        $ref_code_exists = User::where('ref_code',$ref_code)->get();

        while(count($ref_code_exists) > 0){
            $generator = $generator+10000;
            $ref_code = $ref_by.random_int(10, $generator);
            $ref_code_exists = User::where('ref_code',$ref_code)->get();
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role'  =>  0,
            'ref_code' => $ref_code,
            'ref_by'   => $data['ref_by'],
            'password' => Hash::make($data['password']),
        ]);
        

        //write a code for send email to a user with activation link
        // $mail = new MailController();
        // $mail->sendEmail($data['name'],$data['email'],$data['password'], $ref_code);

        return $user;

    }
}