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
  	<div class="col-12">

      <div class="row mb-2">
        <div class="col-sm-2">
          <a href="javascript:history.back()" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        <div class="col-md-3">
        </div>
         <div class="col-md-3">
         	<h3>View Family Members</h3>
        </div>
        <div class="col-md-3">
        </div>
        
        
      </div>
    </div>
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              
              <div class="card-body">
			  <table class="table">
				 <thead>
				 	<th>S.No</th>
					<th>Name</th>
					<th>Phone No</th>
					<th>Relationship Type</th>
				 </thead>
				 <tbody>

			<?php $i=1; ?>

				   @foreach($FamilyMember as $member)
			           <tr>
			           	 <td> {{ $i++ }} </td>

			             <td>{{ $member['firstName'] }} {{ $member['lastName'] }}</td>
			             <td>{{ $member['phoneNo'] }}</td>
			             <td>{{ $member['relationshipType'] }}</td>
			            
			             
			           </tr>
			         @endforeach
				</tbody>
			  </table>
</div>
</div>
</div>
</div>
</section>
</div>

@endsection