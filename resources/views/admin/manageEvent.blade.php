@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11 col-md-offset-2">
            <div class="panel">
                <div class="panel-heading"><a  href="{{ url('admin/addEvent') }}" style="background-color:brown;color:white;font-size:18px;padding:10px;border-radius:10px;text-decoration:none">Add Events </a></span></div>

              <div class="panel-body">
                <table class="table" style="width:100%">
                  <thead>
                    <tr style="background-color:brown;padding;15px;text-align:center;font-size:18px">
                      <th style="color:white;text-align:center">SI.No</th>
                      <th style="color:white;text-align:center">Event Name</th>
                      <th style="color:white;text-align:center">Description</th>
                      <th style="color:white;text-align:center">Flyer</th>
                      <th style="color:white;text-align:center">Date</th>
                      <th style="color:white;text-align:center">Time</th>
                      <th style="color:white;text-align:center">Location</th>
                      <th style="color:white;text-align:center">Update</th>
                      <th style="color:white;text-align:center">Tickets</th>
                      <th style="color:white;text-align:center">Delete</th>
                    </tr>
                  </thead>
                  <tbody style="background-color:#f3f4c6"> 
              <?php $i=1 ?> 
                      @foreach($events as $event)
                        <tr>
                         
                          <td style="padding:13px;text-align:center">{{ $i++ }}</td>
                          <td style="padding:13px;text-align:center">{{ $event['eventName'] }}</td>
                          <td style="padding:13px;text-align:center">{{ $event['eventDescription'] }}</td>
                          <td style="padding:13px;text-align:center">{{ $event['eventFlyer'] }}</td>
                          <td style="padding:13px;text-align:center">{{ $event['eventDate'] }}</td>
                          <td style="padding:13px;text-align:center">{{ $event['eventTime'] }}</td>
                          <td style="padding:13px;text-align:center">{{ $event['eventLocation'] }}</td>
                          <td style="padding:13px;text-align:center"><a href="/admin/eventEdit/{{ $event['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                          <td style="padding:13px;text-align:center"><a href="/admin/editEventTicket/{{ $event['id'] }}" ><i class="fa fa-eye fa-lg" style="text-align:cenetr;"></i></a></td>
                          <td style="padding:13px;text-align:center"><a href="/admin/eventDelete/{{ $event['id'] }}" ><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
                          

                        </tr>
                      @endforeach
                  </tbody> 
                </table>
              </div>
            </div>
        </div>
    </div>
</div>

@if(Auth::user()->job_title=='Admin')
<script language="javascript">
$(document).ready(function()
{ 
       $(document).bind("contextmenu",function(e){
              return false;
       }); 
})
</script>
@endif
@endsection
