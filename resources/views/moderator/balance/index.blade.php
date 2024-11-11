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
                                <form class="row" action="#"
                                      style="display: flex ;align-items: flex-end">
                                    <div class="col-sm-12 col-md-2">
                                        <div>
                                            <div class="fw-bold fs-6">First name</div>
                                            <div class="fht-cell">
                                                <div class="filter-control">
                                                    <input type="text" value="{{request()['name'] ?? ''}}" name="name"
                                                           class="form-control" placeholder="Text ...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2">
                                        <div>
                                            <div class="fw-bold fs-6">Last name</div>
                                            <div class="fht-cell">
                                                <div class="filter-control">
                                                    <input type="text" value="{{request()['last_name'] ?? ''}}"
                                                           name="last_name" class="form-control" placeholder="Text ...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2">
                                        <div>
                                            <div class="fw-bold fs-6">Email</div>
                                            <div class="fht-cell">
                                                <div class="filter-control">
                                                    <input type="text" value="{{request()['email'] ?? ''}}" name="email"
                                                           class="form-control" placeholder="Text ...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2">
                                        <div>
                                            <div class="fw-bold fs-6">Phone</div>
                                            <div class="fht-cell">
                                                <div class="filter-control">
                                                    <input type="text" value="{{request()['phone'] ?? ''}}" name="phone"
                                                           class="form-control" placeholder="Text ...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2">
                                        <div>
                                            <div class="fw-bold fs-6">Role</div>
                                            <div class="fht-cell">
                                                <div class="filter-control">
                                                    <select
                                                        class="form-select bootstrap-table-filter-control-price "
                                                        style="width: 100%;" dir="ltr" name="role">
                                                        <option
                                                            {{request()['role'] == 'all' ? 'selected' : '' }} value="all">
                                                            All
                                                        </option>
                                                        <option
                                                            {{request()['role'] == 'owner' ? 'selected' : '' }} value="owner">
                                                            Owner
                                                        </option>
                                                        <option
                                                            {{request()['role'] == 'advertiser' ? 'selected' : '' }} value="advertiser">
                                                            Advertiser
                                                        </option>
                                                        <option
                                                            {{request()['role'] == 'user' ? 'selected' : '' }} value="user">
                                                            User
                                                        </option>
                                                        <option
                                                            {{request()['role'] == 'moderator' ? 'selected' : '' }} value="moderator">
                                                            Moderator
                                                        </option>
                                                        <option
                                                            {{request()['role'] == 'admin' ? 'selected' : '' }} value="admin">
                                                            Admin
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2">
                                        <div>
                                            <div class="fw-bold fs-6">Status</div>
                                            <div class="fht-cell">
                                                <div class="filter-control">
                                                    <select
                                                        class="form-select bootstrap-table-filter-control-price "
                                                        style="width: 100%;" dir="ltr" name="status">
                                                        <option
                                                            {{request()['status'] == 'all' ? 'selected' : '' }} value="all">
                                                            All
                                                        </option>
                                                        <option
                                                            {{request()['status'] == 'moderation' ? 'selected' : '' }} value="moderation">
                                                            Moderation
                                                        </option>
                                                        <option
                                                            {{request()['status'] == 'cancelled' ? 'selected' : '' }} value="cancelled">
                                                            Cancelled
                                                        </option>
                                                        <option
                                                            {{request()['status'] == 'approved' ? 'selected' : '' }} value="approved">
                                                            Approved
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12  col-md-2 d-flex gap-2">
                                        <button class="btn btn-light mt-3" tabindex="0"
                                                aria-controls="example1" type="submit"><span>Search</span></button>
                                        <a href="{{route('moderator.balance.index')}}" class="btn btn-secondary mt-3"
                                           tabindex="0"
                                           aria-controls="example1" type="submit"><span>Refresh</span></a>
                                    </div>
                                </form>
                                <br>
                                <h3 class="card-title">Applications</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>Full name</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Method</th>
                                            <th>Information</th>
                                            <th>Date</th>
                                            <th style="width: 100px">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($applications as $item)
                                            <tr>
                                                <td>{{$item->user()->name}} {{$item->user()->last_name}}</td>
                                                <td>{{$item->type}}</td>
                                                <td>{{$item->amount}}</td>
                                                <td>{{$item->method}}</td>
                                                <td>{{$item->information}}</td>
                                                <td>{{$item->created_at}}</td>
                                                <td>
                                                    @if($item->status == 'moderation')
                                                        <div style="display: flex; gap: 10px">
                                                            <form style="display: block;"
                                                                  action="{{ route('moderator.balance.update', $item->id) }}"
                                                                  method="post">
                                                                @csrf
                                                                @method('patch')
                                                                <button name="status" value="approved" type="submit"
                                                                        class="btn btn-success btn-sm">Approve
                                                                </button>
                                                            </form>

                                                            <form style="display: block;"
                                                                  action="{{ route('moderator.balance.update', $item->id) }}"
                                                                  method="post">
                                                                @csrf
                                                                @method('patch')
                                                                <button name="status" value="cancelled" type="submit"
                                                                        class="btn btn-danger btn-sm">Reject
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @elseif($item->status == 'approved')
                                                        <span class="badge bg-success">{{$item->status}}</span>
                                                    @elseif($item->status == 'canceled')
                                                        <span class="badge bg-danger">{{$item->status}}</span>
                                                    @endif

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
