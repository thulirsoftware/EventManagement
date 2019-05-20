@extends('layouts.admin')

@section('content')

<style type="text/css">
    div{
        margin-top:15px;
    }
    .top{
        font-size: 20px;
        font-weight: bold;
        color:brown;
        margin-top: 30px;
        margin-bottom: 20px;
    }
    .top1{
        font-size: 20px;
        font-weight: bold;
        color:grey;
        margin-top: 30px;
    }
    .text{
      font-size: 15px;
        font-weight: bold;
        color:brown;
    }
    .bottom{
        font-size: 15px;
        font-weight: bold;
        color:black;
        margin-bottom: 30px;
    }
</style>
<center><p class="top1">Admin Add Events Screen 2</p></center>
<div class=" col-md-offset-3 col-md-8" style="background-color: #f2edb5;">
  <center><p class="top">Add Tickets</p></center>
  

  <form method="post" action="{{ url('admin/addEventTicket') }}">
        {{ csrf_field() }}

        <input type="hidden" name="eventId" value={{ $eventId['id'] }}>

        <div class="col-md-12">
        <div class="col-md-2">
          <span class="text">Event</span>
        </div>
        
        <div class="col-md-5">
          <input type="text" name="eventName" value={{ $eventId['eventName'] }} readonly="">
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
      <tr>
        <th>SI.No</th>
        <th>Event Id</th>
        <th>Event Name</th>
        <th>Age Group</th>
        <th>Member Type</th>
        <th>Food Type</th>
        <th>Date Range</th>
        <th>Ticket Price</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    <?php $i = 1 ?>  
        @foreach($eventTicket as $ticket)
          <tr>
           
            <td>{{ $i++ }}</td>
            <td>{{ $ticket['eventId'] }}</td>
            <td>{{ $ticket['eventName'] }}</td>
            <td>{{ $ticket['ageGroup'] }}</td>
            <td>{{ $ticket['memberType'] }}</td>
            <td>{{ $ticket['foodType'] }}</td>
            <td>{{ $ticket['dateRange'] }}</td>
            <td>{{ $ticket['ticketPrice'] }}</td>
            <td><a href="/admin/eventTicketDelete/{{ $ticket['id'] }}" ><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>

          </tr>
        @endforeach
    </tbody>
  </table>
</div>





<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
@endsection