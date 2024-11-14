@extends('layouts.app') 
@section('content')  
  <!-- Page Content-->
  <div class="container padding-bottom-3x mb-1 mt-5">
  <div class="card text-center shadow rounded p-5">
          <div class="card-body padding-top-2x">
            <h3 class="card-title text-success">{{__('Thank you for your order')}}!</h3>
            <!--<p class="card-text">{{__('Your order has been placed and will be processed as soon as possible.')}}</p>-->
            <p class="card-text">{{__('Make sure you make note of your order number, which is')}} <span class="text-medium">{{$order->transaction_number}}</span></p>
            <!--<p class="card-text">{{__('You will be receiving an email shortly with confirmation of your order.')}}-->

            </p>
            <div class="padding-top-1x padding-bottom-1x">

                <a class="btn btn-primary m-4" href="{{route('main_page')}}"><span><i class="icon-package pr-2"></i> {{__('View our Services')}}</span></a>

              </div>
          </div>
        </div>
        </div>
@endsection
