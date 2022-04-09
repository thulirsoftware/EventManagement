@extends('layouts.user')

@section('content')
<div class="content-wrapper" style="background-color:white">
  <!-- Content Header (Page header) -->
  <div class="content-header">
 <a href="#" class="sidebar-toggle openbtn" data-toggle="push-menu" role="button">&#9776;</a>

</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">   
     <div class="row">
      <div class="col-md-1">
        <a href="javascript:history.back()" class="btn btn-warning" ><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
      </div>
        <div class="col-md-10">
       <div class="card card-info" style="-webkit-box-shadow: none;
          -moz-box-shadow: none;  box-shadow: none;background-color: #fff;border: 1px solid rgba(0,0,0.1,0.1);">
        <div class="card-header"  style="background-color: #f5f5fc;color:black">
            <?php
            $event = \App\Event::where('id',$id)->first();
            //$event = Event::where('id',$id)->first();
        ?>
             <h3 class="card-title" style="color: black;">Register For {{ $event->eventName }}
 </h3>
        </div>
            @if(Session::has('success'))
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  {{Session::get('success')}}
                  </div>
              @endif

<!-- Modal -->
<div class="modal fade" id="addParticipantModal" tabindex="-1" role="dialog" aria-labelledby="addParticipantModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addParticipantModalLabel">Add Participant</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body">
       <div class='row'>
    <div class='col-md-12 form-group'>
        <label class='names'>First Name</label>
        <input type='text' class='form-control' id='addedparticpantName1' onkeypress='return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)'>
    </div>
    <div class='col-md-12 form-group'>
        <label class='names'>Last Name</label>
        <input type='text' class='form-control' id='addedparticpantLastName1' onkeypress='return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)'>
    </div>
    <div class='col-md-12 form-group'>
        <label class='names'>Age (Enter the age as of event date)</label>
        <select  class='form-select'  id='addedparticpantage1' onchange='selectAge(this.value)'>
            @for ($i = 1; $i <=100; $i++)
                <option value='{{ $i }}'>{{ $i }}</option>
            @endfor
        </select>  
    </div>
    <input type="hidden" id="addedparticpantcompetitionId1">
    <div class='col-md-12 form-group'>
        <label class='names'>Email</label>
        <input type='text' class='form-control' id='addedparticpantId1'  onkeyup='ValidateEmail(1);' >
        <span id='lblError1' style='color: red'></span>
    </div>
</div><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="added-row" class="btn btn-primary added-row">Add</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" action="{{ route('competition.group.save') }}"   method="POST">
                      {{ csrf_field() }}
      <div class="modal-body">
       <div class="row">
               <input type="hidden" class="form-control" id="modal_competition_id" name="modal_competition_id">
                <input type="hidden" class="form-control" id="modal_event_id" name="modal_event_id">
         <div class="col-md-12 form-group" id="group">
        <label class="names">Group Name</label>
                       <input type="text" class="form-control" id="group_name" name="group_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">

         </div>
         <div class="col-md-12 form-group" id="group">
        <label class="names">Group Description</label>
        <textarea class="form-control" id="competition_description" name="group_description" style="height: 33px;"></textarea>

         </div>
         <div class="col-md-12 form-group" id="group">
        <label class="names">No of Participants</label>
              <select  class="form-select"  id="no_of_participants" name="no_of_participants" onchange="selectParticipants(this.value)">
            @for ($i = 1; $i <=10; $i++)
        <option value="{{ $i }}">{{ $i }}</option>
        @endfor
         </select>  
         </div>
         </div><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
  </form>
    </div>
  </div>
