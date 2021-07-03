@extends('layouts.user')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">

</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">   
   <div class="col-12">

      <div class="row mb-2">
        <div class="col-sm-2">
          <a href="javascript:history.back()" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        <div class="col-md-3">
        </div>
         <div class="col-md-3">
        </div>
        <div class="col-md-3">
        </div>
        
        
      </div>
    </div>
     <div class="row">
      <div class="col-md-2">
      </div>
        <div class="col-md-8">
  <div class="card panel-default">
  @if(Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
{{Session::get('success')}}
</div>
@endif
                <div class="card-body">
                  <form class="form-horizontal" action="{{ url('memberBuyTicketPost') }}" method="POST">
                      {{ csrf_field() }}

                <?php 
                $tickets = count($memberTickets);
                $Entrytickets = count($memberEventTickets);
                $user = Auth::user()->email;
                $member = App\Member::where('Email_Id',$user)->get();
                $memberDetails = $member[0];
                ?>

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
          <div class="card-header" style="border-bottom:none"><center><strong>Entry Ticket</strong></center></div>
          <div class="row">
            @if($Entrytickets>0)
           

            <input type="hidden" name="eventId" value="{{ $memberEventTickets[0]['eventId'] }}">

            <input type="hidden" name="eventName" value="{{ $memberEventTickets[0]['eventName'] }}">
            <input type="hidden" name="membershipExpiry" id="membershipExpiry" value="{{ $memberDetails['membershipExpiryDate'] }}">
            <input type="hidden" name="todayDate" id="todayDate" value="{{ $todayDate }}">
            
            <input type="hidden" name="memberType" value="member">
            
            @for($i=0; $i<$Entrytickets; $i++)
              <div class="col-md-6 form-group">
                <label  for="" style="font-weight:normal">{{ $memberEventTickets[$i]['ageGroup'] }} ({{"$".$memberEventTickets[$i]['ticketPrice'] }}):</label>

                  <input type="number" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="ticketQty[]" price="{{$memberEventTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}">
                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="EntryTicketId[]" value="{{$memberEventTickets[$i]['id'] }}" indexValue="{{ $i }}">


                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="ticketType[]" price="{{$memberEventTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  value="{{ $memberEventTickets[$i]['ageGroup'] }}-{{ $memberEventTickets[$i]['foodType'] }}" >


                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="ticketPrice[]" price="{{$memberEventTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  value="{{$memberEventTickets[$i]['ticketPrice'] }}">

              </div>
            @endfor
            @endif
          </div>
            <div class="card-header" style="border-bottom:none"><center><strong>Food Ticket</strong></center></div>
          <div class="row">
              @if($tickets>0)
            @for($i=0; $i<$tickets; $i++)
              <div class="col-md-6 form-group">
                <label  for="" style="font-weight:normal">{{ $memberTickets[$i]['ageGroup'] }}-{{ $memberTickets[$i]['foodType'] }} ({{"$".$memberTickets[$i]['ticketPrice'] }}):</label>

                  <input type="number" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="FoodticketQty[]" price="{{$memberTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}" >
                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="FoodTicketId[]" value="{{$memberTickets[$i]['id'] }}" indexValue="{{ $i }}">


                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="FoodticketType[]" price="{{$memberTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  value="{{ $memberTickets[$i]['ageGroup'] }}-{{ $memberTickets[$i]['foodType'] }}">


                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="FoodticketPrice[]" price="{{$memberTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  value="{{$memberTickets[$i]['ticketPrice'] }}" required>

              </div>
            @endfor
            @endif
          </div>
                  <div class="form-group" id="submit">        
                    <center>
                      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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


@endsection
