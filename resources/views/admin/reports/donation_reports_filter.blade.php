<?php $i=1; 

			?>

				   @foreach($Donation as $Donation)
				   	 
			           <tr>

			             <td>{{ $Donation['name'] }}</td>
			             <td>{{ $Donation['email'] }}</td>
			            <td>{{ $Donation['mobile_no'] }}</td>
			             <td>{{ $Donation['amount'] }}</td>
			             <td>{{ $Donation['address'] }}</td>
			              
			             <td>{{ $Donation['city'] }}</td>
			             <td>{{ $Donation['pincode'] }}</td>
			             <td>{{ $Donation['comments'] }}</td>
			             <td>Pending</td>

			           </tr>
			         @endforeach