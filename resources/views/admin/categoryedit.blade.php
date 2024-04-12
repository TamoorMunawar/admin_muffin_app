@extends('layouts.master')

@section('title')
Edit Category
@endsection

@section('content')

<div class="col-md-12 mt-4" style="margin-top: 120px !important;">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Catgeory Details</h4>
        </div>
        <div class="card-body">
        <form action="{{ route('category.update', ['id' => $category['_id']]) }}" method="POST">
                @csrf
                @method('PUT')
               
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ $category['description'] }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
