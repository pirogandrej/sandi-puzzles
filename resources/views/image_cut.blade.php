@extends('fitter.template.theme')

@section('styles')

    <link href="{{ asset('puzzles/css/style_game_id.css') }}" rel="stylesheet">
    <link href="{{ asset('puzzles/css/style_game_fit.css') }}" rel="stylesheet">

    <style type="text/css" media="all">
    </style>

@endsection

@section('content')

    <div id="footer_crop" class="container white-box">
        <div class="row">

            @for($i = 0; $i < $posts['number_zone']; $i++)
                <div class="col-sm-1">
                    <div id="box_{{ $i }}"
                         class="crop-box"
                         data-url_change_activ="{{ route('image_cut_change') }}"
                         data-url_del_activ="{{ route('image_cut_delete') }}"
                         data-image_id="{{ $posts['id'] }}"

                         style="
                             @if($i == $number_activ)
                                     border: 1px solid #affcf5;
                             @endif
                             ">

                        <div class="col-md-12" style="margin-top: 30px">

                            <span style="color: #affcf5;padding-top: 10px">{{ $i + 1}}</span><br><br>

                        </div>

                    </div>
                </div>
            @endfor

        </div>

    </div>

    {{--<div style="position: absolute; left: 1400px;top: 800px;">--}}

        {{--<h2 id="btnReady" style="color: #b5e0ff;display: none">Готово!</h2>--}}

    {{--</div>--}}


    <form id="image_cut" class="form-horizontal" data-toggle="validator" novalidate="true" method="post" action="{{ route('image_cut')}}" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div id="div-main" class="col-sm-12">

            <div class="white-box">
                <div id="imagePic1">

                    <img id="imagePicOrigin" src="{{ $posts['image_main_url'] }}" alt="" title="" style="display: none" />
                    <img id="imagePic" src="{{ $posts['image_main_url_mini'] }}" alt="" title="" style="" />
                    <div id="movediv">
                        <button type="button" class="btn btn-info btn-circle btn-x2 image_cut"
                                data-url_cut_activ="{{ route('image_cut') }}"
                                data-image_id="{{ $posts['id'] }}"
                        ><i class="fa fa-scissors"></i> </button>
                    </div>

                </div>
            </div>

        </div>

    </form>

@endsection

@section('scripts')

    <script>

        var isReady = '{{ $isReady }}';
        var PicMiniWidth = '{{ $posts['w_mini'] }}';
        var PicMiniHeight = '{{ $posts['h_mini'] }}';
        var wh_item = '{{ $posts['wh_cut'] }}';
        var card_map = JSON.parse('{!! $card_map_json !!}');
        var number_activ = '{{ $number_activ }}';

    </script>

    <script src="{{ asset('puzzles/js/custom_cut.js') }}"></script>

@endsection
