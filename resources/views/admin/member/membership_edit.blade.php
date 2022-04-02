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
          <a href="/admin/Payments" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        
      </div>
    </div>
      <div class="row">
       
        <div class="col-md-2">
      </div>
       <div class="col-md-8">
            <div class="card">
 @if(Session::has('success'))
           <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {{Session::get('success')}}
          </div>
          @endif
               <div class="card-body">
                  <form class="form-horizontal" action="{{ url('admin/Member/UpdateMembership') }}" method="POST">
                      {{ csrf_field() }}

            <?php 
           $member = App\Member::where('user_id',$MembershipBuy->user_id)->first();
                        if($member==null)
                        {
                        $member = App\NonMember::where('user_id',$MembershipBuy->user_id)->first();
                      }
                      else
                      {
                        $member = App\Member::where('user_id',$MembershipBuy->user_id)->first();
                      }
                      $memberships = App\MembershipConfig::where('id',$MembershipBuy->membership_id)->first();
            ?>
            <div class="row">
              <input type="hidden" class="form-control" id="firstName" placeholder="" name="user_id" value="{{$MembershipBuy->user_id}}" required >

            <div class="col-md-6 form-group">
              <label class="control-label" for="firstName">Name:</label>
                <input type="text" class="form-control" id="firstName" placeholder="" name="firstName" value="{{$member->firstName}}" required readonly="">

                <input type="hidden" class="form-control" id="id" placeholder="" name="id" value="{{$MembershipBuy->id}}" required readonly="">                
            </div>

            <div class="col-md-6 form-group">
              <label class="control-label" for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{$member->Email_Id}}" required readonly="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
              <label class="control-label" for="phoneNo">Phone No:</label>
                <input type="text" class="form-control" id="Member_Id" placeholder="" name="phoneNo" value="{{$member->mobile_number}}" required readonly="">
            </div>

            <div class="col-md-6 form-group">
              <label class="control-label" for="membershipType">Membership Code:</label>
                 <select name="membershipType" id="membershipType"  class="form-select" required>
                    <option value="">Choose Membership Code</option>
                     @foreach($MembershipCode as $i=>$MembershipCode)
                    <option value="{{$MembershipCode['membership_code']}}" <?= $MembershipBuy['membership_code'] == $MembershipCode['membership_code']?'selected':'' ?>>{{$MembershipCode['membership_code']}}</option> 
                    @endforeach
                   
                  </select>

              </div>
            </div>
       

            <div class="form-group">   
            <center>
                      <button type="submit" class="btn btn-primary" name="submit">Update</button>
                      <a class="btn  btn-warning" href="{{ url('admin/Payments') }}">Cancel</a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


@endsection
