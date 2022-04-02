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
      <div class="col-md-2">
      </div>
        <div class="col-md-8">
             @if(Session::has('success'))
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  {{Session::get('success')}}
                  </div>
              @endif
              @if(Session::has('warning'))
                  <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  {{Session::get('warning')}}
                  </div>
              @endif
            <div class="card panel-default">
              <div class="card-header"><center><h4>Enroll as Volunteer</h4></center></div>

                <div class="card-body">
                  <form class="form-horizontal" action="{{ url('/AddVolunteer/Family') }}" method="POST">
                      {{ csrf_field() }}
                       <?php
                             $relationships = \App\FamilyMember::where('user_id',Auth()->user()->id)->get();
                             $selectedrelationship = \App\FamilyMember::where('user_id',Auth()->user()->id)->where('id',request()->id)->first();
                           ?>
                  <div class="row">
                    <div class="col-md-12 form-group">
                       <input name="volunteer_from" value="{{$selectedrelationship->relationshipType}}" type="hidden">
                       <input type="hidden" name="familyMemberId" value="{{$id}}">
                        <label class="control-label" for="volunteer_from">Whom to be volunteer?:&nbsp;<span style="color:red">*</span></label>

                       <select class="form-select" name="volunteer_from" disabled ="">
                             <option value="{{$selectedrelationship->relationshipType}}">{{$selectedrelationship->firstName}} {{$selectedrelationship->lastName}}</option>
                          
                        </select>
                    </div>
                     <div class="col-md-12 form-group">
                        <label class="control-label" for="volunteer_for">Volunteer?:&nbsp;<span style="color:red">*</span></label>
                       <select class="form-select" name="volunteer_for" required="">
                            <option value="">Select</option>
                             <option value="E">Event</option>
                            <option value="G">General</option>

                        </select>
                    </div>
                     <div class="col-md-12 form-group">
                        <label class="control-label" for="youth_volunteer">Youth Volunteer?:&nbsp;<span style="color:red">*</span></label>
                       <select class="form-select" name="youth_volunteer" required="">
                            <option value="">Select</option>
                             <option value="Yes">Yes</option>
                            <option value="No">No</option>

                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="control-label" for="email_group">Can we add you to Volunteer Email Group? *:&nbsp;<span style="color:red">*</span></label>
                       <select class="form-select" name="email_group" required="">
                            <option value="">Select</option>
                             <option value="Yes">Yes</option>
                            <option value="No">No</option>

                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="control-label" for="lastName">Volunteering Opportunities you are interested in (please select at least one):&nbsp;<span style="color:red">*</span></label><br>
                        <input class="col-md-12 form-check-input" type="checkbox" id="vehicle1" name="opportunities[]" value="On Event Day Only">&nbsp;&nbsp;
                          <label for="vehicle1" style="font-weight:normal"> On Event Day Only</label><br>
                          <input class="form-check-input" type="checkbox" id="vehicle2" name="opportunities[]" value="Event Logistics (such as help with purchasing/picking up event day items)">&nbsp;&nbsp;

                          <label for="vehicle2" style="font-weight:normal">Event Logistics (such as help with purchasing/picking up event day items)</label><br>

                          <input class="form-check-input" type="checkbox" id="vehicle3" name="opportunities[]" value="Work with NETS Committee Member in event pre-planning">&nbsp;&nbsp;
                          <label for="vehicle3"  style="font-weight:normal">Work with NETS Committee Member in event pre-planning</label><br>
                          <input  class="form-check-input" type="checkbox" id="vehicle3" name="opportunities[]" value="As Youth volunteer, Interested in Emcee (13 & above)">&nbsp;&nbsp;
                          <label for="vehicle3"  style="font-weight:normal">As Youth volunteer, Interested in Emcee (13 & above)</label>
                          <br>
                          <input class="form-check-input" type="checkbox" id="othercheckbox"  onclick="other()" >&nbsp;&nbsp;
                          <label for="vehicle3"  style="font-weight:normal">Other</label><input type="text" class="form-control" id="othertext" name="opportunities[]" style="display:none">&nbsp;&nbsp;
                    </div>
                   
                    <div class="col-md-12 form-group">
                        <label class="control-label" for="comments">Comments:</label>
                        <textarea   class="form-control" id="comments"   name="comments" ></textarea>
                    </div>
                   
                   
                   
                </div> 
                            
                  <div class="row">
                     <div class="col-md-4 form-group">
                     </div>
                     <div class="col-md-8 form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                                                <a href="/familyMembers" class="btn btn-warning">Cancel</a>

                    </div>
                    </div><br>

                    </form>

                  </div>




                 

                  

                 
                    
               </div>
             </div>
           </div>
         </div>
</section>
</div>
<script>
  function other()
  {
    var checkBox = document.getElementById("othercheckbox");
    console.log(checkBox);
    var x = document.getElementById('othertext');
    if (checkBox.checked == true) {
      x.style.display = "block";
    } else {
     x.style.display = "none";
    }
  }
</script>

@endsection
