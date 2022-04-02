<!DOCTYPE html>
<html>
   <head>
      <title>NETS Membership Registration</title>
      <!-- Latest compiled and minified CSS -->
     
      <style type="text/css">
         body
         {
         font-weight: bold;
         font-family: 'Mada', sans-serif;
         }
         .table-bordered > tbody > tr > th,.table-bordered > thead > tr > td, .table-bordered > tbody > tr > td {
         border: 1px solid #000;
         font-size: 16px;
         }
         .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td
         {
         padding-left: 12px;
         }
      </style>
   </head>
   <body>
      <section id="success" style="background-color: #fff;">
         <div class="container" >
            <div class="col-md-12">
                <table  class="center" align="center" >
                      <tr>
                         <td  style="border:1px solid lightgrey;">
                            <img src="http://staging.netamilsangam.org/assets/img/nets-logo.png" width='150px'>
                        </td>
                        <td style="background-color:#f2f2f2;padding-top:30px;border:1px solid lightgrey;width:330px">
                             <h5 class="font-weight-bold mb-1">நியூ இங்கிலாந்து தமிழ் சங்கம்</h5>
                             <h5 class="font-weight-bold mb-1">New England Tamil Sangam</h5>
                              <h5 class="font-weight-bold mb-1">Non-profit organization</h5>
                        </td>
                      </tr>

                    </table>
               <div class="col-md-4 col-md-offset-1">
                  <h4 style="color: red;">Hello {{Auth::user()->name}} ...</h4>
                  <br>
               </div>
            </div>
            
            <div class="col-md-8 col-md-offset-1">
               <br>
               <h4 style="color: #00BFFF;">Membership Details :</h4>
               <br>
               <table class="table table-bordered">
                  <tr>
                     <td>Transaction Id : </td>
                     <td>{{ $payment['Inst_No'] }} </td>
                  </tr>
                  <tr>
                     <td> Your Member Id :</td>
                     <td> {{Auth::user()->Member_Id}} </td>
                  </tr>
                  <tr>
                     <td> Membership Type :</td>
                     <td>{{ $payment['membership_code'] }}</td>
                  </tr>
                  <tr>
                     <td> Membership Amount :</td>
                     <td>${{ $payment['membership_amount'] }}</td>
                  </tr>
                  <?php
                  $member = \App\Member::where('Email_Id',Auth::user()->email)->first();
                  ?>
                  <tr>
                     <td> Your Membership Expiry Date :</td>
                     <td>{{ $member['membershipExpiryDate']}}</td>
                  </tr>
               </table>
               <br><br>
            </div>
             <div class="text-dark mt-5 mb-5">
      Website: <a href="https://www.netamilsangam.org" class="btn btn-link" target="_blank">www.netamilsangam.org</a><br><br>
      Contact: <a href="mailto:tamil@netamilsangam.org" class="btn btn-link" target="_blank">tamil@netamilsangam.org</a><br><br>
      Social Media: <a href="https://www.facebook.com/NewEnglandTamilSangam/" class="btn btn-link" target="_blank">Facebook</a>, <a href="https://www.youtube.com/channel/UCVlTOoSetVFmsO1UembKkuQ" class="btn btn-link" target="_blank">YouTube</a>, <a href="https://www.instagram.com/netamilsangam/" class="btn btn-link" target="_blank">Instagram</a>, <a href="https://twitter.com/netamilsangam" class="btn btn-link" target="_blank">Twitter</a><br>

</div>
         </div>
         </div>
      </section>
   </body>
</html>