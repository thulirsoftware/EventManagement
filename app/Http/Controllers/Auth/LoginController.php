<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

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
    protected $redirectTo = '/memberTickets';
    

    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'userLogout']]);
    }
    
    public function home()
    {
        return view('auth/login');
    }
    

    public function userLogout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
