@extends('fitter.template.theme')

@section('styles')

    <link href="{{ asset('puzzles/css/style_game_id.css') }}" rel="stylesheet">
    <link href="{{ asset('puzzles/css/style_game_fit.css') }}" rel="stylesheet">

@endsection

@section('content')

    <div class="col-md-12">

        <div class="white-box">

            <table class="table table-bordered table-striped">

                <thead>

                <tr>
                    <th>#</th>
                    <th>Изображение</th>
                    <th>Заголовок</th>
                    <th>Видимость</th>
                    <th>Создан</th>
                    <th></th>
                </tr>

                </thead>

                <tbody>

                @foreach( $posts as $key => $post )

                    <tr>

                        <td>
                            {{ $key + 1 }}
                        </td>

                        <td>
                            <img src="{{ $post['image_main_url_fit'] }}">
                        </td>

                        <td>
                            {{ $post['title'] }}
                        </td>

                        <td>
                            <select
                                    class="form-control change_game_visible"
                                    data-url="{{ route('game_visible_post') }}"
                                    data-post-id="{{ $post['id'] }}"
                                    style="color: {{ $post['game_visible'] == 1 ? 'lightgreen' : '#FFA9AE' }};">

                                @if($post['game_visible'] == 1)

                                    <option value="1" selected="selected">Видна</option>
                                    <option value="0">Не видна</option>

                                @elseif($post['game_visible'] == 0)

                                    <option value="1">Видна</option>
                                    <option value="0" selected="selected">Не видна</option>

                                @endif

                            </select>
                        </td>

                        <td>{{ $post['created_at'] }}</td>

                        <td>
                            <a href="{{ route('delete_game', $post['id']) }}" class="btn btn-block btn-outline btn-danger">Удалить игру</a>
                        </td>
                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

@endsection

@section('scripts')

    <script src="{{ asset('puzzles/js/custom_fit.js') }}"></script>

@endsection



