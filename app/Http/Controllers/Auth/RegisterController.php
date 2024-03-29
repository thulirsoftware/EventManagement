<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
//use App\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\NonMember;
use App\FamilyMember;

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
    protected $redirectTo = '/home';

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
     * @param  array  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $request)
    {
        return Validator::make($request, [
            'name' => 'required|max:255',
            'phoneNo1' => 'required|max:10|min:10',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $request
     * @return User
     */
    public function create(Request $request)
    {

       $request->validate([
        'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed',
        ]);
       $user = User::whereRaw('id = (select max(`id`) from users)')->get()->toArray();

       if($user){
        $userId=$user[0]['id'];

        $Member_Id='NETS'.sprintf("%07d", ++$userId);
        }else{
            $Member_Id = "NETS0000001";
        }

    $users = User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'user_type' => "user", 
        'password' => bcrypt($request['password']),
        'token' => str_random(25),
    ]);
    $users = User::orderby('id','desc')->first();
    $NonMember = new NonMember();
    $NonMember->firstName = $request['name'];
    $NonMember->lastName =$request['lastName'];
    $NonMember->Email_Id = $request['email'];
    $NonMember->mobile_number =$request['phoneNo1'];
    $NonMember->user_id =$users->id;
    $NonMember->save();
    
   
    
    $details = [
        'email' => $request->email,
        'token' =>  $users->token
    ];
                
    \Mail::to($request->email)->send(new \App\Mail\VerifyMail($details));

    return redirect('/')->withSuccess('Registered Successfully Check Your Email To Verify Account And Also Check in Spam Folder');

}
}
