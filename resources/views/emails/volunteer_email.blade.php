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
                            <img src="http://netamilsangam.org/assets/img/nets-logo.png" width='150px'>
                        </td>
                        <td style="background-color:#f2f2f2;padding-top:30px;border:1px solid lightgrey;width:330px">
                             <h5 class="font-weight-bold mb-1">நியூ இங்கிலாந்து தமிழ் சங்கம்</h5>
                             <h5 class="font-weight-bold mb-1">New England Tamil Sangam</h5>
                              <h5 class="font-weight-bold mb-1">Non-profit organization</h5>
                        </td>
                      </tr>

                    </table>

                   
                   <div class="row pb-5 p-5">
                        <div class="col-md-12">
                            <p>You have received a new volunteer signup, please check the details below.</p>
                              <table class="table table-bordered"   style="border:1px solid lightgrey;">
                                  <tr   style="border:1px solid lightgrey;">
                                     <td   style="border:1px solid lightgrey;">Name : </td>
                                     <td   style="border:1px solid lightgrey;">{{ $volunteer['name'] }} </td>
                                     
                                </tr>
                                <tr  style="border:1px solid lightgrey;">
                                    <td   style="border:1px solid lightgrey;">Email : </td>
                                    <td   style="border:1px solid lightgrey;">{{ $volunteer['email'] }} </td>
                                </tr>
                                <tr  style="border:1px solid lightgrey;">
                                     <td   style="border:1px solid lightgrey;">Mobile No : </td>
                                    <td   style="border:1px solid lightgrey;">{{ $volunteer['mobile_number'] }} </td>
                                 </tr>
                                  <tr  style="border:1px solid lightgrey;">
                                     <td   style="border:1px solid lightgrey;">Email Group : </td>
                                    <td   style="border:1px solid lightgrey;">{{ $volunteer['email_group'] }} </td>
                                 </tr>
                                   <tr  style="border:1px solid lightgrey;">
                                     <td   style="border:1px solid lightgrey;">Opportunities : </td>
                                    <td   style="border:1px solid lightgrey;">{{ $volunteer['opportunities'] }} </td>
                                 </tr>
                                   <tr  style="border:1px solid lightgrey;">
                                     <td   style="border:1px solid lightgrey;">Comments : </td>
                                    <td   style="border:1px solid lightgrey;">{{ $volunteer['comments'] }} </td>
                                 </tr>
                                   <tr  style="border:1px solid lightgrey;">
                                     <td   style="border:1px solid lightgrey;">Youth Volunteer : </td>
                                    <td   style="border:1px solid lightgrey;">{{ $volunteer['youth_volunteer'] }} </td>
                                 </tr>
                                  <tr  style="border:1px solid lightgrey;">
                                     <td   style="border:1px solid lightgrey;">Volunteer for : </td>
                                     @if($volunteer['volunteer_for']=="E")
                                    <td   style="border:1px solid lightgrey;">Event </td>
                                    @else
                                     <td   style="border:1px solid lightgrey;">General </td>
                                    @endif
                                 </tr>
                                 
                                </table>
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