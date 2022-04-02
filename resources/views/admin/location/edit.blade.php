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
                  <a href="/admin/Location/List" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
              </div>

          </div>
      </div>
      <div class="row">

        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="card">

              <div class="card-body">
                  <form class="form-horizontal" action="{{ route('admin.location.update') }}" method="POST">
                      {{ csrf_field() }}


                      <div class="row">
                          <div class="col-md-12 form-group">
                            <label for="location_name">Location Name :&nbsp;<span style="color:red">* </span></label>
                            <input type="text" class="form-control" id="location_name" placeholder="Enter Location Name" name="location_name" value="{{$Location->location_name}}"required>
                        </div>
                        <input type="hidden"  name="LocationId" value="{{$Location->id}}"required>
                        

                        
                    </div>
                      <div class="row">
                          <div class="col-md-6 form-group">
                            <label for="location_name">Duration From :&nbsp;<span style="color:red">* </span></label>
                            <input type="text" class="form-control" id="duration_from_edit"  name="duration_from" value="{{$Location->duration_from}}" required>
                        </div>
                         <div class="col-md-6 form-group">
                            <label for="location_name">Duration To :&nbsp;<span style="color:red">* </span></label>
                            <input type="text" class="form-control" value="{{$Location->duration_to}}" id="duration_to_edit"  name="duration_to" required>
                        </div>

                     

                  
                </div>
                   <div class="row">
                        
                      <div class="col-md-12 form-group">
                        <label for="location_for">For:&nbsp;<span style="color:red">* </span></label>
                        <select name="location_for"  class="form-select">
                            <option value="E" <?=($Location['location_for'] == 'E')?'selected':''?>>Event</option>
                            <option value="C" <?=($Location['location_for'] == 'C')?'selected':''?>>Competition</option>
                            <option value="B" <?=($Location['location_for'] == 'B')?'selected':''?>>Both</option>

                        </select>
                    </div>

                </div>
                    <div class="row">
                        
                      <div class="col-md-12 form-group">
                        <label for="status">Active:&nbsp;<span style="color:red">* </span></label>
                        <select name="status"  class="form-select">
                            <option value="Y" <?=($Location['is_visible'] == 'Y')?'selected':''?>>Yes</option>
                            <option value="N" <?=($Location['is_visible'] == 'N')?'selected':''?>>No</option>
                        </select>
                    </div>

                </div>


                <div class="form-group"> 
                    <center>       
                      <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                      <a class="btn btn-warning" href="{{ route('admin.location.list') }}">Cancel</a>
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
