@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">

  </div>   
  <section class="content">
      <div class="container-fluid"> 
          <div class="col-12">

              <div class="row mb-2">
                <div class="col-sm-2">
                  <a href="/admin/Membership/List" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
              </div>

          </div>
      </div>
      <div class="row">

        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="card">

              <div class="card-body">
                  <form class="form-horizontal" action="{{ route('admin.membership.save') }}" method="POST">
                      {{ csrf_field() }}


                      <div class="row">
                          <div class="col-md-6 form-group">
                            <label for="membershipCode">Membership Type :&nbsp;<span style="color:red">* </span></label>
                            <input type="text" class="form-control" id="membershipCode" placeholder="Enter Membership Name" name="membershipCode" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="Description">Description :&nbsp;<span style="color:red">* </span></label>
                            <input type="text" class="form-control" id="Description" placeholder="Enter Membership Description" name="description" required>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 form-group">
                        <label for="Amount">Membership Amount:($)&nbsp;<span style="color:red">* </span></label>
                        <input type="text" class="form-control" id="Amount" placeholder="Enter Membership Amount" name="amount" required>
                    </div><span id="errmsg" style="color:red;"></span>
                    <div class="col-md-6 form-group">
                        <label for="membership_type">Membership Type:&nbsp;<span style="color:red">* </span></label>
                        <select name="membership_type" class="form-control" required>
                          <option value="">Select Membership Type</option>
                            <option value="Family">Family</option>
                            <option value="Single">Single</option>
                        </select>
                    </div>
                     

                  
                </div>
                <div class="row">
                  <?php $date = Carbon\Carbon::now();
                  $start_date = $date->toDateString();
                  $year = $date->format('Y');
                  ?>
                 <div class="col-md-6 form-group">
                    <label for="openDate">Starting Date:&nbsp;<span style="color:red">* </span></label>
                    <input type="date" class="form-control" id="starting_date" placeholder="Enter Year" name="starting_date" value="{{$start_date}}" required>
                </div>
                <div class="col-md-6 form-group">
                    <label for="openDate">Closing Date:&nbsp;<span style="color:red">* </span></label>
                    <input type="date" class="form-control" id="closing_date" placeholder="Enter Year" name="closing_date" value="{{$year}}-12-31"required>
                </div>
                  <div class="col-md-6 form-group">
                        <label for="isVisible">Active:&nbsp;<span style="color:red">* </span></label>
                        <select name="isVisible" class="form-control">
                            <option value="yes">yes</option>
                            <option value="no">no</option>
                        </select>
                    </div>

            </div>


            <div class="form-group"> 
                <center>       
                  <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                  <a class="btn btn-warning" href="{{ route('admin.membership.list') }}">Cancel</a>
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

<script type="text/javascript">
  $(document).ready(function () {

      $("#Amount").keypress(function (e) {
       if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
        return false;
    }
});
      $("#Year").keypress(function (e) {
       if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
        return false;
    }
});
  });
</script>


@endsection
