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
			  <table class="table table">
				 <thead>
					<th>Name</th>
					<th>Email</th>
					<th>Mobile No</th>
					<th>Youth Volunteer</th>
					<th>Email Group</th>
					<th style="width:250px">Opportunities</th>
					<th>Comments</th>
				 </thead>
				 <tbody>

			<?php $i=1; 

			?>

				   @foreach($Volunteers as $Volunteer)
				   	 <?php
                       $string = str_replace(",","</li>",$Volunteer['opportunities']);
                       $str_arr = explode (",", $Volunteer['opportunities']); 
                      ?>
			           <tr>

			             <td>{{ $Volunteer['name'] }}</td>
			              <td>{{ $Volunteer['email'] }}</td>
			             <td>{{ $Volunteer['mobile_number'] }}</td>
			              <td>{{ $Volunteer['youth_volunteer'] }}</td>
			              <td>{{ $Volunteer['email_group'] }}</td>
			               <td style="width:250px">
			               	<ul>
			               		@foreach($str_arr as $str_arr)
			               		@if($str_arr!=" ")
			               		<li>{{$str_arr}} </li>
			               		@endif
			               			@endforeach
			               		</ul>
			               </td>
			             	<td>{{ $Volunteer['comments'] }}</td>
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