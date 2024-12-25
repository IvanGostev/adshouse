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
                                    <h3 class="card-title">{{__('admin.Plans')}}</h3>
                                </div>

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>{{__('admin.Link')}}</th>
                                            <th>{{__('admin.Title')}}</th>
                                            <th>{{__('admin.Price')}}</th>
                                            <th>{{__('admin.Status')}}</th>
                                            <th>{{__('admin.Date of purchase')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->link}}</td>
                                                <td>{{$item->tarrif()->title}}</td>
                                                <td>{{$item->tarrif()->price . ' АЕD'}}</td>
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
