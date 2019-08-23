@extends('layouts.admin')

@section('content')
<style>
th{
	padding:10px;
	font-size: 16px;
	font-weight: bold;
	color:brown;
}
td{
	padding:8px;
	font-size: 14px;
	color:black;
}
</style>
<div class="col-md-offset-3 ">
	<div>
	  <table style="width:50%;margin-left:-50px">
		 <thead style="background-color:brown">
		 	<th style="padding:15px;border:1px solid grey;color:white">S.No</th>
		 	<th style="padding:15px;border:1px solid grey;color:white">Edit</th>
			<th style="padding:15px;border:1px solid grey;color:white">TagDvId</th>
			<th style="padding:15px;border:1px solid grey;color:white">Name</th>
			<th style="padding:15px;border:1px solid grey;color:white">Email</th>
			<th style="padding:15px;border:1px solid grey;color:white">Phone No</th>
			<th style="padding:15px;border:1px solid grey;color:white">Address</th>
			<th style="padding:15px;border:1px solid grey;color:white">Gender</th>
			<th style="padding:15px;border:1px solid grey;color:white">Dob</th>
			<th style="padding:15px;border:1px solid grey;color:white">Status</th>
			<th style="padding:15px;border:1px solid grey;color:white">Membership</th>
			<th style="padding:15px;border:1px solid grey;color:white">Expiry</th>
		 </thead>
		 <tbody style="background-color:#f3f4c6">

	<?php $i=1; ?>

		   @foreach($members as $member)
	           <tr>
	           	 <td style="padding:15px;text-align:center;border:1px solid grey;"> {{ $i++ }} </td>

	           	 <td style="padding:15px;text-align:center;border:1px solid grey;"><a href="/admin/editMember/{{ $member['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>

	             <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $member['tagDvId'] }}</td>
	             <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $member['firstName'] }} {{ $member['lastName'] }}</td>
	             <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $member['primaryEmail'] }}</td>
	             <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $member['phoneNo1'] }}</td>
	             <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $member['addressLine1'] }}</td>
	             <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $member['gender'] }}</td>
	             <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $member['dob'] }}</td>
	             <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $member['maritalStatus'] }}</td>
	             <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $member['membershipType'] }}</td>
	             <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $member['membershipExpiryDate'] }}</td>
	           </tr>
	         @endforeach
		</tbody>
	  </table>
	</div>
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