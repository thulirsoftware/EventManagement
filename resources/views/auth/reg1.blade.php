<div class="container">
  <h2>Vertical (basic) form</h2>
  <form action="/action_page.php">

       <div class="panel col-md-10 col-md-offset-1">
                <div class="panel-heading" style="background-color:brown;color:white">Register</div>
                <div class="panel-body "style="background-color:#f3f4c6">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
         <input type="hidden" class="form-control" name="userType" value="user">


        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
     <div class="row">
        <div class="form-group col-md-3 col-md-offset-2">
          <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="First Name" required autofocus>
        </div>
        <div class="col-md-1" style="margin-left:-30px;margin-top:0px">
          <span style="background-color:brown;height: 35px;width:35px" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-envelope"></i></span>
        </div>
        <div class="form-group col-md-3">
          <input id="lastName" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}" placeholder="Last Name" required autofocus>
        </div>
        <div class="col-md-1" style="margin-left:-30px;margin-top:0px">
          <span style="background-color:brown;height: 35px;width:35px" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-envelope"></i></span>
        </div>

     </div>


     <div class="row">

        <div class="form-group col-md-3 col-md-offset-2">
          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Primary Email" required>
        </div>
        <div class="col-md-1" style="margin-left:-30px;margin-top:0px">
          <span style="background-color:brown;height: 35px;width:35px" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-envelope"></i></span>
        </div>
        <div class="form-group col-md-3">
          <input id="phoneNo1" type="text" class="form-control" name="phoneNo1" placeholder="Phone No" max="10" value="{{ old('phoneNo1') }}" required>
        </div>
        <div class="col-md-1" style="margin-left:-30px;margin-top:0px">
          <span style="background-color:brown;height: 35px;width:35px" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-envelope"></i></span>
        </div>

     </div>


     <div class="row">

        <div class="form-group col-md-3 col-md-offset-2">
          <select name="gender" id="gender" class="selectpicker form-control" required="">
                    <option value="">Gender</option> 
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
        </div>
        <div class="col-md-1" style="margin-left:-30px;margin-top:0px">
          <span style="background-color:brown;height: 35px;width:35px" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-envelope"></i></span>
        </div>
        <div class="form-group col-md-3">
          </select>
          <select name="maritalStatus" id="maritalStatus" class="selectpicker form-control" required="">
                    <option value="">Marital Status</option>
                    <option value="single">Single</option> 
                    <option value="married">Married</option>
                </select>
        </div>
        <div class="col-md-1" style="margin-left:-30px;margin-top:0px">
          <span style="background-color:brown;height: 35px;width:35px" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-envelope"></i></span>
        </div>

     </div>


     <div class="row">

        <div class="form-group col-md-3 col-md-offset-2">
          <select class="form-control" id="sel1">
            <option>Date of Birth</option>
            <option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option><option>21</option><option>22</option><option>23</option><option>24</option><option>25</option><option>26</option><option>27</option><option>28</option><option>29</option><option>30</option><option>31</option>
          </select>
        </div>
        <div class="col-md-1" style="margin-left:-30px;margin-top:0px">
          <span style="background-color:brown;height: 35px;width:35px" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-envelope"></i></span>
        </div>
        <div class="form-group col-md-3">
          </select>
          <select class="form-control" id="sel1">
            <option>Month of Birth</option><option>January</option><option>February</option><option>March</option><option>April</option>
            <option>May</option><option>June</option><option>July</option><option>August</option>
            <option>September</option><option>October</option><option>November</option><option>December</option>
          </select>
        </div>
        <div class="col-md-1" style="margin-left:-30px;margin-top:0px">
          <span style="background-color:brown;height: 35px;width:35px" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-envelope"></i></span>
        </div>

     </div>

    
    <div class="row">

        <div class="form-group col-md-3 col-md-offset-2">
          <textarea id="address1" class="form-control" name="address1" placeholder="Address 1" value="{{ old('address1') }}" required></textarea>
        </div>
        <div class="col-md-1" style="margin-left:-30px;margin-top:0px">
          <span style="background-color:brown;height: 35px;width:35px" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-envelope"></i></span>
        </div>
        <div class="form-group col-md-3">
          <textarea id="address2" class="form-control" name="address2" placeholder="Address 2" value="{{ old('address2') }}" required></textarea>
        </div>
        <div class="col-md-1" style="margin-left:-30px;margin-top:0px">
          <span style="background-color:brown;height: 35px;width:35px" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-envelope"></i></span>
        </div>

     </div>
    

    <div class="row">

        <div class="form-group col-md-3 col-md-offset-2">
          <input id="city" type="text" class="form-control" name="city" placeholder="Enter City Name" value="{{ old('city') }}" required>
        </div>
        <div class="col-md-1" style="margin-left:-30px;margin-top:0px">
          <span style="background-color:brown;height: 35px;width:35px" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-envelope"></i></span>
        </div>
        <div class="form-group col-md-3">
          <input id="state" type="text" class="form-control" name="state" placeholder="Enter State Name" value="{{ old('state') }}" required>
        </div>
        <div class="col-md-1" style="margin-left:-30px;margin-top:0px">
          <span style="background-color:brown;height: 35px;width:35px" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-envelope"></i></span>
        </div>

     </div>


     <div class="row">

        <div class="form-group col-md-3 col-md-offset-2">
          <input id="zipCode" type="text" class="form-control" name="zipCode" placeholder="Zip Code" value="{{ old('zipCode') }}" maxlength="6" required>
        </div>
        <div class="col-md-1" style="margin-left:-30px;margin-top:0px">
          <span style="background-color:brown;height: 35px;width:35px" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-envelope"></i></span>
        </div>

     </div>


     <div class="row">

        <div class="form-group col-md-3 col-md-offset-4">
          <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" required>
        </div>
        <div class="col-md-1" style="margin-left:-30px;margin-top:0px">
          <span style="background-color:brown;height: 35px;width:35px" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-envelope"></i></span>
        </div>

     </div>


