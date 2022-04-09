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
									<label>Event Name</label>
									<select  class="form-select" name="event_name" id="event_name">
						                <option value="">Select Event name</option>
						                    @foreach($events as $event) 
						                        <option value="{{$event->id}}">{{$event->eventName}}</option>
						                            
						                     @endforeach
           							 </select>
								</div>
							
								<div class="col-md-2">
									<label>Users</label>
									<select  class="form-select" name="user_id" id="user_id">
						                <option value="">Select User</option>
						                    @foreach($purchased_users as $purchased_user) 
						                        <option value="{{$purchased_user->id}}">{{$purchased_user->name}}</option>
						                            
						                     @endforeach
           							 </select>
								</div>
								<div class="col-md-2">
									<label>Food Type</label>
									<select  class="form-select" name="food_type" id="food_type" required="">
								      <option value="">Select</option>
								      <option value="Veg-Box">Veg-Box</option>
								      <option value="Veg-Banana-Leaf">Veg-Banana-Leaf</option>
								       <option value="Non-Veg-Box">Non-Veg-Box</option>
								        <option value="Non-Veg-Banana-Leaf">Non-Veg-Banana-Leaf</option>
								        <option value="Snack">Snack</option>
								  </select>
								</div>
								
								<div class="col-md-1" style="padding-top:33px">
									<input type="button" value="Submit" class="btn btn-primary" onclick="getFoodReports()">
								</div>
								<div class="col-sm-1" style="padding-top:33px">
								</div>
								<div class="col-sm-1" style="padding-top:33px">
						<a class="btn btn-primary" onclick="exportTableToExcel('food_report_list','food_report_list')" style="float:right;cursor: pointer;color:white;"><i class="fa fa-download" aria-hidden="true" ></i></a>
					</div>
							</div>
							</div>
							</div>
					<div class="card">
						
						<div class="card-body">
							<table class="table table-bordered table-striped table-responsive" id="food_report_list">
								<thead>
									<th>S.No</th>
									<th>Event Name</th>
									<th>Event Date</th>
									<th>Name</th>
									<th>Email</th>
									<th>Mobile No</th>
									<th>Age Group</th>
									<th>Food Type</th>
									<th>Qty</th>
									<th>Ticket Amount</th>
								</thead>
								<tbody id="foodreport">

								
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
	function getFoodReports()
	{
		var event_name = document.getElementById("event_name");
      	event_name = event_name.value;
      
      	var user_id = document.getElementById("user_id");
      	user_id = user_id.value;
      	var food_type = document.getElementById("food_type");
      	food_type = food_type.value;
      	$.ajax({
          type : 'get',
          url : '{{route('foodticket.reports.filter')}}',
          data : {'event_name':event_name,'event_date':null,'user_id':user_id,'food_type':food_type},
          success:function(data){
          	console.log(data);
           $('#foodreport').empty();
           $('#foodreport').html(data['FoodTickets']);
         } 
       });
	}
</script>
@endsection