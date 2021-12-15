         <br>
           <div class="add-button" >
      <a class="btn btn-primary btn-sm" style="float:right;color:white" href="{{ url('admin/Event/addVipTicket',$event['id']) }}">Add</a> 
  </div><br><br>
         <table class="table table-striped table-bordered">
             <thead style="background-color: white;">
              <tr>
                <th>Type</th>
                <th>For</th>
                <th>Time</th>
                <th>Name</th>
                <th>No Of Entry Tickets</th>
                <th>No Of Food Tickets</th>
            </tr>
        </thead>
        <tbody> 
            @foreach($VipJudgeTickets as $vipJudgeTicket)
             <?php 
                $competion = App\Competition::where('id',$vipJudgeTicket->competition_id)->first();
            ?>
            <tr>
                <td>{{$vipJudgeTicket->type}}</td>
                
                @if($vipJudgeTicket->competition_id!=null)
                <td>Competition - {{$competion->name}}</td>
                @else
                <td>Event</td>
                @endif
                <td>{{$vipJudgeTicket->start_time}} - {{$vipJudgeTicket->end_time}}</td>
                <td>{{$vipJudgeTicket->name}}</td>
                <td>{{$vipJudgeTicket->no_entry_tickets}}</td>
                <td>{{$vipJudgeTicket->no_food_tickets}}</td>
            </tr>
            @endforeach
        </tbody>
         </table>