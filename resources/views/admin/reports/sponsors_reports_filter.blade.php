	<?php $i=1; 

			?>

				   @foreach($Sponsorship as $Sponsorship)
				   	 	<?php
				   	 		$user = App\User::where('id',$Sponsorship->user_id)->first();
				   	 		?>
				   	 		@if($user!=null)
			           <tr>
                        
			             <td>{{ $user->name }}</td>
			              <td>{{ $user->email }}</td>
			              <td>{{ $Sponsorship->amount }}</td>
			              
			             	<td>{{ $Sponsorship->payment_status }}</td>
			           </tr>
			           @endif
			         @endforeach