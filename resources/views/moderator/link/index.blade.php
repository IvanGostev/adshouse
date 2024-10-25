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
                                <h3 class="card-title">Advertised links</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 50px">ID</th>
                                            <th>Preview</th>
                                            <th>URL</th>
                                            <th style="width: 40px">Approve</th>
                                            <th style="width: 150px">Refund the funds</th>
                                            <th style="width: 150px">Statistic</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($links as $link)
                                            <tr>
                                                <td>{{$link->id}}</td>
                                                <td>
                                                    <img src="{{asset($link->img)}}" height="200px">
                                                </td>
                                                <td>{{$link->url}}</td>
                                                <td>
                                                    @if($link->status != 'approved')
                                                        <form action="{{ route('moderator.link.approve', $link->id) }}"
                                                              method="post">
                                                            @method('patch')
                                                            @csrf
                                                            <button type="submit" class="btn btn-light btn-sm"> Approve
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if($link->status != 'approved')
                                                        <form action="{{ route('moderator.link.refund', $link->id) }}"
                                                              method="post">
                                                            @method('patch')
                                                            @csrf
                                                            <button type="submit" class="btn btn-light btn-sm"> Refund
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('moderator.link.statistic', $link->id)}}"
                                                       class="btn btn-primary">Statistic</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
