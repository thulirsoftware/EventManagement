@extends('layouts.admin')

@section('content')
<style>
    .dlk-radio input[type="radio"],
.dlk-radio input[type="checkbox"] 
{
    display:none;
}
.dlk-radio input[type="radio"] + .fa ,
.dlk-radio input[type="checkbox"] + .fa {
     opacity:0.15
}
.dlk-radio input[type="radio"]:checked + .fa,
.dlk-radio input[type="checkbox"]:checked + .fa{
    opacity:1
}
a.disabled {
  pointer-events: none;
  cursor: default;
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
          <a href="/admin/manageEvent" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        
      </div>
    </div>
      <div class="row">
       
        <div class="col-md-1">
      </div>
       <div class="col-md-10">
        <form method="post" action="{{ url('admin/Event/addEventCompetitionPost') }}" enctype="multipart/form-data" id="regForm">
            <input type="hidden" name="id" value="{{$id}}">

    {{ csrf_field() }}
        <div class="card">
               @if(Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
{{Session::get('success')}}
</div>
@endif

              <div class="card-header"><center><strong>Add Competition</strong></center></div>
              <div class="card-body">


     <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                     <th>Competition Name</th>
                     <th>Age</th>
                    <th>Member Fee</th>
                    <th>Non Member Fee</th>
                    <th>Select</th>
                    <th>Add</th>
                    </tr>
                  </thead>
                  <tbody> 
                   <?php $AddedLocations="";?>
                  @foreach($Competition as $i=>$competition)
              <?php
              $EventCompetition = \App\EventCompetition::where('competition_id',$competition->id)->first();
              
                

            ?>
            <tr>
                <td>{{ $competition['name'] }} </td>
              <td>{{ $competition['min_age'] }} - {{ $competition['max_age'] }}</td>
              <td>{{ $competition['member_fee'] }}
               <input type="hidden" name="member_fee[]"  value="{{$competition['member_fee']}}"> </td>
              <td>{{ $competition['non_member_fee'] }}
              <input type="hidden" name="non_member_fee[]"  value="{{$competition['non_member_fee']}}">
          </td>
              <td>
                @if($competition['id']==$EventCompetition['competition_id'])
                 <input type="checkbox" name="competition_id[]" value="{{ $competition['id'] }}" onclick="EnableLocation(this)">&nbsp;&nbsp;Competition 
                @else
                    <input type="checkbox" name="competition_id[]" value="{{ $competition['id'] }}" onclick="EnableLocation(this)">&nbsp;&nbsp;Competition 
                @endif
            </td>
              @if($competition['id']==$EventCompetition['competition_id'])
              <td><a class="btn btn-info disabled" data-toggle="modal" data-target="#{{ $competition['id'] }}Modal" id="dis_btn_{{ $competition['id'] }}"style="color:white" href="#{{ $competition['id'] }}Modal"  >Add Location</a></td>
              @else
               <td><a class="btn btn-info disabled" data-toggle="modal" data-target="#{{ $competition['id'] }}Modal" id="dis_btn_{{ $competition['id'] }}"style="color:white" href="#{{ $competition['id'] }}Modal"  >Add Location</a></td>
              @endif
            </tr>
             <div class="modal" id="{{ $competition['id'] }}Modal"  >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="{{ $competition['id'] }}ModalLabel">Add Location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="well well-sm ">
    <div class="dlk-radio">
        <?php $locations = \App\LocationModel::where('status','Y')->get();?>
         <input type="hidden" id="location_competition_id_{{ $competition['id'] }}" name="location_competition_id[]"  > 
         @foreach($locations as  $AddedLocation)
        <label class=" col-md-10">
            
            <input name="location[]" class="form-control" type="checkbox" value="{{$competition->id}}_{{$AddedLocation->id}}">
            <i class="fa fa-check glyphicon glyphicon-ok"></i>
            {{$AddedLocation->location_name}}
       </label><br>
       @endforeach
       
      
    </div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"   data-dismiss="modal">Add</button>
      </div>
    </div>
  </div>
</div>
            @endforeach 
                  </tbody>
              </table><br>
               <div style="overflow:auto;">
    <center >
      <button type="submit" class="button nextBtn" id="nextBtn" >Submit</button>
    </center>
  </div>
          </div>
      </div>

  </form>
          </div>
      </div>
  </div>
</section>
</div>
@endsection
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <!-- Modal -->
   

    <script type="text/javascript">
        function deleterow(rowId)
        {
            console.log(rowId);
            document.getElementById(rowId).remove();
        }
    </script>
    <script>
        function EnableLocation(checkbox)
        {
            if(checkbox.checked==true)
            {
                
                var elements = document.getElementById("dis_btn_"+checkbox.value);
                document.getElementById("location_competition_id_"+checkbox.value).value=checkbox.value;
                elements.classList.remove("disabled");

                
            }
            else
            {
               var elements = document.getElementById("dis_btn_"+checkbox.value);
                elements.classList.add("disabled"); 
            }
            
        }
    </script>