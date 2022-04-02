@extends('layouts.admin')

@section('content')
<style>
    .dlk-radio input[type="radio"],
.dlk-radio input[type="checkbox"] 
{
    display:none;
}
.dlk-radio input[type="radio"] + .fa ,
.dlk-radio input[type="checkbox"] + .fa {
     opacity:0.15
}
.dlk-radio input[type="radio"]:checked + .fa,
.dlk-radio input[type="checkbox"]:checked + .fa{
    opacity:1
}
a.disabled {
  pointer-events: none;
  cursor: default;
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
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
        <div class="col-12">
            <div class="row mb-2">
                <div class="col-sm-2">
                  <a href="javascript:history.back()" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-10">
                <form method="post" action="{{ url('admin/Event/createVipTicket') }}">
                    {{ csrf_field() }}    
                    <input type="hidden" name="event_id" value="{{$eventId}}">
                    <div class="card">
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            {{Session::get('success')}}
                        </div>
                    @endif
                    <div class="card-header"><center><strong>Add Vip Tickets</strong></center></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-1">
                              <div class="radio">
                                  <label><input type="radio" value="Vip" class="form-check-input" name="type">&nbsp;&nbsp;Vip</label>
                                </div>
                              
                            </div>
                            <div class="form-group col-md-2">
                              <div class="radio">
                                  <label><input type="radio"  class="form-check-input" name="type" value="Judge">&nbsp;&nbsp;Judge</label>
                                </div>
                              
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="names">For&nbsp;<span style="color:red">*</span></label>
                                <select class="form-control" name="for" onchange="selectType(this.value);">
                                    <option value="">Select</option>
                                    <option value="Event">Event</option>
                                    <option value="Competition">Competition</option>
                                </select>
                            </div>
                             <div class="form-group col-md-6" id="competitionHidden" style="display:none">
                                <label class="names">Competition&nbsp;<span style="color:red">*</span></label>
                                <select class="form-control" name="competition_id">
                                    <option value="">Select Competition</option>
                                    @foreach($competitions as $competition)
                                        <option value="{{$competition->id}}">{{$competition->name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                             <div class="form-group col-md-6">
                                <label class="names">From Time&nbsp;<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="start_time" name="start_time">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="names">To Time&nbsp;<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="end_time" name="end_time">
                            </div>
                             <div class="form-group col-md-6">
                                <label class="names">Name&nbsp;<span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="name">
                            </div>
                             <div class="form-group col-md-6">
                                <label class="names">No Of Entry Tickets&nbsp;<span style="color:red">*</span></label>
                                <input type="number" class="form-control" name="no_entry_tickets">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="names">No Of Food Tickets&nbsp;<span style="color:red">*</span></label>
                                <input type="number" class="form-control" name="no_food_tickets">
                            </div>
                        </div>
                        
                      
                        <div style="overflow:auto;">
                            <center>
                                <button type="submit" class="button nextBtn" id="nextBtn" >Submit</button>
                            </center>
                        </div>
                    </div>
                    </div>
                </form>
          </div>
      </div>
  </div>
</section>
</div>
@endsection
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <!-- Modal -->
<script>
function selectType(type)
{
  console.log(type);
  if(type=="Competition")
  {
    var x =  document.getElementById('competitionHidden');
    x.style.display = "block";
  }
  else
  {
    var x =  document.getElementById('competitionHidden');
    x.style.display = "none";
  }
}
</script>