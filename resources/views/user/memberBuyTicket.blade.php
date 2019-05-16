@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
     
        <div class="col-md-8 col-md-offset-3">
          <span id="Error" style="color:red;font-size:20px;"></span><br><br>
            <div class="panel">

              @if(session()->has('Error'))
                  <div class="alert alert-success">
                      {{ session()->get('Error') }}
                  </div>
              @endif
                <div class="panel-heading" style="background-color:brown;color:white;font-size:18px;font-weight:bold">Purchase Ticket </div>

               <div class="panel-body" style="background-color:#f3f4c6">
                  <form class="form-horizontal" action="{{ url('memberBuyTicketPost') }}" method="POST">
                      {{ csrf_field() }}

                <?php 
                $tickets = count($memberTickets);
                $user = Auth::user()->email;
                $member = App\Member::where('primaryEmail',$user)->get();
                $memberDetails = $member[0];
                ?>


            <div class="form-group">
              <label class="control-label col-sm-3 col-md-offset-1" for="firstName">Name:</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="firstName" placeholder="" name="firstName" value="{{$memberDetails['firstName']}}" required readonly="">
                <input type="hidden" class="form-control" id="lastName" placeholder="" name="lastName" value="{{$memberDetails['lastName']}}" required readonly="">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3 col-md-offset-1" for="email">Email:</label>
              <div class="col-sm-5">
                <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{$memberDetails['primaryEmail']}}" required readonly="">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3 col-md-offset-1" for="tagDvId">TagDvId No:</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="tagDvId" placeholder="" name="tagDvId" value="{{$memberDetails['tagDvId']}}" required readonly="">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3 col-md-offset-1" for="phoneNo">Phone No:</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="tagDvId" placeholder="" name="phoneNo" value="{{$memberDetails['phoneNo1']}}" required readonly="">
              </div>
            </div>

            <input type="hidden" name="eventId" value="{{ $memberTickets[0]['eventId'] }}">

            <input type="hidden" name="eventName" value="{{ $memberTickets[0]['eventName'] }}">
            <input type="hidden" name="membershipExpiry" id="membershipExpiry" value="{{ $memberDetails['membershipExpiryDate'] }}">
            <input type="hidden" name="todayDate" id="todayDate" value="{{ $todayDate }}">
            
            <input type="hidden" name="memberType" value="member">

            @for($i=0; $i<$tickets; $i++)
              <div class="form-group">
                <label class="control-label col-sm-3 col-md-offset-1" for="">{{ $memberTickets[$i]['ageGroup'] }}-{{ $memberTickets[$i]['foodType'] }} ({{ "$".$memberTickets[$i]['ticketPrice'] }}):</label>

                <div class="col-sm-5">
                  <input type="number" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="ticketQty[]" price="{{$memberTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  required>
                </div>


                <div class="col-sm-3 col-md-offset-1">
                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="ticketType[]" price="{{$memberTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  value="{{ $memberTickets[$i]['ageGroup'] }}-{{ $memberTickets[$i]['foodType'] }}" required>
                </div>


                <div class="col-sm-3">
                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="ticketPrice[]" price="{{$memberTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  value="{{$memberTickets[$i]['ticketPrice'] }}" required>
                </div>

              </div>
            @endfor

                  <div class="form-group" id="submit">        
                    <div class="col-sm-offset-4 col-sm-4">
                      <button type="submit" class="btn btn-default btn-lg btn-primary" name="submit">Submit</button>
                      <a class="btn btn-default btn-close btn-lg btn-primary col-md-offset-1" href="{{ url('memberTickets') }}">Cancel</a>
                    </div>

                  </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  
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
