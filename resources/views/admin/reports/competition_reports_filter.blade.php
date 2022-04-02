<?php $i=1; 

			?>

				   @foreach($competitions as $competition)
				   	 	<?php
				   	 		$events = \App\Event::where('id',$competition->event_id)->first();
				   	 		$competitioncfg = \App\Competition::where('id',$competition->competition_id)->first();
				   	 		$groups = \App\GroupNames::where('id',$competition->group_id)->first();
				   	 ?>

			           <tr>
			               @if($events!=null)
			             <td>{{ $events['eventName'] }}</td>
			             @else
			                <td> - </td>
			             @endif
			              @if($competitioncfg!=null)
			             <td>{{ $competitioncfg['name'] }}</td>
			             @else
			                <td> - </td>
			             @endif
			             @if($groups!=null)
			            <td>{{ $groups['name'] }}</td>
			             @else
			             <td> - </td>
			             @endif
			             
			             <td>{{ $competition['first_name'] }} {{ $competition['last_name'] }}</td>
			            <td>{{ $competition['participant_id'] }}</td>
			             <td>$ {{ $competition['fees'] }}</td>
			              

			           </tr>
			         @endforeach