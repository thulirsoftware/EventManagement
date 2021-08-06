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
        <form method="post" action="{{ url('admin/addDuplicateEventcompetitionsSave') }}" enctype="multipart/form-data" id="regForm">

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
                  @foreach($Competition as $i=>$competition)
              <?php
              $EventCompetition = \App\EventCompetition::where('competition_id',$competition->id)->first();
              $EventLocation = \App\CompetitionLocations::where('competition_id',$competition->id)->first();
           $str_arr = explode (",", $competition->location); 
               $locations = \App\LocationModel::whereIn('id',$str_arr)->pluck('location_name')->implode(',');

            ?>
            <tr>
                <td>{{ $competition['name'] }} </td>
              <td>{{ $competition['min_age'] }} - {{ $competition['max_age'] }}</td>
              <td>{{ $competition['member_fee'] }}
               <input type="hidden" name="member_fee[]"  value="{{$competition['member_fee']}}"> </td>
              <td>{{ $competition['non_member_fee'] }}
              <input type="hidden" name="non_member_fee[]"  value="{{$competition['non_member_fee']}}">
          </td>
              <td><input type="checkbox" name="competition_id[]" value="{{ $competition['id'] }}" onclick="EnableLocation(this)" <?=($competition['id'] == $EventCompetition['competition_id'])?'checked':''?>>&nbsp;&nbsp;Competition </td>
              @if($competition['id']==$EventCompetition['competition_id'])
              <td><a class="btn btn-info" data-toggle="modal" data-target="#{{ $competition['id'] }}Modal" id="dis_btn_{{ $competition['id'] }}"style="color:white" href="#{{ $competition['id'] }}Modal"  >Add Location</a></td>
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
         @foreach($locations as  $location)
        <label class=" col-md-10">
            
            <input name="location[]" class="form-control" type="checkbox" value="{{$competition->id}}_{{$location->id}}" <?=($location['id'] == $EventLocation['location_id'])?'checked':''?>>
            <i class="fa fa-check glyphicon glyphicon-ok"></i>
            {{$location->location_name}}
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
   
<script>
        let lineNo = 1;

        $(document).ready(function () {
            $(".add-row").click(function () {
                 document.getElementById('nextBtn').disabled=false;
                 console.log("dis");
                var member_fee = document.getElementById("member_fee").value;
                var non_member_fee = document.getElementById("non_member_fee").value;

                var e = document.getElementById("ddlViewBy");
                var strUser = e.options[e.selectedIndex].text;

                var e = document.getElementById("ddlViewBy");
                var id = e.value;
                if(member_fee=="" && non_member_fee=="" && id=="")
                {
                    document.getElementById('member_fee_error').innerHTML="Enter Member Fee";
                    document.getElementById('non_member_fee_error').innerHTML="Enter Non Member Fee";
                    document.getElementById('competitionerror').innerHTML="Select Competition";
                }
                else if(member_fee=="")
                {
                    document.getElementById('member_fee_error').innerHTML="Enter Member Fee";
                    document.getElementById('non_member_fee_error').innerHTML="";
                    document.getElementById('competitionerror').innerHTML="";
                }
                else if(non_member_fee=="")
                {
                    document.getElementById('member_fee_error').innerHTML="";
                    document.getElementById('non_member_fee_error').innerHTML="Enter Non Member Fee";
                    document.getElementById('competitionerror').innerHTML="";
                }
                else if(id=="")
                {
                    document.getElementById('member_fee_error').innerHTML="";
                    document.getElementById('non_member_fee_error').innerHTML="";
                    document.getElementById('competitionerror').innerHTML="Select Competition";
                }
                else
                {
                    document.getElementById('member_fee_error').innerHTML="";
                    document.getElementById('non_member_fee_error').innerHTML="";
                    document.getElementById('competitionerror').innerHTML="";
                var substateArray =  @json($CompetitionAjax);
                var filteredArray = substateArray.filter(x => x.id == id);
                console.log(filteredArray);
                         markup = "<tr id=row_"+ lineNo +"><td>"+strUser+ "<input type='hidden' name='competition_id[]' value="+ id +"></td><td>"+ member_fee +  "<input type='hidden' name='member_fee[]' value="+ member_fee +"></td><td>"+ non_member_fee + "<input type='hidden' name='non_member_fee[]' value="+ non_member_fee +"></td><td><a  id='row_"+ lineNo +"' onclick='deleterow(this.id)'><i class='fa fa-trash fa-lg' style='cursor:pointer;color:#0069d9'></i></a></td></tr>";
            
                tableBody = $("table tbody");
                tableBody.append(markup);
                lineNo++;
            }
            });
        }); 
    </script>
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