<div class="family" style="display: none">
        <div class="col-md-6 form-group">

            <div class="input-group col-md-offset-4 col-md-9">
                <input id="spouseName" type="text" class="form-control" name="spouseName" placeholder="Spouse First Name" value="{{ old('spouseName') }}">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

            </div>
        </div>
<div class="col-md-6 form-group">
           
            <div class="input-group col-md-offset-2 col-md-8">
                <input id="spousePhoneNo" type="text" class="form-control" name="spousePhoneNo" placeholder="Spouse Phone Number" value="{{ old('spousePhoneNo') }}">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-earphone"></i></span>

                <span style="color: red" id="errmssg"></span>

            </div>
        </div>


        <?php 
          $schools = App\School::pluck('name');
        ?>

        
        <div class="col-md-6 form-group">

            <div class="input-group col-md-offset-4 col-md-9">
                <input id="firstChildName" type="text" class="form-control" name="firstChildName" value="{{ old('firstChildName') }}" placeholder="Child1 First Name">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

              
            </div>
        </div>

        <div class="col-md-6 form-group">
           
            <div class="input-group col-md-offset-2 col-md-8">
              
                <select name="child1SchoolName" id="child1SchoolName" style="width: 180px;height: 30px;border-radius: 4px;background-color: white">
                  <option value="">None</option>
                  @foreach($schools as $key => $school)
                    <option value="{{ $school }}">{{ $school }}</option>
                  @endforeach
                </select>

                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-home"></i></span>

               
            </div>
        </div>



        <div class="col-md-6 form-group" style="margin-left: -260px">
           
            <div class="input-group col-md-offset-1 col-md-9">
                <input id="secondChildName" type="text" class="form-control" name="secondChildName" placeholder="Child2 First Name" value="{{ old('secondChildName') }}">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

              
            </div>
        </div>
        <div class="col-md-6 form-group" style="margin-left: -100px">
         
            <div class="input-group col-md-offset-2 col-md-8">
               
                <select name="child2SchoolName" id="child2SchoolName" style="width: 180px;height: 30px;border-radius: 4px;background-color: white">
                  <option value="">None</option>
                  @foreach($schools as $key => $school)
                    <option value="{{ $school }}">{{ $school }}</option>
                  @endforeach
                </select>

                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-home"></i></span>

            </div>
        </div>


        <div class="col-md-6 form-group" style="margin-left: 14px">
            <div class="input-group col-md-offset-3 col-md-9">
                <input id="thirdChildName" type="text" class="form-control" name="thirdChildName" value="{{ old('thirdChildName') }}" placeholder="Child3 First Name">
                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-user"></i></span>

            </div>
        </div>

         <div class="col-md-6 form-group">
           
            <div class="input-group col-md-offset-1 col-md-8">
                
                <select name="child3SchoolName" id="child3SchoolName" style="width: 180px;height: 30px;border-radius: 4px;background-color: white">
                  <option value="">None</option>
                  @foreach($schools as $key => $school)
                    <option value="{{ $school }}">{{ $school }}</option>
                  @endforeach
                </select>


                <span style="background-color:brown" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-home"></i></span>

            </div>
        </div>
</div>

     <div class="row">

        <div class="form-group col-md-3 col-md-offset-4">
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmation Password" required>
        </div>
        <div class="col-md-1" style="margin-left:-30px;margin-top:0px">
          <span style="background-color:brown;height: 35px;width:35px" class="input-group-addon"><i style="color:white" class="glyphicon glyphicon-envelope"></i></span>
        </div>

     </div>


    <div class="row">
      <div class="form-group col-md-3 col-md-offset-5">
        <button type="submit" class="btn btn-lg btn-primary">
                Register
        </button>
     </div>   
    </div>

    
</form>
</div>