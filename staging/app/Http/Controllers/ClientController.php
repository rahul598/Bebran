<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ClientController extends Controller
{
    public function index(){
        $client = DB::table('clients')->get();
        $client_data = json_decode(json_encode($client), true);
        return view('admin.client.index', compact('client_data'));
    }
    
    public function view_data(Request $request, $id){ 
        
        $client = DB::table('clients')->where('id', $id)->first();
        if($client){
            $order_cart = DB::table('orders')
                        ->where('user_id', $id)
                        ->get();
         
            $user_cart = [];
            foreach($order_cart as $key => $val){
                $plan_id =  json_decode($val->cart); 
                foreach($plan_id as $plan_key => $plan_val){
                    $user_cart[] =$plan_val->product_id;
                }
            } 
             
            $plan_details = DB::table('digital_service_price_widget')
                              ->whereIn('id', array_unique($user_cart))
                              ->get(); 
            dd($order_cart);
            return view('admin.client.index', compact('client_data'));
        }
        return back()->with('error', 'User not Not exist!');
       
    }
}
