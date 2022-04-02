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

          <div class="add-button" >
            <a class="btn btn-primary btn-sm" style="float:right;color:white" href="{{ route('admin.sponsorship.add') }}" >Add Sponsorship</a> 
        </div><br><br>
        <div class="card">
            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              {{Session::get('success')}}
          </div>
          @endif
          <div class="card-body">


              <table class="table table-bordered table-striped" id="sponsorship_list">
                <thead>
                  <tr>
                    <th>S.No</th>
                     <th>Package Name</th>
                      <th>Type</th>
                    <th>Amount</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>  
              @foreach($sponsorship as $sponsorship)
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $sponsorship['name'] }}</td>
                <td>{{ $sponsorship['type'] }}</td>
                <td>${{ $sponsorship['amount'] }}</td>
                <td><a class="btn btn-primary" href="{{ route('admin.sponsorship.edit', ['id' => $sponsorship['id']]) }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a>&nbsp;&nbsp;<a class="btn btn-warning" onclick="Delete({{$sponsorship['id']}})" style="color:black"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>

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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    function Delete (value) {
      if (confirm("Are your sure you want to delete the sponsorship?")) {
        $.ajax({
            type : 'get',
            url : '{{route('admin.sponsorship.delete')}}',
            data : {'sponsorshipId':value},
            success:function(data){
              window.location.reload();
          } 
      });

    } else {
     
    }
}
</script>