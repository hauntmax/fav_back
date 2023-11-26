@extends("layouts.main")

@push('style')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endpush

<header>
    <div class="header-menu-logo">
        <div class="header-item-logo">
            <p class="header-item-text">Favvert App</p>
        </div>
    </div>
    <div class="header-menu-group">
        <div class="header-item">
            <a class="header-item-text" href="{{route('admin.dashboard')}}">
                Admin
            </a>
        </div>
        <div class="header-item">
            <p class="header-item-text">Storage</p>
        </div>
        <div class="header-item">
            <p class="header-item-text">Services</p>
        </div>
        <div class="header-item">
            <p class="header-item-text">Messages</p>
        </div>
        <div class="header-item">
            <p class="header-item-text">Calls</p>
        </div>
        <div class="header-item">
            <p class="header-item-text">Updates</p>
        </div>
    </div>
    <div class="header-menu-profile">
        <div class="header-item-profile">
            <p class="header-item-text">{{ isset($user) ? $user->name : 'Unknown' }}</p>
        </div>
        <div class="header-item-profile">
            <a class="header-item-text" href="{{ route('auth.logout') }}">
                Logout
            </a>
        </div>
    </div>
</header>
@section("content")

@include('partial.footer')

@endsection
