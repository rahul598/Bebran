
     
     <!-- Modal PayPal -->
     <div class="modal fade" id="paypal" tabindex="-1" aria-hidden="true">
       <form class="interactive-credit-card row" action="{{route('front.checkout.submit')}}" method="POST">
         @csrf
         <div class="modal-dialog">

           <div class="modal-content">
             <div class="modal-header">
               <h6 class="modal-title">{{__('Transactions via PayPal')}}</h6>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
               <div class="card-body">
                   
               </div>
             </div>
             <input type="hidden" name="payment_method" value="Paypal">
             <input type="hidden" name="shipping_id" value="" class="shipping_id_setup">
             <input type="hidden" name="state_id" value="{{auth()->check() && auth()->user()->state_id ? auth()->user()->state_id : ''}}" class="state_id_setup">
             <p class="p-3">PayPal is the faster & safer way to send money. Make an online payment via PayPal.</p>
             <div class="modal-footer">
               <button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal"><span>{{ __('Cancel') }}</span></button>
               <button class="btn btn-primary btn-sm" type="submit"><span>{{__('Checkout With PayPal')}}</span></button>
             </div>
           </div>

         </div>
       </form>
     </div>

     <!-- Modal Stripe -->
     <div class="modal fade" id="stripe" tabindex="-1" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h6 class="modal-title">{{__('Transactions via Stripe')}}</h6>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
             <div class="card-body">

               <form class="interactive-credit-card row" action="{{ route('front.checkout.submit') }}" method="POST">
                 @csrf

                 <input type="hidden" name="payment_method" value="Stripe">
                 <input type="hidden" name="shipping_id" value="" class="shipping_id_setup">
                 <input type="hidden" name="state_id" value="{{auth()->check() && auth()->user()->state_id ? auth()->user()->state_id : ''}}" class="state_id_setup">
                 <p class="p-3">Stripe is the faster & safer way to send money. Make an online payment via Stripe.</p>
             </div>
           </div>
           <div class="modal-footer">
             <button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal"><span>{{ __('Cancel') }}</span></button>
             <button class="btn btn-primary btn-sm" type="submit"><span>{{__('Chekout With Stripe')}}</span></button>
           </div>
           </form>
         </div>
       </div>
     </div>



     {{-- PAYPAL --}}
     <div class="modal fade" id="paypal" tabindex="-1" aria-hidden="true">
       <div class="modal-dialog">
         <form class="interactive-credit-card row" action="" method="POST">
           @csrf
           <div class="modal-content">
             <div class="modal-header">
               <h6 class="modal-title">{{__('Transactions via PayPal')}}</h6>
               <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             </div>
             <div class="modal-body">
               <div class="card-body">
                   
               </div>
             </div>
             <input type="hidden" name="payment_method" value="Paypal">
             <input type="hidden" name="shipping_id" value="" class="shipping_id_setup">
             <input type="hidden" name="state_id" value="{{auth()->check() && auth()->user()->state_id ? auth()->user()->state_id : ''}}" class="state_id_setup">
             <div class="modal-footer">
               <button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal"><span>{{ __('Cancel') }}</span></button>
               <button class="btn btn-primary btn-sm" type="submit"><span>{{__('Checkout With PayPal')}}</span></button>
             </div>
           </div>
         </form>
       </div>
     </div>


     {{-- REZORPAY --}}
     <div class="modal fade" id="razorpay" tabindex="-1" aria-hidden="true">
       <form class="interactive-credit-card row" action="{{ route('front.razorpay.submit') }}" method="POST">
         @csrf
         <div class="modal-dialog">

           <div class="modal-content">
             <div class="modal-header">
               <h6 class="modal-title">{{__('Transactions via Razorpay')}}</h6>
               <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             </div>
             <div class="modal-body">
               <div class="card-body">
                   
               </div>
             </div>
             <input type="hidden" name="payment_method" value="Rezorpay">
             <input type="hidden" name="shipping_id" value="" class="shipping_id_setup">
             <input type="hidden" name="state_id" value="{{auth()->check() && auth()->user()->state_id ? auth()->user()->state_id : ''}}" class="state_id_setup">
             <div class="modal-footer">
               <button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal"><span>{{ __('Cancel') }}</span></button>
               <button class="btn btn-primary btn-sm" type="submit"><span>{{__('Checkout With Razorpay')}}</span></button>
             </div>
           </div>
         </div>
       </form>
     </div>


     {{-- PAYTM --}}
     <div class="modal fade" id="paytm" tabindex="-1" aria-hidden="true">
       <form class="interactive-credit-card row" action="{{ route('front.paytm.submit') }}" method="POST">
         @csrf
         <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header">
               <h6 class="modal-title">{{__('Transactions via Paytm')}}</h6>
               <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             </div>
             <div class="modal-body">
               <div class="card-body">
                   
               </div>
             </div>
             <input type="hidden" name="payment_method" value="Paytm">
             <input type="hidden" name="shipping_id" value="" class="shipping_id_setup">
             <input type="hidden" name="state_id" value="{{auth()->check() && auth()->user()->state_id ? auth()->user()->state_id : ''}}" class="state_id_setup">
             <div class="modal-footer">
               <button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal"><span>{{ __('Cancel') }}</span></button>
               <button class="btn btn-primary btn-sm" type="submit"><span>{{__('Checkout With Paytm')}}</span></button>
             </div>
           </div>
         </div>
       </form>
     </div>


