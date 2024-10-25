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
                                <h3 class="card-title">Rooms</h3>
                            </div>
                            <div class="card-body ">
                                <form class="row" action="{{route('moderator.room.search')}}">
                                    <div class="col-sm-12 col-md-2">
                                        <div>
                                            <div class="fw-bold fs-6">Status</div>
                                            <div class="fht-cell">
                                                <div class="filter-control">
                                                    <select
                                                        class="form-select bootstrap-table-filter-control-price "
                                                        style="width: 100%;" dir="ltr" name="status">
                                                        <option value="all">All</option>
                                                        <option
                                                            {{request()['status'] == 'approved' ? 'selected' : '' }}  value="approved">
                                                            Approved
                                                        </option>
                                                        <option
                                                            {{request()['status'] == 'moderation' ? 'selected' : '' }} value="moderation">
                                                            Moderation
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
                                    <div class="col-sm-12  col-md-2 d-flex gap-2">
                                        <button class="btn btn-light mt-3" tabindex="0"
                                                aria-controls="example1" type="submit"><span>Search</span></button>
                                        <a href="{{route('moderator.room.index')}}" class="btn btn-secondary mt-3"
                                           tabindex="0"
                                           aria-controls="example1" type="submit"><span>Refresh</span></a>
                                    </div>
                                </form>
                                <br>

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Qrcode</th>
                                            <th>Address</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>Download qrcode</th>
                                            <th style="width: 40px">Approve/Moderation</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($rooms as $room)
                                            <tr>
                                                <td>{{$room->id}}</td>
                                                <td>{{$room['qrcode'] ?? '-'}}</td>
                                                <td>{{$room->house()->country()->title}}
                                                    , {{$room->house()->city()->title}}
                                                    , {{$room->house()->district()->title}}, {{$room->house()->street}}
                                                    , {{$room->house()->number}}  {{$room->house()->apartment_number ?? ''}} </td>
                                                <td>{{$room->type()->title}}</td>
                                                <td>{{$room->about}}</td>
                                                <td id="download">
                                                    @if($room['qrcode_link'])

                                                        <a class="btn btn-outline-success"
                                                           href="{{trim(explode('public', $room['qrcode_link'])[1])}}"
                                                           download>Download</a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>

                                                <td>
                                                    <form action="{{ route('moderator.room.update', $room->id) }}"
                                                          method="post">
                                                        @method('patch')
                                                        @csrf
                                                        <button type="submit"
                                                                class="btn btn-light btn-sm"> {{$room->status == 'approved' ? 'Return to moderation' : 'Approve'}}
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
                                    {{ $rooms->withQueryString()->links() }}
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