</div>

                <div class="card-body">
                  <form class="form-horizontal" action="{{ route('member.competition.save') }}"   method="POST">
                      {{ csrf_field() }}

               
                  <div class="row">
                    <div  class="col-md-4" >
                    </div>
                    <div class="col-md-4 form-group ">
        <label class="names">Select Competition/Non-Competition</label>
            <select class="form-select" name="Competition" id="getCompetition" onchange="getcompetitionType(this.value)">
                <option value="">Select Competition/Non-Competition</option>
                    @foreach($Competition as $Competition) 
                        <option value="{{$Competition->id}}_{{$Competition->competition_type}}_{{$Competition->name}}">{{$Competition->name}}</option>
                            
                     @endforeach
            </select>
         </div>
          <div class="col-md-4 form-group" style="padding-top:35px;display:none" id="add-group-button">
           <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">Add Group</button> 
         </div>
         <input type="hidden" id="eventId" value="{{ $event->id }}">
     </div>

 <div class="row " id="rulesHidden" style="display:none">
     <div class="col-md-4 form-group">
     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#rulesModal">
  Rules and regulations
</button>
</div>
 </div>
 <div class="modal fade" id="rulesModal" tabindex="-1" role="dialog" aria-labelledby="rulesModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="rulesModalLongTitle">Rules and regulations</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row" id="rules">
            
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
     <p class="alert alert-warning" id="competitionError" style="display:none">Select Competition</p>
     
      <div id="groupForm" style="display:none">
          
        <div id="group_data_form">
               <table class="table" id="addedGroups" style="width:100%; ">
                  <thead>
                    <tr>
                        <th>Group Name</th>
                        <th>Description</th>
                        <th>No Of Participants</th>
                        <th>Add </th>
                    </tr>
                  </thead>
                  <tbody id="group_data_table_form">  
                  </tbody>
              </table>
       </div>
        
     <br><br>
          
            </div> 
            <p class="alert alert-warning" id="soloParticipantError" style="display:none">Not a Valid Participant</p>
             <div class="row" >

     <div  class="col-md-6"  id="solo" style="display: none;"  >
       
    <div class="form-group ">
        <label class="names">Select Participant</label>
            <select class="form-select" name="familyMembers" id="solofamilyMembers" onchange="selectSoloParticipantAge(this.value)" >
                <option value="">Select</option>
                   
            </select>
         </div>
            
                  
        </div>
         <div class="col-md-6 form-group" id="solo-add-row" style="padding-top:6px;display: none;">
                        <br>
                       <button type="button"  class="button1 solo-add-row"  >Add Participant</button>
                    </div> 
               </div>
             <table class="table" id="added" style="display:none;width:100%; ">
                  <thead>
                    <tr>
                        <th>Competition Name</th>
                       <th>First Name</th>
                        <th>Last Name</th>
                         <th>Age</th>
                         <th>Fee</th>
                          <th>Delete</th>
                       
                    </tr>
                  </thead>
                  <tbody id="final_participant_added">  
                  </tbody>
              </table>       
          </div> 
          
                     
                  <div class="form-group" id="submit">        
                    <center>
                      <button type="submit"  class="btn btn-primary" name="submit" id="Submitbtn" disabled="">Submit</button>
                    </center>

                  </div>
 </form>
 <table class="table" id="alreadyAdded">
                  <thead>
                    <tr>
                        <th>Group Name</th>
                       <th>First Name</th>
                        <th>Last Name</th>
                         <th>Age</th>
                         <th>Fee</th>
                       
                    </tr>
                  </thead>
                  <tbody id="alreadyAdded_participant_added">  
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
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
    var competitionId = localStorage.getItem('Competition_value');
    console.log(competitionId);
    if(competitionId!=null)
    {
        document.getElementById('getCompetition').value=competitionId;
        getcompetitionType(competitionId);
    }
});
$('input').on('focusin', function(){
    console.log("Saving value " + $(this).val());
    $(this).data('val', $(this).val());
});

$('input').on('change', function(){
    var prev = $(this).data('val');
    var current = $(this).val();
    console.log("Prev value " + prev);
    console.log("New value " + current);
});

