@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
  <div class="content-header">
 <a href="#" class="sidebar-toggle openbtn" data-toggle="push-menu" role="button">&#9776;</a>

</div>
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
          
      </div>
  </div>
  <div class="row">
     
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
        <form method="post" action="{{ url('admin/Event/addEventFoodTicketPost') }}" enctype="multipart/form-data" id="regForm">

            {{ csrf_field() }}
            <div class="card">
             @if(Session::has('success'))
             <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              {{Session::get('success')}}
          </div>
          @endif
          <div class="card-header"><center><strong>Add Event Food Ticket</strong></center></div>
          <br>
          <input type="hidden" name="eventId" value="{{$id}}">
          <div class="card-body">
        <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Min Age</th>
                    <th>Max Age</th>
                    <th>Member Type</th>
                     <th>Food Type</th>
                    <th>Amount</th>
                    <th>Select</th>
                </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>  
              @foreach($FoodTypes as $food)
              <tr id="food_mod_row_{{ $food['id'] }}">

                <td>{{ $i++ }}</td>

                <td>{{ $food['min_age'] }}</td>
                <td>{{ $food['max_age'] }}</td>
                <td>{{ $food['memberType'] }}</td>
                <td>{{ $food['food_type'] }}</td>
                <td>${{ $food['price'] }}</td>
                <td> <div class="custom-control custom-switch">
                <input type="checkbox" 
                       class="custom-control-input" 
                       id="customSwitch{{ $food['id'] }}" name="food_id[]" value="{{ $food['id'] }}" onclick="FoodType(this)" />
                <label class="custom-control-label"
                       for="customSwitch{{ $food['id'] }}">
                  </label>
            </div></td>
              

            </tr>
            @endforeach
        </tbody> 
    </table><br>
    <div style="overflow:auto;">
  <center>
       @if($FoodTypes->count()>0)
      <button type="submit" class="button nextBtn" id="nextBtn" >Submit</button>
      @else
      <button type="submit" class="button nextBtn" id="nextBtn" disabled="">Submit</button>
      @endif
  </center>
</div>
     </div>

</div>

</div>
</form>
</div>
</div>
</div>
</div>




<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


@endsection