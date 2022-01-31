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
            <div class="col-md-11">
                <div class="card">

                 <div class="card-body" >

                  <form class="form-horizontal" action="{{ url('membershipPost') }}" method="POST">
                      {{ csrf_field() }}

                      <?php 
                      $user = Auth::user()->email;
                      $memberDetails = App\Member::where('Email_Id',$user)->first();
                      if($memberDetails!=null)
                      {
                        $memberDetails = App\Member::where('Email_Id',$user)->first();

                    }
                    else
                    {
                        $memberDetails = App\NonMember::where('Email_Id',$user)->first();

                    }

                ?>
                <div class="row">

                    <div class="col-md-6 form-group">
                      <label class="control-label" for="firstName">Name:</label>
                      <input type="text" class="form-control" id="firstName" placeholder="" name="firstName" value="{{$memberDetails['firstName']}}" required readonly="">

                      <input type="hidden" class="form-control" id="lastName" placeholder="" name="lastName" value="{{$memberDetails['lastName']}}" required readonly="">     

                  </div>

                  <div class="col-md-6 form-group">
                      <label class="control-label" for="email">Email:</label>
                      <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{$memberDetails['Email_Id']}}" required readonly="">
                  </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="control-label" for="phoneNo">Phone No:</label>
                  <input type="text" class="form-control" id="tagDvId" placeholder="" name="phoneNo" value="{{$memberDetails['mobile_number']}}" required readonly="">
              </div>

              <div class="col-md-6 form-group">
                  <label class="control-label" for="membership_code">Membership Code:</label>
                  <input type="text" class="form-control" id="membership_code" placeholder="" name="membership_code" value="{{$membership->membership_code}}" required readonly="">

              </div>
          </div>
          <div class="row">
            
           <div class="col-md-6 form-group">
              <label class="control-label" for="membershipAmount">Membership Type:</label>
                         <input type="text" class="form-control" id="membership_type" placeholder="" name="membership_type" value="{{$membership->membership_type}}" readonly="">    

              
          </div>
          <div class="col-md-6 form-group">
              <label class="control-label" for="membershipAmount">Membership Amount:</label>
              <input type="text" class="form-control" id="membershipAmount" placeholder="" name="membershipAmount" value="{{$membership->membership_amount}}" required readonly="">
              
          </div>
           <div class="col-md-6 form-group">
              <label class="control-label" for="membershipAmount">Payment Method:</label>
             <select class="form-control" name="payment_method" required="">
                            <option value="">Select Payment Method</option>
                             <option value="Paypal">Paypal</option>
                           
             </select>
              
          </div>
          <input type="hidden" class="form-control" id="Validity" placeholder="" name="Validity" value="{{$membership->closing_date}}">
          <input type="hidden" class="form-control" id="membership_id" placeholder="" name="membership_id" value="{{$membership->id}}">


      </div>

<input type="checkbox" name="terms" id="terms" onchange="activateButton(this)">  I solemnly agree that the information provided is true to the best of my knowledge and I am older than 18 years.<br>    
      <div class="form-group">   <br>

          <div class="col-sm-offset-4 col-sm-4">
            <button type="submit" class="btn btn-sm btn-primary" name="submit" id="myBtn" disabled="">Submit</button>
        </div>
    </div>

</form>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
 function disableSubmit() {
  document.getElementById("myBtn").disabled = true;
 }

  function activateButton(element) {

      if(element.checked) {
        document.getElementById("myBtn").disabled = false;
       }
       else  {
        document.getElementById("myBtn").disabled = true;
      }

  }
</script>
<script>
    function getPayment(type)
    {
        console.log(type);
        if(type=="cheque")
        {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
        else
        {
            var x = document.getElementById("myDIV");
            x.style.display = "none";

        }
    }
</script>

@endsection
