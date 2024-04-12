@extends('layouts.master')

@section('title')
Dashboard
@endsection

@section('content')

<div class="col-md-12 mt-4" style="margin-top: 120px !important;">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Category Details</h4>
        </div>
        <div class="card-body" style="margin-left: 30px !important;">
            @if(isset($category))
            <ul>
                <li>ID: {{ $category['_id'] }}</li>
                <li>Category Name: {{ $category['categoryName'] }}</li>
                <li>Subcategories:</li>
                <ul>
                    @if(is_array($category['subcategories']))
                        @foreach($category['subcategories'] as $subcategory)
                        <li>{{ $subcategory }}</li>
                        @endforeach
                    @else
                        <li>No subcategories available.</li>
                    @endif
                </ul>
                <li>Description: {{ $category['description'] }}</li>
                <li>CreatedAt: {{ $category['createdAt'] }}</li>
                <li>UpdatedAt: {{ $category['updatedAt'] }}</li>
            </ul>
            @else
            <p>No category details available.</p>
            @endif
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
