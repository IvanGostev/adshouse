<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <style>
        .card {
            background-color: #212529 !important;
        }

        .dark-mode .content-wrapper {
            background-color: #343a40;
            color: #fff;
        }

        .select2-selection, .select2-selection__rendered, .dropdown-wrapper {
            background-color: #454d55 !important;
            color: #fff;
        }

        .select2.selection {
            background-color: #343a40;
        }

        .select2-selection__choice {
            background-color: #007bff !important;
            border-color: #006fe6 !important;
            color: #fff !important;
        }

        @media (max-width: 450px) {
            .small-box h3 {
                font-size: 1.4rem !important;
            }
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('/admin/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/air-datepicker.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>


    <!-- Add -->

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
          href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/jqvmap/jqvmap.min.css')}}">


    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css')}}">
</head>
<style>
    .dark-mode .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active, .dark-mode .sidebar-light-primary .nav-sidebar > .nav-item > .nav-link.active {
        background-color: #fff;
        color: black;
    }

    .bg-verydark {
        background-color: #212529
    }
</style>
{{--        dark-mode--}}
<body
    class="dark-mode @if(!in_array(auth()->user()->role, ['moderator', 'admin'])) layout-top-nav @endif  layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <h1 class="fw-bolder">{{ config('app.name', 'Laravel') }}</h1>
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-sm  navbar-dark justify-content-between"
         style="background-color: #212529">
        <div class="container-fluid">
            <button class="navbar-toggler collapsed btn btn-dark btn-md" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarSupportedContent" style="">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                    @if(in_array(auth()->user()->role, ['moderator', 'admin']))
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                    class="fas fa-bars"></i></a>
                        </li>
                    @endif
                    @switch(auth()->user()->role)
                        @case('owner')
                            <li class="nav-item d-sm-inline-block">
                                <a href="{{ route('owner.main.index') }}"
                                   class="nav-link {{request()->path() == 'owner' ? 'active' : ''}}">
                                    <p>
                                        {{__('main.Dashboard')}}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item d-sm-inline-block">
                                <a href="{{ route('owner.house.index') }}"
                                   class="nav-link {{request()->path() == 'owner/houses' ? 'active' : ''}}">
                                    <p>
                                        {{__('main.My apartment')}}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item d-sm-inline-block">
                                <a href="{{ route('owner.link.index') }}"
                                   class="nav-link {{request()->path() == 'owner/links' ? 'active' : ''}}">
                                    <p>
                                        {{__('main.Advertiser')}}
                                    </p>
                                </a>
                            </li>
                            @break
                        @case('advertiser')
                            <li class="nav-item  d-sm-inline-block">
                                <a href="{{ route('advertiser.main.index') }}"
                                   class="nav-link {{request()->path() == 'advertiser' ? 'active' : ''}}">
                                    <p>
                                         {{__('main.Dashboard')}}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item d-sm-inline-block">
                                <a href="{{route('advertiser.tariff.index')}}"
                                   class="nav-link {{request()->path() == 'advertiser/tariffs' ? 'active' : ''}}">
                                    <p>
                                        {{__('main.Plans')}}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item d-sm-inline-block">
                                <a href="{{route('advertiser.tariff.my')}}"
                                   class="nav-link {{request()->path() == 'advertiser/tariffs/my' ? 'active' : ''}}">
                                    <p>
                                        {{__('main.Current plan')}}
                                    </p>
                                </a>
                            </li>
                            @break
                        @case('user')
                            <li class="nav-item d-sm-inline-block">
                                <a href="{{ route('user.main.index') }}"
                                   class="nav-link {{request()->path() == 'user' ? 'active' : ''}}">
                                    <p>
                                        {{__('main.Dashboard')}}
                                    </p>
                                </a>
                            </li>
                            @break
                    @endswitch
                </ul>
            </div>
            <ul class="navbar-nav" style="display: flex; min-width: 210px!important; flex-direction: row; gap: 10px" >
                @if(!in_array(auth()->user()->role, ['moderator', 'admin']))
                    <li class="nav-item">
                        <a href="{{route('balance.show')}}" class="nav-link">{{__('main.Balance')}}: <span class="fw-bold">{{auth()->user()->balance}} AED</span>
                        </a>
                    </li>
                @endif
                    <li class="nav-item">
                        <form action="{{route('language.switch')}}" method="post">
                            @csrf
                            <select onchange="this.form.submit()" name="language"
                                    class="form-select bootstrap-table-filter-control-price "
                                    style="width: 100%;" dir="ltr">
                                <option
                                    {{((session()->get('language') !== null ) and (session()->get('language') == 'en')) ? 'selected' : ''}} value="en">
                                    English
                                </option>
                                <option {{((session()->get('language') !== null ) and (session()->get('language') == 'ru')) ? 'selected' : ''}} value="ru">
                                    Русский
                                </option>
                            </select>
                        </form>
                    </li>
                <li class="nav-item">
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit"
                                class="btn btn-outline-light fw-normal">{{__('main.Logout')}}
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </nav>


    @include('includes.sidebar')

    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer" style="position: relative">
        <strong>{{ __('admin.Copyright &copy; 2024')}}<a href="/">{{ config('app.name', 'Laravel') }}</a>.</strong>
        {{ __('admin.All rights reserved')}}.
        <div class="float-right d-none d-sm-inline-block">
            {!! __('admin.<b>Version</b> 1.0.0') !!}
        </div>
    </footer>
</div>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.js')}}"></script>
<script src="{{asset('admin/dist/js/pages/dashboard.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('admin/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('admin/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('admin/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('admin/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>


<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin/dist/js/pages/dashboard2.js')}}"></script>

<script src="{{asset('admin/js/air-datepicker.js')}}"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
<script src="{{asset('admin/js/app.js')}}"></script>
<script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>

<form hidden="hidden" id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
<script src="https://bootstraptema.ru/plugins/jquery/jquery-1.11.3.min.js"></script>
<script src="https://bootstraptema.ru/plugins/2016/shieldui/script.js"></script>
@if(isset($transitionsForChartAdvertiserLink))
    <script>
        $(document).ready(function () {
            $("#chartAdvertiserLink").shieldChart({
                theme: "dark",
                primaryHeader: {
                    text: "{{__('main.The number of clicks on the advertised link')}}"
                },
                exportOptions: {
                    image: false,
                    print: false
                },
                axisX: {
                    categoricalValues: [
                        @foreach($transitionsForChartAdvertiserLink as $transition)
                            "{{$transition->date}}",
                        @endforeach
                    ]
                },
                tooltipSettings: {
                    chartBound: true,
                    axisMarkers: {
                        enabled: true,
                        mode: 'xy'
                    }
                },
                dataSeries: [{
                    seriesType: 'line',
                    collectionAlias: "{{__('main.Number of clicks')}}",
                    data: [
                        @foreach($transitionsForChartAdvertiserLink as $transition)
                            {{$transition->views}},
                        @endforeach
                    ]
                }],
                backgroundColor: "#212529",
            });
        });
    </script><!-- /.График -->
@endif
@if(isset($transitionsForQrcode))
    <script>
        $(document).ready(function () {
            $("#chartQrcode").shieldChart({
                theme: "dark",
                primaryHeader: {
                    text: "{{__('main.Number of clicks on qrcodes')}}"
                },
                exportOptions: {
                    image: false,
                    print: false
                },
                axisX: {
                    categoricalValues: [
                        @foreach($transitionsForQrcode as $transition)
                            "{{$transition->date}}",
                        @endforeach
                    ]
                },
                tooltipSettings: {
                    chartBound: true,
                    axisMarkers: {
                        enabled: true,
                        mode: 'xy'
                    }
                },
                dataSeries: [{
                    seriesType: 'line',
                    collectionAlias: "{{__('main.Number of clicks')}}",
                    data: [
                        @foreach($transitionsForQrcode as $transition)
                            {{$transition->views}},
                        @endforeach
                    ]
                }],
                backgroundColor: "#212529",
            });
        });
    </script><!-- /.График -->
@endif
<script src="{{ asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $('.select2').select2()
</script>
</body>
</html>
