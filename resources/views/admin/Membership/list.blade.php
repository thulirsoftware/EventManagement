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
            <a class="btn btn-primary btn-sm" style="float:right;color:white" href="{{ route('admin.membership.add') }}" >Add Membership</a> 
        </div><br><br>
        <div class="card">
            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              {{Session::get('success')}}
          </div>
          @endif
          <div class="card-body">


              <table class="table table-bordered table-striped" id="membership_list">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Membership Name</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Is Visible</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>  
              @foreach($memberships as $membership)
              <tr>

                <td>{{ $i++ }}</td>


                <td>{{ $membership['membership_code'] }}</td>
                <td>{{ $membership['membership_type'] }}</td>
                <td>{{ $membership['membership_desc'] }}</td>
                <td>${{ $membership['membership_amount'] }}</td>
                <td>{{ $membership['is_visible'] }}</td>
                <td>{{$membership['starting_date'] }}</td>
                <td>{{$membership['closing_date'] }}</td>
                <td><a href="{{ route('admin.membership.edit', ['id' => $membership['id']]) }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a>&nbsp;&nbsp;<a   onclick="Delete({{$membership['id']}})" style="color:#0069d9;cursor: pointer;"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>

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
      if (confirm("Are your sure you want to delete the membership?")) {
        $.ajax({
            type : 'get',
            url : '{{route('admin.membership.delete')}}',
            data : {'membershipId':value},
            success:function(data){
              window.location.reload();
          } 
      });

    } else {
     
    }
}
</script>