@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">

  </div>
  <!-- /.content-header -->

  <!-- Main content -->
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
            <div class="card-header"><center><strong>Update Membership</strong></center></div>
            <div class="card-body">

              <form class="form-horizontal" action="{{ route('admin.membership.update') }}" method="POST">
                {{ csrf_field() }}


                <input type="hidden" name="membershipId" value="{{ $membership['id']}}">
                <div class="row">
                  <div class="col-md-6 form-group">
                    <label for="membershipCode">Membership Type :</label>
                    
                    <input type="text" class="form-control" id="membershipCode" placeholder="Enter Membership Name" name="membershipCode" value="{{ $membership['membership_code'] }}" required>
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="Description">Description :</label>
                    
                    <input type="text" class="form-control" id="Description" placeholder="Enter Membership Description" name="description" value="{{ $membership['membership_desc'] }}" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 form-group">
                    <label for="Amount">Membership Amount:($)</label>
                    
                    <input type="text" class="form-control" id="Amount" placeholder="Enter Membership Amount" name="amount" required value="{{ $membership['membership_amount'] }}">
                  </div>
                  <div class="col-md-6 form-group">
                        <label for="membership_type">Membership Type:&nbsp;<span style="color:red">* </span></label>
                        <select name="membership_type" class="form-control" required>
                          <option value="">Select Membership Type</option>
                            <option value="Family" <?=($membership['membership_type'] == 'Family')?'selected':''?>>Family</option>
                            <option value="Single" <?=($membership['membership_type'] == 'Single')?'selected':''?>>Single</option>
                            <option value="Special Membership" <?=($membership['membership_type'] == 'Special Membership')?'selected':''?>>Special Membership</option>
                            <option value="Senior Membership"  <?=($membership['membership_type'] == 'Senior Membership')?'selected':''?>>Senior Membership</option>
                        </select>
                    </div>
                  <div class="col-md-6 form-group">
                    <label for="openDate">Starting Date:</label>
                    <input type="date" class="form-control" id="starting_date" placeholder="Enter Year" name="starting_date" value="{{ $membership['starting_date'] }}" required>
                  </div>
 <div class="col-md-6 form-group">
                  <label for="openDate">Closing Date:</label>
                  <input type="date" class="form-control" id="closing_date" placeholder="Enter Year" name="closing_date" value="{{ $membership['closing_date'] }}"  required>
                </div>


                </div>
                <div class="row">
                
                <div class="col-md-6 form-group">
                  <label for="isVisible">Active:</label>

                  <select name="isVisible" class="form-control">
                    <option value="yes" <?=($membership['is_visible'] == 'yes')?'selected':''?> >yes</option>
                    <option value="no" <?=($membership['is_visible'] == 'no')?'selected':''?> >no</option>
                  </select>
                </div>

              </div>

              <div class="col-md-12">        
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
  });
</script>



@endsection
