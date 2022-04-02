@extends('layouts.admin')
@section('content')
<style>
    .btn-group > .btn, .btn-group-vertical > .btn {
  position: relative;
  flex: 1 1 auto;
  color: black !important;
}
</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
  <div class="content-header">
 <a href="#" class="sidebar-toggle openbtn" data-toggle="push-menu" role="button">&#9776;</a>

</div>
  <div class="content-header">

  </div>   
  <section class="content">
      <div class="container-fluid"> 
          <div class="col-12">

              <div class="row mb-2">
                <div class="col-sm-2">
                  <a href="{{route('admin.campaign.list')}}" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
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
                  <form class="form-horizontal" action="{{ route('admin.campaign.save') }}" method="POST">
                      {{ csrf_field() }}
     

  <div class="row">

     
         <div class="col-md-12 form-group ">
          <label class="names">Name:&nbsp;<span style="color:red">*</span></label>
          <input type="text" class="form-control" id="Name" placeholder="Enter Name" name="name" required>       
         
        </div>
         <?php
                  $date =  Carbon\Carbon::tomorrow()->toDateString();
                ?>  
                 <div class="col-md-6 form-group">
                  <label for="start_date">Starting Date:&nbsp;<span style="color:red">*</span></label>
                  <input type="date" class="form-control" id="start_date" placeholder="Enter Start Date" name="start_date" min="{{$date}}" required>
                </div>
                <div class="col-md-6 form-group">
                  <label for="close_date">End Date:&nbsp;<span style="color:red">*</span></label>
                  <input type="date" class="form-control" id="end_date" placeholder="Enter Close Date" name="end_date" min="{{$date}}" required>
                </div>
          <div class="col-md-12 form-group">
                <label for="Description" >Description:</label>
                
                <textarea class="form-control" name="description" rows="2" cols="30">
                </textarea>
              </div>
              <div class="col-md-12 form-group">
                <label for="type">Goal:</label>
                <textarea id="editor1" name="goal" rows="15" cols="30">
                </textarea>
                
              </div>
             


   
</div>


                </div>

                <div class="form-group"> 
                    <center>       
                      <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                      <a class="btn btn-warning" href="{{ route('admin.campaign.list') }}">Cancel</a>
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
<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script>
 var l=1;
 function AddFoodTicket()
 {
  l++;
  $('<div id="row_food'+l+'" class="row" >'+'<div class="col-md-2 form-group">'+'<select class="form-control"  name="food_min_age[]" id="food_min_age'+l+'"></select>'+'</div>'+'<div class="col-md-2 form-group">'+' <select class="form-control"   name="food_max_age[]" id="food_max_age'+l+'"></select>'+'</div>'+'<div class="col-md-3 form-group">'+'<select class="form-control" name="FoodmemberType[]" id="sel1"><option value="">Select</option><option value="Member">Member</option><option value="NonMember">NonMember</option></select>'+'</div>'+'<div class="col-md-2 form-group">'+'<input type="text" class="form-control" id="food_type" placeholder="Enter Food Type" name="foodType[]" required>'+'</div>'+'<div class="col-md-2 form-group">'+'<input class="form-control" type="text" name="FoodticketPrice[]" id="FoodticketPrice_'+l+'" >'+'</div>'+'<div class="col-md-1">'+'<a type="button" name="remove" id="'+l+'" class="btn btn-warning spf_btn_remove1" >'+'<i class="fa fa-trash"></i>'+'</a>'+'</div>'+'</div>').appendTo('#food-list');

  $("#FoodticketPrice_"+l).keypress(function(e) {
    var a = [];
    var k = e.which;

    for (i = 48; i < 58; i++)
      a.push(i);

  if (!(a.indexOf(k)>=0))
      e.preventDefault();

});

  $("#FoodticketPrice").keypress(function(e) {
    var a = [];
    var k = e.which;

    for (i = 48; i < 58; i++)
      a.push(i);

    if (!(a.indexOf(k)>=0))
      e.preventDefault();

  });
  var $select = $("#food_max_age"+l);
    for (i=0;i<=50;i++){
      $select.append($('<option></option>').val(i).html(i))
    }

     var $select = $("#food_min_age"+l);
    for (i=0;i<=50;i++){
      $select.append($('<option></option>').val(i).html(i))
    }
 

 

 
}


$(document).on('click', '.spf_btn_remove1', function(){  
 var button_idspf = $(this).attr("id");   
 $('#row_food'+button_idspf+'').remove();  
 $(this).hide();
});

  $(document).ready(function () {

      $("#FoodticketPrice").keypress(function (e) {
       if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
        return false;
    }
});
    
  });
  function getPrice(price)
  {
      
      var lblError = document.getElementById("lblError");
      if(Math.abs(price)<='0')
      {
          var FoodticketPrice = document.getElementById("FoodticketPrice");
            FoodticketPrice.value='';
           lblError.innerHTML = "Must enter valid price";
      }
      else
      {
            lblError.innerHTML = "";
         
      }
  }
</script>

@endsection
