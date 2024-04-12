@extends('layouts.master')

@section('title')
Dashboard
@endsection

@section('content')

<div class="container mt-4">
    <h1 class="display-4">Add Delivery Method</h1>
    <form action="{{ route('delivery.create') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="methodName" class="form-label h4" style="color: grey;">Method Name</label>
            <input type="text" class="form-control form-control-lg" id="methodName" name="methodName" required
                style="width: 300px; height: 30px; border: 1px solid grey; padding: 5px; font-size: 14px; margin-bottom: 10px;"
                placeholder="Method Name">
        </div>
        <div class="mb-3">
    <label for="days" class="form-label h4" style="color: grey;">Days</label>
    <input type="text" class="form-control form-control-lg" id="days" name="days" required
        style="width: 300px; height: 30px; border: 1px solid grey; padding: 5px; font-size: 14px; margin-bottom: 10px;"
        placeholder="Days">
</div>

        <div class="mb-3">
            <label for="price" class="form-label h4" style="color: grey;">Price</label>
            <input type="number" class="form-control form-control-lg" id="price" name="price" required
                style="width: 300px; height: 30px; border: 1px solid grey; padding: 5px; font-size: 14px; margin-bottom: 10px;"
                placeholder="Price">
        </div>
        <button type="submit" class="btn btn-primary">Add Delivery Method</button>
    </form>
</div>@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@endsection

@section('scripts')

@endsection
