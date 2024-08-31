@extends('layouts.main')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.4px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            </div><!-- /.container-fluid -->
        </section>
        @foreach($UTs as $UT)
            <a href="{{$UT->url}}" class="jumbotron text-center   mr-5  ml-5"
               style="background-image: url({{asset($UT->img)}});">
            </a>
        @endforeach
    </div>
@endsection
