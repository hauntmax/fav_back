@extends('layouts.main')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endpush

@section('content')
    @include('partial.user.header')
    <form action="{{ route('user.services.export') }}" method="POST">
        @csrf
        <input type="text" name="playlistLink" placeholder="Playlist Link">
        <button type="submit">Экспорт</button>
    </form>

    @include('partial.footer')
@endsection

@push('script')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
