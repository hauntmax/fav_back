@extends("layouts.main")

@push('style')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endpush

@section("content")
    @include('partial.admin.header')
    <div class="content">
        @include('partial.sidebar')

        <p class="content-text">Admin dashboard content</p>
    </div>
@endsection

@push('script')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
