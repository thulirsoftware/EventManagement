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
                  <form class="form-horizontal" action="{{ route('admin.campaign.update') }}" method="POST">
                      {{ csrf_field() }}
      <input type="hidden"  id="campaignId"  name="campaignId"  value="{{$campaign->id}}">

  <div class="row">

     
         <div class="col-md-12 form-group ">
          <label class="names">Name:&nbsp;<span style="color:red">*</span></label>
          <input type="text" class="form-control" id="Name" placeholder="Enter Name"  value="{{$campaign->name}}" name="name" required>       
         
        </div>
         <?php
                  $date =  Carbon\Carbon::tomorrow()->toDateString();
                ?>  
                 <div class="col-md-6 form-group">
                  <label for="start_date">Starting Date:&nbsp;<span style="color:red">*</span></label>
                  <input type="date" class="form-control" id="start_date" placeholder="Enter Start Date" name="start_date"  value="{{$campaign->start_date}}" min="{{$date}}" required>
                </div>
                <div class="col-md-6 form-group">
                  <label for="close_date">End Date:&nbsp;<span style="color:red">*</span></label>
                  <input type="date" class="form-control" id="end_date" placeholder="Enter Close Date" name="end_date" value="{{$campaign->end_date}}" min="{{$date}}" required>
                </div>
          <div class="col-md-12 form-group">
                <label for="Description" >Description:</label>
                
                <textarea class="form-control" name="description" rows="2" cols="30">{{$campaign->description}}
                </textarea>
              </div>
              <div class="col-md-12 form-group">
                <label for="type">Goal:</label>
                <textarea id="editor1" name="goal" rows="15" cols="30">{{$campaign->goal}}
                </textarea>
                
              </div>
             


   
</div>


                </div>

                <div class="form-group"> 
                    <center>       
                      <button type="submit" class="btn btn-primary" name="submit" value="submit">Update</button>
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

@endsection
