@extends('layouts.user')
@section('content')
<style>
.amount{
    padding-left: 10px;
    color: green;
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
        <div class="col-md-3">
        </div>
         <div class="col-md-3">
        </div>
        <div class="col-md-3">
        </div>
        
        
      </div>
    </div>
     <div class="row">
      <div class="col-md-2">
      </div>
        <div class="col-md-8">
            <div class="card panel-default">
                 @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {{Session::get('success')}}
                    </div>
                @endif
              <div class="card-header"><center><h4>Sponsor</h4></center></div>

                <div class="card-body">
                  <form class="form-horizontal" action="{{ url('/sponsors/add') }}" method="POST">
                      {{ csrf_field() }}

                  <div class="row">
                     <div class="col-md-12 form-group">
                        <label class="control-label" for="firstName">Select Package:&nbsp;<span style="color:red">*</span></label>
                        <select name="sponsorship_id" class="form-control" required="" onchange="getDetails(this.value)">
                            <option value="">Select Package</option>
                            @foreach($configs as $config)
                                <option value="{{$config->id}}">{{$config->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                   
                </div> 
                 <div class="row" id="amount">
                     <div class="col-md-12 form-group">
                        <h3 class="amount" id="amountP"></h3>
                     </div>
                     <input type="hidden" name="amount" id="addedAmount">
                 </div>
                            
                <div style="max-width: 200px; margin: auto;">
                        <button type="submit" class="btn btn-primary">Add</button>
                                                <a href="/familyMembers" class="btn btn-warning">Cancel</a>

                    </div><br>

                    </form>

                  </div>




                 

                  

                 
                    
               </div>
             </div>
           </div>
         </div>
       </div>
</section>
</div>



<script type="text/javascript">
    function getDetails(value)
    {
        if(value!="")
        {
            var substateArray1 =  @json($configsAjax);
            var filteredArray1 = substateArray1.filter(x => x.id == value);
            var element = document.getElementById("amountP");
            element.innerHTML ="Amount :"+filteredArray1[0]['amount'];
            var element1 = document.getElementById("addedAmount");
            element1.value=filteredArray1[0]['amount'];

            
        }
    }
</script>

@endsection