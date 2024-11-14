<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Razorpay\Api\Api;
use DB;
use App\Models\Page;
use App\Models\PageExtra;

class RazorpayController extends Controller
{
    
     public function __construct()
        {
            $data = DB::table('payment_settings')->whereUniqueKeyword('razorpay')->first();
     
            $paydata = json_decode(json_encode(json_decode($data->information)), true);
            $this->keyId = $paydata['key'];
            $this->keySecret = $paydata['secret'];
            $this->displayCurrency = 'INR';
            $this->api = new Api($this->keyId, $this->keySecret);
        }
    
     public function store(Request $request)
    {
        
        if (Session::has('currency')) {
            $currency = DB::table('currencies')->findOrFail(Session::get('currency'));
        } else {
            $currency = DB::table('currencies')->where('is_default', 1)->first();
        }
        
        $supportedCurrencies = ['INR']; // Add other supported currencies if needed
        if (!in_array($currency->name, $supportedCurrencies)) {
            Session::flash('error', __('Currency Not Supported'));
            return redirect()->back();
        }
    
        $user = session()->get('client_data'); 
        $setting = DB::table('settings')->first(); 
        $cart = DB::table('cart_items')->where('client_id', $user->id)->get();
        $arr = session()->get('cart_vlaue');
        // $total_amount = $cart->sum('price'); // Calculate total amount directly
        $total_amount =  (int) $arr['total_with_tax'];  
        $total_tax =  intval(round($arr['tax']));
        $item_number = Str::random(8);
        $item_name = $setting->value.' Order';
        
        $orderData = [
            'receipt'         => $item_number,
            'amount'          => $total_amount * 100, 
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
        ];
        
        $razorpayOrder = $this->api->order->create($orderData);
        
        $razorpayOrderId = $razorpayOrder['id'];
        
        session(['razorpay_order_id'=> $razorpayOrderId]);
        
             

                    $displayAmount = $amount = $orderData['amount'];
                    
                    if ($this->displayCurrency !== 'INR')
                    {
                        $url = "https://api.fixer.io/latest?symbols=$this->displayCurrency&base=INR";
                        $exchange = json_decode(file_get_contents($url), true);
                    
                        $displayAmount = $exchange['rates'][$this->displayCurrency] * $amount / 100;
                    }
                    
                    $checkout = 'automatic';
                    
                    if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
                    {
                        $checkout = $_GET['checkout'];
                    }
                    
                    $data = [
                        "key"               => $this->keyId,
                        "amount"            => $amount,
                        "name"              => $item_name,
                        "description"       => $item_name,
                        "prefill"           => [
							"name"              => $request->name,
							"email"             => $request->email,
							"contact"           => $request->phone,
                        ],
                        "notes"             => [
							"address"           => $request->address,
							"merchant_order_id" => $item_number,
                        ],
                        "theme"             => [
							"color"             => "{{ #181e4e }}"
                        ],
                        "order_id"          => $razorpayOrderId,
                    ];
                    
                    if ($this->displayCurrency !== 'INR')
                    {
                        $data['display_currency']  = $this->displayCurrency;
                        $data['display_amount']    = $displayAmount;
                    }
                    $notify_url = route('front.razorpay.notify');
                    $json = json_encode($data);
                    $displayCurrency = $this->displayCurrency;
                    Session::put('requestData',$request->all());
                    
        return view( 'frontend.razorpay-checkout', compact( 'data','displayCurrency','json','notify_url' ) );
        
    }

    
	public function notify( Request $request ) { 
	   
        $success = true;
        $error = "Payment Failed";
        if (empty($_POST['razorpay_payment_id']) === false)
        {
            try
            {
                $attributes = array(
                    'razorpay_order_id' => session('razorpay_order_id'),
                    'razorpay_payment_id' => $_POST['razorpay_payment_id'],
                    'razorpay_signature' => $_POST['razorpay_signature']
                );
                $this->api->utility->verifyPaymentSignature($attributes);
            }
            catch(SignatureVerificationError $e)
            {
                $success = false;
                $error = 'Razorpay Error : ' . $e->getMessage();
            }
        }
   
        if ($success)
        {
            $transaction_id = $_POST['razorpay_payment_id'];
            
                $cart = DB::table('cart_items')->where('client_id', session()->get('client_data')->id)->get();
                $user = session()->get('client_data');
                $arr = session()->get('cart_vlaue');
                $total_tax = (int) $arr['tax'];
                $cart_total = 0;
                $total = 0;
                $option_price = 0;
                $total = [];
                foreach($cart as $key => $price){ 
                    $total[] = $price->price;
                }
                $total_amount = (int) $arr['total'];
               
               
                $orderData['cart'] = json_encode($cart,true);  
                $orderData['shipping_info'] = json_encode(Session::get('shipping_address'),true);
                $orderData['billing_info'] = json_encode(Session::get('billing_address'),true);
                $orderData['payment_method'] = 'Rezorpay';
                $orderData['total_order_value'] = $total_amount;
                $orderData['tax'] = $total_tax;
                $orderData['user_id'] = isset($user) ? $user->id : 0;
                $orderData['transaction_number'] = Str::random(10);
                $orderData['currency_sign'] = '₹'; 
                $orderData['payment_status'] = 'Paid';
                $orderData['txnid'] = $transaction_id;
                $orderData['order_status'] = 'Pending'; 
                
                $order = DB::table('orders')->insert($orderData); 
                if ($order) {
                    $lastInsertedId = DB::getPdo()->lastInsertId(); 
                    $currentDate = date('Ymd'); // Format current date as YYYYMMDD
                    $new_txn = 'ORD-' . str_pad($currentDate, 4, '0000', STR_PAD_LEFT) . '-' . $lastInsertedId; 
                    
                    $update_arr = [
                        'transaction_number' => $new_txn
                    ];
                
                    if (!empty($update_arr)) {
                        $order_update = DB::table('orders')->where('id', $lastInsertedId)->update($update_arr);
                    }
                }
               
                
                Session::put('order_id', $lastInsertedId);
                Session::forget('cart'); 
                DB::table('cart_items')->where('client_id',session()->get('client_data')->id)->delete();
                return redirect()->route('thank_page', ['order_id' => $lastInsertedId]);
                // $data['page'] = Page::where('slug','thank-you-purchase')->where('status','1')->first(); 
                // $data['extra_data']   = PageExtra::where('page_id',$data['page']->id)->where('status',1)->orderBy('rank', 'asc')->get();
                // return view('frontend.pages.thankyou_page');
            
        }
        else
        {
            return redirect()->route('front.checkout.cancle')->withError($error);
        }
        
    }
}
