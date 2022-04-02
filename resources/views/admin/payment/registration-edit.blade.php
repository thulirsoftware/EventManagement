@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
  <div class="content-header">
 <a href="#" class="sidebar-toggle openbtn" data-toggle="push-menu" role="button">&#9776;</a>

</div>
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
                  <form class="form-horizontal" action="{{ url('admin/RegistrationPaymentUpdate') }}" method="POST">
                      {{ csrf_field() }}

          
            <div class="row">
              <input type="hidden" class="form-control" id="firstName" placeholder="" name="user_id" value="{{$TicketPurchase->user_id}}" required >

            <div class="col-md-6 form-group">
              <label class="control-label" for="firstName">Name:</label>
                <input type="text" class="form-control" id="firstName" placeholder="" name="firstName" value="{{$TicketPurchase->name}}" required readonly="">

                <input type="hidden" class="form-control" id="id" placeholder="" name="id" value="{{$TicketPurchase->id}}" required readonly="">                
            </div>

            <div class="col-md-6 form-group">
              <label class="control-label" for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{$TicketPurchase->email}}" required readonly="">
            </div>
        </div>
     
             <div class="row">
            <div class="col-md-6 form-group">
              <label class="control-label" for="membershipAmount">Total Amount:</label>
                <input type="text" class="form-control" id="totalAmount" placeholder="" name="totalAmount" value="{{$TicketPurchase->totalAmount}}" required readonly="">
              
            </div>
            <div class="col-md-6 form-group">
              <label class="control-label" for="paymentType">Payment Type:</label>
              
                <select name="paymentType" id="paymentType" class="form-control"  required>
                    <option value="">Choose Payment Type</option>
                    <option value="cash" <?= $TicketPurchase['payment_type'] == "cash"?'selected':'' ?>>Cash</option> 
                    <option value="cheque" <?= $TicketPurchase['payment_type'] == "cheque"?'selected':'' ?>>Cheque</option>
                  </select>
              
            </div>
           
             <div class="col-md-6 form-group">
              <label class="control-label" for="payment_status">Payment Status:</label>
              
              <select name="payment_status" id="payment_status" class="form-control" required>
                    <option value="">Choose Payment Status</option>
                    <option value="Pending" <?= $TicketPurchase['paymentStatus'] == "Pending"?'selected':'' ?> >Pending</option> 
                    <option value="Completed"<?= $TicketPurchase['paymentStatus'] == "Completed"?'selected':'' ?> >Completed</option>
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
