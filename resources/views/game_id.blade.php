@extends('layouts.template')

@section('styles')

    <link href="{{ asset('puzzles/css/style_game_id.css') }}" rel="stylesheet">
    <link href="{{ asset('puzzles/css/style_games_main.css') }}" rel="stylesheet">

@endsection

@section('content')
    {{--background-image: url({{ $post['large_image_url'] or $large_image--}}
    <div id="div-background" class="" style="display:none">

        <div id="div_mini_message" class="popover top alert alert-success">
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

                <div id="timer_zone">
                    <b>
                        <span id="timer">
                        </span>
                    </b>
                </div>

                <div id="games_all">
                    <a href="{{ route('games') }}">
                        <button class="btn btn-primary btn-lg button_original" id="games_all_button">
                            Все игры
                        </button>
                    </a>
                </div>

                <div id="start_div">
                    <button class="btn btn-primary btn-lg button_original" id="start_button">
                        Restart
                    </button>
                </div>

            </div>

            <div id="div-main" class="col-md-7">

                <div id="div-img">

                    <img src="{{ $posts['image_main_url_mini'] }} ">

                </div>

                @for($i=0; $i<$posts['number_zone']; $i++)
                    <div id="fitDrop{{$i+1}}" class="droppable fitDrop-all">
                        <span class="span_question">?</span>
                    </div>
                @endfor

            </div>

            <div class="col-md-3">

                <div class="row">

                    @if($posts['number_zone'] < 6)

                        <div class="col-md-12">
                            <div class="div-pic-i">

                                @for($i=0; $i<$posts['number_zone']; $i++)
                                        <div id="picture-{{$i+1}}" class="draggable picture-all">
                                            <img src="{{ $posts['description'][$i]['image'] }}">
                                        </div>
                                @endfor

                            </div>
                        </div>

                    @else

                        <div class="col-md-6">
                            <div class="div-pic-i">

                                @for($i = 0; $i < 5; $i++)
                                        <div id="picture-{{$i+1}}" class="draggable picture-all">
                                            <img src="{{ $posts['description'][$i]['image'] }}">
                                        </div>
                                @endfor

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="div-pic-i">

                                @for($i = 5; $i < $posts['number_zone']; $i++)
                                        <div id="picture-{{$i+1}}" class="draggable picture-all">
                                            <img src="{{ $posts['description'][$i]['image'] }}">
                                        </div>
                                @endfor

                            </div>
                        </div>

                    @endif

                    <button class="btn btn-success btn-lg button_original" id="ready_button"> Готово </button>

                </div>

            </div>

        </div>

    </div>

    <div id="modal_first" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">СОБЕРИ КАРТИНКУ</h4>
                </div>
                <div class="modal-body">
                    Необходимо поставить отсутствующие элементы картинки на свои места.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-lg" type="button" data-dismiss="modal" id="timer_button">
                        Start
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="modalResultOk" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="{{ $smile_yes }}">
                    <h4 class="modal-title" id="modal-title-ok">Изображение собрано верно !!!</h4><br>
                </div>
                <div class="modal-body" id="modalResultOkText">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-lg" type="button" data-dismiss="modal" id="ok_button">
                        Ok
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="modalResultError" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="{{ $smile_no }}">
                    <h4 class="modal-title" id="modal-title-error">Изображение собрано не верно.</h4><br>
                </div>
                <div class="modal-body" id="modalResultErrorText">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-lg" type="button" data-dismiss="modal" id="error_button">
                        Ok
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>

        var number_zone = '{{ $posts['number_zone'] }}';
        var wh_cut = '{{ $posts['wh_cut'] }}';
        var h_mini = '{{ $posts['h_mini'] }}';
        var w_mini = '{{ $posts['w_mini'] }}';
        var images = [];
        var posX = [];
        var posY = [];

        @for ($i = 0; $i < $posts['number_zone']; $i++)
            i = '{{ $i }}';
        images[i] = '{{ $posts['description'][$i]['image'] }}';
        posX[i] = '{{ $posts['description'][$i]['x1'] }}';
        posY[i] = '{{ $posts['description'][$i]['y1'] }}';
        @endfor

    </script>

    <script src="{{ asset('puzzles/js/custom.js') }}"></script>

@endsection

