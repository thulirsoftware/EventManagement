
									<?php $i=1; 

								?>

								@foreach($PurchasedEventEntryTickets as $PurchasedEventEntryTickets)
								<?php
								$user =  App\User::where('id',$PurchasedEventEntryTickets->userId)->first();
								$event  = App\Event::where('id',$PurchasedEventEntryTickets->eventId)->first();
								$EventTicket  = App\EventEntryTickets::where('id',$PurchasedEventEntryTickets->ticketId)->first();

								 if($PurchasedEventEntryTickets[$i]['min_age']>=9 && $member[$i]['PurchasedEventEntryTickets']>=16)
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
								<td>{{ $user['name'] }}</td>
								<td>{{ $ageGroup }}</td>
								<td>{{ $PurchasedEventEntryTickets['no_of_tickets']}}</td>
								<?php 
								$totalAmount = $PurchasedEventEntryTickets['no_of_tickets']*$PurchasedEventEntryTickets['ticketAmount'];
							?>
								<td>${{ $totalAmount }}</td>


							</tr>
							@endforeach