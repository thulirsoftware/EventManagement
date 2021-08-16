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
                  <a href="/admin/Entry/List" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
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
                  <form class="form-horizontal" action="{{ route('admin.entry.update') }}" method="POST">
                      {{ csrf_field() }}
     
  <div id="food-list"></div>

  <div class="row" id="row_food0">

      <div class="col-md-6 form-group ">
         <label class="names">Min Age:&nbsp;<span style="color:red">*</span></label>
        <select class="form-control"  name="min_age" id="food_min_age">
           @for ($i = 0; $i <=100; $i++)
        <option value="{{ $i }}" <?=($entry['min_age'] == $i)?'selected':''?>>{{ $i }}</option>
        @endfor
         </select>
        
        </div>
         <div class="col-md-6 form-group ">
          <label class="names">Max Age:&nbsp;<span style="color:red">*</span></label>
          <select class="form-control"  name="max_age" id="food_max_age">
            @for ($i = 0; $i <=100; $i++)
        <option value="{{ $i }}" <?=($entry['min_age'] == $i)?'selected':''?>>{{ $i }}</option>
        @endfor
         </select>           
         
        </div>
  <div class="col-md-6 form-group ">
    <label class="names">Member Type:&nbsp;<span style="color:red">*</span></label>
    <select class="form-control" name="member_type" id="FoodmemberType">
      <option value="">Select</option>
      <option value="Member" <?=($entry['member_type'] == 'Member')?'selected':''?>>Member</option>
      <option value="NonMember" <?=($entry['member_type'] == 'NonMember')?'selected':''?>>NonMember</option>
  </select>
</div>
 
   <input type="hidden"  name="EntryId" value="{{$entry->id}}" required>

<div class="col-md-6 form-group ">
  <label class="names">Price ($)&nbsp;<span style="color:red">*</span></label>
    <input class="form-control" type="text" name="price" id="FoodticketPrice"  value="{{$entry->price}}">
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
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
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
</script>

@endsection
