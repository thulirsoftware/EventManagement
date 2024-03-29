@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
     <div class="content-header">
 <a href="#" class="sidebar-toggle openbtn" data-toggle="push-menu" role="button">&#9776;</a>

</div>
  <!-- Content Header (Page header) -->
  <div class="content-header">

  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-11 col-md-offset-2">
          <div class="add-button" >
            <a class="btn btn-primary btn-sm" style="float:right;color:white" href="{{ route('admin.competition.add') }}" >Add Competition</a> 
          </div><br><br>
          <div class="card">
           @if(Session::has('success'))
           <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {{Session::get('success')}}
          </div>
          @endif
          <div class="card-body">
            <table class="table table-bordered table-striped" id="competition_list">
              <thead>
                <tr>
                 <th>S.No</th>
                 <th>Name</th>
                 <th>Awards</th>
                 <th>Age Limit</th>
                 <th>Type</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>  
              @foreach($Competition as $i=>$competition)
              <?php
              $awards = wordwrap($competition['awards'], 20, "\n");
              $name = wordwrap($competition['name'], 20, "\n");
            ?>
            <tr>
              <td>{{ $i+1 }}</td>
              <td>{!! nl2br(e($name)) !!}</td>
              <td>{!! nl2br(e($awards)) !!}</td>
              <td>{{ $competition['min_age'] }} - {{ $competition['max_age'] }}</td>
              <td>{{ $competition['competition_type'] }} </td>
              <td><a class="btn btn-primary" href="{{ route('admin.competition.edit', ['id' => $competition['id']]) }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a>&nbsp;&nbsp;<a class="btn btn-warning" onclick="Delete({{$competition['id']}})" style="color:white"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
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
      if (confirm("Are your sure you want to delete the competition?")) {
        $.ajax({
            type : 'get',
            url : '{{route('admin.competition.delete')}}',
            data : {'CompetitionId':value},
            success:function(data){
              window.location.reload();
          } 
      });

    } else {
     
    }
}
</script>