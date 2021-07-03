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
<div class="card-body">
                <table class="table">
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
                        $member = App\Member::where('Member_Id',$MembershipBuy->user_id)->first();
                      ?>
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
