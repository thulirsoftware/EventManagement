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
                  <form class="form-horizontal" action="{{ route('admin.sponsorship.update') }}" method="POST" enctype="multipart/form-data">
                      {{ csrf_field() }}
     

  <div class="row" id="row_food0">
<input type="hidden" name="sponsorshipId" class="form-control" value="{{$sponsorship->id}}"required>
 <div class="col-md-12 form-group ">
                    <label class="names">Package Name:&nbsp;<span style="color:red">*</span></label>
                    <input type="text" name="name" class="form-control"  value="{{$sponsorship->name}}" required>
                  </div>
                  <div class="col-md-12 form-group ">
                    <label class="names">Type:&nbsp;<span style="color:red">*</span></label>
                    <select name="type"  class="form-select"  id="package_type" required onchange="getDetails(this.value)" >
                      <option value="">Select Package Type</option>
                      <option value="General" <?=($sponsorship['type'] == 'General')?'selected':''?>>General</option>
                      <option value="Event Sponsor" <?=($sponsorship['type'] == 'Event Sponsor')?'selected':''?>>Event Sponsor</option>
                      <option value="Vendor" <?=($sponsorship['type'] == 'Vendor')?'selected':''?>>Vendor</option>
                    </select>
                  </div>
                  <div class="col-md-12 form-group"  id="event_sponsor" style="display:none">
                  <div class="row">
                     <div class="col-md-12 form-group">
                        <label class="control-label" for="firstName">Select Event:&nbsp;<span style="color:red">*</span></label>
                        <select name="event_id"  class="form-select">
                            <option value="">Select Event</option>
                            @foreach($Events as $event)
                                <option value="{{$event->id}}" <?=($sponsorship['event_id'] == $event->id)?'selected':''?>>{{$event->eventName}}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                </div>
                 <div class="col-md-12 form-group ">
                    <label for="formFile" class="form-label">Choose File</label>
                        <input class="form-control" type="file" id="formFile" name="image"  accept="image/*" >
                  </div>
               
                      <div class="col-md-12 form-group ">
                         <label class="names">Amount: ($)&nbsp;<span style="color:red">*</span></label>
                          <input type="text" name="amount" class="form-control" value="{{$sponsorship->amount}}"required onkeypress="return onlyNumberKey(event)">
                        </div>
                         <div class="col-md-12 form-group ">
                          <label class="names">Benefits:&nbsp;<span style="color:red">*</span></label>
                                        <textarea name="benefits" id="benefits" class="form-control"  required>{{$sponsorship->benefits}}</textarea>
                
                        </div>



                </div>

                <div class="form-group"> 
                    <center>       
                      <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                      <a class="btn btn-warning" href="{{ route('admin.sponsorship.list') }}">Cancel</a>
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
$(function () {
    var value = document.getElementById("package_type").value;
    $("select#package_type").change(getDetails(value));
});

function yourFunction() {
    var marca = $("select#marca option:selected").attr('value');
    $("select#modello").html(attendere);
    $.post("select.php", {id_marca:marca}, function(data){
        $("select#modello").html(data);
    });
}

    function onlyNumberKey(evt) {
          
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>
<script type="text/javascript">
    function getDetails(value)
    {
            console.log(value);

       
            if(value=="Event Sponsor")
            {
                var event_sponsor = document.getElementById("event_sponsor");
                event_sponsor.style.display= "block";
            }
            else
            {
                var event_sponsor = document.getElementById("event_sponsor");
                event_sponsor.style.display= "none";
            }
            
        
    }
</script>
@endsection
