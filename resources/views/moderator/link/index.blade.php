@extends('layouts.main')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.4px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Rooms</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Preview</th>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th style="width: 40px">Approve</th>
                                        <th style="width: 40px">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rooms as $room)
                                        <tr>
                                            <td>{{$room->id}}</td>
                                            <td>
                                                <img src="{{asset($room->img)}}" height="200px">
                                            </td>
                                            <td>{{$room->title}}</td>
                                            <td>{{$room->type()->title}}</td>
                                            <td>{{$room->about}}</td>
                                            <td>
                                                <form action="{{ route('moderator.room.update', $room->id) }}"
                                                      method="post">
                                                    @method('patch')
                                                    @csrf
                                                    <button type="submit" class="btn btn-light btn-sm"> Approve
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('user.room.destroy', $room->id) }}"
                                                      method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-light btn-sm"><i
                                                            class="fas fa-trash">
                                                        </i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {{ $rooms->links() }}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
