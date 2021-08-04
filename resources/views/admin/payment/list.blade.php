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
      <div class="row">
        <div class="col-md-11 col-md-offset-2">
          
          <div class="card">
           @if(Session::has('success'))
           <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {{Session::get('success')}}
          </div>
          @endif
          <div class="card-header">
            <center><h4>Membership Purchase</h4></center>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped" id="payments_list">
              <thead>
                <tr>
                  <th>Member Name</th>
                  <th>Membership Code</th>
                  <th>Amount</th>
                  <th>Payment Type</th>
                  <th>Payment Status</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>  
                @foreach($MembershipBuy as $MembershipBuy)
                <?php
                $member = App\Member::where('user_id',$MembershipBuy->user_id)->first();
                if($member==null)
                {
                  $member = App\NonMember::where('user_id',$MembershipBuy->user_id)->first();
                }
                else
                {
                  $member = App\Member::where('user_id',$MembershipBuy->user_id)->first();
                }

              ?>
              @if($member!=null)

              <tr>

                <td>{{ $member->firstName }} {{ $member->lastName }}</td>
                <td>{{ $MembershipBuy->membership_code }}</td>
                <td>$ {{ $MembershipBuy->membership_amount}}</td>
                <td>{{ $MembershipBuy->Inst_Type}}</td>
                @if($MembershipBuy->payment_status=="Completed")
                <td><span class="badge bg-success">{{ $MembershipBuy->payment_status }}</span>
                </td>
                @else
                <td><span class="badge bg-danger">{{ $MembershipBuy->payment_status }}</span>
                </td>
                @endif

                @if($MembershipBuy->payment_status!="Completed")
                <td><a href="/admin/PaymentEdit/{{ $MembershipBuy->id}}" ><i class="fa fa-edit fa-lg" style="text-align:center;"></i></a></td>
                @else
                <td></td>
                @endif


              </tr>
              @endif
              @endforeach
            </tbody> 
          </table>

        </div>
      </div>
    </div>
  </div>
  <div class="col-md-11 col-md-offset-2">

          <div class="card">
          <div class="card-header">
            <center><h4>Events Tickets</h4></center>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped" id="payments_tickets_list">
              <thead>
                <tr>
                  <th>User Name</th>
                  <th>User Email</th>
                  <th>Event Name</th>
                  <th>Payment Type</th>
                  <th>Payment Status</th>
                  <th>Total Amount</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>  
                @foreach($TicketPurchase as $TicketPurchase)
               

              <tr>

                <td>{{ $TicketPurchase->name }}</td>
                <td>{{ $TicketPurchase->email }}</td>
                <td>{{ $TicketPurchase->eventName}}</td>
                <td>{{ $TicketPurchase->payment_type}}</td>
                @if($TicketPurchase->paymentStatus=="Completed")
                <td><span class="badge bg-success">{{ $TicketPurchase->paymentStatus }}</span>
                </td>
                @else
                <td><span class="badge bg-danger">Pending</span>
                </td>
                @endif
                 <td>${{ $TicketPurchase->totalAmount}}</td>
                @if($TicketPurchase->paymentStatus!="Completed")
                <td><a href="/admin/RegistrationPaymentEdit/{{ $TicketPurchase->id}}" ><i class="fa fa-edit fa-lg" style="text-align:center;"></i></a></td>
                @else
                <td></td>
                @endif


              </tr>
              @endforeach
            </tbody> 
          </table>
          
        </div>
      </div>
    </div>
</div>
</section>
</div>

@endsection
