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
            <input class="login-item-checkbox" type="checkbox" name="remember">Remember me
        </div>
        <div class="login-item">
            <button class="login-item-button-submit" type="submit">Enter</button>
        </div>
    </form>
</div>
@endsection
