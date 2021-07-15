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
      <div class="col-12">

      <div class="row mb-2">
        <div class="col-sm-2">
          <a href="/admin/Payments" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        
      </div>
    </div>
      <div class="row">
       
        <div class="col-md-2">
      </div>
       <div class="col-md-8">
            <div class="card">

               <div class="card-body">
                  <form class="form-horizontal" action="{{ url('admin/UpdatePayment') }}" method="POST">
                      {{ csrf_field() }}

            <?php 
            $member = App\NonMember::where('user_id',$MembershipBuy->user_id)->first();
            ?>
            <div class="row">
              <input type="hidden" class="form-control" id="firstName" placeholder="" name="user_id" value="{{$MembershipBuy->user_id}}" required >

            <div class="col-md-6 form-group">
              <label class="control-label" for="firstName">Name:</label>
                <input type="text" class="form-control" id="firstName" placeholder="" name="firstName" value="{{$member->firstName}}" required readonly="">

                <input type="hidden" class="form-control" id="id" placeholder="" name="id" value="{{$MembershipBuy->id}}" required readonly="">                
            </div>

            <div class="col-md-6 form-group">
              <label class="control-label" for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{$member->Email_Id}}" required readonly="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
              <label class="control-label" for="phoneNo">Phone No:</label>
                <input type="text" class="form-control" id="Member_Id" placeholder="" name="phoneNo" value="{{$member->mobile_number}}" required readonly="">
            </div>

            <div class="col-md-6 form-group">
              <label class="control-label" for="membershipType">Membership Code:</label>
                <input type="text" class="form-control" id="membershipType" placeholder="" name="membershipType" value="{{$MembershipBuy->membership_code}}" required readonly="">
              
              </div>
            </div>
             <div class="row">
            <div class="col-md-6 form-group">
              <label class="control-label" for="membershipAmount">Membership Amount:</label>
                <input type="text" class="form-control" id="membershipAmount" placeholder="" name="membershipAmount" value="{{$MembershipBuy->membership_amount}}" required readonly="">
              
            </div>
            <div class="col-md-6 form-group">
              <label class="control-label" for="paymentType">Payment Type:</label>
              
                <select name="paymentType" id="paymentType" class="form-control" onchange="getPayment(this.value)" required>
                    <option value="">Choose Payment Type</option>
                    <option value="cash" <?= $MembershipBuy['Inst_Type'] == "cash"?'selected':'' ?>>Cash</option> 
                    <option value="cheque" <?= $MembershipBuy['Inst_Type'] == "cheque"?'selected':'' ?>>Cheque</option>
                  </select>
              
            </div>
            <div class="col-md-6 form-group" id="myDIV" style="display:none">
              <label class="control-label" for="Inst_number">Cheque Number:</label>
              
               <input type="text" class="form-control" id="Inst_number" value="{{$MembershipBuy->Inst_No}}" placeholder="Enter Cheque Number" name="Inst_number">
              
            </div>
             <div class="col-md-6 form-group">
              <label class="control-label" for="payment_status">Payment Status:</label>
              
              <select name="payment_status" id="payment_status" class="form-control" required>
                    <option value="">Choose Payment Status</option>
                    <option value="Pending" <?= $MembershipBuy['payment_status'] == "Pending"?'selected':'' ?> >Pending</option> 
                    <option value="Completed"<?= $MembershipBuy['payment_status'] == "Completed"?'selected':'' ?> >Completed</option>
                  </select>
            </div>
        </div>


            <div class="form-group">   
            <center>
                      <button type="submit" class="btn btn-primary" name="submit">Update</button>
                      <a class="btn  btn-warning" href="{{ url('admin/Payments') }}">Cancel</a>
                    </center>
            
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
  $(function () {
      var x = document.getElementById("paymentType");
      var val= x.value;
      console.log(val);
      getPayment(val);
      
  });
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
