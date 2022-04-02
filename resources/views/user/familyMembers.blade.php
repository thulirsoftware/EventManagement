@extends('layouts.user')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
 <a href="#" class="sidebar-toggle openbtn" data-toggle="push-menu" role="button">&#9776;</a>

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
            <div class="row">
                @foreach($familyMembers as $family)
              <div class="col-12 col-md-6 col-lg-4">
           <div class="card">
                 
                  <div class="card-body">
                    <p class="card-text"><b>Name</b> : {{ $family['firstName'] }} {{ $family['lastName'] }}</p>
                    <p class="card-text"><b>DOB </b>: {{ $family['dob'] }}</p>
                    <p class="card-text"><b>Age</b> : {{ $family['age'] }}</p>
                    <p class="card-text"><b>Relationship</b> : {{ $family['relationshipType'] }}</p>
                    <a href="/familyEdit/{{ $family['id'] }}" class="card-link"><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a>
                    <a href="/familyDelete/{{ $family['id'] }}"  class="card-link"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a>
                  </div>
                </div>
                </div>
                @endforeach
</div>
</div>
</div>
</div>
</section>
</div>
@endsection
