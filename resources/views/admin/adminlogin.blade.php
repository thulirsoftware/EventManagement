@extends('layouts.app2')

@section('content')
<style type="text/css">
    div{
        margin-top:15px;
    }
    .top{
        font-size: 20px;
        font-weight: bold;
        color:brown;
        margin-top: 30px;
    }
    .forgot{
    	color:blue;
    	font-size: 15px;
    }
    .bottom{
        font-size: 20px;
        font-weight: bold;
        color:black;
        margin-bottom: 30px;
    }
</style>

<div class=" col-md-offset-3 col-md-6" style="background-color: #f2edb5;">
  <center><p class="top">Admin Sign In</p></center>
  <form method="post" action="">
    <a href="/admin" style="color:brown">Admin</a>
    <div class="col-md-6">
      <div class="input-group col-md-offset-6 col-md-12">
          <input id="email" type="text" class="form-control" name="email" placeholder="Admin ID">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      </div>
      <div class="input-group  col-md-offset-6 col-md-12">
          <input id="password" type="text" class="form-control" name="password" placeholder="password">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      </div>
    <div class="col-md-offset-6 col-md-12 bottom" >
        <center><input type="submit" style="background-color: #ff6100;color:black" name="submit" value="Submit"></center>
    </div>
    </form>	
</div>

@endsection