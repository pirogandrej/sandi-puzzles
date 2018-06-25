@extends('layouts.template')

@section('styles')

    <link href="{{ asset('puzzles/css/style_games_main.css') }}" rel="stylesheet">

@endsection

@section('content')

    <div id="div_common_id" style="background-image: url({{ $post['large_image_url'] or $large_image }});">
        <div id="div-background">
            <div class="popover top alert alert-success">
                <div class="arrow">

                </div>
                <h3 class="popover-title">
                    Info
                </h3>
                <div class="popover-content">
                    <p>Для корректной работы игры требуется разрешение экрана не менее (770 * 300) px</p><br>
                    <p>Текущее разрешение экрана <br/>(<span id="span_bk_width"></span> * <span id="span_bk_height"></span>) px</p>
                </div>
            </div>
        </div>


        <div class="container-fluid">

            <div class="row">

                <div class="col-md-2">

                </div>

                <div id="div_center" class="col-md-8">

                    <table class="table table-bordered table-striped">

                        <thead>

                            <tr>
                                <th>#</th>
                                <th>Изображение</th>
                                <th>Заголовок</th>
                                <th></th>
                            </tr>

                        </thead>

                        <tbody>

                            @if(isset($posts[0]['game_visible']))

                                @php
                                    $sum_key = 0
                                @endphp

                                @foreach( $posts as $key => $post )

                                        @if($post['game_visible'] == 1)

                                            @php
                                                $sum_key++
                                            @endphp

                                            <tr>

                                                <td>
                                                    {{ $sum_key }}
                                                </td>

                                                <td>
                                                    <img src="{{ $post['image_main_url_fit'] }}" id="img-icon">
                                                </td>

                                                <td>
                                                    {{ $post['title'] }}
                                                </td>

                                                <td>
                                                    <a href="{{ route('game_id', $post['id']) }}" class="btn btn-block btn-outline btn-success">Выбрать</a>
                                                </td>

                                            </tr>

                                        @endif

                                @endforeach

                            @endif

                        </tbody>

                    </table>

                </div>

                <div class="col-md-2">

                    <a href="/load_image"><button href="/load_image"> Login </button></a>

                </div>

            </div>

        </div>

    </div>

@endsection

@section('scripts')

    <script src="{{ asset('puzzles/js/custom.js') }}"></script>

@endsection
