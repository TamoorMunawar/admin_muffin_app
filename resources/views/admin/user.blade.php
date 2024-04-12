@extends('layouts.master')

@section('title')
Dashboard
@endsection

@section('content')

<div class="col-md-12 mt-4" style="margin-top: 120px !important;">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">User Details</h4>
        </div>
        <div class="card-body" style="margin-left: 30px !important;" >
            @if(isset($user))
            <ul>
                <li>emailstatus: {{ $user['emailVerification'] }}</li>
                <li>address: {{ $user['streetAddress'] }}</li>
                <li>postalcode: {{ $user['postalCode'] }}</li>
                <li>status: {{ $user['userStatus'] }}</li>
                <li>email: {{ $user['email'] }}</li>
                <li>createdAt: {{ $user['createdAt'] }}</li>
                <li>updatedAt: {{ $user['updatedAt'] }}</li>

            </ul>
            @else
            <p>No user details available.</p>
            @endif
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
