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
							<table class="table table-bordered table-striped" id="members_list">
								<thead>
									<th>S.No</th>
									
									<th>Member Id</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone No</th>
									<th>Address</th>
									<th>Action</th>
								</thead>
								<tbody>

									<?php $i=1; ?>

									@foreach($members as $member)
									<tr>
										<td> {{ $i++ }} </td>
										<td>{{ $member['Member_Id'] }}</td>
										<td>{{ $member['firstName'] }} {{ $member['lastName'] }}</td>
										<td>{{ $member['Email_Id'] }}</td>
										<td>{{ $member['mobile_number'] }}</td>
										<td>{{ $member['addressLine1'] }}</td>
										<td><a href="/admin/viewFamilyMember/{{ $member['user_id'] }}" ><i class="fa fa-eye fa-lg" style="text-align:center;"></i></a>&nbsp;&nbsp;
											<a href="/admin/Member/EditMembership/{{ $member['user_id'] }}" ><i class="fa fa-edit fa-md" style="text-align:center;"></i></a></td>
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
@endsection