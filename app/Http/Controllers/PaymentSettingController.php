<?php

namespace App\Http\Controllers;

use App\{
    Models\PaymentSetting,
    Http\Controllers\Controller,
    Http\Requests\PaymentSettingRequest
};
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    
    public function payment()
    {
        return view('admin.payment_gateway.index', $this->paymentGate());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentSettingRequest $request)
    {
        $this->updateGate($request);
        return redirect()->back()->withSuccess(__('Payment Information Updated Successfully.'));
    }
    
    //  supportive function 
    public function paymentGate()
    {
        $bank = PaymentSetting::whereUniqueKeyword('bank')->first();
        $data['bank'] = $bank;

        $paypal = PaymentSetting::whereUniqueKeyword('paypal')->first();
        $data['paypalData'] = $paypal->convertJsonData();
        $data['paypal'] = $paypal;


        $molly = PaymentSetting::whereUniqueKeyword('mollie')->first();
        $data['mollyData'] = $molly->convertJsonData();
        $data['molly'] = $molly;

        $stripe = PaymentSetting::whereUniqueKeyword('stripe')->first();
        $data['stripeData'] = $stripe->convertJsonData();
        $data['stripe'] = $stripe;

        $paytm = PaymentSetting::whereUniqueKeyword('paytm')->first();
        $data['paytmData'] = $paytm->convertJsonData();
        $data['paytm'] = $paytm;

        $sslcommerz = PaymentSetting::whereUniqueKeyword('sslcommerz')->first();
        $data['sslcommerzData'] = $sslcommerz->convertJsonData();
        $data['sslcommerz'] = $sslcommerz;

        $mercadopago = PaymentSetting::whereUniqueKeyword('mercadopago')->first();
        $data['mercadopagoData'] = $mercadopago->convertJsonData();
        $data['mercadopago'] = $mercadopago;

        $authorize = PaymentSetting::whereUniqueKeyword('authorize')->first();
        $data['authorizeData'] = $authorize->convertJsonData();
        $data['authorize'] = $authorize;

        $flutterwave = PaymentSetting::whereUniqueKeyword('flutterwave')->first();
        $data['flutterwaveData'] = $flutterwave->convertJsonData();
        $data['flutterwave'] = $flutterwave;

        $razorpay = PaymentSetting::whereUniqueKeyword('razorpay')->first();
        $data['razorpayData'] = $razorpay->convertJsonData();
        $data['razorpay'] = $razorpay;
        
        $instamojo = PaymentSetting::whereUniqueKeyword('instamojo')->first();
        $data['instamojoData'] = $instamojo->convertJsonData();
        $data['instamojo'] = $instamojo;

        $paystack = PaymentSetting::whereUniqueKeyword('paystack')->first();
        $data['paystackData'] = $paystack->convertJsonData();
        $data['paystack'] = $paystack;

        $cod = PaymentSetting::whereUniqueKeyword('cod')->first();
        $data['cod'] = $cod;

        return $data;
    }
    
    public function updateGate($request)
    {

        $input = $request->all();
        $pay_data = PaymentSetting::whereUniqueKeyword($input['unique_keyword'])->first();

        if ($file = $request->file('photo')) {
            $input['photo'] = $this->handleUpdatedUploadedImage($file,'images',$pay_data,'images/','photo');
        }

        
        if($request->has('pkey')){

            $info_data = $input['pkey'];

            if($pay_data->unique_keyword == 'mollie'){
                $paydata = $pay_data->convertJsonData();
                $prev = $paydata['key'];
            }

            if (array_key_exists("check_sandbox",$info_data)){
                $info_data['check_sandbox'] = 1;
            }else{
                if (strpos($pay_data->information, 'check_sandbox') !== false) {
                    $info_data['check_sandbox'] = 0;
                }
            }

            if (array_key_exists("paytm_mode",$info_data)){
                $info_data['paytm_mode'] = 1;
            }else{
                if (strpos($pay_data->information, 'paytm_mode') !== false) {
                    $info_data['paytm_mode'] = 0;
                }
            }

            
        
            $input['information'] = json_encode($info_data);

        }

        if($request->has('status')){
            $input['status'] = 1;
        }else{

            $input['status'] = 0;
        }
        // dd($input['pkey']['key']);
        $pay_data->update($input);

        // if($pay_data->unique_keyword == 'mollie'){
        //     $paydata = $pay_data->convertJsonData();
        //     $this->setEnv('MOLLIE_KEY',$input['pkey']['key'],$prev);
        // }
    }
    
    //  imagehelper
    
    public function handleUpdatedUploadedImage_old($file,$path,$data,$delete_path,$field) {
        $name = time().$file->getClientOriginalName();
   
        $file->move($path,$name);
        if($data[$field] != null){
            if (file_exists($delete_path.$data[$field])) {
                unlink($delete_path.$data[$field]);
            }
        }
        return $name;
    }
    
    public function handleUpdatedUploadedImage($file, $path, $data, $delete_path, $field) { 

    $name = time().$file->getClientOriginalName();
    $file->move(public_path().'/uploads/', $name);

    // Delete the old image if it exists
    if ($data[$field] != null) {
        $deleteFilePath = $delete_path . $data[$field];
        if (file_exists(public_path().'/uploads/'.$deleteFilePath)) {
            unlink(public_path().'/uploads/'.$deleteFilePath);
        }
    }

    return $name;
}

}
