<br>
         <table class="table table-striped table-bordered" id="event_edit_list">
            <thead style="background-color: white;">
              <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Location</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody> 
          <?php $i=1 ?> 
          <?php
          $string = str_replace(" ","\r\n",$event['eventName']);
          ;
          $newtext = wordwrap($event['eventName'], 20, "\n");
      ?>
      <tr>

          <td>{!! nl2br(e($newtext)) !!}</td>
          <td>{{ $event['eventDate'] }}</td>
          <td>{{ $event['eventTime'] }}</td>
          <td>{{ $event['eventLocation'] }}</td>
          <td><button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit" style="text-align:center;"></i>&nbsp;</button>&nbsp;&nbsp;<a onclick="DeleteEvent({{$event['id']}})"  > <i class="fa fa-trash" style="cursor:pointer;color:#0069d9"></i></a></td>
      </tr>
  </tbody> 
</table>