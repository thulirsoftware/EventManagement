<!DOCTYPE html>
<html lang="en">

<body>
	
<p style="text-align:left;font-weight:bold"> Dear Candidate,</p>
<p style="text-align:center">You have completed the basic registration. Please verify your email to fill Personal, Education & Employment details.</p>
<p style="text-align:center">You will be allowed to apply job only after completing your profile. Please click the below button to verify your mail.</p>
 	<div class="button_container" style="text-align:center">
 	 	<a class="view_detail_button" href="{{config('app.url')}}verify/{{$details['email']}}/{{$details['token']}}" target="_blank"
 	  style="text-align: center; padding: 10px 15px; background: #3b5998; border-radius: 10px; margin: 0; color: white;"> Verify Email </a>
     </div><br>
<span>Regards</span><br>
<span>Ongil Jobs Team</span><br>
</body>

</html> 