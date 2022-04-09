	<?php $i=1; 

			?>

				   @foreach($Sponsorship as $Sponsorship)
				   	 	<?php
				   	 		$user = App\User::where('id',$Sponsorship->user_id)->first();
				   	 		$member =  App\Member::where('user_id',$Sponsorship->user_id)->first();
					            if($member==null)
					            {
					                 $member =  App\NonMember::where('user_id',$Sponsorship->user_id)->first();
					            }
				   	 		?>
				   	 		@if($user!=null)
			           <tr>
                        
			             <td>{{ $user->name }}</td>
			              <td>{{ $user->email }}</td>
			              <td>{{ $member['mobile_number'] }}</td>
			              <td>{{ $Sponsorship->amount }}</td>
			              
			             	<td>{{ $Sponsorship->payment_status }}</td>
			           </tr>
			           @endif
			         @endforeach