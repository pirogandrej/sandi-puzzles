@extends('fitter.template.theme')

@section('styles')

    <link href="{{ asset('puzzles/css/style_game_id.css') }}" rel="stylesheet">

@endsection

@section('content')

    <h1>Игры не выбраны</h1>

@endsection

@section('scripts')

    <script src="{{ asset('puzzles/js/custom_fit.js') }}"></script>

@endsection
