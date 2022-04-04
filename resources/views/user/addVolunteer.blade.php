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
                  <form class="form-horizontal" action="{{ url('/AddVolunteer') }}"  onsubmit="return validateForm()" method="POST">
                      {{ csrf_field() }}

                  <div class="row">
                    <div class="col-md-12 form-group">
                        <label class="control-label" for="volunteer_from">Whom to be volunteer?:&nbsp;<span style="color:red">*</span></label>
                       <select class="form-select" name="volunteer_from" onchange="selectFamilyMember(this.value)" required="">
                            <option value="">Select</option>
                             <option value="self">Self</option>
                             <?php
                             $relationships = \App\FamilyMember::where('user_id',Auth()->user()->id)->where('is_family_member','Y')->get();
                             $events = \App\Event::whereDate('eventDate','>=',date('Y-m-d'))->get();
                           ?>
                           @foreach($relationships as $relationship)
                           <option value="{{$relationship->id}} - {{$relationship->relationshipType}}">{{$relationship->firstName}} {{$relationship->lastName}}</option>
                           @endforeach
                           

                        </select>
                    </div>
                     <div class="col-md-12 form-group">
                        <label class="control-label" for="volunteer_for">Volunteer?:&nbsp;<span style="color:red">*</span></label>
                       <select class="form-select" name="volunteer_for" onchange="selectEVent(this.value)" required="">
                            <option value="">Select</option>
                             <option value="E">Event</option>
                            <option value="G">General</option>

                        </select>
                    </div>
                     <div class="col-md-12 form-group" id="event_id" style="display:none">
                        <label class="control-label" for="event_id">Event:&nbsp;<span style="color:red">*</span></label>
                       <select class="form-select" name="event_id" >
                            <option value="">Select</option>
                             @foreach($events as $event) 
						                        <option value="{{$event->id}}">{{$event->eventName}}</option>
						                            
						                     @endforeach

                        </select>
                    </div>
                    <?php
$date =  Carbon\Carbon::now();
$dates = $date->toDateString();
?>

<div class="col-md-12">
   <div class="form-group">
      <label class="control-label" for="dob">DOB&nbsp;<span style="color:red">*</span> </label>
      <input type="date" class="form-control"  name="dob"  max="{{$dates}}" id="dob" required="">

  </div>

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
  
  function selectEVent(eventName)
  {
      var x = document.getElementById('event_id');
      if(eventName=='E')
      {
           x.style.display = "block";
      }
      else
      {
           x.style.display = "none";
      }
  }
  function validateForm(){
    var birthday = document.getElementById('dob').value;
    console.log(birthday);
	// it will accept two types of format yyyy-mm-dd and yyyy/mm/dd
	var optimizedBirthday = birthday.replace(/-/g, "/");

	//set date based on birthday at 01:00:00 hours GMT+0100 (CET)
	var myBirthday = new Date(optimizedBirthday);

	// set current day on 01:00:00 hours GMT+0100 (CET)
	var currentDate = new Date().toJSON().slice(0,10)+' 01:00:00';

	// calculate age comparing current date and borthday
	var myAge = ~~((Date.now(currentDate) - myBirthday) / (31557600000));

	if(myAge < 18) {
	    alert('Age must be greater than 18')
     	    return false;
        }else{
	    return true;
	}

}
function selectFamilyMember(value)
{
    console.log(value);
    if(value=="self")
    {
        var substateArray1 =  @json($familyMember);
        var filteredArray1 = substateArray1.filter(x => x.firstName == "Self");
        console.log(filteredArray1[0]['dob']);
        document.getElementById('dob').value= filteredArray1[0]['dob'];
    }
    else
    {
       var arr = value.split('-');
        var substateArray1 =  @json($familyMember);
        var filteredArray1 = substateArray1.filter(x => x.id == arr[0]);
        console.log(filteredArray1);
        document.getElementById('dob').value= filteredArray1[0]['dob'];
    }
    
}
</script>

@endsection
