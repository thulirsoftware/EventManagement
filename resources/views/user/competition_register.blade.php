@extends('layouts.user')

@section('content')
<div class="content-wrapper" style="background-color:white">
  <!-- Content Header (Page header) -->
  <div class="content-header">

</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">   
     <div class="row">
      <div class="col-md-1">
        <a href="javascript:history.back()" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
      </div>
        <div class="col-md-9">
        <div class="card card-info" style="-webkit-box-shadow: none;
          -moz-box-shadow: none;  box-shadow: none;background-color: #f7f7f7;">
        <div class="card-header" style="background-color: #1f5387;">
             <h3 class="card-title">Register For {{$eventName}}</h3>
        </div>
            @if(Session::has('success'))
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  {{Session::get('success')}}
                  </div>
              @endif
                <div class="card-body">
                  <form class="form-horizontal" action="{{ route('member.competition.save') }}" id="regForm" method="POST">
                      {{ csrf_field() }}

               
                  <div class="row">
                    
                    <div class="col-md-4 form-group ">
        <label class="names">Select Competition</label>
            <select class="form-control" name="Competition" id="Competition" onchange="getcompetitionType(this.value)">
                <option value="">Select Competition</option>
                    @foreach($Competition as $Competition) 
                        <option value="{{$Competition->id}}_{{$Competition->competition_type}}">{{$Competition->name}}</option>
                            
                     @endforeach
            </select>
         </div>
     
     <div  class="col-md-4" >
       
    <div class="form-group " id="solo" style="display:none">
        <label class="names">Select Participant</label>
            <select class="form-control" name="familyMembers">
                <option value="">Select</option>
                    @foreach($familyMembers as $familyMembers) 
                        <option value="{{$familyMembers->id}}">{{$familyMembers->firstName}} {{$familyMembers->lastName}}</option>
                              
                     @endforeach
            </select>
         </div>
              <div class="form-group " id="group"  style="display:none">
        <label class="names">Add Participant</label>
            <select class="form-control" name="familyMembers" id="familyMembers">
                <option value="">Select</option>
                    @foreach($familyMember_list as $familyMembers) 
                        <option value="{{$familyMembers->id}}">{{$familyMembers->firstName}} {{$familyMembers->lastName}}</option>
                              
                     @endforeach
                     <option value="AddOther">Add Other Participants</option>
            </select>
         </div>
           
     
                  
        </div>
         <div class="col-md-2 form-group">
                        <br>
                      <button type="button" id="add-row" class="button1 add-row" onclick="add()" style="display:none">Add</button>
                    </div> 
               
                    
          </div>
          <div class="row">
           <table class="col-md-10 table" id="groupadded" style="display:none">
                  <thead>
                    <tr>
                        <th>Competition Name</th>
                       <th>Participant Name</th>
                        <th>Member Fees</th>
                       
                    </tr>
                  </thead>
                  <tbody>  
                  </tbody>
              </table><br>        
</div>
                  <div class="form-group" id="submit">        
                    <center>
                      <button type="submit"  class="btn btn-primary" name="submit" >Submit</button>
                    </center>

                  </div>
</div>

                    </form>
                </div>
            </div>
        </div>
    </section>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="AddParticpantModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Participant</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>
        <div class="modal-body">
         <div class="form-group " id="group">
        <label class="names">Member Id</label>
            <input type="text" class="form-control" id="addedparticpantId">
         </div>
         <div class="form-group " id="group">
        <label class="names">Participant Name</label>
                       <input type="text" class="form-control" id="addedparticpantName">

         </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary added-row">ADD</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
    function  getcompetitionType(id) {
        const slug = id.split('_').pop();
        if(slug=="solo")
        {
                        document.getElementById("group").style.display = "none";
 document.getElementById("add-row").style.display = "none";

           document.getElementById("solo").style.display = "block";

         console.log(slug);
        }
        else
        {
            document.getElementById("solo").style.display = "none";
             document.getElementById("group").style.display = "block";

             document.getElementById("groupadded").style.display = "block";
 document.getElementById("add-row").style.display = "block";
         console.log(slug);
        }
    }
</script>
<script>

        let lineNo = 1;

        $(document).ready(function () {
            $(".add-row").click(function () {
                
                var Competition_id = document.getElementById("Competition");
                var Competition_id = Competition_id.options[Competition_id.selectedIndex].text;
                var competition_value = document.getElementById("Competition");
                var Competition_values = competition_value.value;
                 var Competition_value  = Competition_values.split('_', 2);
                 console.log(Competition_value[0]);

                var participant_id = document.getElementById("familyMembers");
                var participant_id = participant_id.options[participant_id.selectedIndex].text;
                var particpant_value = document.getElementById("familyMembers");
                var particpant_value = particpant_value.value;

                if(particpant_value!="AddOther")
                {

                var substateArray =  @json($EventCompetitionAJax);
                var filteredArray = substateArray.filter(x => x.id == Competition_value[0]);
                console.log(filteredArray);
                 markup = "<tr><td>"+Competition_id+"</td><td>"+ participant_id + "<input type='hidden' name='competition_id[]' value="+ Competition_value[0] +"></td><input type='hidden' name='participant_id[]' value="+ particpant_value +"></td><td>"+filteredArray[0]['member_fee']+"<input type='hidden' name='member_fee[]' value="+ filteredArray[0]['member_fee'] +"></td></tr>";
            
                tableBody = $("table tbody");
                tableBody.append(markup);
            }
            else
            {
                $('#AddParticpantModal').modal('show');

            }

                        
                lineNo++;
            });
        }); 
    </script>

    <script>

        let lineNos = 1;

        $(document).ready(function () {
            $(".added-row").click(function () {
                console.log("aded");
                var Competition_id = document.getElementById("Competition");
                var Competition_id = Competition_id.options[Competition_id.selectedIndex].text;
                var competition_value = document.getElementById("Competition");
                var Competition_values = competition_value.value;
                 var Competition_value  = Competition_values.split('_', 2);
                 console.log(Competition_value[0]);

                var addedparticpantId = document.getElementById("addedparticpantId");
                var addedparticpantId = addedparticpantId.value;
var particpant_value = document.getElementById("addedparticpantName");
                var particpant_value = particpant_value.value;

               
                var substateArray =  @json($EventCompetitionAJax);
                var filteredArray = substateArray.filter(x => x.id == Competition_value[0]);
                console.log("fil",substateArray);
                 markup = "<tr><td>"+Competition_id+"</td><td>"+ particpant_value + "<input type='hidden' name='competition_id[]' value="+ Competition_value[0] +"></td><input type='hidden' name='participant_id[]' value="+ addedparticpantId +"></td><td>"+filteredArray[0]['member_fee']+"<input type='hidden' name='member_fee[]' value="+ filteredArray[0]['member_fee'] +"></td></tr>";
            
                tableBody = $("table tbody");
                tableBody.append(markup);
            $('#AddParticpantModal').modal('hide');
                        
                lineNos++;
            });
        }); 
    </script>
@endsection
