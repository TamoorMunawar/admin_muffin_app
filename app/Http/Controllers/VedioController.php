<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class VedioController extends Controller
{
    public function delete($id)
    {
        try {
            $token = session('token');

            $apiUrl = env('DELETEVEDIO_API_URL') . '/' . $id;
            $client = new Client();

            $response = $client->delete($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                return redirect()->route('home')->with('success', 'Vedio deleted successfully');
            } else {
                return response()->json(['error' => 'Error deleting Vedio'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}
