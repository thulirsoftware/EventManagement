@extends('layouts.app')
@section('content')
@if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif
@if (Session::has('success'))
<div class="alert alert-success col-sm-6 col-md-6 col-lg-6 col-md-offset-2" role="alert" style="margin-top: 25px;
   font-size: 20px;">{{ Session::get('success') }}</div>
@endif
<div id="board" style="text-align: left;background-color: #D3D3D3;">
  
   <div class="container">
      <div class="col-sm-12 col-md-12 col-lg-12" style="margin: 35px 0px;">
         <div id="board" >
            <div class="container">
               <div class="col-sm-12 col-md-12 col-lg-12" >
                  <div class="col-sm-2 col-md-2 col-lg-2">
                  </div>
                  <div class="col-sm-8 col-md-8 col-lg-8" style="background-color: #fff;padding: 30px;">

   <?php $count = count($sessionData['ticketType']); ?>


                  @for($i=0; $i<$count; $i++)
                    <div class="row" style="border-bottom: 1px solid #DDD;margin-top: 20px;">
                        <div class="col-sm-7 col-md-7 col-lg-7">
                           <h4>{{ $sessionData['ticketType'][$i] }}</h4>
                           <h4>Qty : {{ $sessionData['ticketQty'][$i] }} </h4>
                        </div>
                        <div class="col-sm-5 col-md-5 col-lg-5" style="text-align: center;word-spacing: 3px;">
                           <h4>Price ${{ $sessionData['ticketPrice'][$i] }}.00</h4>
                        </div>
                    </div>
                  @endfor
                   
                     <div class="row" style="border-bottom: 1px solid #DDD;margin-top: 20px;">
                        <div class="col-sm-7 col-md-7 col-lg-7">
                        </div>
                        <div class="col-sm-5 col-md-5 col-lg-5" style="text-align: center;word-spacing: 3px;">
                           <h4>Total : ${{ $sessionData['totalAmount'] }}.00</h4>
                        </div>
                     </div>
                     <div class="row">
                        <form action="{{ url('/nonMemberEventPaymentCreate') }}" method="POST">
                          {{ csrf_field() }}
                           <div style="float: right;margin: 25px 34px 10px 0px;">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="col-sm-2 col-md-2 col-lg-2">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection