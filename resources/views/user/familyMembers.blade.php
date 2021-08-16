@extends('layouts.user')

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
                <a class="btn btn-primary btn-sm" style="float:right;color:white"  href="{{ url('add/familyMembers') }}">Add Family Members</a> 
            </div><br><br>
            <div class="card panel-default">
              @if(Session::has('success'))
              <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  {{Session::get('success')}}
              </div>
              @endif
              <div class="card-body">
                <table class="table table-bordered table-striped" id="family_members_list">
                   <thead >
                      <th>SI.No</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>DOB</th>
                      <th>Age</th>
                      <th>Relationship</th>
                      <th>Edit</th>
                      <th>Delete</th>
                      <th>Make Volunteer</th>
                  </thead>
                  <tbody>
                    <?php $i=1; ?> 
                    @foreach($familyMembers as $family)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $family['firstName'] }}</td>
                        <td>{{ $family['lastName'] }}</td>
                        <td>{{ $family['dob'] }}</td>
                        <td>{{ $family['age'] }}</td>
                        <td>{{ $family['relationshipType'] }}</td>
                        <td><a href="/familyEdit/{{ $family['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                        <td><a href="/familyDelete/{{ $family['id'] }}" ><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
                        <?php $volunteer = \App\Volunteer::where('family_member_id',$family['id'])->count();
                      ?>
                      @if($volunteer>0)
                        <td><a class="badge badge-success" style="color:white">Volunteer</a></td>
                        @else
                         <td><a class="badge badge-info" href="/AddAsVolunteer/Family/{{ $family['id'] }}" class="badge badge-success">Add As Voluntter</a></td>
                        @endif
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
