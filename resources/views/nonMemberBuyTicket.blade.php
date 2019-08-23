@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            <div class="panel">

              @if(session()->has('Error'))
                  <div class="alert alert-success">
                      {{ session()->get('Error') }}
                  </div>
              @endif

                <div class="panel-heading" style="background-color:brown;color:white;font-size:18px;font-weight:bold">Purchase Ticket</div>

               <div class="panel-body" style="background-color:#f3f4c6">
                  <form class="form-horizontal" action="{{ url('nonMemberBuyTicketPost') }}" method="POST">
                      {{ csrf_field() }}

                <?php

                  $tickets = count($nonMemberTickets);

                ?>


            <div class="form-group" style="padding-top:15px">
              <label class="control-label col-md-3 col-md-offset-2" for="firstName">First Name:</label>
             
              <div class="col-md-5">
                <input type="text" class="form-control" id="firstName" placeholder="" name="firstName" required>
              </div>

            </div>

            <div class="form-group">
              <label class="control-label col-sm-3 col-md-offset-2" for="lastName">Last Name:</label>
             
              <div class="col-sm-5">
                <input type="text" class="form-control" id="lastName" placeholder="" name="lastName" required>
              </div>

            </div>

            <div class="form-group">
              <label class="control-label col-sm-3 col-md-offset-2" for="email">Email:</label>
             
              <div class="col-sm-5">
                <input type="email" class="form-control" id="email" placeholder="" name="email" required>
              </div>

            </div>

            <div class="form-group">
              <label class="control-label col-sm-3 col-md-offset-2" for="phoneNo">Phone No:</label>
             
              <div class="col-sm-5">
                <input type="text" class="form-control" id="phoneNo" placeholder="" maxlength="10" name="phoneNo" required>
              </div>

            </div>


            <div class="form-group" style="display: none">
              <label class="control-label col-sm-3 col-md-offset-2" for="phoneNo">TagDvId No:</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="tagDvId" placeholder="" name="tagDvId" value="NM" required readonly="">
              </div>
            </div>

            <input type="hidden" name="eventId" value="{{ $nonMemberTickets[0]['eventId'] }}">

            <input type="hidden" name="eventName" value="{{ $nonMemberTickets[0]['eventName'] }}">
            
            <input type="hidden" name="memberType" value="nonmember">

            @for($i=0; $i<$tickets; $i++)
              <div class="form-group">
                <label class="control-label col-sm-3 col-md-offset-2" for="">{{ $nonMemberTickets[$i]['ageGroup'] }}-{{ $nonMemberTickets[$i]['foodType'] }} ({{ "$".$nonMemberTickets[$i]['ticketPrice'] }}):</label>

                <div class="col-sm-5">
                  <input type="number" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="ticketQty[]" price="{{$nonMemberTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  required>
                </div>


                <div class="col-sm-3">
                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="ticketType[]" price="{{$nonMemberTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  value="{{ $nonMemberTickets[$i]['ageGroup'] }}-{{ $nonMemberTickets[$i]['foodType'] }}" required>
                </div>


                <div class="col-sm-3">
                  <input type="hidden" class="form-control" id="ticketQty{{ $i }}" placeholder="" name="ticketPrice[]" price="{{$nonMemberTickets[$i]['ticketPrice'] }}" indexValue="{{ $i }}"  value="{{$nonMemberTickets[$i]['ticketPrice'] }}" required>
                </div>

              </div>
            @endfor

                  <div class="form-group">        
                    <div class="col-md-offset-4 col-sm-4">
                      <button type="submit" class="btn btn-lg btn-default btn-primary" name="submit">Submit</button>
                      <a class="btn btn-lg btn-default btn-primary" href="{{ redirect()->getUrlGenerator()->previous() }}">Cancel</a>
                    </div>

                  </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
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
        }else{}
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


@endsection
