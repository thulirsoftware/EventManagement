<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class VerifyController extends Controller
{
    public function verify($email,$token)
    {
    	$user = User::where('token', $token)->where('email', $email)->first();
        $user->status ="Active";
        $user->save();
    	return redirect('/login')->withSuccess('Account Verified!');

    }
}
