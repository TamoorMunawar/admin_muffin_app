@extends('layouts.master')

@section('title')
Dashboard
@endsection


@section('content')

<div class="container mt-4">
    <h1 class="display-4">Add Anything</h1>
    <form action="" method="post">
        @csrf
        <div class="mb-3">
            <label for="serviceName" class="form-label h4"  style="color:black;">% Name</label>
            <input type="text" class="form-control form-control-lg" id="serviceName" name="serviceName" required 
       style="width: 400px; height: 40px; border: 1px solid black; padding: 10px; font-size: 16px;"
       placeholder="Post Name">
        </div>
        <button type="submit" class="btn btn-primary">Add Post</button>
    </form>
</div>

@endsection


@section('scripts')

@endsection