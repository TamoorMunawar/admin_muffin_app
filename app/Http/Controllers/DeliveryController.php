<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;

use Illuminate\Http\Request;

class DeliveryController extends Controller
{

    public function showdeliveryPage()
    {
        return view('admin.delivery');
    }

    public function create(Request $request)
    {
        try {
            $token = session('token');
    
            $apiUrl = env('DELIVERYMETHOD_API_URL');
    
            $methodName = $request->input('methodName');
            $days = $request->input('days');
            $price = $request->input('price');

            $client = new Client();
    
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer '. $token,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'methodName' => $methodName,
                    'days' => $days,
                    'price' => $price,
                ],
            ]);
    
            if ($response->getStatusCode() == 201) {
                return redirect()->route('home')->with('success', 'Delivery METHOD Added successfully');
            } else {
                return response()->json(['error' => 'Error adding Delivery METHOD'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
