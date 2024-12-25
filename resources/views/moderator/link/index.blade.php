@extends('moderator.layouts.main')
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
                                <h3 class="card-title">{{__('admin.Advertised links')}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 50px">ID</th>
                                            <th>{{__('admin.Preview')}}</th>
                                            <th>{{__('admin.URL')}}</th>
                                            <th style="width: 40px">{{__('admin.Approve')}}</th>
                                            <th style="width: 150px">{{__('admin.Refund the funds')}}</th>
                                            <th style="width: 150px">{{__('admin.Statistic')}}</th>
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
                                                            <button type="submit" class="btn btn-light btn-sm">{{__('admin.Approve')}}
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
                                                            <button type="submit" class="btn btn-light btn-sm"> {{__('admin.Refund')}}
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('moderator.link.refundAfterApprove', $link->id) }}"
                                                              method="post">
                                                            @method('patch')
                                                            @csrf
                                                            <button type="submit" class="btn btn-light btn-sm"> {{__('admin.Refund')}}
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('moderator.link.statistic', $link->id)}}"
                                                       class="btn btn-primary">{{__('admin.Statistic')}}</a>
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
    @if($errors->any())
        <div id="toastsContainerTopRight" class="toasts-top-right fixed">
            <div class="toast bg-danger fade show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header"><strong class="mr-auto">{{__('admin.Error')}}</strong>
                </div>
                <div class="toast-body">{{$errors->first()}}</div>
            </div>
        </div>
    @endif
@endsection
