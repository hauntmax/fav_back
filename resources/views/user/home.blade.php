@extends("layouts.main")

@push('style')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endpush

@section("content")
    @include('partial.user.header')
    <p class="content-text">Home content</p>
    @include('partial.footer')
@endsection

@push('script')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
