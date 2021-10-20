@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">

  </div>   
  <section class="content">
      <div class="container-fluid"> 
          <div class="col-12">

              <div class="row mb-2">
                <div class="col-sm-2">
                  <a href="/admin/Food/List" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
              </div>

          </div>
      </div>
      <div class="row">

        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="card">
  @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              {{Session::get('success')}}
          </div>
          @endif
              <div class="card-body">
                  <form class="form-horizontal" action="{{ route('admin.sponsorship.update') }}" method="POST">
                      {{ csrf_field() }}
     

  <div class="row" id="row_food0">
<input type="hidden" name="sponsorshipId" class="form-control" value="{{$sponsorship->id}}"required>
      <div class="col-md-12 form-group ">
         <label class="names">Amount:&nbsp;<span style="color:red">*</span></label>
          <input type="text" name="amount" class="form-control" value="{{$sponsorship->amount}}"required onkeypress="return onlyNumberKey(event)">
        </div>
         <div class="col-md-12 form-group ">
          <label class="names">Benefits:&nbsp;<span style="color:red">*</span></label>
                        <textarea name="benefits" class="form-control"  required>{{$sponsorship->benefits}}</textarea>

        </div>



                </div>

                <div class="form-group"> 
                    <center>       
                      <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                      <a class="btn btn-warning" href="{{ route('admin.sponsorship.list') }}">Cancel</a>
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
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<script>
    function onlyNumberKey(evt) {
          
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>
@endsection
