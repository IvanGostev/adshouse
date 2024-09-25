@extends('layouts.main')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.4px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">




                    <div class="col-md-12">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Tariffs</h3>
                                </div>

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Link</th>
                                            <th>Title</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Date of purchase</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->link}}</td>
                                                <td>{{$item->tarrif()->title}}</td>
                                                <td>{{$item->tarrif()->price . ' RUB'}}</td>
                                                <td>{{$item->status}}</td>
                                                <td>{{$item->created_at}}</td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>


                    </div>

                </div>

            </div>
        </section>
    </div>
@endsection
