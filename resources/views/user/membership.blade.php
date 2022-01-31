@extends('layouts.user')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
 <a href="#" class="sidebar-toggle openbtn" data-toggle="push-menu" role="button">&#9776;</a>

</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
               
          <div class="card">
              
              <div class="card-body">
                <table class="table table-bordered table-striped" style="width:100%" id="user_membership_list">
                  <thead>
                    <tr>
                      <th>SI.No</th>
                      <th>Code</th>
                      <th>Description</th>
                      <th>Amount</th>
                       <th>Type</th>
                      <th>Starting Date</th>
                       <th>Closing Date</th>
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
                           <td>{{ $membership->membership_type}}</td>
                          <td>{{ $membership->starting_date}}</td>
                          <td>{{ $membership->closing_date}}</td>
                          <?php 
                            $MembershipBuy = App\MembershipBuy::where('user_id',Auth::user()->id)->first();

                           $this_year =  Carbon\Carbon::now()->format('Y-m-d');

                          $Member = App\Member::where('user_id',Auth::user()->id)->where('membershipExpiryDate','<=',$this_year)->first();
                        ?>
                        @if($MembershipBuy==null)
                          <td><a href="/MemberShipAdd/{{ $membership->id }}" ><i class="fa fa-shopping-cart fa-lg" style="text-align:center;"></i></a></td>
                          @elseif($Member!=null)
                          <td><a href="/MemberShipAdd/{{ $membership->id }}" class="badge badge-danger">Renew</a></td>
                           @elseif($MembershipBuy->payment_status=="Pending")
                          <td><a  class="badge badge-danger" style="color:white">Pending</a></td>
                          @else
                          <td><a  class="badge badge-success" style="color:white">Member</a></td>
                        @endif

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
