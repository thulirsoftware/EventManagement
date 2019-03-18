@extends('layouts.user')

@section('content')
<style>
th{
	padding:15px;
	font-size: 20px;
	font-weight: bold;
	color:brown;
	text-align: center;
}
td{
	padding:15px;
	font-size: 16px;
	color:black;
}
</style>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<div class="container col-md-offset-4 col-md-8">


  <?php
   $tagDvId = Auth::user()->tagDvid;
  ?> 

  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Family Members</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="">
        <div class="modal-header" style="background-color: #ff6100;color:black">
          <button type="button" class="close" data-dismiss="modal"><span style="color:black;font-size: 30px;">&times;</span></button>
          <h4 class="modal-title">Add Family Members</h4>
        </div>
        
       
        <div class="modal-body" style="background-color: #f9f7c7">

         <form method="post" action="{{ url('addFamilyMembers') }}">
              {{ csrf_field() }}
          <input type="hidden" name="tagDvId" value={{ $tagDvId }}>

         <div class="col-md-offset-2 col-md-3">First Name:</div>
         <div class="col-md-3"><input type="text" name="firstName"></div><br><br>

         <div class="col-md-offset-2 col-md-3">Last Name:</div><div class="col-md-3"><input type="text" name="lastName"></div><br><br>

         <div class="col-md-offset-2 col-md-3">Relationship:</div><div class="col-md-3"><input type="text" name="relationshipType"></div><br><br>

         <div class="col-md-offset-2 col-md-3">PhoneNo:</div><div class="col-md-3"><input type="text" name="phoneNo"></div><br><br>

         <div class="col-md-offset-2 col-md-3">DOB</div><div class="col-md-3"><input type="date" name="dob"></div><br><br>

         <div class="col-md-offset-2 col-md-3">School Name:</div><div class="col-md-3"><input type="text" name="schoolName"></div><br><br><br><br>

         <div class="col-md-offset-5"><input type="submit" style="background-color: #ff6100;color:black;padding:7px" name="submit"></div>

         </form>
        </div>
        
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" style="background-color: #ff6100;color:black" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>



<div class="col-md-offset-3 col-md-9" style="background-color: #f2edb5">
	<div style="background-color:#f2edb5;color:brown">
	  <table width="100%">
		 <thead>
			<th>SI.No</th>
      <th>First Name</th>
			<th>Last Name</th>
			<th>Relationship</th>
			<th>Phone No</th>
			<th>DOB</th>
			<th>School Name</th>
      <th>Edit</th>
      <th>Delete</th>
		 </thead>
		 <tbody>
<?php $i=1; ?> 
        @foreach($familyMembers as $family)
          <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $family['firstName'] }}</td>
            <td>{{ $family['lastName'] }}</td>
            <td>{{ $family['relationshipType'] }}</td>
            <td>{{ $family['phoneNo'] }}</td>
            <td>{{ $family['dob'] }}</td>
            <td>{{ $family['schoolName'] }}</td>
            <td><a href="/familyEdit/{{ $family['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
            <td><a href="/familyDelete/{{ $family['id'] }}" ><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
          </tr>
        @endforeach

		</tbody>
	  </table>
	</div>
</div>









@endsection