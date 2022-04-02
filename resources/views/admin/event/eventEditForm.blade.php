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
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">   
    <div class="col-12">

      <div class="row mb-2">
        <div class="col-sm-2">
          <a href="/admin/manageEvent" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
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
              <div class="card-header"><center><strong>Update Event</strong></center></div>
              <div class="card-body">
  <form method="post" action="{{ url('admin/eventUpdate') }}" enctype="multipart/form-data">

    {{ csrf_field() }}

  <input type="hidden" name="id" value="{{ $event['id'] }}">
 <div class="col-md-12">
        <div class="row">
        <div class="form-group col-md-6">
          <label class="names">Event Name&nbsp;<span style="color:red">*</span></label>
            <input type="text" class="form-control"  name="eventName" value="{{ $event['eventName'] }}" required="">
        </div>


        <div class="col-md-6 form-group ">
          <label class="names">Event Description&nbsp;<span style="color:red">*</span></label>
          <input type="text" class="form-control" name="eventDescription" id="comment" value="{{ $event['eventDescription'] }}" required="">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <div class="form-group">
                    <label for="exampleInputFile">Event Picture</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="eventFlyer" id="exampleInputFile" onchange="showname()">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                  </div>
          <div id="editor"></div>
        </div>


        <div class="col-md-6 form-group ">
          <label class="names">Venue&nbsp;<span style="color:red">*</span></label>
          <input class="form-control" type="text" name="eventLocation" value="{{ $event['eventLocation'] }}" required="">
        </div>
      </div>
      <div class="row">
      

        <div class="col-md-6 form-group ">
          <label class="names">Date&nbsp;<span style="color:red">*</span></label>
          <input class="form-control" type="date" name="eventDate" value="{{ $event['eventDate'] }}" required="">
        </div>
        <div class="form-group col-md-6">
          <label class="names">Time&nbsp;<span style="color:red">*</span></label>
            <input class="form-control" type="time" name="eventTime" value="{{ $event['eventTime'] }}">
        </div>
      </div>
      <div class="row">
          <div class="form-group col-md-6">
          <label class="names">Location Link</label>
            <input class="form-control" type="text" name="eventLocationLink" value="{{ $event['eventLocationLink'] }}">
        </div>



       
      </div>
    

      <div class="col-md-offset-2 col-md-12 bottom" >
          <center><input type="submit"  class="next btn btn-primary btn-md" name="Submit" value="Update">
          <a class="next btn btn btn-warning btn-md" href="{{ url('admin/manageEvent') }}">Cancel</a>
        </center>
      </div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</section>
</div>

@if(Auth::user()->job_title=='Admin')
<script language="javascript">
$(document).ready(function()
{ 
       $(document).bind("contextmenu",function(e){
              return false;
       }); 
})
</script>
@endif
<script>
function showname () {
      var name = document.getElementById('exampleInputFile'); 
              document.getElementById('editor').appendChild(document.createTextNode( name.files.item(0).name));
    };
</script>
@endsection