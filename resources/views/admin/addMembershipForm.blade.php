@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel" style="padding-top:15px">
                <div class="panel-heading"  style="background-color:brown;color:white">Add Membership</div>

               <div class="panel-body"  style="background-color:#f9f3c7;">
                  <form class="form-horizontal" action="{{ url('admin/addMembershipPost') }}" method="POST">
                      {{ csrf_field() }}
                                


                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="membershipCode">Membership Code :</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="membershipCode" placeholder="Enter Membership Short Code" name="membershipCode" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="Description">Description :</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="Description" placeholder="Enter Membership Description" name="description" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="Amount">Membership Amount:</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="Amount" placeholder="Enter Membership Amount" name="amount" required>
                    </div><span id="errmsg" style="color:red;"></span>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="isVisible">Is Visible:</label>
                    <div class="col-sm-5">
                      <select name="isVisible" style="width: 350px;height: 30px;border-radius: 4px;background-color: white;">
                        <option value="yes">yes</option>
                        <option value="no">no</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="openDate">Open Date:</label>
                    <div class="col-sm-5">
                      <input type="date" class="form-control" id="openDate" placeholder="Enter openDate" name="openDate" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="close  Date">Closing Date:</label>
                    <div class="col-sm-5">
                      <input type="date" class="form-control" id="close Date" placeholder="Enter close Date" name="closeDate" required>
                    </div>
                  </div>


                  <div class="form-group">        
                    <div class="col-sm-offset-3 col-sm-4 col-md-offset-5">
                      <button type="submit" class="btn btn-default btn-lg btn-primary" name="submit" value="submit">Submit</button>
                      <a class="btn btn-default btn-close btn-lg btn-primary" href="{{ url('admin/manageMembership') }}">Cancel</a>
                    </div>

                  </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
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
