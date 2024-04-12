@extends('layouts.log')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@section('title')
    Login
@endsection

@section('content')
<div class="container">
    <form method="POST" action="{{ route('login') }}" class="main-login">
        @csrf
        <div class="left-login">
            <img src="{{ asset('images/person-working.png') }}" class="left-login-image" alt="Pessoa trabalhando">
        </div>
        <div class="right-login" style="">
                    <div class="card-login">
                    <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right" style="">{{ __('E-Mail Address') }}</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="margin-left: 20px; margin-top: 10px; font-size: 1.2rem;">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right" style="font-size: 1.2rem;">{{ __('Password') }}</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="margin-left: 20px; margin-top: 10px; font-size: 1.2rem;">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember" style="">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-0" style="">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary" style="">
                        {{ __('Login') }}
                    </button>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}" style="color: green; font-size: 1.2rem; margin-left: 10px;">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </form>
</div>
@endsection
