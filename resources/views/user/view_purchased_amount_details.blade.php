@extends('layouts.user')
@section('content')
<div class="content-wrapper" style="background-color:white">
  <!-- Content Header (Page header) -->
  <div class="content-header">
  <div class="container-fluid">
    
</div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
     <div class="col-12">
<br>
  @if(Session::has('success'))
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
{{Session::get('success')}}
</div>
@endif
<?php
            $event = Session::get('Events');
            //$event = Event::where('id',$id)->first();
        ?>
  <div class="card card-info" style="-webkit-box-shadow: none;
          -moz-box-shadow: none;  box-shadow: none;background-color: #f7f7f7;">
           <div class="card-header" style="background-color: #1f5387;">
             <h3 class="card-title">View Purchased Amount Details</h3>
        </div>
            @if(Session::has('success'))
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  {{Session::get('success')}}
                  </div>
              @endif
                <div class="card-body">
    <form  action="{{ url('memberPaymentCreate') }}" method="POST">
                      {{ csrf_field() }}
     
        <table id="example1" class="table table-borderless" style="border:none">
                                                        
        
         <tr>  
              <td >Event Name</td>
              <td>{{ $event->eventName }}</td> 
        </tr>
       
        <tr> 
              <td >Food Tickets</td>
              <td>{{$FoodAmount}}</td> 
        </tr>
        <tr> 
              <td >Entry Ticket</td>
              <td>{{$EntryTicketAmounts}}</td> 
        </tr>
        <tr> 
              <td >Competition</td>
              <td>{{$compeitionAmounts}}</td> 
        </tr>
        
         <tr> 
              <td >Total Amount</td>
              <td>{{$totalAmount}}</td> 
        </tr>
        <tr>
          <td>Payment Type</td>
          <td>
          <input type="radio" class="minimal" id="Cash" name="payment_type" value="cash"><br>Cash
           </td>
           <td>
          <input type="radio" class="minimal" id="cheque" name="payment_type" value="cheque"><br>Cheque
           </td>
           <td>
          <input type="radio" class="minimal" id="paypal" name="payment_type" value="paypal"><br>Paypal
           </td>

        </tr>
        
       </table>
       <div class="form-group" id="submit">        
                    <center>
                      <button type="submit" class="btn btn-primary btn-sm" name="submit">Pay</button>
                      <a class="btn btn-warning btn-sm" href="{{ url('memberTickets') }}">Cancel</a>
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


@endsection
