@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
           
                <a style="background-color:brown;color:white;border-radius:5px;font-size:18px;padding:15px;margin-top:15px" href="{{ url('admin/addMembership') }}">Add Membership</a>
              
                <table class="table" style="margin-top:25px">
                  <thead style="background-color:brown">
                    <tr>
                      <th style="padding:15px;color:white;text-align:center;font-size:16px;border:1px solid grey">S.No</th>
                      <th style="padding:15px;color:white;text-align:center;font-size:16px;border:1px solid grey">Membership Code</th>
                      <th style="padding:15px;color:white;text-align:center;font-size:16px;border:1px solid grey">Description</th>
                      <th style="padding:15px;color:white;text-align:center;font-size:16px;border:1px solid grey">Amount</th>
                      <th style="padding:15px;color:white;text-align:center;font-size:16px;border:1px solid grey">Is Visible</th>
                      <th style="padding:15px;color:white;text-align:center;font-size:16px;border:1px solid grey">Open Date</th>
                      <th style="padding:15px;color:white;text-align:center;font-size:16px;border:1px solid grey">Closing Date</th>
                      <th style="padding:15px;color:white;text-align:center;font-size:16px;border:1px solid grey">Edit</th>
                      <th style="padding:15px;color:white;text-align:center;font-size:16px;border:1px solid grey">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; ?>  
                      @foreach($memberships as $membership)
                        <tr style="background-color:#f3f4c6">

                          <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $i++ }}</td>


                          <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $membership['membership_code'] }}</td>
                          <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $membership['membership_desc'] }}</td>
                          <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $membership['membership_amount'] }}</td>
                          <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $membership['is_visible'] }}</td>
                          <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $membership['open_date'] }}</td>
                          <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $membership['closing_date'] }}</td>

                          <td style="padding:15px;text-align:center;border:1px solid grey;"><a href="/admin/membershipEdit/{{ $membership['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                          <td style="padding:15px;text-align:center;border:1px solid grey;"><a href="/admin/membershipDelete/{{ $membership['id'] }}" ><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>

                        </tr>
                      @endforeach
                  </tbody> 
                </table>
              </div>
            </div>
      </div>
  
@if(Auth::user()->job_title=='Admin')
<script language="javascript">
$(document).ready(function()
{ 
       $(document).bind("contextmenu",function(e){
              return false;
       }); 
})
</script>
@endif
@endsection
