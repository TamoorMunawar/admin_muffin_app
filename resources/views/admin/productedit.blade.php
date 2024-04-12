@extends('layouts.master')

@section('title')
Edit User
@endsection

@section('content')

<div class="col-md-12 mt-4" style="margin-top: 120px !important;">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Store Details</h4>
        </div>
        <div class="card-body">
        <form action="{{ route('product.update', ['id' => $product['_id']]) }}" method="POST">
                @csrf
                @method('PATCH')
               
                <div class="form-group">
                    <label for="price">Product Price</label>
                    <input type="text" class="form-control" id="price" name="price" value="{{ $product['price'] }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
