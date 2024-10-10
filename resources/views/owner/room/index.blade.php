@extends('layouts.main')
@section('content')
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <a href="{{route('owner.room.create', $house->id)}}" class="btn btn-light">Add</a>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="container-fluid">
                <h5 class="mb-2">Rooms</h5>
                <div class="card card-success">
                    <div class="card-body">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th style="width: 40px">Status</th>
                                <th style="width: 40px">Edit</th>
                                <th style="width: 40px">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rooms as $room)
                                <tr>
                                    <td>{{$room->id}}</td>
                                   <td>{{$room->type()->title}}</td>
                                    <td>{{$room->about}}</td>
                                    <td>
                                        @if($room->status == 'moderation')
                                            <span class="badge bg-primary">{{$room->status}}</span>
                                        @elseif($room->status == 'approved')
                                            <span class="badge bg-success">{{$room->status}}</span>
                                        @elseif($room->status == 'canceled')
                                            <span class="badge bg-danger">{{$room->status}}</span>
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{route('owner.room.edit', $room->id)}}" class="btn btn-light btn-sm">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('owner.room.destroy', $room->id) }}"
                                              method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-light btn-sm">Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
