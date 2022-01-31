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
					<th>Amount</th>
					<th>Payment Status</th>
				 </thead>
				 <tbody>

			<?php $i=1; 

			?>

				   @foreach($Sponsorship as $Sponsorship)
				   	 	<?php
				   	 		$user = App\User::where('id',$Sponsorship->user_id)->first();
				   	 		?>
			           <tr>

			             <td>{{ $user->name }}</td>
			              <td>{{ $user->email }}</td>
			              <td>{{ $Sponsorship->amount }}</td>
			              
			             	<td>{{ $Sponsorship->payment_status }}</td>
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