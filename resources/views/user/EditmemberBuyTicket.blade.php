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
          -moz-box-shadow: none;  box-shadow: none;background-color: #f7f7f7;">
        <div class="card-header" style="background-color: #1f5387;">
             <h3 class="card-title">Register For {{$events['eventName'] }}</h3>
        </div>
            @if(Session::has('success'))
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  {{Session::get('success')}}
                  </div>
              @endif
                <div class="card-body">
                  <form class="form-horizontal" action="{{ url('memberBuyTicketPost') }}" id="regForm" method="POST">
                      {{ csrf_field() }}

                <?php 
                $tickets = count($memberTickets);
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

          <div class="row">
            <div class="col-md-6 form-group">
              <label  for="firstName">First Name:</label>
                <input type="text" class="form-control" id="firstName" placeholder="" name="firstName" value="{{$memberDetails['firstName']}}" required readonly="">
            </div>
            <div class="col-md-6 form-group">
              <label  for="firstName">Last Name:</label>
                <input type="text" class="form-control" id="lastName" placeholder="" name="lastName" value="{{$memberDetails['lastName']}}" required readonly="">
            </div>

            <div class="col-md-6 form-group">
              <label  for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{$memberDetails['Email_Id']}}" required readonly="">
            </div>
             <div class="col-md-6 form-group">
              <label  for="phoneNo">Phone No:</label>
                <input type="text" class="form-control" id="Member_Id" placeholder="" name="phoneNo" value="{{$memberDetails['mobile_number']}}" required readonly="">
            </div>
          </div>
                      @if($Entrytickets>0)

          <div class="card-header" style="border-bottom:none"><center><strong>Entry Ticket</strong></center></div>
          @endif
          <div class="row">
          <input type="hidden" id="entryticketcount" value="{{$Entrytickets}}">
            @if($Entrytickets>0)
           


            <input type="hidden" name="membershipExpiry" id="membershipExpiry" value="{{ $memberDetails['membershipExpiryDate'] }}">
            <input type="hidden" name="todayDate" id="todayDate" value="{{ $todayDate }}">
            
            <input type="hidden" name="memberType" value="member">

            @for($i=0; $i<$Entrytickets; $i++)
            <?php
            $ageGroup="";
            if($memberEventTickets[$i]['max_age']<=9)
            {
              $ageGroup = "Kids";
            }
            else 
            {
              $ageGroup = "Adult";
            }
          ?>
              <div class="col-md-6 form-group">
                
                @if($memberEventTickets[$i]['max_age']<=9)
                <label  for="" style="font-weight:normal">{{ $ageGroup }} ({{"$".$memberEventTickets[$i]['ticketPrice'] }}):</label>

                  <input type="number" class="form-control" id="ticketQty_{{ $i }}" min="1" placeholder="" name="ticketQty[]" price="{{$memberEventTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  >
                  @else
                  <label  for="" style="font-weight:normal">{{ $ageGroup}} ({{"$".$memberEventTickets[$i]['ticketPrice'] }}):</label>

                  <input type="number" class="form-control" id="ticketQty_{{ $i }}" min="1" placeholder="" name="ticketQty[]" price="{{$memberEventTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}" >
                  @endif

                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="EntryTicketId[]" value="{{$memberEventTickets[$i]['id'] }}" indexValue="{{ $i }}" >


                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="ticketType[]" price="{{$memberEventTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  value="{{ $memberEventTickets[$i]['ageGroup'] }}-{{ $memberEventTickets[$i]['foodType'] }}" >


                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="ticketPrice[]" price="{{$memberEventTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  value="{{$memberEventTickets[$i]['ticketPrice'] }}">

              </div>
            @endfor
            @endif
          </div>
           @if($tickets>0)
            <div class="card-header" style="border-bottom:none"><center><strong>Food Ticket</strong></center></div>
            @endif
          <div class="row">
              @if($tickets>0)
            @for($i=0; $i<$tickets; $i++)
            <?php 
            $ageGroup="";
            if($memberTickets[$i]['min_age']>=9 && $memberTickets[$i]['max_age']>=16)
            {
              $ageGroup = "Adult";
            }
            else 
            {
              $ageGroup = "Kids";
            }

          ?>
              <div class="col-md-6 form-group">
                <label  for="" style="font-weight:normal">{{ $ageGroup }}-{{ $memberTickets[$i]['foodType'] }} ({{"$".$memberTickets[$i]['ticketPrice'] }}):</label>

                  <input type="number" class="form-control" id="ticketQty{{ $i }}" min="0" placeholder="" name="FoodticketQty[]" price="{{$memberTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}" >
                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="FoodTicketId[]" value="{{$memberTickets[$i]['id'] }}" indexValue="{{ $i }}">


                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="FoodticketType[]" price="{{$memberTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  value="{{ $memberTickets[$i]['min_age'] }}-{{ $memberTickets[$i]['foodType'] }}">


                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="FoodticketPrice[]" price="{{$memberTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  value="{{$memberTickets[$i]['ticketPrice'] }}">

              </div>
            @endfor
            @endif
          </div>
          @if($competitionCount>0)

            <label>Want to participate in competition</label>

           <div class="form-group">
                <label class="col-md-4">
                  <input type="radio" name="minimal" value="yes" id="competitionYes" checked>&nbsp;&nbsp;Yes
                </label>
                <label class="col-md-4">
                  <input type="radio" name="minimal"  value="no" id="competitionNo">&nbsp;&nbsp;No
                </label>
                
              </div>
               
                @else
                <div class="form-group" style="display:none">
                
                <label class="col-md-4">
                  <input type="radio" name="minimal"  value="no" id="competitionNo"  checked>&nbsp;&nbsp;No
                </label>
                
              </div>
              @endif
                  <div class="form-group" id="submit">        
                    <center>
                      <button type="submit" class="btn btn-primary" name="submit" id="myBtn">Register</button>
                      <a class="btn btn-warning col-md-offset-1" href="{{ url('memberTickets') }}">Cancel</a>
                    </center>

                  </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
  </div>

