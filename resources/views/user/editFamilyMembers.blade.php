@extends('layouts.user')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Update Family Member</div>

               <div class="panel-body">
                  <form class="form-horizontal" action="{{ url('/familyUpdate') }}" method="POST">
                      {{ csrf_field() }}

                  <input type="hidden" name="id" value="{{ $family['id']}}">
                  <input type="hidden" name="tagDvId" value="{{ $family['tagDvId']}}">
                                          
                  <div class="form-group">
                    <label class="control-label col-sm-3" for="firstName">First Name:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="firstName" placeholder="Enter Name" name="firstName" value="{{ $family['firstName']}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3" for="lastName">Last Name:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="lastName" placeholder="Enter Name" name="lastName" value="{{ $family['lastName']}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3" for="relationshipType">Relationship:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="relationshipType" placeholder="Enter Name" name="relationshipType" value="{{ $family['relationshipType']}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3" for="phoneNo">Phone No:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="phoneNo" placeholder="Enter Name" name="phoneNo" value="{{ $family['phoneNo']}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3" for="dob">DOB:</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="dob" placeholder="Enter Name" name="dob" value="{{ $family['dob']}}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3" for="schoolName">School Name:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="schoolName" placeholder="Enter Name" name="schoolName" value="{{ $family['schoolName']}}">
                    </div>
                  </div>

                  <div class="form-group">        
                    <div class="col-sm-offset-3 col-sm-4">
                      <button type="submit" class="btn btn-default" name="submit">Submit</button>
                      <button class="btn btn-default"><a href="{{ url('familyMembers') }}">cancel</a></button>
                    </div>
                  </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
