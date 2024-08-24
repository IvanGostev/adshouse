@extends('layouts.main')
@section('content')

    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <a href="{{route('user.room.create', $house->id)}}" class="btn btn-light">Добавить</a>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="container-fluid">
                <h5 class="mb-2">Комнаты</h5>
                <div class="card card-success">
                    <div class="card-body">
                        <div class="row">
                            @foreach($rooms as $room)
                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="card mb-2 bg-gradient-dark text-white">
                                        <img class="card-img-top" src="{{asset('images/room-placeholder.jpg')}}" alt="Dist Photo 1">
                                        <div class="card-img-overlay d-flex flex-column justify-content-end" style="background: black; opacity: 75%">
                                            <a href="{{route('user.room.edit', $room->id)}}" class="card-title text-primary text-white" style="cursor: pointer;">{{$room->type()->title}}</a>
                                            <a class="card-text text-white pb-2 pt-1">{{$room->about}}</a>
                                            <a href="{{route('user.room.edit', $room->id)}}" class="text-white">Последние обновление {{$room->updated_at}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
