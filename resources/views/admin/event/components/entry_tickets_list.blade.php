 <br>
    <div class="add-button" >
      <a class="btn btn-primary btn-sm" style="float:right;color:white" href="{{ url('admin/Event/addEventEntryTicket',$event['id']) }}">Add</a> 
  </div><br><br>
  <table class="table table-bordered table-striped" id="event_entry_list">
      <thead style="background-color:white">
        <tr>
          <th>Min Age</th>
          <th>Max Age</th>
          <th>Member Type</th>
          <th>Ticket Price</th>
          <th>Actions</th>
      </tr>
  </thead>
  <tbody >
    <?php $i = 1 ?>  
    @foreach($eventTicket as $ticket)
    <tr id="row_event_{{ $ticket['id'] }}">

      <?php
      $event = \App\Event::where('id',$ticket['eventId'])->first();
  ?>
  <td id="row_entry_age{{ $ticket['id'] }}">{{ $ticket['min_age'] }}</td>
  <td id="row_entry_max_age{{ $ticket['id'] }}">{{ $ticket['max_age'] }}</td>
  <td id="row_entry_type{{ $ticket['id'] }}">{{ $ticket['memberType'] }}</td>
  <td id="row_entry_price{{ $ticket['id'] }}">{{ $ticket['ticketPrice'] }}</td>
  <td>
      <a style="cursor:pointer;color:#0069d9" onclick="edit_Entry_row('{{ $ticket['id'] }}')" id="row_entry_edit{{ $ticket['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a>

      <input type="button" id="entry_save_button{{ $ticket['id'] }}" value="Save" class="btn btn-primary" onclick="save_Entry_row('{{ $ticket['id'] }}')" style="display:none">
      &nbsp;&nbsp;
      <a id="row_entry_delete{{ $ticket['id'] }}" onclick="DeleteEntryTicket({{ $ticket['id'] }})"><i class="fa fa-trash fa-lg" style="cursor:pointer;color:#0069d9"></i></a>
      @if($ticket['status']=='Y')
      <a id="row_entry_approve{{ $ticket['id'] }}" onclick="ApproveEntryTicket({{ $ticket['id'] }},'N')"><i class="fa fa-thumbs-up fa-lg" style="cursor:pointer;color:green"></i></a>
      @else
        <a id="row_entry_approve{{ $ticket['id'] }}" onclick="ApproveEntryTicket({{ $ticket['id'] }},'Y')"><i class="fa fa-thumbs-down fa-lg" style="cursor:pointer;color:red"></i></a>
      @endif
  </td>

</tr>
@endforeach
</tbody>
</table>