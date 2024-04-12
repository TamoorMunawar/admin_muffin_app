<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function delete($id)
    {
        try {
            $token = session('token');

            $apiUrl = env('DELETE_STORE_API_URL') . '/' . $id;
            $client = new Client();

            $response = $client->delete($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                return redirect()->route('home')->with('success', 'store deleted successfully');
            } else {
                return response()->json(['error' => 'Error deleting store'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function show($id)
    {
        try {
            $token = session('token');
    
            $apiUrl = env('SHOW_SIGNLE_STORE_API_URL') . '/' . $id;
            $client = new Client();
    
            $response = $client->get($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
            ]);
    
            $store = json_decode($response->getBody(), true);
    
            return view('admin.storedetails', ['store' => $store]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
  
    public function block(Request $request, $userId)
    {
        try {
            $token = session('token');

        $apiUrl = env('STORE_EDIT_API_URL') . '/' . $userId;
            $client = new Client();

            $response = $client->patch($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'storeStatus' => 'deactivate',
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                return redirect()->route('home')->with('success', 'user blocked successfully');
            } else {
                return response()->json(['error' => 'Error blocking user'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function edit($userId)
    {
        try {
            $token = session('token');
    
            $apiUrl = env('SHOW_SIGNLE_STORE_API_URL'). '/' . $userId;
            $client = new Client();
    
            $response = $client->get($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
            ]);
    
            $store = json_decode($response->getBody(), true);
    
            return view('admin.storeedit', ['store' => $store]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $userId)
    {
        try {
            $request->validate([
                'storeStatus' => 'required',
            ]);
    
            $token = session('token');
            $apiUrl = env('UPDATESTORE_API_URL') . '/' . $userId; 
    
            $client = new Client();
    
            $response = $client->patch($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'storeStatus' => $request->storeStatus,
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
