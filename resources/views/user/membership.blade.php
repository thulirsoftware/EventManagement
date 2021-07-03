@extends('layouts.user')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">

</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
               
          <div class="card">
              
              <div class="card-body">
                <table class="table" style="width:100%">
                  <thead>
                    <tr>
                      <th>SI.No</th>
                      <th>Code</th>
                      <th>Description</th>
                      <th>Amount</th>
                      <th>Year</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody> 
              <?php $i=1 ?> 
                      @foreach($membership as $membership)
                        <tr>
                         
                          <td>{{ $i++ }}</td>
                          <td>{{ $membership->membership_code}}</td>
                          <td>{{ $membership->membership_desc }}</td>
                          <td>{{ $membership->membership_amount }}</td>
                          <td>{{ $membership->year}}</td>
                          <td><a href="/MemberShipAdd/{{ $membership->id }}" ><i class="fa fa-shopping-cart fa-lg" style="text-align:center;"></i></a></td>

                        

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
