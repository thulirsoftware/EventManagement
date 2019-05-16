@extends('layouts.user')

@section('content')
<style>
th{
	padding:25px;
	font-size: 17px;
	font-weight: bold;
	color:brown;
	text-align: center;
}
td{
	padding:15px;
	font-size: 14px;
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

<div class="container col-md-offset-4 col-md-8" style="margin-top:-50px">


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
        <div class="modal-header" style="background-color: #ff6100;color:black;margin-bottom:15px">
          <button type="button" class="close" data-dismiss="modal"><span style="color:black;font-size: 16px;">&times;</span></button>
          <h5 class="modal-title">Add Family Members</h5>
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


    <?php 
        $schools = App\School::pluck('name');
    ?>

         <div class="col-md-offset-2 col-md-3">School Name:</div><div class="col-md-3">
          {{-- <input type="text" name="schoolName"> --}}
          <select name="schoolName" style="width: 150px;height: 30px;border-radius: 4px;background-color: white" required="">
            <option value="">None</option>
            @foreach($schools as $key => $school)
              <option value="{{ $school }}">{{ $school }}</option>
            @endforeach
          </select>
        </div><br><br><br><br>

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



<div class="col-md-offset-3 col-md-9">
	<div style="background-color:#f2edb5;color:brown">
	  <table width="100%" style="border:1px solid grey" >
		 <thead style="background-color:brown;font-weight:bold;text-align:center;height:30%;border:1px solid grey">
			<th style="color:white;padding:15px;border:1px solid grey">SI.No</th>
            <th style="color:white;border:1px solid grey;text-align:center">First Name</th>
			<th style="color:white;border:1px solid grey;text-align:center">Last Name</th>
			<th style="color:white;border:1px solid grey;text-align:center">Relationship</th>
			<th style="color:white;border:1px solid grey;text-align:center">Phone No</th>
			<th style="color:white;border:1px solid grey;text-align:center">DOB</th>
			<th style="color:white;border:1px solid grey;text-align:center">School Name</th>
            <th style="color:white;border:1px solid grey;text-align:center">Edit</th>
            <th style="color:white;border:1px solid grey;text-align:center">Delete</th>
		 </thead>
		 <tbody>
<?php $i=1; ?> 
        @foreach($familyMembers as $family)
          <tr>
            <td style="padding:15px;border:1px solid grey;text-align:center">{{ $i++ }}</td>
            <td style="padding:15px;border:1px solid grey;text-align:center">{{ $family['firstName'] }}</td>
            <td style="padding:15px;border:1px solid grey;text-align:center">{{ $family['lastName'] }}</td>
            <td style="padding:15px;border:1px solid grey;text-align:center">{{ $family['relationshipType'] }}</td>
            <td style="padding:15px;border:1px solid grey;text-align:center">{{ $family['phoneNo'] }}</td>
            <td style="padding:15px;border:1px solid grey;text-align:center">{{ $family['dob'] }}</td>
            <td style="padding:15px;border:1px solid grey;text-align:center">{{ $family['schoolName'] }}</td>
            <td style="padding:15px;border:1px solid grey;text-align:center"><a href="/familyEdit/{{ $family['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
            <td style="padding:15px;border:1px solid grey;text-align:center"><a href="/familyDelete/{{ $family['id'] }}" ><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
          </tr>
        @endforeach

		</tbody>
	  </table>
	</div>
</div>









@endsection