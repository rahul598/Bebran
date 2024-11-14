<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\{
        Helpers\PriceHelper
    
};
use Illuminate\Support\Str;
use paytm;

class PaytmController extends Controller
{
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
    
        $cart = DB::table('cart_items')->where('client_id', $user->id)->get();
        $total_amount = $cart->sum('price'); // Calculate total amount directly
    
        // Prepare order data
        $orderData = [
            'cart' => $cart->toJson(),
            'shipping_info' => json_encode(Session::get('shipping_address')),
            'billing_info' => json_encode(Session::get('billing_address')),
            'payment_method' => 'Paytm',
            'order_status' => 'Pending',
            'user_id' => $user ? $user->id : 0,
            'transaction_number' => Str::random(10),
            'currency_sign' => PriceHelper::setCurrencySign(),
        ];
    
        // Insert order data into database
        $order = DB::table('orders')->insert($orderData);
        if ($order) {
            $lastInsertedId = DB::getPdo()->lastInsertId(); 
            $currentDate = date('Ymd'); // Format current date as YYYYMMDD
            $new_txn = 'ORD-' . str_pad($currentDate, 4, '0', STR_PAD_LEFT) . '-' . $lastInsertedId; 
            
            // Update transaction number
            DB::table('orders')->where('id', $lastInsertedId)->update(['transaction_number' => $new_txn]);
    
            // Get the last inserted order
            $order_last = DB::table('orders')->where('id', $lastInsertedId)->first();
            
            if ($order_last) {
                // Prepare data for Paytm request
                $data_for_request = $this->handlePaytmRequest($order_last->transaction_number, $total_amount); 
                
                $paytm_txn_url = 'https://securegw-stage.paytm.in/theia/processTransaction';
                $paramList = $data_for_request['paramList'];
                $checkSum = $data_for_request['checkSum'];
    
                // Return view with Paytm parameters
                return view('frontend.paytm', compact('paytm_txn_url', 'paramList', 'checkSum')); 
            }
        }
    }

    
  public function handlePaytmRequest($order_id, $amount)
{
    $data = DB::table('payment_settings')->whereUniqueKeyword('paytm')->first();
     
    $paydata = json_decode(json_encode(json_decode($data->information)), true);
    // dd($paydata);
    // Load all functions of encdec_paytm.php and config-paytm.php
    $this->getAllEncdecFunc();
    
    $checkSum = "";
    $paramList = array();

    // Create an array having all required parameters for creating checksum.
        $paramList["MID"] = $paydata['mercent'];
        $paramList["ORDER_ID"] = $order_id;
        $paramList["CUST_ID"] = $order_id;
        $paramList["INDUSTRY_TYPE_ID"] = $paydata['industry'];
        $paramList["CHANNEL_ID"] = 'WEB';
        $paramList["TXN_AMOUNT"] = $amount;
        $paramList["WEBSITE"] = $paydata['website'];
        $paramList["CALLBACK_URL"] = route('front.paytm.notify');

    $paytm_merchant_key = $paydata['client_secret']; // Use 'merchant_key' instead of 'client_secret'
    
    // Generate checksum
    $checkSum = getChecksumFromArray($paramList, $paytm_merchant_key);
    
    return [
        'checkSum' => $checkSum,
        'paramList' => $paramList
    ];
}

    //  public function handleCallback(Request $request)
    // {
    //     // Verify checksum
    //     $checksum = $request->input('CHECKSUMHASH');
    //     $isValidChecksum = Checksum::verifySignature($request->all(), env('PAYTM_MERCHANT_KEY'), $checksum);

    //     // Process Paytm's response
    //     if ($isValidChecksum) {
    //         // Payment successful
    //         // Update your database or perform other actions
    //         return 'Payment successful';
    //     } else {
    //         // Payment failed
    //         // Log error or perform other actions
    //         return 'Payment failed';
    //     }
    // }   
     
    public function notify(Request $request)
        {
         
            $order_id = $request['ORDERID'];
        
            if ( 'TXN_SUCCESS' === $request['STATUS'] ) {
    			$transaction_id = $request['TXNID'];
                
                $order = DB::table('orders')->where('transaction_number', $order_id )->first();
             
            if ($response->isSuccessful()) {
                $cart = DB::table('cart_items')->where('client_id', session()->get('client_data')->id)->get();
                $user = session()->get('client_data');
                $total_tax = 0;
                $cart_total = 0;
                $total = 0;
                $option_price = 0;
                $total = [];
                foreach($cart as $key => $price){ 
                    $total[] = $price->price;
                }
                $total_amount = array_sum($total);
    
    
    
                $orderData['txnid'] = $response->getData()['transactions'][0]['related_resources'][0]['sale']['id'];
                $orderData['payment_status'] = 'Paid';
                $orderData['transaction_number'] = Str::random(10);
                $orderData['currency_sign'] = PriceHelper::setCurrencySign();
                $orderData['currency_value'] = PriceHelper::setCurrencyValue(); 
                $orderData['shipping_info'] = json_encode(Session::get('shipping_address'),true);
                $orderData['billing_info'] = json_encode(Session::get('billing_address'),true);
                $orderData['order_status'] = 'Pending';
                
                //  dd($orderData);
                $order = DB::table('orders')->insert($orderData); 
                if ($order) {
                    $lastInsertedId = DB::getPdo()->lastInsertId(); 
                    $currentDate = date('Ymd'); // Format current date as YYYYMMDD
                    $new_txn = 'ORD-' . str_pad($currentDate, 4, '0', STR_PAD_LEFT) . '-' . $lastInsertedId; 
                    
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
                Session::forget('order_data');
                Session::forget('order_payment_id');
                return [
                    'status' => true
                ];
            } 
            } else if( 'TXN_FAILURE' === $request['STATUS'] ){
                $order = DB::table('orders')->where('transaction_number', $order_id )->delete();
                return redirect()->route('front.checkout.cancle');
    		}else{
                $order = DB::table('orders')->where('transaction_number', $order_id )->delete();
                return redirect()->route('front.checkout.redirect');
    
            }
        }
        
         function getAllEncdecFunc()
    {
        function encrypt_e($input, $ky)
        {
            $key   = html_entity_decode($ky);
            $iv = "@@@@&&&&####$$$$";
            $data = openssl_encrypt($input, "AES-128-CBC", $key, 0, $iv);
            return $data;
        }
        function decrypt_e($crypt, $ky)
        {
            $key   = html_entity_decode($ky);
            $iv = "@@@@&&&&####$$$$";
            $data = openssl_decrypt($crypt, "AES-128-CBC", $key, 0, $iv);
            return $data;
        }
        function pkcs5_pad_e($text, $blocksize)
        {
            $pad = $blocksize - (strlen($text) % $blocksize);
            return $text . str_repeat(chr($pad), $pad);
        }
        function pkcs5_unpad_e($text)
        {
            $pad = ord($text[
                strlen($text) - 1]);
            if ($pad > strlen($text))
                return false;
            return substr($text, 0, -1 * $pad);
        }
        function generateSalt_e($length)
        {
            $random = "";
            srand((float) microtime() * 1000000);
            $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
            $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
            $data .= "0FGH45OP89";
            for ($i = 0; $i < $length; $i++) {
                $random .= substr($data, (rand() % (strlen($data))), 1);
            }
            return $random;
        }
        function checkString_e($value)
        {
            if ($value == 'null')
                $value = '';
            return $value;
        }
        function getChecksumFromArray($arrayList, $key, $sort = 1)
        {
            if ($sort != 0) {
                ksort($arrayList);
            }
            $str = getArray2Str($arrayList);
            $salt = generateSalt_e(4);
            $finalString = $str . "|" . $salt;
            $hash = hash("sha256", $finalString);
            $hashString = $hash . $salt;
            $checksum = encrypt_e($hashString, $key);
            return $checksum;
        }
        
        function getChecksumFromString($str, $key)
        {
            $salt = generateSalt_e(4);
            $finalString = $str . "|" . $salt;
            $hash = hash("sha256", $finalString);
            $hashString = $hash . $salt;
            $checksum = encrypt_e($hashString, $key);
            return $checksum;
        }
        function verifychecksum_e($arrayList, $key, $checksumvalue)
        {
            $arrayList = removeCheckSumParam($arrayList);
            ksort($arrayList);
            $str = getArray2StrForVerify($arrayList);
            $paytm_hash = decrypt_e($checksumvalue, $key);
            $salt = substr($paytm_hash, -4);
            $finalString = $str . "|" . $salt;
            $website_hash = hash("sha256", $finalString);
            $website_hash .= $salt;
            $validFlag = "FALSE";
            if ($website_hash == $paytm_hash) {
                $validFlag = "TRUE";
            } else {
                $validFlag = "FALSE";
            }
            return $validFlag;
        }
        function verifychecksum_eFromStr($str, $key, $checksumvalue)
        {
            $paytm_hash = decrypt_e($checksumvalue, $key);
            $salt = substr($paytm_hash, -4);
            $finalString = $str . "|" . $salt;
            $website_hash = hash("sha256", $finalString);
            $website_hash .= $salt;
            $validFlag = "FALSE";
            if ($website_hash == $paytm_hash) {
                $validFlag = "TRUE";
            } else {
                $validFlag = "FALSE";
            }
            return $validFlag;
        }
        function getArray2Str($arrayList)
        {
            $findme   = 'REFUND';
            $findmepipe = '|';
            $paramStr = "";
            $flag = 1;
            foreach ($arrayList as $key => $value) {
                $pos = strpos($value, $findme);
                $pospipe = strpos($value, $findmepipe);
                if ($pos !== false || $pospipe !== false) {
                    continue;
                }
                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= "|" . checkString_e($value);
                }
            }
            return $paramStr;
        }
        function getArray2StrForVerify($arrayList)
        {
            $paramStr = "";
            $flag = 1;
            foreach ($arrayList as $key => $value) {
                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= "|" . checkString_e($value);
                }
            }
            return $paramStr;
        }
        function redirect2PG($paramList, $key)
        {
            $hashString = getchecksumFromArray($paramList, $key);
            $checksum = encrypt_e($hashString, $key);
        }
        function removeCheckSumParam($arrayList)
        {
            if (isset($arrayList["CHECKSUMHASH"])) {
                unset($arrayList["CHECKSUMHASH"]);
            }
            return $arrayList;
        }
        function getTxnStatus($requestParamList)
        {
            return callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
        }
        function getTxnStatusNew($requestParamList)
        {
            return callNewAPI(PAYTM_STATUS_QUERY_NEW_URL, $requestParamList);
        }
        function initiateTxnRefund($requestParamList)
        {
            $CHECKSUM = getRefundChecksumFromArray($requestParamList, PAYTM_MERCHANT_KEY, 0);
            $requestParamList["CHECKSUM"] = $CHECKSUM;
            return callAPI(PAYTM_REFUND_URL, $requestParamList);
        }
        function callAPI($apiURL, $requestParamList)
        {
            $jsonResponse = "";
            $responseParamList = array();
            $JsonData = json_encode($requestParamList);
            $postData = 'JsonData=' . urlencode($JsonData);
            $ch = curl_init($apiURL);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($postData)
                )
            );
            $jsonResponse = curl_exec($ch);
            $responseParamList = json_decode($jsonResponse, true);
            return $responseParamList;
        }
        function callNewAPI($apiURL, $requestParamList)
        {
            $jsonResponse = "";
            $responseParamList = array();
            $JsonData = json_encode($requestParamList);
            $postData = 'JsonData=' . urlencode($JsonData);
            $ch = curl_init($apiURL);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($postData)
                )
            );
            $jsonResponse = curl_exec($ch);
            $responseParamList = json_decode($jsonResponse, true);
            return $responseParamList;
        }
        function getRefundChecksumFromArray($arrayList, $key, $sort = 1)
        {
            if ($sort != 0) {
                ksort($arrayList);
            }
            $str = getRefundArray2Str($arrayList);
            $salt = generateSalt_e(4);
            $finalString = $str . "|" . $salt;
            $hash = hash("sha256", $finalString);
            $hashString = $hash . $salt;
            $checksum = encrypt_e($hashString, $key);
            return $checksum;
        }
        function getRefundArray2Str($arrayList)
        {
            $findmepipe = '|';
            $paramStr = "";
            $flag = 1;
            foreach ($arrayList as $key => $value) {
                $pospipe = strpos($value, $findmepipe);
                if ($pospipe !== false) {
                    continue;
                }
                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= "|" . checkString_e($value);
                }
            }
            return $paramStr;
        }
        function callRefundAPI($refundApiURL, $requestParamList)
        {
            $jsonResponse = "";
            $responseParamList = array();
            $JsonData = json_encode($requestParamList);
            $postData = 'JsonData=' . urlencode($JsonData);
            $ch = curl_init($refundApiURL);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_URL, $refundApiURL);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $jsonResponse = curl_exec($ch);
            $responseParamList = json_decode($jsonResponse, true);
            return $responseParamList;
        }
    }
}
