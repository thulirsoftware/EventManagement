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
  <section class="content">
      <div class="container-fluid"> 
          <div class="col-12">

              <div class="row mb-2">
                <div class="col-sm-2">
                  <a href="/admin/Food/List" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
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
                  <form class="form-horizontal" action="{{ route('admin.food.update') }}" method="POST">
                      {{ csrf_field() }}
     
  <div id="food-list"></div>

  <div class="row" id="row_food0">

      <div class="col-md-6 form-group ">
         <label class="names">Min Age:&nbsp;<span style="color:red">*</span></label>
        <select  class="form-select"  name="min_age" id="food_min_age" required="">
           @for ($i = 1; $i <=100; $i++)
        <option value="{{ $i }}" <?=($food['min_age'] == $i)?'selected':''?>>{{ $i }}</option>
        @endfor
         </select>
        
        </div>
         <div class="col-md-6 form-group ">
          <label class="names">Max Age:&nbsp;<span style="color:red">*</span></label>
          <select  class="form-select"  name="max_age" id="food_max_age" required="">
            @for ($i = 1; $i <=100; $i++)
        <option value="{{ $i }}" <?=($food['min_age'] == $i)?'selected':''?>>{{ $i }}</option>
        @endfor
         </select>           
         
        </div>
  <div class="col-md-6 form-group ">
    <label class="names">Member Type:&nbsp;<span style="color:red">*</span></label>
    <select  class="form-select" name="memberType" id="FoodmemberType" required="">
      <option value="">Select</option>
      <option value="Member" <?=($food['memberType'] == 'Member')?'selected':''?>>Member</option>
      <option value="NonMember" <?=($food['memberType'] == 'NonMember')?'selected':''?>>NonMember</option>
  </select>
</div>
<div class="col-md-6 form-group ">
    <label class="names">Food Type&nbsp;<span style="color:red">*</span></label>
    <select  class="form-select" name="food_type" id="food_type" required="">
      <option value="">Select</option>
      <option value="Veg-Box" <?=($food['food_type'] == 'Veg-Box')?'selected':''?>>Veg-Box</option>
      <option value="Veg-Banana-Leaf" <?=($food['food_type'] == 'Veg-Banana-Leaf')?'selected':''?>>Veg-Banana-Leaf</option>
       <option value="Non-Veg-Box" <?=($food['food_type'] == 'Non-Veg-Box')?'selected':''?>>Non-Veg-Box</option>
        <option value="Non-Veg-Banana-Leaf" <?=($food['food_type'] == '"Non-Veg-Banana-Leaf')?'selected':''?>>Non-Veg-Banana-Leaf</option>
        <option value="Snack" <?=($food['food_type'] == 'Snack')?'selected':''?>>Snack</option>
  </select>
   <input type="hidden"  name="FoodId" value="{{$food->id}}" required>
</div>

<div class="col-md-6 form-group ">
  <label class="names">Price ($)&nbsp;<span style="color:red">*</span></label>
    <input class="form-control" type="text" name="price" id="FoodticketPrice" maxlength="5"   oninput="getPrice(this.value)" value="{{$food->price}}" required="">
         <span id="lblError" style="color: red"></span>
</div>

   
</div>


                </div>

                <div class="form-group"> 
                    <center>       
                      <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                      <a class="btn btn-warning" href="{{ route('admin.food.list') }}">Cancel</a>
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
      if(Math.abs(price)<='-1')
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
