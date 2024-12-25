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
                                @if(auth()->user()->role == 'admin')
                                    <a href="{{ route('moderator.user.create') }}"
                                       class="btn btn-block btn-outline-light">{{__('admin.Add')}} {{__('admin.moderator')}}</a>
                                @endif
                                <br>
                                <form class="row" action="{{route('moderator.user.index')}}"
                                      style="display: flex ;align-items: flex-end">
                                    <div class="col-sm-12 col-md-2">
                                        <div>
                                            <div class="fw-bold fs-6">{{__('admin.First name')}}</div>
                                            <div class="fht-cell">
                                                <div class="filter-control">
                                                    <input type="text" value="{{request()['name'] ?? ''}}" name="name"
                                                           class="form-control" placeholder="{{__('Enter')}} ...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2">
                                        <div>
                                            <div class="fw-bold fs-6">{{__('admin.Last name')}}</div>
                                            <div class="fht-cell">
                                                <div class="filter-control">
                                                    <input type="text" value="{{request()['last_name'] ?? ''}}"
                                                           name="last_name" class="form-control" placeholder="{{__('Enter')}} ...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2">
                                        <div>
                                            <div class="fw-bold fs-6">{{__('admin.Email')}}</div>
                                            <div class="fht-cell">
                                                <div class="filter-control">
                                                    <input type="text" value="{{request()['email'] ?? ''}}" name="email"
                                                           class="form-control" placeholder="{{__('Enter')}} ...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2">
                                        <div>
                                            <div class="fw-bold fs-6">{{__('admin.Phone')}}</div>
                                            <div class="fht-cell">
                                                <div class="filter-control">
                                                    <input type="text" value="{{request()['phone'] ?? ''}}" name="phone"
                                                           class="form-control" placeholder="{{__('Enter')}} ...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2">
                                        <div>
                                            <div class="fw-bold fs-6">{{__('admin.Role')}}</div>
                                            <div class="fht-cell">
                                                <div class="filter-control">
                                                    <select
                                                        class="form-select bootstrap-table-filter-control-price "
                                                        style="width: 100%;" dir="ltr" name="role">
                                                        <option
                                                            {{request()['role'] == 'all' ? 'selected' : '' }} value="all">
                                                            {{__('admin.All')}}
                                                        </option>
                                                        <option
                                                            {{request()['role'] == 'advertiser' ? 'selected' : '' }} value="advertiser">
                                                             {{__('admin.Advertiser')}}
                                                        </option>
                                                        <option
                                                            {{request()['role'] == 'user' ? 'selected' : '' }} value="user">
                                                            {{__('admin.User')}}
                                                        </option>
                                                        <option
                                                            {{request()['role'] == 'moderator' ? 'selected' : '' }} value="moderator">
                                                            {{__('admin.Moderator')}}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-12  col-md-2 d-flex gap-2">
                                        <button class="btn btn-light mt-3" tabindex="0"
                                                aria-controls="example1" type="submit"><span>{{__('admin.Search')}}</span></button>
                                        <a href="{{route('moderator.user.index')}}" class="btn btn-secondary mt-3"
                                           tabindex="0"
                                           aria-controls="example1" type="submit"><span>{{__('admin.Refresh')}}</span></a>
                                    </div>
                                </form>
                                <br>
                                <h3 class="card-title">{{__('admin.Users')}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>{{__('admin.Full name')}}</th>
                                            <th style="width: 40px">{{__('admin.Email')}}</th>
                                            <th style="width: 40px">{{__('admin.Phone')}}</th>
                                            <th style="width: 40px">{{__('admin.Role')}}</th>
                                            <th style="width: 40px">{{__('admin.Balance')}}</th>
                                            <th style="width: 40px">{{__('admin.History')}}</th>
                                            <th style="width: 40px">{{__('admin.Plans')}}</th>
                                            <th style="width: 40px">{{__('admin.Apartments')}}</th>
                                            <th style="width: 40px">{{__('admin.Delete')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{$user->name}} {{$user->last_name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->phone}}</td>
                                                <td>{{__('admin.' . $user->role)}}</td>
                                                <td>{{$user->balance}}</td>
                                                <td>
                                                    <a class="btn btn-light btn-sm"
                                                       href="{{route('moderator.user.history', $user->id)}}">
                                                        {{__('admin.History')}}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if ($user->role == 'advertiser')
                                                        <a class="btn btn-light btn-sm"
                                                           href="{{route('moderator.user.tariffs', $user->id)}}">
                                                            {{__('admin.Plans')}}
                                                        </a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($user->role == 'owner')
                                                        <a class="btn btn-light btn-sm"
                                                           href="{{route('moderator.user.houses', $user->id)}}">
                                                                      {{__('admin.Apartments')}}
                                                        </a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('moderator.user.destroy', $user->id) }}"
                                                          method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-light btn-sm">{{__('admin.Delete')}}
                                                        </button>
                                                    </form>
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
                                    {{ $users->withQueryString()->links() }}
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
