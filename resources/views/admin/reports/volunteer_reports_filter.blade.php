	<?php $i=1; 

			?>

				   @foreach($Volunteers as $Volunteer)
				   	 <?php
                       $string = str_replace(",","</li>",$Volunteer['opportunities']);
                       $str_arr = explode (",", $Volunteer['opportunities']); 
                      ?>
			           <tr>
                             <td>{{ $Volunteer['name'] }}</td>
			              <td>{{ $Volunteer['email'] }}</td>
			             <td>{{ $Volunteer['mobile_number'] }}</td>
			              <td>{{ $Volunteer['youth_volunteer'] }}</td>
			              <td>{{ $Volunteer['email_group'] }}</td>
			               <td style="width:250px">
			               	<ul>
			               		@foreach($str_arr as $str_arr)
			               		@if($str_arr!=" ")
			               		<li>{{$str_arr}} </li>
			               		@endif
			               			@endforeach
			               		</ul>
			               </td>
			             	<td>{{ $Volunteer['comments'] }}</td>
			           </tr>
			         @endforeach