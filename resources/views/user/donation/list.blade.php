@extends('layouts.user')
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
      <div class="row">
        <div class="col-md-12">

          <div class="add-button" >
            <a class="btn btn-primary btn-sm" style="float:right;color:white" href="{{ url('/donation/add') }}" >Add Donation</a> 
        </div><br><br>
        <div class="card">
            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              {{Session::get('success')}}
          </div>
          @endif
          <div class="card-body">


              <table class="table table-bordered table-striped" id="campaign_list">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Donation For</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>  
              @foreach($donations as $donation)
              <tr>

                <td>{{ $i++ }}</td>

                <td>{{ $donation['donation_for'] }}</td>
                <td>{{ $donation['name'] }}</td>
                <td>{{ $donation['email'] }}</td>
                <td>${{ $donation['amount'] }}</td>
                
               

            </tr>
            @endforeach
        </tbody> 
    </table>
</div>
</div>
</div>
</div>
</div>

</section>
</div>

@endsection
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

