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
            <a href="{{ route('admin.competition.list') }}" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
          </div>
          
        </div>
      </div>
      <div class="row">
       
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
          <div class="card">
           
            <div class="card-body">
              <form class="form-horizontal" action="{{ route('admin.competition.save') }}" method="POST">
                {{ csrf_field() }}
                

                <div class="row">
                  <div class="col-md-6 form-group">
                    <label for="Name">Name :&nbsp;<span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="Name" placeholder="Enter Competition Name" name="Name" required>
                  </div>
                   <div class="col-md-6 form-group">
                  <label for="type">Type:&nbsp;<span style="color:red">*</span></label>

                  <select name="competition_type"  class="form-select" required>
                    <option value="">Select Type</option>
                    <option value="group">Group</option>
                    <option value="solo">Solo</option>
                  </select>
                </div>
                  
                  <div class="col-md-6 form-group">
                    <label for="Description">Min Age :&nbsp;<span style="color:red">*</span></label>
                    <input type="number" class="form-control" id="age_limit" placeholder="Enter Min Age" name="age_limit" required>
                  </div>  
                  <div class="col-md-6 form-group">
                    <label for="Description">Max Age:&nbsp;<span style="color:red">*</span></label>
                    <input type="number" class="form-control" id="max_age" placeholder="Enter Max Age" name="max_age" required>
                  </div>    
                  <?php
                  $date =  Carbon\Carbon::tomorrow()->toDateString();
                ?>              
                <div class="col-md-6 form-group">
                  <label for="Description">Starting Date:&nbsp;<span style="color:red">*</span></label>
                  <input type="date" class="form-control" id="Date" placeholder="Enter Starting Date" name="starting_date" min="{{$date}}" required>
                </div>
                <div class="col-md-6 form-group">
                  <label for="Description">Closing Date:&nbsp;<span style="color:red">*</span></label>
                  <input type="date" class="form-control" id="closing_date" placeholder="Enter Closing Date" name="closing_date" min="{{$date}}" required>
                </div>

               
               
                <div class="col-md-6 form-group">
                <label for="Description">Member Fees : ($)&nbsp;<span style="color:red">*</span></label>
                <input type="text" class="form-control" id="member_fee" name="member_fee" required maxlength="5"   oninput="getPrice(this.value)">
                 <p id="member_fee_error" style="color:red"></p>
            </div>
           <div class="col-md-6 form-group">
                    <label for="Description">Non Member Fees :($)&nbsp;<span style="color:red">*</span></label>
                      <input type="text" class="form-control" id="non_member_fee" name="non_member_fee" maxlength="5"   oninput="getNonMemberPrice(this.value)" required>
                       <p id="non_member_fee_error" style="color:red"></p>
            </div>
                
                
              </div>
              <div class="col-md-12 form-group">
                <label for="Description" >Awards:</label>
                
                <textarea class="form-control" name="awards" rows="2" cols="30">
                </textarea>
              </div>
              <div class="col-md-12 form-group">
                <label for="type">Instruction:</label>
                <textarea id="editor1" name="instruction" rows="15" cols="30">
                </textarea>
                
              </div>
              

              <div class="form-group"> 
                <center>       
                  <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                  <a class="btn btn-warning" href="{{ route('admin.competition.list') }}">Cancel</a>
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

<script>
     function getPrice(price)
  {
      
      var lblError = document.getElementById("member_fee_error");
      if(Math.abs(price)<='-1')
      {
          var FoodticketPrice = document.getElementById("member_fee");
            FoodticketPrice.value='';
           lblError.innerHTML = "Must enter valid price";
      }
      else
      {
            lblError.innerHTML = "";
         
      }
  }
function getNonMemberPrice(price)
  {
      
      var lblError = document.getElementById("non_member_fee_error");
      if(Math.abs(price)<='-1')
      {
          var FoodticketPrice = document.getElementById("non_member_fee");
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
