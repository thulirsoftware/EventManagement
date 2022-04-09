@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
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
									<label>Event</label>
									<select  class="form-select" name="event_name" id="event_name" onchange="selectEvent(this.value)">
						                <option value="">Select Event</option>
						                    @foreach($events as $event) 
						                        <option value="{{$event->id}}">{{$event->eventName}}</option>
						                            
						                     @endforeach
           							 </select>
								</div>
								<div class="col-md-3">
									<label>Competition</label>
									<select  class="form-select" name="competition" id="competition">
						                <option value="">Select competition</option>
						                    
           							 </select>
								</div>
								<div class="col-md-1" style="padding-top:33px">
									<input type="button" value="Submit" class="btn btn-primary" onclick="getReports()">
								</div>
								<div class="col-sm-1" style="padding-top:33px">
								</div>
								<div class="col-sm-1" style="padding-top:33px">
									<a class="btn btn-primary" onclick="exportTableToExcel('competition_report_list','competition_report_list')" style="float:right;cursor: pointer;color:white;"><i class="fa fa-download" aria-hidden="true" ></i></a>
								</div>
							</div>
							</div>
							</div>
					<div class="card">
						
						<div class="card-body">
							<table class="table table-bordered table-striped table-responsive" id="competition_report_list">
								<thead>
									<th>Event Name</th>
									<th>Competition Name</th>
									<th>Group Name</th>
									<th>Participant Name</th>
									<th>Participant Id</th>
									<th>User Email</th>
									<th>Mobile No</th>
									<th>Fees</th>
								</thead>
								<tbody id="competitionreport">
									 @include('admin.reports.competition_reports_filter')
								
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
	function selectEvent(value)
	{
		var substateArray =  @json($eventcompetitionCfg);
    	var filteredArray = substateArray.filter(x => x.event_id == value);
    	$('#competition').empty();
    	$('#competition').append('<option value="">Select competition</option>');
    	var competition = [];

     	var options = filteredArray.forEach( function(item, index){

     		var substateArray1 =  @json($competitionCfg);
    		var filteredArray1 = substateArray1.filter(x => x.id == item.competition_id);
    		 competition.push(filteredArray1); 
            
        });
        var options1 = competition.forEach( function(items, index){
        	$('#competition').append('<option value="'+items[0].id+'">'+items[0].name+'</option>');
        });
        
	}
	function getReports()
	{
		var event_name = document.getElementById("event_name");
      	event_name = event_name.value;
      	var competition = document.getElementById("competition");
      	competition = competition.value;
      	console.log(competition,"competition");
      	$.ajax({
          type : 'get',
          url : '{{route('competition.reports.filter')}}',
          data : {'event_id':event_name,'competition_id':competition},
          success:function(data){
          	console.log(data);
           $('#competitionreport').empty();
           $('#competitionreport').html(data['competitions']);
         } 
       });
	}
</script>
@endsection