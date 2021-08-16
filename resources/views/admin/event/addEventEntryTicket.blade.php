@extends('layouts.admin')

@section('content')
<style>
            .custom-control-input:focus ~ 
          .custom-control-label::before {
                /* when the button is toggled off 
  it is still in focus and a violet border will appear */
                border-color: violet !important;
                /* box shadow is blue by default
  but we do not want any shadow hence we have set 
  all the values as 0 */
                box-shadow:
                  0 0 0 0rem rgba(0, 0, 0, 0) !important;
            }
  
            /*sets the background color of
          switch to violet when it is checked*/
            .custom-control-input:checked ~ 
          .custom-control-label::before {
                border-color: #5cb85c !important;
                background-color: #5cb85c !important;
            }
  
            /*sets the background color of
          switch to violet when it is active*/
            .custom-control-input:active ~ 
          .custom-control-label::before {
                background-color: #5cb85c !important;
                border-color: #5cb85c !important;
            }
  
            /*sets the border color of switch
          to violet when it is not checked*/
            .custom-control-input:focus:
          not(:checked) ~ .custom-control-label::before {
                border-color: #5cb85c !important;
            }
        </style>
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
          <a href="javascript:history.back()" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        
      </div>
    </div>
      <div class="row">
       
        <div class="col-md-1">
      </div>
       <div class="col-md-10">
        <form method="post" action="{{ url('admin/Event/addEventEntryTicketPost') }}" enctype="multipart/form-data" id="regForm">

    {{ csrf_field() }}
            <div class="card">
               @if(Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
{{Session::get('success')}}
</div>
@endif
  <div class="card-header"><center><strong>Add Event Entry Ticket</strong></center></div>
              <br>
            <input type="hidden" name="eventId" value="{{$id}}">
<div class="card-body">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Min Age</th>
                    <th>Max Age</th>
                    <th>Member Type</th>
                    <th>Amount</th>
                    <th>Select</th>
                </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>  
              @foreach($Entry as $entry)
              <tr id="entry_mod_row_{{ $entry['id'] }}">

                <td>{{ $i++ }}</td>

                <td>{{ $entry['min_age'] }}</td>
                <td>{{ $entry['max_age'] }}</td>
                <td>{{ $entry['member_type'] }}</td>
                <td>${{ $entry['price'] }}</td>
                <td> <div class="custom-control custom-switch">
                <input type="checkbox" 
                       class="custom-control-input" 
                       id="customSwitch_entry{{ $entry['id'] }}" name="entry_id[]" value="{{ $entry['id'] }}" onclick="getEntryType(this)" />
                <label class="custom-control-label"
                       for="customSwitch_entry{{ $entry['id'] }}">
                  </label>
            </div></td>
              

            </tr>
            @endforeach
        </tbody> 
    </table>
        
    </div>
    <div style="overflow:auto;">
    <center>
      @if($Entry->count()>0)
      <button type="submit" class="button nextBtn" id="nextBtn" >Submit</button>
      @else
      <button type="submit" class="button nextBtn" id="nextBtn" disabled="">Submit</button>
      @endif
    </center>
  </div>
</div>

</div>
</form>
</div>
</div>
</div>
</div>




<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


@endsection