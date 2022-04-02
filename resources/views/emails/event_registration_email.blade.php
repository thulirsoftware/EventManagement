
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
                        <br>
                       <h4 style="color: #00BFFF;">Event Ticket Details :</h4>
                       <br>
                       <table class="table table-bordered"   style="border:1px solid lightgrey;">
                          <tr   style="border:1px solid lightgrey;">
                             <td   style="border:1px solid lightgrey;">Transaction Id : </td>
                             <td   style="border:1px solid lightgrey;">{{ $ticketPurchase['paymentId'] }} </td>
                          </tr   style="border:1px solid lightgrey;">
                          <tr   style="border:1px solid lightgrey;">
                             <td   style="border:1px solid lightgrey;"> Your Member Id :</td>
                             <td   style="border:1px solid lightgrey;"> {{Auth::user()->Member_Id}} </td>
                          </tr>
                           <?php
                                $event = \App\Event::where('id',$ticketPurchase['eventId'])->first();
                                $eventTickets = Session::get('entryTickets');
                                $foodTickets = Session::get('foodTickets');
                                $CompetitionStore = Session::get('CompetitionStore');//need to add
                              ?>
                          <tr   style="border:1px solid lightgrey;">
                             <td   style="border:1px solid lightgrey;"> Event Name :</td>
                             <td   style="border:1px solid lightgrey;">{{ $event['eventName'] }}</td>
                          </tr>
                          <tr   style="border:1px solid lightgrey;">
                             <td  style="border:1px solid lightgrey;"> Total Amount :</td>
                             <td  style="border:1px solid lightgrey;">${{ $ticketPurchase['totalAmount'] }}</td>
                          </tr>
                       </table>
                       <br><br>
                       <h4 style="color: #00BFFF;">Entry Ticket Details :</h4>
                       <br>
                        <table class="table table-bordered"   style="border:1px solid lightgrey;">
                            <thead>
                                <tr   style="border:1px solid lightgrey;">
                                    <th  style="border:1px solid lightgrey;">Event Name</th>
                                    <th  style="border:1px solid lightgrey;">Ticket Qty</th>
                                    <th  style="border:1px solid lightgrey;">Ticket Price</th>
                                    
                                </tr>
                            </thead>
                                @if(isset($eventTickets['ticketQty']))
                                
                                    <?php 
                                            $array = array_filter($eventTickets['ticketQty'], function($a) {return $a !==null;});
                                            $EventEntryTickets_count = count($array); ?>
                                @else
                                      <?php $EventEntryTickets_count = 0; ?>
                                @endif
                               
                            @for($i = 0;$i < $EventEntryTickets_count; $i++)
                             <?php
                                $event = \App\Event::where('id',$eventTickets['eventId'])->first();
                              ?>
                              <tr   style="border:1px solid lightgrey;">
                                 <td  style="border:1px solid lightgrey;">{{ $event['eventName'] }}</td>
                                 <td  style="border:1px solid lightgrey;">{{ $eventTickets['ticketQty'][$i] }}</td>
                                 <td  style="border:1px solid lightgrey;">${{ $eventTickets['ticketPrice'][$i] }}</td>
                              </tr>
                          @endfor
                       </table>
                       <br><br>
                       <h4 style="color: #00BFFF;">Food Ticket Details :</h4>
                       <br>
                        <table class="table table-bordered"   style="border:1px solid lightgrey;">
                            <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th >Ticket Qty</th>
                                    <th>Ticket Price</th>
                                    
                                </tr>
                            </thead>
                          
                                 @if(isset($foodTickets['ticketQty']))
                                      <?php  
                                            $array = array_filter($foodTickets['ticketQty'], function($a) {return $a !==null;});
                                            $EventFoodTickets_count = count($array);?>
                                  @else
                                       <?php $EventFoodTickets_count = 0;?>
                                  @endif
                            @for($i = 0;$i < $EventFoodTickets_count; $i++)
                             <?php
                                $event = \App\Event::where('id',$foodTickets['eventId'])->first();
                              ?>
                              <tr>
                                 <td   style="border:1px solid lightgrey;">{{ $event['eventName'] }}</td>
                                 <td  style="border:1px solid lightgrey;">{{ $foodTickets['ticketQty'][$i] }}</td>
                                 <td  style="border:1px solid lightgrey;">${{ $foodTickets['ticketPrice'][$i] }}</td>
                              </tr>
                          @endfor
                       </table>
                       <br><br>
                        <h4 style="color: #00BFFF;">Competition :</h4>
                       <br>
                        <table class="table table-bordered"   style="border:1px solid lightgrey;">
                            <thead>
                                <tr   style="border:1px solid lightgrey;">
                                    <th   style="border:1px solid lightgrey;">Participant Name</th>
                                    <th  style="border:1px solid lightgrey;">Email</th>
                                    <th  style="border:1px solid lightgrey;">Age</th>
                                    <th  style="border:1px solid lightgrey;">Competition Name</th>
                                    <th  style="border:1px solid lightgrey;">Group Name</th>
                                    
                                </tr>
                            </thead>
                          
                                @if(isset($CompetitionStore['competition_id']))
                                      <?php $competition_idCount = count($CompetitionStore['competition_id']);?>
                                @else
                                     <?php  $competition_idCount = 0;?>
                                @endif
                            @for($i = 0;$i < $competition_idCount; $i++)
                             <?php
                                 if(isset($CompetitionStore['group_id']))
                                 {
                                    $group = \App\GroupNames::where('id',$CompetitionStore['group_id'][$i])->first();
                                 }
                                 else
                                 {
                                    $group =null;
                                 }
                                $Competition = \App\Competition::where('id',$CompetitionStore['competition_id'][$i])->first();
                              ?>
                              <tr   style="border:1px solid lightgrey;">
                                   <td>{{ $CompetitionStore['first_name'][$i] }} {{ $CompetitionStore['last_name'][$i] }}</td>
                                    <td>{{ $CompetitionStore['participant_id'][$i] }}</td>
                                    <td>{{ $CompetitionStore['age'][$i] }}</td>
                                    <td>{{ $Competition['name'] }}</td>
                                    @if($group!=null)
                                        <td>{{ $group['name'] }}</td>
                                   @else
                                        <td> - </td>
                                    @endif
                              </tr>
                          @endfor
                       </table>
                       <br><br>
        
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