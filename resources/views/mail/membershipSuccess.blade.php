<!DOCTYPE html>
<html>
   <head>
      <title>TagDv Registration</title>
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
                     <td>{{ $payment['transactionId'] }} </td>
                  </tr>
                  <tr>
                     <td> Your Member Id :</td>
                     <td> {{Auth::user()->tagDvid}} </td>
                  </tr>
                  <tr>
                     <td> Membership Type :</td>
                     <td>{{ $payment['purpose'] }}</td>
                  </tr>
                  <tr>
                     <td> Membership Amount :</td>
                     <td>${{ $payment['amount'] }}</td>
                  </tr>
                  <tr>
                     <td> Your Membership Expiry Date :</td>
                     <td>{{ $member['membershipExpiryDate']}}</td>
                  </tr>
               </table>
               <br><br>
            </div>
            <div class="col-md-12">
               <p align="left">
                  Regards,<br>
               </p>
              
            </div>
         </div>
         </div>
      </section>
   </body>
</html>