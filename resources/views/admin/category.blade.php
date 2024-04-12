@extends('layouts.master')

@section('title')
Dashboard
@endsection

@section('content')

<div class="container mt-4">
    <h1 class="display-4">Add Category</h1>
    <form action="{{ route('category.create') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="categoryName" class="form-label h4" style="color: grey;">Category Name</label>
            <input type="text" class="form-control form-control-lg" id="categoryName" name="categoryName" required
                style="width: 300px; height: 30px; border: 1px solid grey; padding: 5px; font-size: 14px; margin-bottom: 10px;"
                placeholder="Category Name">
        </div>
        <div class="mb-3">
            <label for="subcategories" class="form-label h4" style="color: grey;">Subcategories</label>
            <textarea class="form-control form-control-lg" id="subcategories" name="subcategories" required
                style="width: 300px; height: 30px; border: 1px solid grey; padding: 5px; font-size: 14px; margin-bottom: 10px;"
                placeholder="Subcategories JSON"></textarea>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label h4" style="color: grey;">Description</label>
            <textarea class="form-control form-control-lg" id="description" name="description" required
                style="width: 300px; height: 30px; border: 1px solid grey; padding: 5px; font-size: 14px; margin-bottom: 10px;"
                placeholder="Description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Category</button>
    </form>
</div>

@endsection

@section('scripts')

@endsection
