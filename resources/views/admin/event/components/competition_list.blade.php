<br>

 <div class="add-button" >
    <a class="btn btn-primary btn-sm" style="float:right;color:white" href="{{ url('admin/Event/addCompetition',$event['id']) }}">Add</a> 
</div><br><br>
<table class="table table-bordered table-striped" id="event_competition_list">
    <thead style="background-color:white">
      <tr>
        <th>Competition Name</th>
        <th>Member Fees </th>
        <th>Non Member Fees</th>
        <th>Locations</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody >
  <?php $i = 1 ?>  
  @foreach($Competition as $Competition)
  <?php
  $EventCompetition = \App\EventCompetition::where('competition_id',$Competition['id'])->where('event_id',$id)->first();
  $CompetitionRegistered = \App\CompetitionRegistered::where('competition_id',$Competition['id'])->where('event_id',$id)->count();
  $CompetitionLocations = \App\CompetitionLocations::where('competition_id',$Competition['id'])->groupBy('location_id')->pluck('location_id');
   $Locations = \App\LocationModel::whereIn('id',$CompetitionLocations)->pluck('location_name')->implode(',');

?>
<tr>
   <td>{{$Competition->name}}</td>
   <td>{{ $EventCompetition['member_fee'] }}</td>
   <td>{{ $EventCompetition['non_member_fee'] }}</td>
   <td>{{ $Locations}}</td>


   <td>
      <a href="{{ route('admin.event.competition.edit', ['id' => $Competition['id'],'eventId'=>$event['id']]) }}" style="cursor:pointer;color:#0069d9">
        <i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i>
    </a>
    @if($CompetitionRegistered<=0)
    <a onclick="myFunction({{$Competition['id']}})"  id="row_Competition_delete{{ $Competition['id'] }}"  style="cursor:pointer;color:#0069d9"> <i class="fa fa-trash" ></i></a>
    @endif
     @if($EventCompetition['status']=='Y')
      <a id="row_competition_approve{{ $EventCompetition['id'] }}" onclick="ApproveCompetition({{ $EventCompetition['id'] }},'N')"><i class="fa fa-thumbs-up fa-lg" style="cursor:pointer;color:green"></i></a>
      @else
        <a id="row_competition_approve{{ $EventCompetition['id'] }}" onclick="ApproveCompetition({{ $EventCompetition['id'] }},'Y')"><i class="fa fa-thumbs-down fa-lg" style="cursor:pointer;color:red"></i></a>
      @endif
</td>


</tr>
@endforeach
</tbody>
</table>