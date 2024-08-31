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
                                <h3 class="card-title">Applications</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Information</th>
                                        <th>Date</th>
                                        <th style="width: 40px">Reject</th>
                                        <th style="width: 40px">Approve</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($applications as $item)
                                        <tr>
                                            <td>{{$item->user()->name}}</td>
                                            <td>{{$item->type}}</td>
                                            <td>{{$item->amount}}</td>
                                            <td>{{$item->information}}</td>
                                            <td>{{$item->created_at}}</td>
                                            <td>
                                                <form action="{{ route('moderator.balance.update', $item->id) }}"
                                                      method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <button name="status" value="cancelled" type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('moderator.balance.update', $item->id) }}"
                                                      method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <button name="status" value="approved" type="submit" class="btn btn-success btn-sm">Approve</button>
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
                                    {{ $applications->links() }}
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
