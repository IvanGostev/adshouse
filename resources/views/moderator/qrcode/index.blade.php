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
                                <form action="{{ route('moderator.qrcode.store') }}" method="post">
                                    @csrf
                                    <button class="btn btn-block btn-light" type="submit">Add</button>
                                </form>
                                <br>
                                <h3 class="card-title">Qrcodes</h3>
                            </div>
                            <div class="card-body">
                                <form class="row" action="{{route('moderator.qrcode.index')}}">
                                    <div class="col-sm-12 col-md-2">
                                        <div>
                                            <div class="fw-bold fs-6">Status</div>
                                            <div class="fht-cell">
                                                <div class="filter-control">
                                                    <select
                                                        class="form-select bootstrap-table-filter-control-price "
                                                        style="width: 100%;" dir="ltr" name="status">
                                                        <option
                                                            {{request()['status'] == 'free' ? 'selected' : '' }}  value="free">
                                                            Free
                                                        </option>
                                                        <option
                                                            {{request()['status'] == 'attached' ? 'selected' : '' }} value="attached">
                                                            Attached
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2">
                                        <div>
                                            <div class="fw-bold fs-6">City</div>
                                            <div class="fht-cell">
                                                <div class="filter-control">
                                                    <select
                                                        class="form-select bootstrap-table-filter-control-price "
                                                        style="width: 100%;" dir="ltr" name="city_id">
                                                        <option value="all">All</option>
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
                                            <div class="fw-bold fs-6">District</div>
                                            <div class="fht-cell">
                                                <div class="filter-control">
                                                    <select
                                                        class="form-select bootstrap-table-filter-control-price "
                                                        style="width: 100%;" dir="ltr" name="district_id">
                                                        <option value="all">All</option>
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
                                            <div class="fw-bold fs-6">Street</div>
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
                                            <div class="fw-bold fs-6">Type room</div>
                                            <div class="fht-cell">
                                                <div class="filter-control">
                                                    <select
                                                        class="form-select bootstrap-table-filter-control-price "
                                                        style="width: 100%;" dir="ltr" name="room_type_id">
                                                        <option value="all">All</option>
                                                        @foreach($types as $type)
                                                            <option
                                                                {{request()['room_type_id'] == $type->id ? 'selected' : '' }} value="{{$type->id}}">{{$type->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2">
                                        <div>
                                            <div class="fw-bold fs-6">Email owner</div>
                                            <div class="fht-cell">
                                                <div class="filter-control">
                                                    <input type="text" value="{{request()['email'] ?? ''}}" name="email"
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2">
                                        <div>
                                            <div class="fw-bold fs-6">Display</div>
                                            <div class="fht-cell">
                                                <div class="filter-control">
                                                    <input type="number" value="{{request()['paginateNumber'] ?? 12}}"
                                                           name="paginateNumber" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="col-sm-12  d-flex gap-2">
                                            <button class="btn btn-light mt-4" tabindex="0"
                                                    aria-controls="example1" type="submit"><span>Search</span></button>
                                            <a href="{{route('moderator.qrcode.index')}}" class="btn btn-secondary mt-4"
                                               tabindex="0"
                                               aria-controls="example1" type="submit"><span>Refresh</span></a>
                                        </div>
                                    </div>


                                </form>
                                <br>
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 35px!important;">Qrcode</th>
                                            <th>Url</th>
                                            <th style="width: 30px">Room ID</th>
                                            <th style="width: 30px">Type room</th>
                                            <th style="width: 30px">Email</th>
                                            <th style="width: 40px">Download</th>
                                            <th style="width: 150px">Statistic</th>
                                            <th style="width: 40px">Edit</th>
                                            <th style="width: 40px">Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($qrcodes as $qrcode)
                                            <tr>
                                                <td id="qrcode" style="width: 35px!important;">
                                                    {!! $qrcode['qrcode'] !!}
                                                </td>
                                                <td>{{route('qrcode', $qrcode->id)}}</td>
                                                <td>
                                                    {{$qrcode->room_id}}
                                                </td>
                                                <td>
                                                    {{$qrcode->room() ? $qrcode->room()->type()->title : '-'}}
                                                </td>
                                                <td>
                                                    {{$qrcode->room() ? $qrcode->room()->house()->user()->email : 'No'}}
                                                </td>
                                                <td id="download">
                                                    <a class="btn btn-outline-success"
                                                       href="{{trim(explode('public', $qrcode['link'])[1])}}" download>Download</a>
                                                </td>
                                                <td>
                                                    <a href="{{route('moderator.qrcode.statistic', $qrcode->id)}}"
                                                       class="btn btn-primary">Statistic</a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-light"
                                                       href="{{route('moderator.qrcode.edit', $qrcode->id)}}">Edit</a>
                                                </td>

                                                <td>
                                                    <form action="{{ route('moderator.qrcode.destroy', $qrcode->id) }}"
                                                          method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-light">
                                                            Delete
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
                                    {{ $qrcodes->links() }}
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
