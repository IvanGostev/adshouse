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
                                <h3 class="card-title">{{__('main.Resources of our advertisers')}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th style="width: 40px">ID</th>
                                        <th>{{__('main.URL')}}</th>
                                        <th>{{__('main.Statistic')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($links as $link)
                                        <tr>
                                            <td>{{$link->id}}</td>
                                            <td><a href="{{$link->url}}">{{$link->url}}</a></td>
                                            <td><a href="{{route('owner.link.statistic', $link->id)}}" class="btn btn-primary">{{__('main.Statistic')}}</a>  </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {{ $links->links() }}
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
