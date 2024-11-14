<?php

namespace App\Http\Controllers;

use App\Models\PackagePlan; 
use GuzzleHttp\Client; 
use Illuminate\Http\Request;

class CashfreeController extends Controller
{
    public function initiatePayment(Request $request)
    {
        // Incoming request ki validation
        $request->validate([
            'package_id' => 'required|integer',
            'customerId' => 'required|string',
        ]);

        // Package plan ko fetch karna
        $packagePlan = PackagePlan::find($request->input('package_id'));

        if (!$packagePlan) {
            return response()->json(['error' => 'Invalid package ID'], 404);
        }

        $client = new Client();
        try {
            // Cashfree API ko request bhejna
            $response = $client->post('https://api.cashfree.com/api/v1/order/create', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'x-client-id' => env('CASHFREE_APP_ID'), // Environment variable se
                    'x-client-secret' => env('CASHFREE_SECRET_KEY'), // Environment variable se
                ],
                'json' => [
                    'orderId' => uniqid('order_'), // Unique order ID generate karna
                    'orderAmount' => $packagePlan->price, // Package ka price
                    'orderCurrency' => 'INR',
                    'orderNote' => 'Payment for ' . $packagePlan->title,
                    'customerDetails' => [
                        'customerId' => $request->input('customerId'),
                    ],
                ],
            ]);

            // Response ko decode karna
            $data = json_decode($response->getBody(), true);
            return response()->json($data); // Response return karna
        } catch (\Exception $e) {
            return response()->json(['error' => 'Payment initiation failed: ' . $e->getMessage()], 500);
        }
    }
}
