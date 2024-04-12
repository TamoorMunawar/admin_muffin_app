@extends('layouts.master')

@section('title')
Dashboard
@endsection

@section('content')

<div class="col-md-12 mt-4" style="margin-top: 120px !important;">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Store Details</h4>
        </div>
        <div class="card-body" style="margin-left: 30px !important;" >
            @if(isset($store))
            <ul>
                <li>ID: {{ $store['_id'] }}</li>
                <li>Store Name: {{ $store['storeName'] }}</li>
                <li>Slogan: {{ $store['storeSlogan'] }}</li>
                <li>Description: {{ $store['storeDescription'] }}</li>
                <li>class: {{ $store['productClass'] }}</li>
                <li>createdAt: {{ $store['createdAt'] }}</li>
                <li>updatedAt: {{ $store['updatedAt'] }}</li>

            </ul>
            @else
            <p>No store details available.</p>
            @endif
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
