@extends('layouts.user')
@section('content')
<style>
.amount{
    padding-left: 10px;
    color: green;
}
.benefits{
    padding-left: 10px;
    color: brown;
}
</style>
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
                            <?php
                             $events = \App\Event::whereDate('eventDate','>=',date('Y-m-d'))->get();
                           ?>
                  <div class="row">
                       <div class="col-md-12 form-group">
                        <label class="control-label" for="sponsorship_for">Sponsorship ?:&nbsp;<span style="color:red">*</span></label>
                       <select class="form-select" name="sponsorship_for" onchange="selectEVent(this.value)" required="">
                            <option value="">Select</option>
                             <option value="E">Event</option>
                            <option value="G">General</option>

                        </select>
                    </div>
                     <div class="col-md-12 form-group" id="event_id" style="display:none">
                        <label class="control-label" for="event_id">Event:&nbsp;<span style="color:red">*</span></label>
                       <select class="form-select" name="event_id" >
                            <option value="">Select</option>
                             @foreach($events as $event) 
						                        <option value="{{$event->id}}">{{$event->eventName}}</option>
						                            
						                     @endforeach

                        </select>
                    </div>
                    
                     <div class="col-md-12 form-group">
                        <label class="control-label" for="firstName">Select Package:&nbsp;<span style="color:red">*</span></label>
                        <select name="sponsorship_id" class="form-select" required="" onchange="getDetails(this.value)">
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
                  <div class="row" id="amount">
                     <div class="col-md-12 form-group">
                        <h5 class="benefits" id="benefits"></h5>
                     </div>
                      <div class="col-md-12 form-group">
                         <img class="image" id="image" width="520px">
                     </div>
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
            element.innerHTML ="Amount : ($) "+filteredArray1[0]['amount'];
            var element1 = document.getElementById("addedAmount");
            element1.value=filteredArray1[0]['amount'];
            var benefits = document.getElementById("benefits");
            benefits.innerHTML ="Benefits : "+filteredArray1[0]['benefits'];
             document.getElementById("image").src = "";
            if(filteredArray1[0]['files']!=null)
            {
                var img = document.getElementById("image").src="http://events.staging.netamilsangam.org/benefits/"+filteredArray1[0]['files'];
            }

            
        }
    }
    
      function selectEVent(eventName)
  {
      var x = document.getElementById('event_id');
      if(eventName=='E')
      {
           x.style.display = "block";
      }
      else
      {
           x.style.display = "none";
      }
  }
</script>

@endsection
