
</html> 

<!DOCTYPE html>

<html>
<head>

<!------ Include the above in your HEAD tag ---------->
<style>
.card {
  border: none;
}
</style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">

                    
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

                    <?php
                        $body = \DB::table('email_cfgs')->where('name','registration')->value('body');
                ?>
                   <div class="row pb-5 p-5">
                        <div class="col-md-12">
                                {!!html_entity_decode($body)!!}
                              <div class="button_container" style="text-align:center">
                              <a href="http://events.netamilsangam.org/verify/{{$details['email']}}/{{$details['token']}}" target="_blank"  style="text-align: center; padding: 10px 15px; background: #3b5998; border-radius: 10px; margin: 0; color: white;">Verify Email</a>
                              </div><br>
                        </div>

                    </div>
                
                 <hr>
                </div>
            </div>
        </div>
    </div>
    
    <div class="text-dark mt-5 mb-5">
      Website: <a href="https://www.netamilsangam.org" class="btn btn-link" target="_blank">www.netamilsangam.org</a><br><br>
      Contact: <a href="mailto:tamil@netamilsangam.org" class="btn btn-link" target="_blank">tamil@netamilsangam.org</a><br><br>
      Social Media: <a href="https://www.facebook.com/NewEnglandTamilSangam/" class="btn btn-link" target="_blank">Facebook</a>, <a href="https://www.youtube.com/channel/UCVlTOoSetVFmsO1UembKkuQ" class="btn btn-link" target="_blank">YouTube</a>, <a href="https://www.instagram.com/netamilsangam/" class="btn btn-link" target="_blank">Instagram</a>, <a href="https://twitter.com/netamilsangam" class="btn btn-link" target="_blank">Twitter</a><br>

</div>


</body>
</html>