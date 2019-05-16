@extends('layouts.admin')

@section('content')

<style type="text/css">
    div{
        margin-top:15px;
    }
    .top{
        font-size: 25px;
        font-weight: bold;
        color:brown;
        margin-top: 30px;
        margin-bottom: 20px;
    }
    .top1{
        font-size: 30px;
        font-weight: bold;
        color:grey;
        margin-top: 30px;
    }
    .text{
      font-size: 20px;
        font-weight: bold;
        color:brown;
    }
    .bottom{
        font-size: 20px;
        font-weight: bold;
        color:black;
        margin-bottom: 30px;
    }
</style>
<div class=" col-md-offset-3 col-md-8" style="background-color: #f2edb5;margin-bottom:50px">
  <center><p class="top">Add Tickets</p></center>
  

  <form method="post" action="{{ url('admin/addEventTicket') }}">
        {{ csrf_field() }}

        <input type="hidden" name="eventId" value="{{ $event[0]['id'] }}">

        <div class="col-md-12">
        <div class="col-md-2">
          <span class="text">Event</span>
        </div>
        
        <div class="col-md-5">
          <input type="text" name="eventName" value="{{ $event[0]['eventName'] }}" readonly="">
        </div>
    </div>

    <div class="col-md-12">

        <div class="col-md-2">
          <span class="text">Age Group</span>
        </div>
        
        <div class="col-md-2">
          <select class="form-control" name="ageGroup" id="sel1">
            <option value="">Select</option>
            <option value="kids">Kids</option>
            <option value="juniors">11 to 18</option>
            <option value="adults">19 and Above</option>
          </select>
        </div>

        <div class="col-md-offset-1 col-md-1">
          <span class="text">Member</span>
        </div>

        <div class="col-md-2">
          <select class="form-control" name="memberType" id="sel1" style="margin-left: 20px">
            <option value="">Select</option>
            <option value="member">Member</option>
            <option value="nonmember">Non Member</option>
          </select>
        </div>

        <div class="col-md-offset-1 col-md-1">
          <span class="text">Food</span>
        </div>

        <div class="col-md-2">
          <select class="form-control" name="foodType" id="sel1">
            <option value="">Select</option>
            <option value="veg">Veg</option>
            <option value="nveg">Non-VEg</option>
            <option value="no-food">No Food</option>
          </select>
        </div>

        <div class="col-md-12">
        <div class="col-md-2">
          <span class="text">Date</span>
        </div>

        <div class="col-md-2">
            <input class="form-control" type="date" name="dateRange" id="sel1" style="margin-left: -10px">
        </div>

        <div class="col-md-offset-1 col-md-1">
          <span class="text">Price</span>
        </div>

        <div class="col-md-4">
         <input class="col-md-6" name="ticketPrice" style="margin-left: 15px" type="text" name="price"> 
        </div>

    <div class="col-md-offset-0 col-md-12 bottom" style="margin-top: 40px" >
        <center><Button type="submit" style="background-color: #ff6100;color:black" name="submit">Submit</Button></center>
    </div>  
</div>
</form>


<div class="panel-body">
  <table class="table">
    <thead>
      <tr style="background-color:brown;">
        <th style="text-align:center;color:white;border:1px solid grey">SI.No</th>
        <th style="text-align:center;color:white;border:1px solid grey">Event Id</th>
        <th style="text-align:center;color:white;border:1px solid grey">Event Name</th>
        <th style="text-align:center;color:white;border:1px solid grey">Age Group</th>
        <th style="text-align:center;color:white;border:1px solid grey">Member Type</th>
        <th style="text-align:center;color:white;border:1px solid grey">Food Type</th>
        <th style="text-align:center;color:white;border:1px solid grey">Date Range</th>
        <th style="tAdd Memberext-align:center;color:white;border:1px solid grey">Ticket Price</th>
        <th style="text-align:center;color:white;border:1px solid grey">Actions</th>
      </tr>
    </thead>
    <tbody style="background-color:#FFBD9B">
    <?php $i = 1 ?>  
        @foreach($eventTicket as $ticket)
          <tr>
           
            <td style="text-align:center;color:black;border:1px solid grey;font-weight:bold">{{ $i++ }}</td>
            <td style="text-align:center;color:black;border:1px solid grey;font-weight:bold">{{ $ticket['eventId'] }}</td>
            <td style="text-align:center;color:black;border:1px solid grey;font-weight:bold">{{ $ticket['eventName'] }}</td>
            <td style="text-align:center;color:black;border:1px solid grey;font-weight:bold">{{ $ticket['ageGroup'] }}</td>
            <td style="text-align:center;color:black;border:1px solid grey;font-weight:bold">{{ $ticket['memberType'] }}</td>
            <td style="text-align:center;color:black;border:1px solid grey;font-weight:bold">{{ $ticket['foodType'] }}</td>
            <td style="text-align:center;color:black;border:1px solid grey;font-weight:bold">{{ $ticket['dateRange'] }}</td>
            <td style="text-align:center;color:black;border:1px solid grey;font-weight:bold">{{ $ticket['ticketPrice'] }}</td>
            <td style="text-align:center;color:black;border:1px solid grey;font-weight:bold"><a href="/admin/eventTicketDelete/{{ $ticket['id'] }}" ><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>

          </tr>
        @endforeach
    </tbody>
  </table>
</div>





<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
@endsection