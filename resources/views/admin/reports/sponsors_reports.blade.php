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
           <div class="col-md-12">
           <div class="card">
             
              <div class="card-body">
                  <div class="row">
           <div class="col-md-4 form-group">
                        <label class="control-label" for="sponsorship_for">Sponsorship For?:</label>
                       <select class="form-select" id="sponsorship_for"  onchange="selectEVent(this.value)"  required="">
                            <option value="">Select</option>
                             <option value="E">Event</option>
                            <option value="G">General</option>

                        </select>
                    </div>
                     <?php
                             $events = \App\Event::get();
                           ?>
                     <div class="col-md-4 form-group"  id="event_id_group" style="display:none">
                        <label class="control-label" for="event_id">Event Name:</label>
                       <select class="form-select" id="event_id" >
                            <option value="">Select Event Name</option>
                             @foreach($events as $event) 
						          <option value="{{$event->id}}">{{$event->eventName}}</option>
						                            
						      @endforeach

                        </select>
                    </div>
                    	<div class="col-md-1" style="padding-top:33px">
									<input type="button" value="Search" class="btn btn-primary" onclick="getReports()">
								</div>
								 </div>
      </div>
      </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              
              <div class="card-body">
			  <table class="table table-bordered table-striped" id="volunteer_list">
				 <thead>
					<th>Name</th>
					<th>Email</th>
					<th>Amount</th>
					<th>Payment Status</th>
				 </thead>
				 <tbody id="sponsorshipr">
                @include('admin.reports.sponsors_reports_filter')
		
				</tbody>
			  </table>
	</div>
</div>
</div>
</div>
</div>
</section>
</div>
<script>
	function getReports()
	{
      	var sponsorship_for = document.getElementById("sponsorship_for");
      	sponsorship_for = sponsorship_for.value;
      	var event_id = document.getElementById("event_id");
      	event_id = event_id.value;
      	$.ajax({
          type : 'get',
          url : '{{route('sponsors.reports.filter')}}',
          data : {'sponsorship_for':sponsorship_for,'event_id':event_id},
          success:function(data){
          	console.log(data);
           $('#sponsorshipr').empty();
           $('#sponsorshipr').html(data['Sponsorships']);
         } 
       });
	}
	
	function selectEVent(eventName)
  {
      var x = document.getElementById('event_id_group');
      if(eventName=='E')
      {
           x.style.display = "block";
      }
      else
      {
           x.style.display = "none";
      }
  }
</script>

@endsection