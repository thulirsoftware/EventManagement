@extends('layouts.user')
@section('content')
<div class="content-wrapper">
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
 
    <form class="form-horizontal" action="{{ url('memberPaymentCreate') }}" method="POST">
                      {{ csrf_field() }}
     
        <table id="example1" class="table" style="background-color:white">
                                                        
        
         <tr> 
              <td >Event Name</td>
              <td>{{$eventName}}</td> 
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
              <td >Total Amount</td>
              <td>{{$totalAmount}}</td> 
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
</section>
</div>


@endsection
