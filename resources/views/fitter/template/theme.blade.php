<!DOCTYPE html>
<html lang="ru">

<head>

    @include('fitter.template.head')

</head>

<body class="fix-sidebar">

    <div class="preloader">

        <div class="cssload-speeding-wheel"></div>

    </div>

    <div id="wrapper">

        @include('fitter.template.sidebar')

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row bg-title">

                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

                        @include('fitter.template.page_title')

                    </div>

                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                        @include('fitter.template.breadcrumb')

                    </div>

                    <div class="col-sm-12">

                        @include('fitter.template.breadcrumb_buttons')

                    </div>

                </div>

                <div class="row">

                    @yield('content')

                </div>

            </div>

        </div>

    </div>

    @include('admin.components.logout_form')

</body>

@include('fitter.template.scripts')

</html>
