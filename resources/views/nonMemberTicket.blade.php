@extends('layouts.app')

@section('content')
<style>
.image{
    margin-left: 50px;
    margin-top:30px;
}

.para1{
    margin-top:50px;
    font-size: 25px;
    font-weight: bold;
}

.para2{
    margin-top:10px;
    font-size: 20px;
}
.button{
    padding:10px;
    background-color: #3d5377;
    color:black;
    margin-left:15px;
    border-radius: 10px;
}
.text{
    color:black;
    font-weight: bold;
}
</style>


  <?php 
    $noOfEvents = count($events);
  ?>

  @for($i=0; $i<$noOfEvents; $i++)
      <div class="col-md-offset-2 col-md-10" style="margin-bottom:100px">
      <div class="col-md-6">
      <img src="{{ $baseurl }}/{{ $events[$i]['eventFlyer'] }}" width="50%" height=70%" class="image" alt=""/>
      </div>
      <div class="col-md-6">
            <p class="para1">Event Name : {{ $events[$i]['eventName'] }}</p>
            <p class="para1">Event Description : {{ $events[$i]['eventDescription'] }}</p>
            <p class="para2">Event Date : {{ $events[$i]['eventDate'] }}</p>
            <p class="para2">Event Time : {{ $events[$i]['eventTime'] }}</p>
            <p class="para2">Event Location :{{ $events[$i]['eventLocation'] }}</p>

            <div class="input-group col-md-6" style="margin-top: 30px">
                <a href="/nonMemberBuyTicket/{{ $events[$i]['id'] }}" style="background-color: #ff6100;color:black;padding:15px;text-decoration: none;border-radius: 5px" ><span class="text">Buy Ticket</span></a>

                <a href="{{ $events[$i]['eventLocationLink']}}" target="_blank" class="button" style="background-color: #ff6100;color:black;padding:15px;text-decoration: none;margin-left:30px;border-radius: 5px;" ><span class="text">View Location</span></a>

            </div>
      </div>
      </div><br>
  @endfor

@endsection
