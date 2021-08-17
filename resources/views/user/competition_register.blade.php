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
        <div class="col-md-10">
        <div class="card card-info" style="-webkit-box-shadow: none;
          -moz-box-shadow: none;  box-shadow: none;background-color: #f7f7f7;">
        <div class="card-header" style="background-color: #1f5387;">
            <?php
            $event = Session::get('Events');
            //$event = Event::where('id',$id)->first();
        ?>
             <h3 class="card-title">Register For {{ $event->eventName }}
 </h3>
        </div>
            @if(Session::has('success'))
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  {{Session::get('success')}}
                  </div>
              @endif
                <div class="card-body">
                  <form class="form-horizontal" action="{{ route('member.competition.save') }}"   method="POST">
                      {{ csrf_field() }}

               
                  <div class="row">
                    <div  class="col-md-4" >
                    </div>
                    <div class="col-md-4 form-group ">
        <label class="names">Select Competition</label>
            <select class="form-control" name="Competition" id="getCompetition" onchange="getcompetitionType(this.value)">
                <option value="">Select Competition</option>
                    @foreach($Competition as $Competition) 
                        <option value="{{$Competition->id}}_{{$Competition->competition_type}}">{{$Competition->name}}</option>
                            
                     @endforeach
            </select>
         </div>
         <input type="hidden" id="eventId" value="{{ $event->id }}">
     </div>
     <p class="alert alert-warning" id="competitionError" style="display:none">Select Competition</p>
     
                <div id="groupForm" style="display:none">
                <div class="row">
              
         <div class="col-md-3 form-group" id="group">
        <label class="names">First Name</label>
                       <input type="text" class="form-control" id="addedparticpantName">

         </div>
         <div class="col-md-3 form-group" id="group">
        <label class="names">Last Name</label>
                       <input type="text" class="form-control" id="addedparticpantLastName">

         </div>
         <div class="col-md-2 form-group" id="group">
        <label class="names">Age</label>
                       <input type="text" class="form-control" id="addedparticpantage">

         </div>
         <div class="col-md-3 form-group" id="group">
        <label class="names">Email</label>
            <input type="text" class="form-control" id="addedparticpantId">
         </div>
         <center style="padding-top:5px">
            <br>
            <button type="button" class="btn btn-primary added-row">ADD</button> 
        </center>
     </div>
          
            </div> 
            <p class="alert alert-warning" id="soloParticipantError" style="display:none">Not a Valid Participant</p>
             <div class="row" >

     <div  class="col-md-6"  id="solo" style="display: none;"  >
       
    <div class="form-group ">
        <label class="names">Select Participant</label>
            <select class="form-control" name="familyMembers" id="solofamilyMembers">
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
                  <tbody>  
                  </tbody>
              </table>       
          </div> 
          
                     
                  <div class="form-group" id="submit">        
                    <center>
                      <button type="submit"  class="btn btn-primary" name="submit" id="Submitbtn" disabled="">Submit</button>
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

       
         
      
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script>
    
</script>
<script type="text/javascript">
    function  getcompetitionType(id) {
        var Competition_value  = id.split('_', 2);
        const slug = Competition_value[1];
        eventId =  document.getElementById("eventId").value;
        console.log(eventId);
        if(slug=="solo")
        {
               
            const id = Competition_value[0];
            $.ajax({
               type : 'get',
               url : '{{URL::to('Competition/AgeValidation')}}',
                data : {'id':id,'eventId':eventId},
                success:function(data){
                    console.log(data);
                    document.getElementById("groupForm").style.display = "none";
                    document.getElementById("solo-add-row").style.display = "block";
                    document.getElementById("solo").style.display = "block";
                    document.getElementById("added").style.display = "block";

                    document.getElementById("soloParticipantError").style.display = "none";
                    document.getElementById("competitionError").style.display = "none";
                    $("#solofamilyMembers").empty();
                    var $select = $("#solofamilyMembers");
                    $('#solofamilyMembers').append('<option value="">Select Participant</option>');
                    $.each(data, function (index, value) {
                    // APPEND OR INSERT DATA TO SELECT ELEMENT.
                    $('#solofamilyMembers').append('<option value="' + value.id + '">' + value.firstName +' '+ value.lastName + '</option>');
                    });
                },
                error: function(data){
                    document.getElementById("groupForm").style.display = "none";
                     document.getElementById("added").style.display = "none";
                    document.getElementById("soloParticipantError").style.display = "block";
                    document.getElementById("competitionError").style.display = "none";
                }
                 
              });
           

        }
        else if(slug=="group")
        {
             document.getElementById("soloParticipantError").style.display = "none";
             document.getElementById("solo-add-row").style.display = "none";
            document.getElementById("solo").style.display = "none";
           document.getElementById("groupForm").style.display = "block";

           document.getElementById("added").style.display = "block";
          
           document.getElementById("competitionError").style.display = "none";

        }
        else
        {
            document.getElementById("competitionError").style.display = "block";
            document.getElementById("soloParticipantError").style.display = "none";
        }
    }
