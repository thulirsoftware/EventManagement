@extends('layouts.admin')

@section('content')

<style type="text/css">
    div{
        margin-top:15px;
    }
    .top{
        font-size: 25px;
        font-weight: bold;
        color:brown;
        margin-top: 30px;
    }
    .top1{
        font-size: 30px;
        font-weight: bold;
        color:grey;
        margin-top: 30px;
    }
    .forgot{
    	color:blue;
    	font-size: 15px;
    }
    .names{
    	font-size: 20px;
        font-weight: bold;
        color:brown;
    }
    .bottom{
        font-size: 20px;
        font-weight: bold;
        color:black;
        margin-bottom: 30px;
    }
    .next{
    	background-color: #ff6100;
    	color:black;
    	padding:7px;
    	border-radius: 5px;
    }
</style>
<div class=" col-md-offset-4 col-md-6" style="background-color: #f2edb5;margin-bottom:50px">
  <center><p class="top">Add Event</p></center>
  <form method="post" action="{{ url('admin/schoolUpdate') }}" enctype="multipart/form-data">

    {{ csrf_field() }}

  <input type="hidden" name="schoolId" value="{{ $school['id'] }}">

    <div class="col-md-10">    	  
      	<div class="input-group col-md-offset-2 col-md-12">
      		<span class="col-md-4">School Name</span>
            <input type="text" class="col-md-8" name="schoolName" id="schoolName" value="{{ $school['name'] }}" required="">
      	</div>

      <div class="col-md-offset-2 col-md-12 bottom" >
          <center><input type="submit" name="submit" value="submit"></center>
      </div>

</div>
</form>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
@endsection