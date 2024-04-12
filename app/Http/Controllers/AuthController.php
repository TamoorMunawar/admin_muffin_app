<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    public function login2(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    try {

        $apiBaseUrl = env('AUTH_API_URL');  

        $client = new Client();

        $response = $client->post($apiBaseUrl, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ],
        ]);

        $responseBody = $response->getBody()->getContents();

        $responseData = json_decode($responseBody, true);

        if ($response->getStatusCode() == 200 ){
            
            session(['token' => $responseData['token']]); 
            return redirect()->route('home');
        } else {
            $errorMessage = $responseData['message'] ?? 'Invalid credentials';
            return back()->withErrors(['error' => $errorMessage]);
        }
    } catch (\Exception $e) {
        return back()->withErrors(['error' => $e->getMessage()]);
    }
}

public function logout2(Request $request)
    {
        $request->session()->forget('token');
        return redirect()->route('login2')->with('success', 'You have been logged out.');
    }
 
}
