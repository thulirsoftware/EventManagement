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
                    <label for="Name">Name :</label>
                      <input type="text" class="form-control" id="Name" placeholder="Enter Competition Name" name="Name" required>
                    </div>
                    <div class="col-md-6 form-group">
                    <label for="Description">Member Fees :</label>
                      <input type="text" class="form-control" id="member_fee" placeholder="Enter Member Fee" name="member_fee" required>
                    </div>
                     <div class="col-md-6 form-group">
                    <label for="Description">Non Member Fees :</label>
                      <input type="text" class="form-control" id="non_member_fee" placeholder="Enter Non Member Fee" name="non_member_fee" required>
                    </div>
                  <div class="col-md-6 form-group">
                    <label for="Description">Age Limit :</label>
                      <input type="text" class="form-control" id="age_limit" placeholder="Enter Age Limit" name="age_limit" required>
                    </div>                  
                  
                    <div class="col-md-6 form-group">
                    <label for="Description">Closing Date:</label>
                      <input type="date" class="form-control" id="closing_date" placeholder="Enter Closing Date" name="closing_date" required>
                    </div>

                  <div class="col-md-6 form-group">
                    <label for="type">Type:</label>
                      <select name="competition_type" class="form-control">
                        <option value="group">Group</option>
                        <option value="solo">Solo</option>
                      </select>
                    </div>
                   
                  
                  </div>
                   <div class="col-md-12 form-group">
                    <label for="Description">Awards:</label>
                     
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



@endsection
