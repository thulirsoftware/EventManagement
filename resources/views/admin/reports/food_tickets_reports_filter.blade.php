	<?php $i=1; 

								?>

								@foreach($PurchasedEventFoodTickets as $PurchasedEventFoodTickets)
								<?php
								$user =  App\User::where('id',$PurchasedEventFoodTickets->userId)->first();
								$event  = App\Event::where('id',$PurchasedEventFoodTickets->eventId)->first();
								$EventTicket  = App\EventTicket::where('id',$PurchasedEventFoodTickets->ticketId)->first();

								$ageGroup="";
					            if($EventTicket['min_age']>=18)
					            {
					              $ageGroup = "Adult";
					            }
					            else 
					            {
					              $ageGroup = "Kids";
					            }

							?>
							<tr>
								<td> {{ $i++ }} </td>

								<td>{{ $event['eventName'] }}</td>
								<td>{{ $event['eventDate'] }}</td>
								<td>{{ $user['name']}}</td>
								<td>{{ $ageGroup }}</td>
								<td>{{ $EventTicket['foodType'] }}</td>

								<td>{{ $PurchasedEventFoodTickets['no_of_tickets'] }}</td>
								<?php 
								$totalAmount = $PurchasedEventFoodTickets['no_of_tickets']*$PurchasedEventFoodTickets['ticketAmount'];
							?>
								<td>${{ $totalAmount }}</td>
								
								
							</tr>
							@endforeach