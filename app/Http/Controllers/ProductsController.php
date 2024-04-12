<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    
    public function showAddPage()
    {
        return view('admin.product');
    }
    public function show($id)
{
    try {
        $token = session('token');

        $apiUrl = env('GET_PRODUCT_API_URL') . '/' . $id;
        $client = new Client();

        $response = $client->get($apiUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ],
        ]);

        $product = json_decode($response->getBody(), true);

        return view('admin.product', ['product' => $product]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function create(Request $request)
{
    try {
        $token = session('token');

       $apiUrl = env('PRODUCT_SAVE_API_URL');
        $productName = $request->input('productName');
        $productDescription = $request->input('productDescription');
        $productClass = $request->input('productClass');
        $productsubCategory = $request->input('productsubCategory');
        $price = $request->input('price');

        $client = new Client();

        $response = $client->post($apiUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'productName'=> $productName,
                'productDescription'=> $productDescription,
                'productClass'=> $productClass,
                'productsubCategory'=> $productsubCategory,
                'price'=> $price,           
            ],
        ]);

        if ($response->getStatusCode() == 200) {
            return redirect()->route('home')->with('success', 'Product added successfully');
        } else {
            return response()->json(['error' => 'Error adding Product'], $response->getStatusCode());
        }
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
public function delete($id)
{
    try {
        $token = session('token');

        $apiUrl = env('DELETE_PRODUCT_API_URL') . '/' . $id;
        $client = new Client();

        $response = $client->delete($apiUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        if ($response->getStatusCode() == 200) {
            return redirect()->route('home')->with('success', 'Product deleted successfully');
        } else {
            return response()->json(['error' => 'Error deleting Product'], $response->getStatusCode());
        }
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function edit($id)
{
    try {
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI2NWIxNGQ5Yzc3MWE2NzRhNThhZDNjNDEiLCJlbWFpbCI6InNhbWluYW11ZmZpbnRlc3RAbWFpbGluYXRvci5jb20iLCJuYW1lIjoic2FtaW5hIiwiaW1hZ2VVcmwiOiIiLCJzdHJlZXRBZGRyZXNzIjoic2Rkc2ZkcyIsImFnZSI6MjIsImdlbmRlciI6ImZlbWFsZSIsInVzZXJUeXBlIjoiYnV5ZXIiLCJwb3N0YWxDb2RlIjoiMjM0NDQ0IiwiaWF0IjoxNzA4MTg0Nzk5LCJleHAiOjE3Mzk3MjA3OTl9.PhGy_0ijxr30qVMlo8Sj4nGW8EkbPndov8YU9RGMRoE';

        $apiUrl = env('GET_PRODUCT_API_URL'). '/' . $id;
        $client = new Client();

        $response = $client->get($apiUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ],
        ]);

        $product = json_decode($response->getBody(), true);

        return view('admin.productedit', ['product' => $product]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function update(Request $request, $id)
{
    try {
        $request->validate([
            'price' => 'required',
        ]);

        $token = session('token');
        $apiUrl = env('UPDATEPRODUCT_API_URL') . '/' . $id; 

        $client = new Client();

        $response = $client->patch($apiUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'price' => $request->price,
            ],
        ]);

        if ($response->getStatusCode() == 200) {
            return redirect()->route('home')->with('success', 'store details updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update user details');
        }
    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}

}
