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
         <form class="form-horizontal" action="{{ route('save.food.ticket') }}" id="regForm" method="POST">
                      {{ csrf_field() }}
            @if(Session::has('success'))
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                  {{Session::get('success')}}
                  </div>
              @endif
              <?php 
                $tickets = count($memberTickets);
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
                   @if($tickets>0)

          <div class="card-header" style="border-bottom:none"><center><strong>Food Ticket</strong></center></div>
          @if(count($Purchasedfoodtickets)>0)
          <table class="table table-bordered table-striped">
                <thead>
                  <th>S.No</th>
                  <th>Age Group</th>
                  <th>Food Type</th>
                  <th>Qty</th>
                  <th>Ticket Amount</th>
                </thead>
                <tbody>
                  <?php $i=1; 

                ?>

                @foreach($Purchasedfoodtickets as $Purchasedfoodticket)
                <?php
                $user =  App\User::where('id',$Purchasedfoodticket->userId)->first();
                $event  = App\Event::where('id',$Purchasedfoodticket->eventId)->first();
                $EventTicket  = App\EventTicket::where('id',$Purchasedfoodticket->ticketId)->first();

                $ageGroup="";
                      if($EventTicket['min_age']<18)
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

                <td>{{ $ageGroup }}</td>
                <td>{{ $EventTicket['foodType'] }}</td>

                <td>{{ $Purchasedfoodticket['ticketQty'] }}</td>
                <?php 
                $totalAmount = $Purchasedfoodticket['ticketQty']*$Purchasedfoodticket['ticketAmount'];
              ?>
                <td>${{ $totalAmount }}</td>
                
                
              </tr>
              @endforeach
                
            </tbody>
          </table><br>
            @endif
          @endif
          <div class="row">
          <input type="hidden" id="entryticketcount" value="{{$tickets}}">
            @if($memberTicketCount>0)
           
                <p><span style="color:red">*</span>&nbsp;Age as of event date</p>

            <input type="hidden" name="membershipExpiry" id="membershipExpiry" value="{{ $memberDetails['membershipExpiryDate'] }}">
            <input type="hidden" name="todayDate" id="todayDate" value="{{ $todayDate }}">
            
            <input type="hidden" name="memberType" value="member">

            @for($i=0; $i<$tickets; $i++)
            <?php
            $ageGroup="";
            if($memberTickets[$i]['min_age']<18)
            {
              $ageGroup = "Kids";
            }
            else 
            {
              $ageGroup = "Adult";
            }
          ?>
              <div class="col-md-6 form-group">
                
               
                  @if(count($Purchasedfoodtickets)<=0)
                    @if($ageGroup=='Adult')
                  <label  for="" style="font-weight:normal">{{ $ageGroup}} ({{$memberTickets[$i]['min_age']}}-{{$memberTickets[$i]['max_age']}}) ({{"$".$memberTickets[$i]['ticketPrice'] }}):&nbsp;<span style="color: red">*</span></label>

                  <input type="text" class="form-control" id="ticketQty_{{ $i }}" maxlength="2" placeholder="" name="ticketQty[]" price="{{$memberTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}" oninput="getValue(this)" required>
                  @else
                    <label  for="" style="font-weight:normal">{{ $ageGroup }} ({{$memberTickets[$i]['min_age']}}-{{$memberTickets[$i]['max_age']}}) ({{"$".$memberTickets[$i]['ticketPrice'] }}):</label>

                  <input type="text" class="form-control" id="ticketQty_{{ $i }}" maxlength="2" placeholder="" name="ticketQty[]" price="{{$memberTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}" oninput="getValue(this)">
                  @endif
                  @else
                    <label  for="" style="font-weight:normal">{{ $ageGroup }} ({{$memberTickets[$i]['min_age']}}-{{$memberTickets[$i]['max_age']}}) ({{"$".$memberTickets[$i]['ticketPrice'] }}):</label>

                  <input type="text" class="form-control" id="ticketQty_{{ $i }}" maxlength="2" placeholder="" name="ticketQty[]" price="{{$memberTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}" oninput="getValue(this)">
                  @endif

                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="FoodTicketId[]" value="{{$memberTickets[$i]['id'] }}" indexValue="{{ $i }}" >


                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="ticketType[]" price="{{$memberTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  value="{{ $memberTickets[$i]['ageGroup'] }}-{{ $memberTickets[$i]['foodType'] }}" >


                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="ticketPrice[]" price="{{$memberTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  value="{{$memberTickets[$i]['ticketPrice'] }}">

              </div>
            @endfor
            @else
            
                            <h4 style="color:red">Food Ticket is not available now</h4>

            @endif
          </div>
           @if($competitionCount>0 && Auth::user()->Member_Id!=null)

            <label>Want to participate in Competition/Non-Competition</label>

           <div class="form-check">
                <label class="col-md-4">
                  <input type="radio"  class="form-check-input" name="minimal" value="yes" id="competitionYes" checked>&nbsp;&nbsp;Yes
                </label>
                <label class="col-md-4">
                  <input type="radio"  class="form-check-input" name="minimal"  value="no" id="competitionNo" >&nbsp;&nbsp;No
                </label>
                
              </div>
               
               @else
                 <h4><span style="color:red">*</span>&nbsp;To enroll for competitions please register for membership</h4>
                <div class="form-check" style="display:none">
                
                <label class="col-md-4">
                  <input type="radio"  class="form-check-input" name="minimal"  value="no" id="competitionNo"  checked>&nbsp;&nbsp;No
                </label>
                
              </div>
              @endif
                  <div class="form-group" id="submit">       
                    <center>
                         @if($competitionCount>0 && Auth::user()->Member_Id!=null)
                      <button type="submit" class="btn btn-success" name="submit" id="myBtn">Next</button>
                      @else
                        <button type="submit" class="btn btn-success" name="submit" id="myBtn">Submit</button>
                      @endif
                      <a class="btn btn-warning col-md-offset-1" href="{{ url('memberTickets') }}">Cancel</a>
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
  <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>

<script type="text/javascript">
  

    $(document).ready(function(){
        $('input[type=text]').keypress(function (e) {

       if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          return false;
      }
       
      
  });
     
    });
    
    function getValue(data)
    {
        console.log(data);
        if(data.value=="0")
        {
            document.getElementById(data.id).value="";
            alert("Enter ticket quantity greater than zero");
        }
    }
    </script>
  @endsection
