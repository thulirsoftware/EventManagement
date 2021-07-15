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
                  <form class="form-horizontal" action="{{ route('admin.competition.update') }}" method="POST">
                      {{ csrf_field() }}
                             <input type="hidden"  name="id" value="{{ $competition['id'] }}">   
                               <?php
                        $date =  Carbon\Carbon::tomorrow()->toDateString();
                    ?>   
                <div class="row">
                  <div class="col-md-6 form-group">
                    <label for="Name">Name :&nbsp;<span style="color:red">*</span></label>
                      <input type="text" class="form-control" id="Name" placeholder="Enter Competition Name" name="Name" value="{{ $competition['name'] }}" required>
                    </div>
                    
                  <div class="col-md-6 form-group">
                    <label for="Description">Age Limit :&nbsp;<span style="color:red">*</span></label>
                      <input type="text" class="form-control" id="age_limit" placeholder="Enter Age Limit" name="age_limit" value="{{ $competition['age_limit'] }}" required>
                    </div>                  
                  <div class="col-md-6 form-group">
                    <label for="Description">Starting Date:&nbsp;<span style="color:red">*</span></label>
                      <input type="date" class="form-control" id="Date" placeholder="Enter Starting Date" name="starting_date"  value="{{ $competition['starting_date'] }}" min="{{$date}}" required>
                    </div>
                    <div class="col-md-6 form-group">
                    <label for="Description">Closing Date:&nbsp;<span style="color:red">*</span></label>
                      <input type="date" class="form-control" id="closing_date" placeholder="Enter Closing Date" name="closing_date" value="{{ $competition['closing_date'] }}" min="{{$date}}" required>
                    </div>

                  <div class="col-md-6 form-group">
                    <label for="type">Type:&nbsp;<span style="color:red">*</span></label>
                      <select name="competition_type" class="form-control">
                        <option value="group"  <?=($competition['competition_type'] == 'group')?'selected':''?>>Group</option>
                        <option value="solo"  <?=($competition['competition_type'] == 'solo')?'selected':''?>>Solo</option>
                      </select>
                    </div>
                   
                  
                  </div>
                   <div class="col-md-12 form-group">
                    <label for="Description">Awards:&nbsp;<span style="color:red">*</span></label>
                     
                       <textarea class="form-control" name="awards" rows="2" cols="30">{{ $competition['awards'] }}
                    </textarea>
                    </div>
                    <div class="col-md-12 form-group">
                    <label for="type">Instruction:</label>
                      <textarea id="editor1" name="instruction" rows="15" cols="30">{{ $competition['instruction'] }}
                    </textarea>
                
                    </div>
                   

                  <div class="form-group"> 
                    <center>       
                      <button type="submit" class="btn btn-primary" name="submit" value="submit">Update</button>
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
