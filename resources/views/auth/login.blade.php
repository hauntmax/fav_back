@extends('layouts.auth')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
{{-- <link rel="font" href="{{ asset('fonts/Roboto-Regular.ttf') }}"> --}}
@endpush

@section('content')
<div class="login-content-block">
    <form class="login-form-block" action="{{ route('auth.login') }}" method="POST">
        @csrf
        <div class="login-item">
            <input class="login-item-input" type="text" name="email" placeholder="Username or email">
        </div>
        <div class="login-item">
            <input class="login-item-input" type="password" name="password" placeholder="Password">
        </div>
        <div class="login-item">
            <input class="login-item-checkbox" type="checkbox" name="remember"><p class="login-item-text">Remember me</p>
        </div>
        <div class="login-item">
            <button class="login-item-button-submit" type="submit"><p class="login-item-text">Enter</p></button>
        </div>
    </form>
</div>
@endsection
