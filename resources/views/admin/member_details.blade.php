@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
    
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:brown;color:yellow;font-size: 16px;font-weight: bold">Member Details
                </div>

                <div class="panel-body" style="text-align: left;">
                
                <div class="panel-body" style="text-align: left;">
                  
                  
                  <div class="col-md-5 form-group">
                    <select name="membersearch" id="mobile_number" class="selectpicker form-control membersearch"  data-live-search="true">
                          <option value="">Mobile Number</option>
                          @foreach ($members as $member)
                          <option value="{{ $member->phoneNo1 }}">{{ $member->phoneNo1 }}</option>
                          @endforeach 
                        </select>
                  </div>

                  <div class="col-md-5 form-group">
                    <select name="membersearch" id="member_id" class="selectpicker form-control membersearch"  data-live-search="true">
                          <option value="">TagDv Id</option>
                          @foreach ($members as $member)
                          <option value="{{ $member->tagDvId }}">{{ $member->tagDvId }}</option>
                          @endforeach 
                        </select>
                  </div>
                
                
                <table class="table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Mobile Number</th>
                      <th>Email</th>
                      <th>State</th>
                      <th>Membership Type</th>
                      <th>Expiry Date</th>
                    </tr>
                  </thead>
                  <tbody>  
                  
                  </tbody> 
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.membersearch').on('change',function(){
      $value=$(this).val();
      $.ajax({
        type : 'get',
        url : '{{URL::to('admin/membersearch')}}',
        data : {'membersearch':$value},
        success:function(data){
          $('tbody').html(data);
        } 
      });
    })
</script>
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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
  
@endsection