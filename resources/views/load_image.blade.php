@extends('fitter.template.theme')

@section('styles')

    <link href="{{ asset('puzzles/css/style_game_id.css') }}" rel="stylesheet">
    <link href="{{ asset('puzzles/css/style_game_fit.css') }}" rel="stylesheet">

    <style type="text/css" media="all">
    </style>

@endsection

@section('content')

    <form id="form-image" class="form-horizontal" data-toggle="validator" novalidate="true" method="post" action="{{ route('image_update')}}" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="col-sm-8">

            <div class="white-box">

                <div class="form-group">

                    <label class="col-md-12">Название новой игры :</label>

                    <div class="col-md-12">

                        <input type="text" name="title" required class="form-control" value="game_1" placeholder="Название игры">

                    </div>

                </div>

            </div>

            <div class="white-box">

                <div class="form-group">

                    <label for="input-file-max-fs">Загрузка картинки. Максимальный размер - 2 Мб.</label>

                    <div class="col-md-12">

                        <input type="file" name="image_main" class="dropify" data-max-file-size="2M" data-height="500" data-default-file="{{ $posts['image_main_url'] }}" value="{{ $posts['image_main'] }}"/>

                        <input type="hidden" name="latest_image" value="{{ $posts['image_main'] }}" />

                    </div>

                </div>

            </div>

        </div>

        <div class="col-sm-4">

            <div class="white-box" style="height: 75px">

                <div class="col-md-12">

                    <span style="color: greenyellow;padding-bottom: 5px">Шаг 1 - Загрузить картинку</span><br><br>

                </div>

            </div>

            <div class="white-box" style="height: 125px">

                <label for="my_select">Выберите размеры вырезаемых картинок :</label>

                <div class="col-md-12">
                    <select id="sizeZone" name="wh_cut" class="form-control">
                        <option value="100">100 * 100</option>
                        <option value="150" selected>150 * 150</option>
                        <option value="200">200 * 200</option>
                        <option value="250">250 * 250</option>
                    </select>
                </div>

            </div>

            <div class="white-box" style="height: 125px">

                <label for="my_select">Выберите кол-во вырезаемых картинок :</label>

                <div class="col-md-12">
                    <select id="numberZone" name="number_zone" class="form-control">
                    </select>
                </div>

            </div>

            <a id="btnSave" class="btn btn-rounded btn-success btn-lg change_image_js">Сохранить</a>

        </div>

    </form>

@endsection

@section('scripts')

    <script src="{{ asset('puzzles/js/custom_fit.js') }}"></script>

@endsection
