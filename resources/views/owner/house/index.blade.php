@extends('layouts.main')
@section('content')

    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <a href="{{route('owner.house.create')}}" class="btn btn-light">{{__('main.Add')}}</a>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="row">
                        @foreach($houses as $house)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">
                                    <div class="card-header text-muted border-bottom-0">
                                        {{__('main.Number of rooms')}}: {{$house->countRooms()}}
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="lead"><b>{{$house->title}}</b></h2>
                                                <p class="text-muted text-sm"><b>{{__('main.Description')}}: </b> {{$house->about}} </p>
                                            </div>
                                            <div class="col-12">
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li style="padding-bottom: 10px;" class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                                        {{__('main.Address')}}: {{$house->country()->title}}, {{$house->city()->title}}, {{$house->street}}, {{'house ' . $house->number}}, {{$house->apartment_number ? 'apart ' . $house->apartment_number : ''}} </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <a href="{{ route('owner.room.index', $house->id) }}" class="btn  btn-sm btn-light">
                                              {{__('main.Rooms')}}
                                            </a>
                                            <a href="{{route('owner.house.edit', $house->id)}}" class="btn btn-sm btn-secondary">
                                              {{__('main.Edit')}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <nav aria-label="Contacts Page Navigation">
                 {{$houses->links()}}
                    </nav>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection
