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
                                <h3 class="card-title">Apartments</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Date of creation</th>
                                        <th>Email user</th>
                                        <th>Description</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>District</th>
                                        <th>Street</th>
                                        <th>Room number</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($houses as $house)
                                        <tr>
                                            <td>{{$house->created_at}}</td>
                                            <td>{{$house->user()->email}}</td>
                                            <td>{{$house->about}}</td>
                                            <td>{{$house->country()->title}}</td>
                                            <td>{{$house->city()->title}}</td>
                                            <td>{{$house->district()->title}}</td>
                                            <td>{{$house->street}}</td>
                                            <td>{{$house->countRooms()}}</td>
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
