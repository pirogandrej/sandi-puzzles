@extends('admin.template.theme')

@section('styles')

    <link rel="stylesheet" type="text/css" href="{{ asset('fitter/plugins/bower_components/dropify/dist/css/dropify.min.css') }}">

@endsection

@section('scripts')

    <script src="{{ asset('fitter/plugins/bower_components/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="{{ asset('fitter/plugins/bower_components/moment/moment.js') }}"></script>
    <script src="{{ asset('fitter/js/custom/new_post.js') }}"></script>
    <script src="{{ asset('admin/js/validator.js') }}"></script>

@endsection

@section('content')

    <form id="form-user" class="form-horizontal" data-toggle="validator" novalidate="true" method="post" action="{{ route('admin_user_update_form')}}" enctype="multipart/form-data">

        {{ csrf_field() }}

        <input name="id" type="hidden" value="{{ $post['id'] }}">

        <div class="col-sm-4">

            <div class="white-box">

                <div class="form-group">

                    <label for="input-file-max-fs">Загрузка аватарки. Максимальный размер - 2 Мб.</label>

                    <div class="col-md-12">

                        <input type="file" name="avatar" class="dropify" data-max-file-size="2M" data-height="300" data-default-file="{{ $post['avatar_url'] }}" value="{{ $post['avatar'] }}"/>

                        <input type="hidden" name="latest_avatar" value="{{ $post['avatar'] }}" />

                    </div>

                </div>

            </div>

        </div>

        <div class="col-sm-4">

            <div class="white-box">

                <div class="form-group">

                    <label class="col-md-12">Имя пользователя :</label>

                    <div class="col-md-12">

                        <input type="text" name="name" required class="form-control" value="{{ $post['name'] }}" placeholder="Имя пользователя" />

                    </div>

                </div>

                <div class="form-group">

                    <label class="col-md-12">Email :</label>

                    <div class="col-md-12">

                        <input type="text" name="email" required class="form-control" value="{{ $post['email'] }}" data-role="tagsinput" />

                    </div>

                </div>

                <div class="form-group">

                    <label class="col-md-12">Пароль :</label>

                    <div class="col-md-12">

                        <input type="password" name="password" class="form-control" value="{{ $post['password'] }}" data-role="tagsinput" />

                    </div>

                </div>

                <div class="form-group">

                    <label class="col-md-12">Доступ :</label>

                    <div class="col-md-12">

                        <select class="form-control" name="access" required>
                            <option value="1" {{ $post['access'] == '1' ? 'selected="selected"' : '' }}>Включен</option>
                            <option value="0" {{ $post['access'] == '0' ? 'selected="selected"' : '' }}>Отключен</option>
                        </select>

                    </div>

                </div>

                <div class="form-group">

                    <label class="col-md-12">Админ-доступ :</label>

                    <div class="col-md-12">

                        <select class="form-control" name="admin_role" required>
                            <option value="1" {{ $post['admin_role'] == '1' ? 'selected="selected"' : '' }}>Включен</option>
                            <option value="0" {{ $post['admin_role'] == '0' ? 'selected="selected"' : '' }}>Отключен</option>
                        </select>

                    </div>

                </div>

            </div>

        </div>

    </form>

@endsection