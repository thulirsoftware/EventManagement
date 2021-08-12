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
            <a class="btn btn-primary btn-sm" style="float:right;color:white" href="{{ route('admin.food.add') }}" >Add Food</a> 
        </div><br><br>
        <div class="card">
            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              {{Session::get('success')}}
          </div>
          @endif
          <div class="card-body">


              <table class="table table-bordered table-striped" id="Food_list">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Min Age</th>
                    <th>Max Age</th>
                     <th>Member Type</th>
                     <th>Food Type</th>
                    <th>Amount</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>  
              @foreach($foods as $food)
              <tr>

                <td>{{ $i++ }}</td>

                <td>{{ $food['min_age'] }}</td>
                <td>{{ $food['max_age'] }}</td>
                <td>{{ $food['memberType'] }}</td>
                <td>{{ $food['food_type'] }}</td>
                <td>${{ $food['price'] }}</td>
                
                <td><a class="btn btn-primary" href="{{ route('admin.food.edit', ['id' => $food['id']]) }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a>&nbsp;&nbsp;<a class="btn btn-warning" onclick="Delete({{$food['id']}})" style="color:black"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>

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
            url : '{{route('admin.food.delete')}}',
            data : {'foodId':value},
            success:function(data){
              window.location.reload();
          } 
      });

    } else {
     
    }
}
</script>