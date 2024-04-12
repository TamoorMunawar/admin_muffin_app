@extends('layouts.master')

@section('title')
Dashboard
@endsection

@section('content')

<div class="container mt-4">
    <h1 class="display-4">Add Store</h1>
    <form action="{{ route('store.create') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="storeName" class="form-label h4" style="color: orange;">Store Name</label>
            <input type="text" class="form-control form-control-lg" id="storeName" name="storeName" required
                style="width: 400px; height: 40px; border: 1px solid orange; padding: 10px; font-size: 16px;"
                placeholder="Store Name">
        </div>
        <div class="mb-3">
            <label for="storeSlogan" class="form-label h4" style="color: orange;">Store Slogan</label>
            <input type="text" class="form-control form-control-lg" id="storeSlogan" name="storeSlogan" required
                style="width: 400px; height: 40px; border: 1px solid orange; padding: 10px; font-size: 16px;"
                placeholder="Store Slogan">
        </div>
        <div class="mb-3">
            <label for="storeDescription" class="form-label h4" style="color: orange;">Store Description</label>
            <textarea class="form-control form-control-lg" id="storeDescription" name="storeDescription" required
                style="width: 400px; height: 120px; border: 1px solid orange; padding: 10px; font-size: 16px;"
                placeholder="Store Description"></textarea>
        </div>
        <div class="mb-3">
            <label for="productClass" class="form-label h4" style="color: orange;">Product Class</label>
            <input type="text" class="form-control form-control-lg" id="productClass" name="productClass" required
                style="width: 400px; height: 40px; border: 1px solid orange; padding: 10px; font-size: 16px;"
                placeholder="Product Class">
        </div>
        <div class="mb-3">
            <label for="subCategory" class="form-label h4" style="color: orange;">Sub Category</label>
            <input type="text" class="form-control form-control-lg" id="subCategory" name="subCategory" required
                style="width: 400px; height: 40px; border: 1px solid orange; padding: 10px; font-size: 16px;"
                placeholder="Sub Category">
        </div>
        <button type="submit" class="btn btn-primary">Add Store</button>
    </form>
</div>

@endsection

@section('scripts')

@endsection
