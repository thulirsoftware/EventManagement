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
            <a class="btn btn-primary btn-sm" style="float:right;color:white" href="{{ route('admin.entry.add') }}" >Add Entry</a> 
        </div><br><br>
        <div class="card">
            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              {{Session::get('success')}}
          </div>
          @endif
          <div class="card-body">


              <table class="table table-bordered table-striped" id="entry_cfg_list">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Min Age</th>
                    <th>Max Age</th>
                    <th>Member Type</th>
                    <th>Amount</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>  
              @foreach($entries as $entry)
              <tr>

                <td>{{ $i++ }}</td>

                <td>{{ $entry['min_age'] }}</td>
                <td>{{ $entry['max_age'] }}</td>
                <td>{{ $entry['member_type'] }}</td>
                <td>${{ $entry['price'] }}</td>
                
                <td><a class="btn btn-primary" href="{{ route('admin.entry.edit', ['id' => $entry['id']]) }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a>&nbsp;&nbsp;<a class="btn btn-warning" onclick="Delete({{$entry['id']}})" style="color:white"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>

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
      if (confirm("Are your sure you want to delete the entry?")) {
        $.ajax({
            type : 'get',
            url : '{{route('admin.entry.delete')}}',
            data : {'EntryId':value},
            success:function(data){
              window.location.reload();
          } 
      });

    } else {
     
    }
}
</script>