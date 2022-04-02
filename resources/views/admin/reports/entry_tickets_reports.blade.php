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
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-3">
									<label>Event Name</label>
									<select  class="form-select" name="event_name" id="event_name" >
						                <option value="">Select Event name</option>
						                    @foreach($events as $event) 
						                        <option value="{{$event->id}}">{{$event->eventName}}</option>
						                            
						                     @endforeach
           							 </select>
								</div>
								<div class="col-md-3">
									<label>Competition Name</label>
									<select  class="form-select" name="competition_id" id="competition_id">
						                 <option value="">Select Competition</option>
						                    @foreach($Competitions as $Competition) 
						                        <option value="{{$Competition->id}}">{{$Competition->name}}</option>
						                            
						                     @endforeach
           							 </select>
								</div>
								<div class="col-md-3">
									<label>Users</label>
									<select  class="form-select" name="user_id" id="user_id">
						                <option value="">Select User</option>
						                    @foreach($purchased_users as $purchased_user) 
						                        <option value="{{$purchased_user->id}}">{{$purchased_user->name}}</option>
						                            
						                     @endforeach
           							 </select>
								</div>
								
								<div class="col-md-1" style="padding-top:33px">
									<input type="button" value="Submit" class="btn btn-primary" onclick="getEntryReports()">
								</div>
								<div class="col-sm-1" style="padding-top:33px">
								</div>
								<div class="col-sm-1" style="padding-top:33px">
						<a class="btn btn-primary" onclick="exportTableToExcel('food_entry_list','food_entry_list')" style="float:right;cursor: pointer;color:white;"><i class="fa fa-download" aria-hidden="true" ></i></a>
					</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="card">

						<div class="card-body">
							<table class="table table-bordered table-striped" id="food_entry_list">
								<thead>
									<th>S.No</th>
									<th>Event Name</th>
									<th>Event Date</th>
									<th>User Name</th>
									<th>Age Group</th>
									<th>Qty</th>
									<th>Ticket Amount</th>
								</thead>
								<tbody id="entryreport">
									
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
	function getEntryReports()
	{
		var event_name = document.getElementById("event_name");
      	event_name = event_name.value;
      	var competition_id = document.getElementById("competition_id");
      	competition_id = competition_id.value;
      	console.log(competition_id);
      	var user_id = document.getElementById("user_id");
      	user_id = user_id.value;
      	$.ajax({
          type : 'get',
          url : '{{route('entryticket.reports.filter')}}',
          data : {'event_name':event_name,'competition_id':competition_id,'user_id':user_id},
          success:function(data){
           $('#entryreport').empty();
           $('#entryreport').html(data['EntryTickets']);
         } 
       });
	}

	function selectEVent(eventId)
	{
		var substateArray1 =  @json($eventCompetitions);
        var filteredArray1 = substateArray1.filter(x => x.event_id == eventId);
        const competitions = [];
         $.each(filteredArray1, function(key, value) { 

         		var substateArray2 =  @json($Competitions);
        		var filteredArray2 = substateArray2.filter(x => x.id == value.competition_id);
        		 competitions.push(filteredArray2[0]); 

         });
          $('#competition_id').empty();
           $('#competition_id')
        			 .append($("<option></option>")
                    .attr("value","")
                    .text("Select Competition"));
         $.each(competitions, function(key, value) { 
         		console.log(value,"value");
         		  $('#competition_id')
        			 .append($("<option></option>")
                    .attr("value", value.id)
                    .text(value.name)); 
         });
        
	}
</script>

@endsection