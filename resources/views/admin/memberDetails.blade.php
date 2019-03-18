@extends('layouts.admin')

@section('content')
<style>
th{
	padding:15px;
	font-size: 20px;
	font-weight: bold;
	color:brown;
}
td{
	padding:15px;
	font-size: 16px;
	color:black;
}
</style>
<div class="col-md-offset-3 col-md-9" style="background-color: #f2edb5">
	<div style="background-color:#f2edb5">
	  <table width="100%">
		 <thead>
			<th>TagDvId</th>
			<th>Name</th>
			<th>Email</th>
			<th>Phone No</th>
			<th>Address</th>
			<th>Gender</th>
			<th>Dob</th>
			<th>Status</th>
			<th>Membership</th>
			<th>Expiry</th>
		 </thead>
		 <tbody>
		   @foreach($members as $member)
	           <tr>
	             <td>{{ $member['tagDvId'] }}</td>
	             <td>{{ $member['firstName'] }}</td>
	             <td>{{ $member['primaryEmail'] }}</td>
	             <td>{{ $member['phoneNo1'] }}</td>
	             <td>{{ $member['addressLine1'] }}</td>
	             <td>{{ $member['gender'] }}</td>
	             <td>{{ $member['dob'] }}</td>
	             <td>{{ $member['maritalStatus'] }}</td>
	             <td>{{ $member['membershipType'] }}</td>
	             <td>{{ $member['membershipExpiryDate'] }}</td>
	           </tr>
	         @endforeach
		</tbody>
	  </table>
	</div>
</div>


@endsection