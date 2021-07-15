@extends('layouts.admin')

@section('content')
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
        <form method="post" action="{{ url('admin/addEventcompetitionsSave') }}" enctype="multipart/form-data" id="regForm">

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
<div class="row">
    <div class="col-md-3 form-group ">
        <label class="names">Competition</label>
            <select class="form-control" name="FoodmemberType" id="ddlViewBy">
                <option value="">Select</option>
                    @foreach($Competition as $Competition) 
                        <option value="{{$Competition->id}}">{{$Competition->name}}</option>
                              
                     @endforeach
            </select>
            <p id="competitionerror" style="color:red"></p>
         </div>                  
            <div class="col-md-3 form-group">
                <label for="Description">Member Fees :</label>
                <input type="text" class="form-control" id="member_fee" name="member_fee" required>
                 <p id="member_fee_error" style="color:red"></p>
            </div>
           <div class="col-md-3 form-group">
                    <label for="Description">Non Member Fees :</label>
                      <input type="text" class="form-control" id="non_member_fee" name="non_member_fee" required>
                       <p id="non_member_fee_error" style="color:red"></p>
            </div>
                     <div class="col-md-2 form-group">
                        <br>
                      <button type="button" class="button1 add-row" onclick="add()">Add</button>
                    </div>
    </div>
     <table class="table">
                  <thead>
                    <tr>
                        <th>Name</th>
                      <th>Member Fee</th>
                       <th>Non Member Fee</th>
                       <th>Delete</th>
                       
                    </tr>
                  </thead>
                  <tbody>  
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