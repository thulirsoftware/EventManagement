<br>
   <div class="add-button" >
      <a class="btn btn-primary btn-sm" style="float:right;color:white" href="{{ url('admin/Event/addEventFoodTicket',$event['id']) }}">Add</a> 
  </div><br><br>
  <table class="table table-bordered table-striped" id="event_food_list">
      <thead style="background-color:white">
        <tr>
          <th>Min Age</th>
          <th>Max Age</th>
          <th>Member Type</th>
          <th>Food Type</th>
          <th>Ticket Price</th>
          <th>Actions</th>
      </tr>
  </thead>
  <tbody >
    <?php $i = 1 ?>  
    @foreach($eventFoodTicket as $ticket)
    <tr id="row_food_{{ $ticket['id'] }}">

      <td id="row_food_event_age{{ $ticket['id'] }}">{{ $ticket['min_age'] }}</td>
      <td id="row_food_event_max_age{{ $ticket['id'] }}">{{ $ticket['max_age'] }}</td>
      <td id="row_food_event_type{{ $ticket['id'] }}">{{ $ticket['memberType'] }}</td>
      <td id="row_food_event_food{{ $ticket['id'] }}">{{ $ticket['foodType'] }}</td>
      <td id="row_food_event_price{{ $ticket['id'] }}">{{ $ticket['ticketPrice'] }}</td>

      <td>
        <a  id="row_food_edit{{ $ticket['id'] }}" style="cursor:pointer;color:#0069d9" onclick="edit_row('{{ $ticket['id'] }}')">
          <i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i>
      </a>
      <input type="button" id="food_save_button{{ $ticket['id'] }}" value="Save" class="btn btn-primary" onclick="save_Food_row('{{ $ticket['id'] }}')" style="display:none">
      <a  onclick="DeleteEventFoodTicket({{$ticket['id']}})" id="row_food_delete{{ $ticket['id'] }}"><i class="fa fa-trash fa-lg" style="cursor:pointer;color:#0069d9"></i></a>
  </td>


</tr>
@endforeach
</tbody>
</table>