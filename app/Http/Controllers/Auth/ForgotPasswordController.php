<?php

namespace App\Http\Controllers\Auth; 

  

use App\Http\Controllers\Controller;

use Illuminate\Http\Request; 

use DB; 

use Carbon\Carbon; 

use App\User; 

use Mail; 

use Hash;

use Illuminate\Support\Str;

use App\Admin; 

use App\TicketPurchase;

class ForgotPasswordController extends Controller
{
          /**

       * Write code on Method

       *

       * @return response()

       */

      public function showForgetPasswordForm()

      {

         return view('auth.passwords.email');

      }

  

      /**

       * Write code on Method

       *

       * @return response()

       */

      public function submitForgetPasswordForm(Request $request)

      {

          $request->validate([

              'email' => 'required|email|exists:users',

          ]);

  

          $token = Str::random(64);

  

          DB::table('password_resets')->insert([

              'email' => $request->email, 

              'token' => $token, 

              'created_at' => Carbon::now()

            ]);

  
        try{
            Mail::send('emails.forgetPassword', ['token' => $token], function($message) use($request){

              $message->to($request->email);

              $message->subject('Reset Password');

          });
          
          return back()->with('message', 'We have e-mailed your password reset link!');
        }
          catch (Exception $ex) {
    dd($ex->getMessage());
    return "We've got errors!";
     return back()->with('message', 'Email sent unsuccessfull');
}

  


      }

      /**

       * Write code on Method

       *

       * @return response()

       */

      public function showResetPasswordForm($token) { 

         return view('auth.passwords.reset', ['token' => $token]);

      }

  

      /**

       * Write code on Method

       *

       * @return response()

       */

      public function submitResetPasswordForm(Request $request)

      {

          $request->validate([

              'email' => 'required|email|exists:users',

              'password' => 'required|string|min:6|confirmed',

              'password_confirmation' => 'required'

          ]);

  

          $updatePassword = DB::table('password_resets')

                              ->where([

                                'email' => $request->email, 

                                'token' => $request->token

                              ])

                              ->first();

  

          if(!$updatePassword){

              return back()->withInput()->with('error', 'Invalid token!');

          }

  
            
          $user = User::where('email', $request->email)

                      ->update(['password' => Hash::make($request->password)]);

        
            $admin = Admin::where('email', $request->email)->count();
            if($admin>0)
            {
                $admin = Admin::where('email', $request->email)

                      ->update(['password' => Hash::make($request->password)]);
            }
          DB::table('password_resets')->where(['email'=> $request->email])->delete();

  

          return redirect('/login')->with('message', 'Your password has been changed!');

      }
      
      public function email_template()
      {
           $ticketPurchase = TicketPurchase::where('paymentId','PAYID-MI6ZCUQ59D33671D26044844')->first();
        return view('emails.event_registration_email',compact('ticketPurchase'));
      }
}