function selectSoloParticipantAge(value)
{
     var substateArray =  @json($familyMembersAjax);
    var filteredArray1 = substateArray.filter(x => x.id == value);

     Id =  document.getElementById("getCompetition").value;
    var Competition_value1  = Id.split('_', 3);
    const slug1 = Competition_value1[2];
    var Competition_value2  = slug1.split('-', 2);
    const slug2 = Competition_value2[0];
     var substateArray =  @json($CompetitionAjax);
    var filteredArray = substateArray.filter(x => x.id == Competition_value1[0]);
        
        Number.prototype.between = function(a, b) {
  var min = Math.min.apply(Math, [a, b]),
    max = Math.max.apply(Math, [a, b]);
  return this >= min && this <= max;
};

var windowSize = parseInt(filteredArray1[0]['age']);
console.log(windowSize,"windowSize");
        if(windowSize.between(filteredArray[0]['min_age'], filteredArray[0]['max_age'])!=true)
        {
            alert("select age between" + filteredArray[0]['min_age']+ " - " +filteredArray[0]['max_age']);
            document.getElementById('solofamilyMembers').value="";
        }
        
}
function selectAge(value)
{
    Id =  document.getElementById("getCompetition").value;
    var Competition_value1  = Id.split('_', 3);
    const slug1 = Competition_value1[2];
    var Competition_value2  = slug1.split('-', 2);
    const slug2 = Competition_value2[0];
    console.log(Competition_value1[0]);
     var substateArray =  @json($CompetitionAjax);
    var filteredArray = substateArray.filter(x => x.id == Competition_value1[0]);
        
        Number.prototype.between = function(a, b) {
  var min = Math.min.apply(Math, [a, b]),
    max = Math.max.apply(Math, [a, b]);
  return this >= min && this <= max;
};

var windowSize = parseInt(value);
console.log(windowSize,"windowSize");
        if(windowSize.between(filteredArray[0]['min_age'], filteredArray[0]['max_age'])!=true)
        {
            alert("select age between" + filteredArray[0]['min_age']+ " - " +filteredArray[0]['max_age'])
        }

   
    }

 function  getcompetitionType(id) {
        var Competition_value  = id.split('_', 2);
         localStorage.setItem('Competition_value',id);
        const slug = Competition_value[1];
        eventId =  document.getElementById("eventId").value;
        console.log(Competition_value);
        if(slug=="solo")
        {
               
            const id = Competition_value[0];
            var substateArray2 =  @json($CompetitionAjax2);
              var filteredArray2 = substateArray2.filter(x => x.id == Competition_value[0]);

             console.log(filteredArray2[0]['instruction']);
             document.getElementById('rulesHidden').style.display="block";
             document.getElementById('rules').innerHTML = "<h3>Rules and regulations :</h3> " + filteredArray2[0]['instruction'];
           
                    document.getElementById("groupForm").style.display = "none";
                    document.getElementById("add-group-button").style.display = "none";
                    
                    document.getElementById("solo-add-row").style.display = "block";
                    document.getElementById("solo").style.display = "block";
                    document.getElementById("added").style.display = "block";

                    document.getElementById("soloParticipantError").style.display = "none";
                    document.getElementById("competitionError").style.display = "none";
                    
                    var substateArray1 =  @json($familyMembersAjax);
                    
                    $("#solofamilyMembers").empty();
                    var $select = $("#solofamilyMembers");
                    $('#solofamilyMembers').append('<option value="">Select Participant</option>');
                    $.each(substateArray1, function (index, value) {
                    // APPEND OR INSERT DATA TO SELECT ELEMENT.
                    $('#solofamilyMembers').append('<option value="' + value.id + '">' + value.firstName +' '+ value.lastName + '</option>');
                    });
                    $.ajax({
                       type : 'get',
                       url : '{{route('competition.participant.list')}}',
                        data : {'id':id,'eventId':eventId},
                        success:function(data){
                    tableBody = $("table #alreadyAdded_participant_added");
                     tableBody.empty();

                    $.each(data, function (index, value)
                    {
                        console.log(value);
                         markup = "<tr><td>" 
                        + value.group_name + " </td><td>" 
                        + value.first_name + " </td><td>" 
                        + value.last_name + "</td><td>" 
                        + value.age + "</td><td>$" 
                        + value.fees + "</td></tr>";
                        tableBody.append(markup);
                    });
                        },
                            error: function(data){
                                console.log("erro",data);
                                document.getElementById("groupForm").style.display = "none";
                                 

                            }
                    });
                
           

        }
        else if(slug=="group")
        {
            var substateArray2 =  @json($CompetitionAjax2);
              var filteredArray2 = substateArray2.filter(x => x.id == Competition_value[0]);
             document.getElementById('rulesHidden').style.display="block";
             console.log(filteredArray2[0]['instruction']);
             document.getElementById('rules').innerHTML = "<h3>Rules and regulations :</h3> " + filteredArray2[0]['instruction'];
             
            const id = Competition_value[0];
            $.ajax({
               type : 'get',
               url : '{{route('competition.group.list')}}',
                data : {'id':id,'eventId':eventId},
                success:function(data){
                    console.log(data);
                    tableBody = $("table #group_data_table_form");
                     tableBody.empty();

                    $.each(data, function (index, value) {
                     markup = "<tr><td>" 
                    + value.name + "</td><td>" 
                    + value.description + "</td><td>" 
                    + value.no_of_participants + "</td><td><button type='button'  class='btn btn-primary btn-md'  onclick='openAddParticipant("+value.id+")'>Add</button></td></tr>";
                    tableBody.append(markup);

                });
                    

                     document.getElementById("soloParticipantError").style.display = "none";
                     document.getElementById("solo-add-row").style.display = "none";
                    document.getElementById("solo").style.display = "none";
                   document.getElementById("groupForm").style.display = "block";

                   document.getElementById("added").style.display = "block";
                  
                   document.getElementById("competitionError").style.display = "none";

                   document.getElementById("add-group-button").style.display = "block";
                   document.getElementById("modal_competition_id").value = Competition_value[0];
                   document.getElementById("modal_event_id").value = eventId;
                
                   $.ajax({
                       type : 'get',
                       url : '{{route('competition.participant.list')}}',
                        data : {'id':id,'eventId':eventId},
                        success:function(data){
                            console.log(data);
                    tableBody = $("table #alreadyAdded_participant_added");
                     tableBody.empty();

                    $.each(data, function (index, value)
                    {
                         markup = "<tr><td>" 
                        + value.group_name + " </td><td>" 
                        + value.first_name + " </td><td>" 
                        + value.last_name + "</td><td>" 
                        + value.age + "</td><td>$" 
                        + value.fees + "</td></tr>";
                        tableBody.append(markup);
                    });
                        },
                            error: function(data){
                                console.log("erro",data);
                                document.getElementById("groupForm").style.display = "none";
                                 

                            }
                    });
                },
                error: function(data){
                    document.getElementById("groupForm").style.display = "block";
                     document.getElementById("added").style.display = "block";
                     document.getElementById("solo-add-row").style.display = "none";
                    document.getElementById("solo").style.display = "none";
                    document.getElementById("soloParticipantError").style.display = "none";
                    document.getElementById("competitionError").style.display = "block";

                }
            });

        }
        else
        {
            document.getElementById("competitionError").style.display = "block";
            document.getElementById("soloParticipantError").style.display = "none";
        }
    }
