@extends('layouts.main')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.4px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            </div><!-- /.container-fluid -->
        </section>
@dd("hello")
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Apartments</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Preview</th>
                                        <th>Email user</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>District</th>
                                        <th>Street</th>
                                        <th>Number</th>
                                        <th>Room number</th>
                                        <th style="width: 40px">Approve/Moderation</th>
                                        <th style="width: 40px">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($houses as $house)
                                        <tr>
                                            <td>
                                                <img src="{{asset($house->img)}}" height="200px">
                                            </td>
                                            <td>{{$house->user()->email}}</td>
                                            <td>{{$house->title}}</td>
                                            <td>{{$house->about}}</td>
                                            <td>{{$house->country()->title}}</td>
                                            <td>{{$house->city()->title}}</td>
                                            <td>{{$house->district()->title}}</td>
                                            <td>{{$house->street}}</td>
                                            <td>{{$house->number}}</td>
                                            <td>{{$house->countRooms()}}</td>
                                            <td>
                                                <form action="{{ route('moderator.house.update', $house->id) }}"
                                                      method="post">
                                                    @method('patch')
                                                    @csrf
                                                    <button type="submit"
                                                            class="btn btn-light btn-sm"> {{$house->status == 'approved' ? 'Return to moderation' : 'Approve'}}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('user.house.destroy', $house->id) }}"
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
                                    {{ $houses->withQueryString()->links() }}
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
