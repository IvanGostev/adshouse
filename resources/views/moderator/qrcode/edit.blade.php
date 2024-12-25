@extends('moderator.layouts.main')
@section('content')
    <div class="content-wrapper" style="min-height: 1345.6px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        @if(!$roomActive)
                            <div class="card card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">{{__('admin.Free rooms')}}</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form class="row" action="{{route('moderator.qrcode.search', $qrcode->id)}}">
                                        <div class="col-sm-12 col-md-2">
                                            <div>
                                                <div class="fw-bold fs-6">{{__('admin.City')}}</div>
                                                <div class="fht-cell">
                                                    <div class="filter-control">
                                                        <select
                                                            class="form-select bootstrap-table-filter-control-price "
                                                            style="width: 100%;" dir="ltr" name="city_id">
                                                            <option value="all">{{__('admin.All')}}</option>
                                                            @foreach($cities as $city)
                                                                <option
                                                                    {{request()['city_id'] == $city->id ? 'selected' : '' }} value="{{$city->id}}">{{$city->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-2">
                                            <div>
                                                <div class="fw-bold fs-6">{{__('admin.District')}}</div>
                                                <div class="fht-cell">
                                                    <div class="filter-control">
                                                        <select
                                                            class="form-select bootstrap-table-filter-control-price "
                                                            style="width: 100%;" dir="ltr" name="district_id">
                                                            <option value="all">{{__('admin.All')}}</option>
                                                            @foreach($districts as $district)
                                                                <option
                                                                    {{request()['city_id'] == $district->id ? 'selected' : '' }} value="{{$district->id}}">{{$district->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-2">
                                            <div>
                                                <div class="fw-bold fs-6">{{__('admin.Street')}}</div>
                                                <div class="fht-cell">
                                                    <div class="filter-control">
                                                        <input type="text" value="{{request()['street'] ?? ''}}"
                                                               name="street" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-2">
                                            <div>
                                                <div class="fw-bold fs-6">{{__('admin.Email owner')}}</div>
                                                <div class="fht-cell">
                                                    <div class="filter-control">
                                                        <input type="text" value="{{request()['email'] ?? ''}}"
                                                               name="email" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-2">
                                            <div>
                                                <div class="fw-bold fs-6">{{__('admin.Display')}}</div>
                                                <div class="fht-cell">
                                                    <div class="filter-control">
                                                        <input type="number"
                                                               value="{{request()['paginateNumber'] ?? 12}}"
                                                               name="paginateNumber" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12  col-md-2 d-flex gap-2">
                                            <button class="btn btn-light mt-3" tabindex="0"
                                                    aria-controls="example1" type="submit"><span>{{__('admin.Search')}}</span></button>
                                            <a href="{{route('moderator.qrcode.edit', $qrcode->id)}}"
                                               class="btn btn-secondary mt-3" tabindex="0"
                                               aria-controls="example1" type="submit"><span>{{__('admin.Refresh')}}</span></a>
                                        </div>
                                    </form>
                                    <br>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>{{__('admin.A')}} ID</th>
                                            <th>ID</th>
                                            <th>{{__('admin.Country')}}</th>
                                            <th>{{__('admin.City')}}</th>
                                            <th>{{__('admin.District')}}</th>
                                            <th>{{__('admin.Street')}}</th>
                                            <th>{{__('admin.Type room')}} </th>
                                            <th>{{__('admin.Email')}}</th>
                                            <th style="width: 40px">{{__('admin.USE')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($rooms as $room)
                                            <tr>
                                                <td>{{$room->house_id}}</td>
                                                <td>{{$room->id}}</td>
                                                <td>{{$room->house()->country()->title}}</td>
                                                <td>{{$room->house()->city()->title}}</td>
                                                <td>{{$room->house()->district()->title}}</td>
                                                <td>{{$room->house()->street}}</td>
                                                <td>{{$room->type()->title}}</td>
                                                <td><a href="/moderator/users?email={{$room->house()->user()->email}}">{{$room->house()->user()->email}}</a></td>
                                                <td>
                                                    <form action="{{ route('moderator.qrcode.update', $qrcode->id) }}"
                                                          method="post">
                                                        @csrf
                                                        @method('patch')
                                                        <button type="submit" class="btn btn-light btn-sm"
                                                                name="room_id" value="{{$room->id}}">
                                                            </i> {{__('admin.USE')}}
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
                                        {{ $rooms->withQueryString()->links() }}
                                    </ul>
                                </div>
                            </div>
                        @else
                            <div class="card card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">{{__('admin.Editing')}} {{__('admin.qrcode')}}</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="{{ route('moderator.qrcode.free', $qrcode->id) }}" method="post">
                                    @csrf
                                    @method('patch')
                                    <div class="card-body">
                                        <div class="col-sm-12">
                                            <label>{{__('admin.Free rooms')}}</label>
                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                    <tr>
                                                        <th>{{__('admin.Type room')}} </th>
                                                        <th>{{__('admin.Country')}}</th>
                                                        <th>{{__('admin.City')}}</th>
                                                        <th>{{__('admin.District')}}</th>
                                                        <th>{{__('admin.Street')}}</th>
                                                        <th>{{__('admin.First name')}} </th>
                                                        <th>{{__('admin.Last name')}}</th>
                                                        <th>{{__('admin.Email')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>{{$roomActive->type()->title}}</td>
                                                        <td>{{$roomActive->house()->country()->title}}</td>
                                                        <td>{{$roomActive->house()->city()->title}}</td>
                                                        <td>{{$roomActive->house()->district()->title}}</td>
                                                        <td>{{$roomActive->house()->street}}</td>
                                                        <td>{{$roomActive->house()->user()->name}}</td>
                                                        <td>{{$roomActive->house()->user()->last_name}}</td>
                                                        <td><a href="/moderator/users?email={{$roomActive->house()->user()->email}}">{{$roomActive->house()->user()->email}}</a></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-light text-bold">{{__('admin.Unpin')}}</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->
                        @endif


                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->

                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