<script type="text/javascript">
  

    $(document).ready(function(){
        $('input[type="number"]').each(function(){
          if($(this).val() == ""){
            $(this).val(0);
          }
        });  
    });

    function calcTotal(id)
    {
      $('input[type="number"]').each(function(){
        if($(this).val() == ""){
          $(this).val(0);
        }
      });
      
    var value=$('#'+id).val();
      if(value == 0)
      {    
        $('#'+id).val('0');
      }else if(value == ""){
        $('#'+id).val('0');
      }
      else{    
        $('#'+id).val(Math.abs(value));
      }

      var ticketQuantity=$('#'+id).val();
      var ticketPrice=$('#'+id).attr("price");
      var indexValue=$('#'+id).attr("indexValue");
      var concat = "totalPrice" + indexValue;
      var totalPrice = parseInt(ticketQuantity) * parseInt(ticketPrice);

      $("#totalPrice"+indexValue).val(totalPrice);

    
    }

</script>

<script type="text/javascript">
  $(document).ready(function(){
    var expiryDate = $('#membershipExpiry').val();
    var todayDate = $('#todayDate').val();

    if(todayDate > expiryDate){
      $("#submit").hide();
      var errName = $("#Error");
         errName.html("Your membership is expired, If you want to purchase ticket please Renewel   your membership.");
    }else{
      $("#submit").show();
    }

  });
</script>
<script>
  function changevalidation(id)
  {
    const slug = id.split('_').pop();
    var entryticketcount = $('#entryticketcount').val();
    var empty = $('#'+id).val();
     if(empty!="")
     {
       for(i=0;i<entryticketcount;i++)
       {
          document.getElementById("ticketQty_"+i).required = false;
       }
     }
     else
     {
        for(i=0;i<entryticketcount;i++)
       {
          document.getElementById("ticketQty_"+i).required = true;
       }
     }
  }
</script>

@endsection
