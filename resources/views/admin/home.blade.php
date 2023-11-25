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
            <p class="header-item-text">Admin Panel</p>
        </div>
        <div class="header-item">
            <p class="header-item-text">My page</p>
        </div>
    </div>
    <div class="header-menu-profile">
        <div class="header-item-profile">
            <p class="header-item-text">Logout</p>
        </div>
    </div>
</header>
@include('partial.sidebar')
@section("content")


@endsection
