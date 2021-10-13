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
			  <table class="table table-bordered table-striped" id="volunteer_list">
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
				 <tbody>

			<?php $i=1; 

			?>

				   @foreach($Donation as $Donation)
				   	 
			           <tr>

			             <td>{{ $Donation['name'] }}</td>
			             <td>{{ $Donation['email'] }}</td>
			            <td>{{ $Donation['mobile_no'] }}</td>
			             <td>{{ $Donation['amount'] }}</td>
			             <td>{{ $Donation['address'] }}</td>
			              
			             <td>{{ $Donation['city'] }}</td>
			             <td>{{ $Donation['pincode'] }}</td>
			             <td>{{ $Donation['comments'] }}</td>
			             <td>Pending</td>

			           </tr>
			         @endforeach
				</tbody>
			  </table>
	</div>
</div>
</div>
</div>
</div>
</section>
</div>

@endsection