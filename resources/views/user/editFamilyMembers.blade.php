@extends('layouts.user')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset-3">
            <div class="panel">
                <div class="panel-heading" style="background-color:brown;color:white;font-size:18px;font-weight:bold">Update Family Member</div>

               <div class="panel-body col-md-offset-0" style="background-color:#f3f4c6;padding-top:35px">
                  <form class="form-horizontal" action="{{ url('/familyUpdate') }}" method="POST">
                      {{ csrf_field() }}

                  <input type="hidden" name="id" value="{{ $family['id']}}">
                  <input type="hidden" name="tagDvId" value="{{ $family['tagDvId']}}">
                                          
                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="firstName">First Name:</label>
                    <div class="col-sm-5 col-md-offset-0">
                      <input type="text" class="form-control" id="firstName" placeholder="Enter Name" name="firstName" value="{{ $family['firstName']}}" required="">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="lastName">Last Name:</label>
                    <div class="col-sm-5 col-md-offset-0">
                      <input type="text" class="form-control" id="lastName" placeholder="Enter Name" name="lastName" value="{{ $family['lastName']}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="relationshipType">Relationship:</label>
                    <div class="col-sm-5 col-md-offset-0">
                      <input type="text" class="form-control" id="relationshipType" placeholder="Enter Name" name="relationshipType" value="{{ $family['relationshipType']}}" required="">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="phoneNo">Phone No:</label>
                    <div class="col-sm-5 col-md-offset-0">
                      <input type="text" class="form-control" id="phoneNo" maxlength="10" placeholder="Enter Name" name="phoneNo" value="{{ $family['phoneNo']}}">
                    </div>
                  </div>

                  {{-- <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="dob">DOB:</label>
                    <div class="col-sm-5 col-md-offset-0">
                      <input type="date" class="form-control" id="dob" placeholder="Enter Name" name="dob" value="{{ $family['dob']}}">
                    </div>
                  </div> --}}


                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="dobDate">DOB Day in DD:</label>
                    <div class="col-sm-5 col-md-offset-0">
                      {{-- <input type="text" class="form-control" id="dobDate" placeholder="" maxlength="2" name="dobDate" value="{{ $family['day']}}"> --}}
                      <select class="form-control" id="dobDate" name="dob" style="width:155px" value="{{ $family['day'] }}">
                        <option id="day" value="{{ $family['day'] }}">{{ $family['day'] }}</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
                      </select>
                      <span id="errmsgDate" style="color:red"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="dobMonth">DOB Month in MM:</label>
                    <div class="col-sm-5 col-md-offset-0">
                      {{-- <input type="text" class="form-control" id="dobMonth" placeholder="" name="dobMonth" value="{{ $family['month']}}" style="display:none"> --}}
                      <select class="form-control" id="dobMonth" name="mob" style="width:155px">
                        <option id="month" value="{{ $family['month'] }}">{{ $family['month'] }}</option><option value="January">January</option><option value="February">February</option><option value="March">March</option><option value="April">April</option><option value="May">May</option><option value="June">June</option><option value="July">July</option><option value="August">August</option><option value="September">September</option><option value="October">October</option><option value="November">November</option><option value="December">December</option>
                      </select>


                      <span id="errmsgMonth" style="color:red"></span>
                    </div>
                  </div>




                  <?php 
                      $schools = App\School::pluck('name');
                  ?>

                  <div class="form-group">
                    <label class="control-label col-sm-3 col-md-offset-1" for="schoolName">School Name:</label>
                  
                  <div class="col-sm-5 col-md-offset-0">
                    <select name="schoolName" style="width: 320px;height: 30px;border-radius: 4px;background-color: white" required="">
                      <option value="none">None</option>
                      @foreach($schools as $key => $school)
                        <option value="{{ $school }}" <?= ($school == $family['schoolName'])?'selected':''  ?> >{{ $school }}</option>
                      @endforeach
                    </select>
                  </div>  
                  </div>

                  <div class="form-group" style="padding-top:25px">        
                    <div class="col-sm-offset-3 col-md-6">
                      <button type="submit" class="btn btn-default btn-lg btn-primary col-md-offset-3" name="submit">Submit</button>
                      <button class="btn btn-default btn-lg btn-primary col-md-offset-1"><a style="color:white" href="{{ url('familyMembers') }}">cancel</a></button>
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

  $("#dobDate").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errmsgDate").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });

  $("#dobMonth").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errmsgMonth").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });

});
</script>
<script language="javascript">
$(document).ready(function(){
  $("#dobDate").focus(function(){
    $("#day").hide();
  });
});
</script>
<script language="javascript">
$(document).ready(function(){
  $("#dobMonth").focus(function(){
    $("#month").hide();
  });
});
</script>
@endsection
