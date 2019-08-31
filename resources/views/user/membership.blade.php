@extends('layouts.user')

@section('content')
@if(auth()->user()->verified()!='verified')
      <div class="col-md-6 col-md-offset-3">
            <p style="font-size:20px;color:brown;text-align:center">Please verify your email to activate your account !</p>
      </div>
@endif
@if(auth()->user()->verified()=='verified')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-3">
            <div class="panel">
                <div class="panel-heading" style="background-color:brown;color:white;font-size:18px;font-weight:bold;text-align: center;">Membership</div>

               <div class="panel-body" style="background-color:#f3f4c6">
                  <form class="form-horizontal" action="{{ url('membershipPost') }}" method="POST">
                      {{ csrf_field() }}

            <?php 
            $user = Auth::user()->email;
            $member = App\Member::where('primaryEmail',$user)->get();
            $memberDetails = $member[0];
            ?>


            <div class="form-group">
              <label class="control-label col-sm-3 col-md-offset-1" for="firstName">Name:</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="firstName" placeholder="" name="firstName" value="{{$memberDetails['firstName']}}" required readonly="">

                <input type="hidden" class="form-control" id="lastName" placeholder="" name="lastName" value="{{$memberDetails['lastName']}}" required readonly="">                
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3 col-md-offset-1" for="email">Email:</label>
              <div class="col-sm-5">
                <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{$memberDetails['primaryEmail']}}" required readonly="">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3 col-md-offset-1" for="phoneNo">Phone No:</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="tagDvId" placeholder="" name="phoneNo" value="{{$memberDetails['phoneNo1']}}" required readonly="">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3 col-md-offset-1" for="membershipType">Membership:</label>
              <div class="col-sm-5">
                <select name="membershipType" class="select" style="width: 280px;height: 33px;border-radius: 4px;">
                  @foreach($membership as $member)
                  <option value="{{ $member->membership_code }}" id="membershipType">{{ $member->membership_desc}} - ${{ $member->membership_amount}}</option>
                  @endforeach
                </select>
              </div>
            </div>


            <div class="form-group">        
              <div class="col-sm-offset-4 col-sm-4">
                <button type="submit" class="btn btn-default btn-lg btn-primary" name="submit">Submit</button>
              </div>
            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
