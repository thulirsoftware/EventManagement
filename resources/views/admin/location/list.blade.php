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

          <div class="add-button" >
            <a class="btn btn-primary btn-sm" style="float:right;color:white" href="{{ route('admin.location.add') }}" >Add Location</a> 
        </div><br><br>
        <div class="card">
            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              {{Session::get('success')}}
          </div>
          @endif
          <div class="card-body">


              <table class="table table-bordered table-striped" id="location_list">
                <thead>
                  <tr>
                    <th>S.No</th>
                     <th>Location</th>
                    <th>Status</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>  
              @foreach($locations as $location)
              <tr>

                <td>{{ $i++ }}</td>


                <td>{{ $location['location_name'] }}</td>
                @if($location['status']=="Y")
                <td><span class="badge badge-success">Yes</span></td>
                @else
                <td><span class="badge badge-danger">No</span></td>
                @endif
                
                <td><a class="btn btn-primary" href="{{ route('admin.location.edit', ['id' => $location['id']]) }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a>&nbsp;&nbsp;<a class="btn btn-warning" onclick="Delete({{$location['id']}})" style="color:white"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>

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
<script>
    function Delete (value) {
      if (confirm("Are your sure you want to delete the location?")) {
        $.ajax({
            type : 'get',
            url : '{{route('admin.location.delete')}}',
            data : {'locationId':value},
            success:function(data){
              window.location.reload();
          } 
      });

    } else {
     
    }
}
</script>