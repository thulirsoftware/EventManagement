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
   <div class="col-12">

      <div class="row mb-2">
        <div class="col-sm-2">
          <a href="javascript:history.back()" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        <div class="col-md-3">
        </div>
         <div class="col-md-3">
        </div>
        <div class="col-md-3">
        </div>
        
        
      </div>
    </div>
     <div class="row">
      <div class="col-md-1">
      </div>
        <div class="col-md-10">
            <div class="card panel-default">
                 @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {{Session::get('success')}}
                    </div>
                @endif
              <div class="card-header"><center><h4>Add Family Member</h4></center></div>

                <div class="card-body">
                     <div class="add-button" >
                        <button type="button" class="btn btn-primary btn-sm" style="float:right;color:white"  onclick="Add()">Add</button> 
                    </div><br><br>
                  <form class="form-horizontal" action="{{ route('membership.save.familyMembers') }}" method="POST">
                      {{ csrf_field() }}

                  <div class="row">
                     <div class="col-md-2 form-group">
                        <label class="control-label" for="firstName">First Name:&nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="firstName[]" placeholder="First Name" name="firstName[]" required="">
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label" for="lastName">Last Name:&nbsp;<span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="lastName" placeholder="Last Name" name="lastName[]" required>
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="control-label" for="relationshipType">Relationship:&nbsp;<span style="color:red">*</span></label>
                        <select class="form-control" name="relationshipType[]" required="">
                            <option value="">Select Relationship</option>
                            @foreach($mandatory as $Mandatory)
                             <option value="{{$Mandatory->name}}">{{$Mandatory->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label" for="phoneNo">Phone No:</label>
                        <input type="text" class="form-control" id="phoneNo" maxlength="10" placeholder="Phone No" name="phoneNo[]" >
                    </div>
                    <?php
                    $date =  Carbon\Carbon::now();
                    $dates = $date->toDateString();
                    ?>
                     <div class="col-md-2 form-group">
                        <label class="control-label" for="DOB">DOB:&nbsp;<span style="color:red">*</span></label>
                        <input type="date" class="form-control" id="DOB"  placeholder="DOB" name="dob[]"  max="{{$dates}}" required>
                    </div>
                   
                   
                   
                </div> 
                <div id="link-list"></div>
                            
                <div style="max-width: 200px; margin: auto;">
                        <button type="submit" class="btn btn-primary" id="submit" >Submit</button>
                                                <a href="{{ route('membership.add.familyMembers') }}" class="btn btn-warning">Skip</a>

                    </div><br>

                    </form>

                  </div>




                 

                  

                 
                    
               </div>
             </div>
           </div>
         </div>
       </div>
</section>
</div>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

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
<script>
 var j=1;
 function Add()
 {
  j++;
  $('<div id="row'+j+'" class="row" >'+'<div class="col-md-2 form-group">'+'<input class="form-control" type="text" name="firstName[]" placeholder="First Name" id="firstName'+j+'" >'+'</div>'+'<div class="col-md-2 form-group">'+'<input class="form-control" type="text" placeholder="Last Name" name="lastName[]" id="lastName'+j+'" >'+'</div>'+'<div class="col-md-3 form-group">'+'<select class="form-control" name="relationshipType[]" id="relationShip'+j+'"><option value="">Select Relationship</option></select>'+'</div>'+'<div class="col-md-2 form-group">'+' <input class="form-control" type="text" name="phoneNo[]" id="phoneNo'+j+'" >'+'</div>'+'<div class="col-md-2 form-group">'+' <input class="form-control" type="date" name="dob[]" id="dob'+j+'" >'+'</div>'+'<div class="col-md-1">'+'<a type="button" name="remove" id="'+j+'" class="btn btn-warning spf_btn_remove" >'+'<i class="fa fa-trash"></i>'+'</a>'+'</div>'+'</div>').appendTo('#link-list');

        $('#relationShip'+j).empty();
        var subcategory_id = $('#relationShip'+j).val();
        var typeArr = @json($mandatoryAjax);
        console.log('subcategory', typeArr);
        $('#relationShip'+j).append('<option value="">Select Relationship</option>');
        var options = typeArr.forEach( function(item, index){
            $('#relationShip'+j).append('<option value="'+item.name+'">'+item.name+'</option>');
        });
}
$(document).on('click', '.spf_btn_remove', function(){  
 var button_idspf = $(this).attr("id");   
 $('#row'+button_idspf+'').remove();  
 $(this).hide();
});
</script>
@endsection
