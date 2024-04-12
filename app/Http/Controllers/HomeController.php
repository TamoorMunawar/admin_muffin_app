<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
 

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $getuserUrl = env('USER_API_URL');
        $client = new Client();
    
        try {
            $userResponse = $client->get($getuserUrl, [
                'headers' => [
                    'Accept' => "application/json",
                    'Content-Type' => "application/json",
                ],
            ]);
    
            $userData = json_decode($userResponse->getBody(), true);
    
            if ($userResponse->getStatusCode() == 200) {
                $userProfiles = $userData; 
            } else {
                return response()->json(['error' => 'Error fetching data of Users'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    
        $getuservedioUrl = env('USERSTORE_API_URL');
        $token = session('token');
    
        try {
            $userVedioResponse = $client->get($getuservedioUrl, [
                'headers' => [
                    'Authorization' => 'Token ' . $token,
                    'Accept' => "application/json",
                    'Content-Type' => "application/json",
                ],
            ]);
    
            $userVediosData = json_decode($userVedioResponse->getBody(), true);
    
            if ($userVedioResponse->getStatusCode() == 200) {
                $userVedioProfiles = $userVediosData; 
            } else {
                return response()->json(['error' => 'Error fetching data of Users Vedios'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }


        $getproducts = env('PRODUCTS_API_URL');

        try {
            $getproductsResponse = $client->get($getproducts, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => "application/json",
                    'Content-Type' => "application/json",
                ],
            ]);
    
            $getproductsData = json_decode($getproductsResponse->getBody(), true);
    
            if ($getproductsResponse->getStatusCode() == 200) {
                $getproducts = $getproductsData; 
            } else {
                return response()->json(['error' => 'Error fetching data of Users Vedios'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        $getvedios = env('VEDIOS_API_URL');
        try {
            $getvediosResponse = $client->get($getvedios, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => "application/json",
                    'Content-Type' => "application/json",
                ],
            ]);
    
            $getvediosData = json_decode($getvediosResponse->getBody(), true);
    
            if ($getvediosResponse->getStatusCode() == 200) {
                $getvedios = $getvediosData; 
            } else {
                return response()->json(['error' => 'Error fetching data of Users Vedios'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        $getcategories = env('CATEGORIES_API_URL');
        try {
            $getcategoriesResponse = $client->get($getcategories, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => "application/json",
                    'Content-Type' => "application/json",
                ],
            ]);
    
            $getcategoriesData = json_decode($getcategoriesResponse->getBody(), true);
    
            if ($getcategoriesResponse->getStatusCode() == 200) {
                $getcategories = $getcategoriesData; 
            } else {
                return response()->json(['error' => 'Error fetching data of Users Vedios'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

       
    
    
        return view('admin.dashboard', compact('userProfiles', 'userVedioProfiles' , 'getproducts' , 'getvedios' , 'getcategories'));
    }


   
    
}
