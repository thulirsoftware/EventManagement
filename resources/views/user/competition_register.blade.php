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
                    <div class="col-md-3 form-group ">
        <label class="names">Select Competition</label>
            <select class="form-control" name="Competition" id="Competition">
                <option value="">Select Competition</option>
                    @foreach($Competition as $Competition) 
                        <option value="{{$Competition->id}}">{{$Competition->name}}</option>
                            
                     @endforeach
            </select>
         </div>
    <div class="col-md-3 form-group ">
        <label class="names">Select Participant</label>
            <select class="form-control" name="familyMembers" id="familyMembers">
                <option value="">Select</option>
                    @foreach($familyMembers as $familyMembers) 
                        <option value="{{$familyMembers->id}}">{{$familyMembers->firstName}} {{$familyMembers->lastName}}</option>
                              
                     @endforeach
            </select>
         </div>
                   
                     <div class="col-md-2 form-group">
                        <br>
                      <button type="button" class="button1 add-row" onclick="add()">Add</button>
                    </div>
                    <table class="table">
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
                  <div class="form-group" id="submit">        
                    <center>
                      <button type="submit"  class="btn btn-primary" name="submit" >ADD</button>
                    </center>

                  </div>
</div>

                    </form>
                </div>
            </div>
        </div>
    </section>
  </div>
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script>

        let lineNo = 1;

        $(document).ready(function () {
            $(".add-row").click(function () {
                 
                var Competition_id = document.getElementById("Competition");
                var Competition_id = Competition_id.options[Competition_id.selectedIndex].text;
                var competition_value = document.getElementById("Competition");
                var Competition_value = competition_value.value;

                var participant_id = document.getElementById("familyMembers");
                var participant_id = participant_id.options[participant_id.selectedIndex].text;
                var particpant_value = document.getElementById("familyMembers");
                var particpant_value = particpant_value.value;

                var substateArray =  @json($EventCompetitionAJax);
                var filteredArray = substateArray.filter(x => x.id == Competition_value);
                console.log(filteredArray);

                         markup = "<tr><td>"+Competition_id+"</td><td>"+ participant_id + "<input type='hidden' name='competition_id[]' value="+ Competition_value +"></td><input type='hidden' name='participant_id[]' value="+ particpant_value +"></td><td>"+filteredArray[0]['member_fee']+"<input type='hidden' name='member_fee[]' value="+ filteredArray[0]['member_fee'] +"></td></tr>";
            
                tableBody = $("table tbody");
                tableBody.append(markup);
                lineNo++;
            });
        }); 
    </script>
@endsection
