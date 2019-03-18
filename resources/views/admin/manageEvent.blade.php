@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Events<span style="float: right"><a href="{{ url('admin/addEvent') }}">Add Events </a></span></div>

              <div class="panel-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th>SI.No</th>
                      <th>Event Name</th>
                      <th>Description</th>
                      <th>Flyer</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Location</th>
                      <th>Update</th>
                      <th>Tickets</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody> 
              <?php $i=1 ?> 
                      @foreach($events as $event)
                        <tr>
                         
                          <td>{{ $i++ }}</td>
                          <td>{{ $event['eventName'] }}</td>
                          <td>{{ $event['eventDescription'] }}</td>
                          <td>{{ $event['eventFlyer'] }}</td>
                          <td>{{ $event['eventDate'] }}</td>
                          <td>{{ $event['eventTime'] }}</td>
                          <td>{{ $event['eventLocation'] }}</td>
                          <td><a href="/admin/eventEdit/{{ $event['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                          <td><a href="/admin/editEventTicket/{{ $event['id'] }}" ><i class="fa fa-eye fa-lg" style="text-align:cenetr;"></i></a></td>
                          <td><a href="/admin/eventDelete/{{ $event['id'] }}" ><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
                          

                        </tr>
                      @endforeach
                  </tbody> 
                </table>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
