@extends('layouts.user')

@section('content')
<style>
.heading
{
	font-size: 20px;
	font-weight: bold;
	color:brown;
}
.top{
	margin-top: 40px;
}
.top1{
	padding-top: 30px;
}
.bg{
	background-color:#f2edb5;
	padding:15px;
}
.select{
	background-color: #ff6100;
	color:black;
	height: 35px;
	width:50%;
}
img{
	margin-top: -30px;
}
</style>
<div class="bg col-md-offset-3 col-md-8">
<center><p class="heading">Renew Membership</p></center>
<div class="top">
	<div class="input-group col-md-offset-3 col-md-6">
          <input id="semail" type="text" class="form-control" name="semail" placeholder="name">
          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
      </div>
      <div class="input-group col-md-offset-3 col-md-6 top1">
          <input id="semail" type="text" class="form-control" name="semail" placeholder="Email">
          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
      </div>
      <div class="input-group col-md-offset-0 col-md-12" style="margin-bottom:20px;margin-top:40px">
          <center>
          <select class="select">
            <option value="individual" id="formButton1">Select Membership Type</option>
            <option value="family" id="formButton2">Annual Renewal ($40)</option>
          </select>
        </center>
      </div>


      <div id="paypal" style="display:none" class="col-md-offset-4 col-md-6 top1">
      <div>
            <div class="input-group col-md-6">
                <a href=""><img src={{url('/images/paypal.png')}} width="120%" height=40px" class="image" alt=""/></a>
            </div>            
        </div>
    </div>
</div>
</div>




<script>
$("#formButton1").click(function(){
        $("#paypal").hide();
    });
$("#formButton2").click(function(){
        $("#paypal").show();
    });
</script>

@endsection