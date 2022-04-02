@extends('layouts.user')

@section('content')
<div class="content-wrapper" style="background-color:white">
  <!-- Content Header (Page header) -->
  <div class="content-header">
 <a href="#" class="sidebar-toggle openbtn" data-toggle="push-menu" role="button">&#9776;</a>

</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">   
     <div class="row">
      <div class="col-md-1">
        <a href="javascript:history.back()" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
      </div>
        <div class="col-md-9">
        <div class="card card-info" style="-webkit-box-shadow: none;
          -moz-box-shadow: none;  box-shadow: none;background-color: #fff;border: 1px solid rgba(0,0,0.1,0.1);">
        <div class="card-header"  style="background-color: #f5f5fc;color:black">
             <h3 class="card-title" style="color: black;">Register For {{$events['eventName'] }}</h3>
        </div>
            @if(Session::has('success'))
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                  {{Session::get('success')}}
                  </div>
              @endif
              <form class="form-horizontal" action="{{ route('save.entry.ticket') }}" id="regForm" method="POST">
                      {{ csrf_field() }}
              <?php 
                $Entrytickets = count($memberEventTickets);
                $user = Auth::user()->email;
                $memberDetails = App\Member::where('Email_Id',$user)->first();
                if($memberDetails==null)
                {
                $memberDetails = App\NonMember::where('Email_Id',$user)->first();
                }
                ?>
                   <input type="hidden" name="eventId" value="{{ $id}}">
            <input type="hidden" name="eventName" value="{{ $events['eventName'] }}">
                <div class="card-body">
           @if($Entrytickets>0)

          <div class="card-header" style="border-bottom:none;font-size:20px"><center><strong>Entry Ticket</strong></center></div>
           @if(count($Purchasedentrytickets)>0)
          <table class="table table-bordered table-striped">
                <thead>
                  <th>S.No</th>
                  <th>User Name</th>
                  <th>Age Group</th>
                  <th>Qty</th>
                  <th>Ticket Amount</th>
                </thead>
                <tbody>
          <?php $i=1; 

                ?>

                @foreach($Purchasedentrytickets as $PurchasedEventEntryTickets)
                <?php
                $user =  App\User::where('id',$PurchasedEventEntryTickets->userId)->first();
                $event  = App\Event::where('id',$PurchasedEventEntryTickets->eventId)->first();
                $EventTicket  = App\EventEntryTickets::where('id',$PurchasedEventEntryTickets->ticketId)->first();

                 if($PurchasedEventEntryTickets['min_age']<18)
                      {
                        $ageGroup = "Kids";
                      }
                      else 
                      {
                        $ageGroup = "Adult";
                      }
              ?>
              <tr>
                <td> {{ $i++ }} </td>

                <td>{{ $user['name'] }}</td>
                <td>{{ $ageGroup }}</td>
                <td>{{ $PurchasedEventEntryTickets['ticketQty']}}</td>
                <?php 
                $totalAmount = $PurchasedEventEntryTickets['ticketQty']*$PurchasedEventEntryTickets['ticketAmount'];
              ?>
                <td>${{ $totalAmount }}</td>


              </tr>
              @endforeach
            </tbody>
          </table><br>
          @endif
          @endif
          <div class="row">
          <input type="hidden" id="entryticketcount" value="{{$Entrytickets}}">
            @if($memberEventTicketCount>0)
           
                <p><span style="color:red">*</span>&nbsp;Age as of event date</p>

            <input type="hidden" name="membershipExpiry" id="membershipExpiry" value="{{ $memberDetails['membershipExpiryDate'] }}">
            <input type="hidden" name="todayDate" id="todayDate" value="{{ $todayDate }}">
            
            <input type="hidden" name="memberType" value="member">

            @for($i=0; $i<$Entrytickets; $i++)
            <?php
            $ageGroup="";
            if($memberEventTickets[$i]['min_age']<18)
            {
              $ageGroup = "Kids";
            }
            else 
            {
              $ageGroup = "Adult";
            }
          ?>
              <div class="col-md-6 form-group">
                
                
                     @if(count($Purchasedentrytickets)<=0)
                         @if($ageGroup=='Adult')
                        <label  for="" style="font-weight:normal">{{ $ageGroup}} ({{"$".$memberEventTickets[$i]['ticketPrice'] }}):&nbsp;<span style="color: red">*</span></label>
    
                        <input type="text" class="form-control" id="ticketQty_{{ $i }}" maxlength="2" placeholder="" name="ticketQty[]" price="{{$memberEventTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  required>
                            @else
                          <label  for="" style="font-weight:normal">{{ $ageGroup }} ({{"$".$memberEventTickets[$i]['ticketPrice'] }}):</label>

                            <input type="text" class="form-control" id="ticketQty_{{ $i }}" maxlength="2" placeholder="" name="ticketQty[]" price="{{$memberEventTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  >
                    
                        @endif
                        @else
                          <label  for="" style="font-weight:normal">{{ $ageGroup }} ({{"$".$memberEventTickets[$i]['ticketPrice'] }}):</label>

                            <input type="text" class="form-control" id="ticketQty_{{ $i }}" maxlength="2" placeholder="" name="ticketQty[]" price="{{$memberEventTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  >
                    
                        @endif
                   

                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="EntryTicketId[]" value="{{$memberEventTickets[$i]['id'] }}" indexValue="{{ $i }}" >


                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="ticketType[]" price="{{$memberEventTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  value="{{ $memberEventTickets[$i]['ageGroup'] }}-{{ $memberEventTickets[$i]['foodType'] }}" >


                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="ticketPrice[]" price="{{$memberEventTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  value="{{$memberEventTickets[$i]['ticketPrice'] }}">

              </div>
            @endfor
            @endif
          </div>
          <div class="form-group" id="submit" style="float:right">        
                    <center>
                      <button type="submit"  class="btn btn-success" name="submit" id="Submitbtn">Next</button>
                    </center>

                  </div>
</form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  @endsection
