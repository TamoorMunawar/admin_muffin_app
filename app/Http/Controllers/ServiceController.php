<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function delete($id)
    {
        try {
            $token = session('token');

            $apiUrl =  env('USERSTORE_DELETE_API_URL') . '/' . $id;
            $client = new Client();

            $response = $client->delete($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token, 
                     'Accept' => "application/json",
                    'Content-Type' => "application/json",
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                return redirect()->route('home')->with('success', 'Store deleted successfully');
            } else {
                return response()->json(['error' => 'Error deleting barber'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function showAddPage()
    {
        return view('admin.add');
    }
    public function block(Request $request, $userId)
    {
        try {
            $token = session('token');

        $apiUrl = env('STORE_BLOCK_API_URL') . '/' . $userId;
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
                return redirect()->route('home')->with('success', 'Store Deactivate successfully');
            } else {
                return response()->json(['error' => 'Error Deactivate user'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showstorePage()
    {
        return view('admin.store');
    }
    public function create(Request $request)
    {
        try {
            $token = session('token');
    
           $apiUrl = env('ADD_STORE_API_URL');

            $storeName = $request->input('storeName');
            $storeSlogan = $request->input('storeSlogan');
            $storeDescription = $request->input('storeDescription');
            $productClass = $request->input('productClass');
            $subCategory = $request->input('subCategory');
    
            $client = new Client();
    
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'storeName'=> $storeName,
                    'storeSlogan'=> $storeSlogan,
                    'storeDescription'=> $storeDescription,
                    'productClass'=> $productClass,
                    'subCategory'=> $subCategory,           
                ],
            ]);
    
            if ($response->getStatusCode() == 200) {
                return redirect()->route('home')->with('success', 'Store Added successfully');
            } else {
                return response()->json(['error' => 'Error adding Store'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
}
