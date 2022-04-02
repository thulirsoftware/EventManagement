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
  	 <div class="card">
              
              <div class="card-body">
              	<div class="row">
           <div class="col-md-4 form-group">
                        <label class="control-label" for="donation_for">Donations For?:</label>
                       <select class="form-select" id="donation_for"  onchange="select(this.value)"  required="">
                            <option value="">Select</option>
                             <option value="C">Campaign</option>
                            <option value="G">General</option>

                        </select>
                    </div>
                     <?php
                             $campaigns = \App\Campaign::get();
                           ?>
                     <div class="col-md-4 form-group"  id="campaign_id_group" style="display:none">
                        <label class="control-label" for="campaign_id">Campaign Name:</label>
                       <select class="form-select" id="campaign_id" >
                            <option value="">Select Campaign Name</option>
                             @foreach($campaigns as $campaign) 
						          <option value="{{$campaign->id}}">{{$campaign->name}}</option>
						                            
						      @endforeach

                        </select>
                    </div>
                    	<div class="col-md-1" style="padding-top:33px">
									<input type="button" value="Search" class="btn btn-primary" onclick="getReports()">
								</div>
								 </div>
              </div>
       </div>
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              
              <div class="card-body table-responsive">
			  <table class="table table-bordered table-striped " id="volunteer_list">
				 <thead>
					<th>Name</th>
					<th>Email</th>
					<th>Mobile No</th>
					<th>Amount</th>
					<th>Address</th>
					<th>City</th>
					<th>Pincode</th>
					<th>Comments</th>
					<th>Payment Status</th>
				 </thead>
				 <tbody id="donationData">

			
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
      	var donation_for = document.getElementById("donation_for");
      	donation_for = donation_for.value;
      	var campaign_id = document.getElementById("campaign_id");
      	campaign_id = campaign_id.value;
      	$.ajax({
          type : 'get',
          url : '{{route('donations.reports.filter')}}',
          data : {'donation_for':donation_for,'campaign_id':campaign_id},
          success:function(data){
          	console.log(data);
           $('#donationData').empty();
           $('#donationData').html(data['Donation']);
         } 
       });
	}
	
	function select(eventName)
  {
      var x = document.getElementById('campaign_id_group');
      if(eventName=='C')
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