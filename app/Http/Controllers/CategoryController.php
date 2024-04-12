<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showcategoryPage()
    {
        return view('admin.category');
    }
    public function create(Request $request)
    {
        try {
            $token = session('token');
    
            $apiUrl = env('CREATE_CATEGORY_API_URL');
    
            $categoryName = $request->input('categoryName');
            $subcategories = $request->input('subcategories');
            $description = $request->input('description');

            $client = new Client();
    
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer '. $token,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'categoryName' => $categoryName,
                    'subcategoryName' => $subcategories,
                    'description' => $description,
                ],
            ]);
    
            if ($response->getStatusCode() == 201) {
                return redirect()->route('home')->with('success', 'Category added successfully');
            } else {
                return response()->json(['error' => 'Error adding category'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function show($id)
    {
        try {
            $token = session('token');
    
            $apiUrl = env('GET_SIGNLE_CATEGORY_API_URL') . '/' . $id;
            $client = new Client();
    
            $response = $client->get($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
            ]);
    
            $category = json_decode($response->getBody(), true);
    
            return view('admin.categorydetail', ['category' => $category]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function delete($id)
    {
        try {
            $token = session('token');

            $apiUrl = env('CATEGORY_DELETE_API_URL') . '/' . $id;
            $client = new Client();

            $response = $client->delete($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                return redirect()->route('home')->with('success', 'Category deleted successfully');
            } else {
                return response()->json(['error' => 'Error deleting category'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        try {
            $token = session('token');
    
            $apiUrl = env('GET_SIGNLE_CATEGORY_API_URL'). '/' . $id;
            $client = new Client();
    
            $response = $client->get($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
            ]);
    
            $category = json_decode($response->getBody(), true);
    
            return view('admin.categoryedit', ['category' => $category]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'description' => 'required',
            ]);
    
            $token = session('token');
            $apiUrl = env('UPDATECATEGORY_API_URL') . '/' . $id; 
    
            $client = new Client();
    
            $response = $client->put($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'description' => $request->description,
                ],
            ]);
    
            if ($response->getStatusCode() == 200) {
                return redirect()->route('home')->with('success', 'category details updated successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to update category details');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    
    }
