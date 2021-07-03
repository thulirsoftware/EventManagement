<div class="row">
    <div class="col-md-3 form-group ">
        <label class="names">Competition</label>
            <select class="form-control" name="FoodmemberType" id="ddlViewBy">
                <option value="">Select</option>
                    @foreach($Competition as $Competition) 
                        <option value="{{$Competition->id}}">{{$Competition->name}}</option>
                              
                     @endforeach
            </select>
         </div>
         <div class="col-md-3 form-group">
                    <label for="start_date">Starting Date:</label>
                      <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>                  
                  
                    <div class="col-md-3 form-group">
                    <label for="Description">Closing Date:</label>
                      <input type="date" class="form-control" id="closing_date"  name="closing_date" required>
                    </div>
                     <div class="col-md-3 form-group">
                    <label for="Description">Member Fees :</label>
                      <input type="text" class="form-control" id="member_fee" name="member_fee" required>
                    </div>
                     <div class="col-md-3 form-group">
                    <label for="Description">Non Member Fees :</label>
                      <input type="text" class="form-control" id="non_member_fee" name="non_member_fee" required>
                    </div>
                     <div class="col-md-2 form-group">
                        <br>
                      <button type="button" class="button1 add-row" onclick="add()">Add</button>
                    </div>
    </div>
    <!-- Modal -->
   