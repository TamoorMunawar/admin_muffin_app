<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function block(Request $request, $userId)
    {
        try {
            $token = session('token');

        $apiUrl = env('EDITUSER_API_URL') . '/' . $userId;
            $client = new Client();

            $response = $client->patch($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'userStatus' => 'deactivate',
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
    public function show($id)
    {
        try {
            $token = session('token');
    
            $apiUrl = env('GETUSER_API_URL');
            $client = new Client();
    
            $response = $client->get($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'userId' => $id,
                ],
            ]);
    
            $user = json_decode($response->getBody(), true);
    
            return view('admin.user', ['user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
   
    public function edit($userId)
    {
        try {
            $token = session('token');
    
            $apiUrl = env('GETUSER_API_URL');
            $client = new Client();
    
            $response = $client->get($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'userId' => $userId,
                ],
            ]);
    
            $user = json_decode($response->getBody(), true);
    
            return view('admin.useredit', ['user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $userId)
    {
        try {
            $request->validate([
                'userStatus' => 'required',
            ]);
    
            $token = session('token');
            $apiUrl = env('UPDATEUSER_API_URL') . '/' . $userId; 
    
            $client = new Client();
    
            $response = $client->patch($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'userStatus' => $request->userStatus,
                ],
            ]);
    
            if ($response->getStatusCode() == 200) {
                return redirect()->route('home')->with('success', 'User details updated successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to update user details');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    
}