</script>
 <script>

        let lineNo11 = 1;

        $(document).ready(function () {
            $(".solo-add-row").click(function () {
                document.getElementById("Submitbtn").disabled=false;
                var Competition_id = document.getElementById("getCompetition");
                var Competition_id = Competition_id.options[Competition_id.selectedIndex].text;
                var competition_value = document.getElementById("getCompetition");
                var Competition_values = competition_value.value;
                 var Competition_value  = Competition_values.split('_', 2);

                var participant_id = document.getElementById("solofamilyMembers");
                var participant_id = participant_id.options[participant_id.selectedIndex].text;
                
                console.log(participant_id);
                var particpant_value = document.getElementById("solofamilyMembers");
                var particpant_value = particpant_value.value;

              
                var substateArray1 =  @json($familyMembersAjax);
                var filteredArray1 = substateArray1.filter(x => x.id == particpant_value);
                console.log(filteredArray1);

                var substateArray =  @json($EventCompetitionAJax);
                var filteredArray = substateArray.filter(x => x.competition_id == Competition_value[0]);
                const myArr = participant_id.split(" ");
                if(filteredArray1[0]['Member_Id']!=null)
                {
                    MemberId = filteredArray1[0]['Member_Id'];
                    fee = filteredArray[0]['member_fee'];
                }
                else
                {
                    MemberId = filteredArray1[0]['id'];
                    fee = filteredArray[0]['non_member_fee'];
                }
                if(participant_id!="Self"){
                 markup = "<tr id=solo_"+lineNo11+"><td>"+Competition_id+"</td><td><input type='hidden' name='first_name[]' value="+ myArr[0] +">"+ myArr[0] + "<input type='hidden' name='competition_id[]' value="+ Competition_value[0] +"></td><input type='hidden' name='participant_id[]' value="+ MemberId +"></td><td><input type='hidden' name='last_name[]' value="+ myArr[1] +">"+ myArr[1] + "</td><td><input type='hidden' name='age[]' value="+ filteredArray1[0]['age'] +">"+filteredArray1[0]['age']+"</td><td>$"+fee+"<input type='hidden' name='member_fee[]' value="+ fee +"></td><td><a  id='solo_"+ lineNo11 +"' onclick='deleterow(this.id)'><i class='fa fa-trash fa-lg' style='cursor:pointer;color:#0069d9'></i></a></td></tr>";
                }
                else
                {
                     markup = "<tr id=solo_"+lineNo11+"><td>"+Competition_id+"</td><td><input type='hidden' name='first_name[]' value="+ myArr[0] +">"+ myArr[0] + "<input type='hidden' name='competition_id[]' value="+ Competition_value[0] +"></td><input type='hidden' name='participant_id[]' value="+ MemberId +"></td><td><input type='hidden' name='last_name[]' value=''></td><td><input type='hidden' name='age[]' value="+ filteredArray1[0]['age'] +">"+filteredArray1[0]['age']+"</td><td>$"+fee+"<input type='hidden' name='member_fee[]' value="+ fee +"></td><td><a  id='solo_"+ lineNo11 +"' onclick='deleterow(this.id)'><i class='fa fa-trash fa-lg' style='cursor:pointer;color:#0069d9'></i></a></td></tr>";
                }
            
                tableBody = $("table #final_participant_added");
                tableBody.append(markup);
        
                        
                lineNo11++;
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
    
<script type="text/javascript">
    function ValidateEmail(i) {
        var email = document.getElementById("addedparticpantId"+i).value;
        var lblError = document.getElementById("lblError"+i);
        lblError.innerHTML = "";
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (!expr.test(email)) {
            lblError.innerHTML = "Invalid email address.";
        }
    }
</script>
 <script>

        $(document).ready(function () {
            $(".added-row").click(function () {
                $('#addParticipantModal').modal('hide');
                document.getElementById("Submitbtn").disabled=false;
                var Competition_id = document.getElementById("getCompetition");
                Competition_id = Competition_id.options[Competition_id.selectedIndex].text;
                var competition_value = document.getElementById("getCompetition");
                var Competition_values = competition_value.value;
                var Competition_value  = Competition_values.split('_', 2);
                var divs = document.getElementById('no_of_participants');
                var rowsCount = divs.value;
                 const data = [];
                 var addedparticpantId = document.getElementById("addedparticpantId1");
                var addedparticpantId = addedparticpantId.value;
                var particpant_value = document.getElementById("addedparticpantName1");
                var particpant_value = particpant_value.value;

                var addedparticpantLastName = document.getElementById("addedparticpantLastName1");
                var addedparticpantLastName = addedparticpantLastName.value;
                var addedparticpantAge = document.getElementById("addedparticpantage1");
                var addedparticpantAge = addedparticpantAge.value;
                 var addedparticpantcompetitionId1 = document.getElementById("addedparticpantcompetitionId1");
                var groupId = addedparticpantcompetitionId1.value;

                
               if(addedparticpantId!="")
               {
                var substateArray1 =  @json($MembersAjax);
                var filteredArray1 = substateArray1.filter(x => x.Email_Id == addedparticpantId);
                console.log(filteredArray1);
               }
               else
               {
                    var substateArray1 =  @json($MembersAjax);
                    var filteredArray1 = substateArray1.filter(x => x.id == addedparticpantId);
               }
               console.log(filteredArray1.length);
                
               if(filteredArray1.length>0)
               {
                var substateArray =  @json($EventCompetitionAJax);
                var filteredArray = substateArray.filter(x => x.competition_id == Competition_value[0]);

                 markup = "<tr id=group_"+1+"><td>"+Competition_id+"</td><td><input type='hidden' name='first_name[]' value="+ particpant_value +">"+ particpant_value + "<input type='hidden' name='competition_id[]' value="+ Competition_value[0] +"></td><td><input type='hidden' name='last_name[]' value="+ addedparticpantLastName +">"+addedparticpantLastName+"</td><td>input type='hidden' name='age[]' value="+ addedparticpantAge +">"+addedparticpantAge+"</td><input type='hidden' name='participant_id[]' value="+ addedparticpantId +"></td><td>$"+filteredArray[0]['member_fee']+"<input type='hidden' name='member_fee[]' value="+ filteredArray[0]['member_fee'] +"><input type='hidden' name='group_id[]' value="+ groupId +"></td><td><a  id='group_"+ lineNos +"' onclick='deleterow(this.id)'><i class='fa fa-trash fa-lg' style='cursor:pointer;color:#0069d9'></i></a></td></tr>";
            }
            else
            {
                var substateArray =  @json($EventCompetitionAJax);
                var filteredArray = substateArray.filter(x => x.competition_id == Competition_value[0]);
                 markup = "<tr id=group_"+1+"><td>"+Competition_id+"</td><td><input type='hidden' name='first_name[]' value="+ particpant_value +">"+ particpant_value + "<input type='hidden' name='competition_id[]' value="+ Competition_value[0] +"></td><td><input type='hidden' name='last_name[]' value="+ addedparticpantLastName +">"+addedparticpantLastName+"</td><td><input type='hidden' name='age[]' value="+ addedparticpantAge +">"+addedparticpantAge+"</td><input type='hidden' name='participant_id[]' value="+ addedparticpantId +"></td><td>$"+filteredArray[0]['non_member_fee']+"<input type='hidden' name='member_fee[]' value="+ filteredArray[0]['non_member_fee'] +"><input type='hidden' name='group_id[]' value="+ groupId +"></td></td><td><a  id='group_1' onclick='deleterow(this.id)'><i class='fa fa-trash fa-lg' style='cursor:pointer;color:#0069d9'></i></a></td></tr>";
            }
                tableBody = $("table #final_participant_added");
                tableBody.append(markup);
                document.getElementById("addedparticpantId1").value="";
                document.getElementById("addedparticpantName1").value="";
                document.getElementById("addedparticpantLastName1").value="";
                document.getElementById("addedparticpantage1").value="";
                
                
            });
        }); 
function openAddParticipant(groupId)
{
    console.log(groupId,"groupId");
    document.getElementById("addedparticpantcompetitionId1").value=groupId;
    $('#addParticipantModal').modal('show');
  }
  </script>