</script>

    <script>

        let lineNos = 1;

        $(document).ready(function () {
            $(".added-row").click(function () {
                document.getElementById("Submitbtn").disabled=false;
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

                var addedparticpantLastName = document.getElementById("addedparticpantLastName");
                var addedparticpantLastName = addedparticpantLastName.value;
                var addedparticpantAge = document.getElementById("addedparticpantage");
                var addedparticpantAge = addedparticpantAge.value;
                console.log(addedparticpantId);
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

                 markup = "<tr id=group_"+lineNos+"><td>"+Competition_id+"</td><td>"+ particpant_value + "<input type='hidden' name='competition_id[]' value="+ Competition_value[0] +"></td><td>"+addedparticpantLastName+"</td><td>"+addedparticpantAge+"</td><input type='hidden' name='participant_id[]' value="+ addedparticpantId +"></td><td>$"+filteredArray[0]['member_fee']+"<input type='hidden' name='member_fee[]' value="+ filteredArray[0]['member_fee'] +"></td><td><a  id='group_"+ lineNos +"' onclick='deleterow(this.id)'><i class='fa fa-trash fa-lg' style='cursor:pointer;color:#0069d9'></i></a></td></tr>";
            }
            else
            {
                var substateArray =  @json($EventCompetitionAJax);
                var filteredArray = substateArray.filter(x => x.competition_id == Competition_value[0]);
                 markup = "<tr id=group_"+lineNos+"><td>"+Competition_id+"</td><td>"+ particpant_value + "<input type='hidden' name='competition_id[]' value="+ Competition_value[0] +"></td><td>"+addedparticpantLastName+"</td><td>"+addedparticpantAge+"</td><input type='hidden' name='participant_id[]' value="+ addedparticpantId +"></td><td>$"+filteredArray[0]['non_member_fee']+"<input type='hidden' name='member_fee[]' value="+ filteredArray[0]['non_member_fee'] +"></td><td><a  id='group_"+ lineNos +"' onclick='deleterow(this.id)'><i class='fa fa-trash fa-lg' style='cursor:pointer;color:#0069d9'></i></a></td></tr>";
            }
                tableBody = $("table tbody");
                tableBody.append(markup);
                document.getElementById("addedparticpantId").value="";
                document.getElementById("addedparticpantName").value="";
                document.getElementById("addedparticpantLastName").value="";
                document.getElementById("addedparticpantage").value="";
                lineNos++;
            });
        }); 
    </script>
    <script>

        let lineNo11 = 1;

        $(document).ready(function () {
            $(".solo-add-row").click(function () {
                document.getElementById("Submitbtn").disabled=false;
                var Competition_id = document.getElementById("Competition");
                var Competition_id = Competition_id.options[Competition_id.selectedIndex].text;
                var competition_value = document.getElementById("Competition");
                var Competition_values = competition_value.value;
                 var Competition_value  = Competition_values.split('_', 2);

                var participant_id = document.getElementById("solofamilyMembers");
                var participant_id = participant_id.options[participant_id.selectedIndex].text;
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

                 markup = "<tr id=solo_"+lineNo11+"><td>"+Competition_id+"</td><td>"+ myArr[0] + "<input type='hidden' name='competition_id[]' value="+ Competition_value[0] +"></td><input type='hidden' name='participant_id[]' value="+ MemberId +"></td><td>"+ myArr[1] + "</td><td>"+filteredArray1[0]['age']+"</td><td>$"+fee+"<input type='hidden' name='member_fee[]' value="+ fee +"></td><td><a  id='solo_"+ lineNo11 +"' onclick='deleterow(this.id)'><i class='fa fa-trash fa-lg' style='cursor:pointer;color:#0069d9'></i></a></td></tr>";
                
            
                tableBody = $("table tbody");
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
@endsection
