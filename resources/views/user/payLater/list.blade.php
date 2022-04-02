
                  <table class="table table-bordered table-striped" >
                    <thead style="background-color:white">
                       
                       <tr>
                        <th>S.No</th>
                        <th>Event Name</th>
                        <th>Amount</th>
                         <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if(count($purchased)>0)
                   @foreach($purchased as $i=>$purchase)
                   <?php 
                    $event = \App\Event::where('id',$purchase->eventId)->first();
                 ?>
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{$event->eventName}}</td>
                        <td>$ {{$purchase->totalAmount}}</td>
                        <td><a href="{{route('payLater.pay', ['id' => $purchase['id']])}}" class="btn btn-primary btn-sm">Pay</a></td>
                    </tr>
                    @endforeach
                    @else
                      <tr style="text-align:center">
                        <td  colspan="4">No Pending Payments</td>
                      </tr>
                    @endif
                </tbody>
</table>