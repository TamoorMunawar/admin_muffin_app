@extends('layouts.master')

@section('title')
Dashboard
@endsection

@section('content')

<div class="col-md-12 mt-4" style="margin-top: 120px !important;">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Product Details</h4>
        </div>
        <div class="card-body" style="margin-left: 30px !important;" >
            @if(isset($product))
            <ul>
                <li>ID: {{ $product['_id'] }}</li>
                <li>Store ID: {{ $product['storeId'] }}</li>
                <li>Description: {{ $product['productDescription'] }}</li>
                <li>Price: {{ $product['price'] }}</li>
                <li>SubCategory: {{ $product['productsubCategory'] }}</li>
                <li>createdAt: {{ $product['createdAt'] }}</li>
                <li>updatedAt: {{ $product['updatedAt'] }}</li>

            </ul>
            @else
            <p>No product details available.</p>
            @endif
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
