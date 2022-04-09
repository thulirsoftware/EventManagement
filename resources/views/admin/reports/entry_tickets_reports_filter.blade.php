
							<?php $i=1; 

								?>

								@foreach($PurchasedEventEntryTickets as $PurchasedEventEntryTickets)
								<?php
								$user =  App\User::where('id',$PurchasedEventEntryTickets->userId)->first();
								$event  = App\Event::where('id',$PurchasedEventEntryTickets->eventId)->first();
								$EventTicket  = App\EventEntryTickets::where('id',$PurchasedEventEntryTickets->ticketId)->first();

								 if($PurchasedEventEntryTickets['min_age']>=18)
					            {
					              $ageGroup = "Adult";
					            }
					            else 
					            {
					              $ageGroup = "Kids";
					            }
					            
					            $itcketCount  = App\PurchasedEventEntryTickets::where('userId',$PurchasedEventEntryTickets->userId)->sum('ticketQty');
					            
					            $member =  App\Member::where('user_id',$PurchasedEventEntryTickets->userId)->first();
					            if($member==null)
					            {
					                 $member =  App\NonMember::where('user_id',$PurchasedEventEntryTickets->userId)->first();
					            }
							?>
							<tr>
								<td> {{ $i++ }} </td>

								<td>{{ $event['eventName'] }}</td>
								<td>{{ $event['eventDate'] }}</td>
								<td>{{ $user['name'] }}</td>
								<td>{{ $user['email'] }}</td>
								<td>{{ $member['mobile_number'] }}</td>
								<td>{{ $ageGroup }}</td>
								<td>{{ $itcketCount}}</td>
								<?php 
								$totalAmount = $PurchasedEventEntryTickets['no_of_tickets']*$PurchasedEventEntryTickets['ticketAmount'];
							?>
								<td>${{ $totalAmount }}</td>


							</tr>
							@endforeach