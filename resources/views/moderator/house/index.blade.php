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
                                <h3 class="card-title">Houses</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form class="row" action="{{route('moderator.house.search')}}">
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
                                        <a href="{{route('moderator.house.index')}}" class="btn btn-secondary mt-3"
                                           tabindex="0"
                                           aria-controls="example1" type="submit"><span>Refresh</span></a>
                                    </div>
                                </form>
                                <br>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Preview</th>
                                        <th>Email user</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>District</th>
                                        <th>Street</th>
                                        <th>Room number</th>
                                        <th style="width: 40px">Approve/Moderation</th>
                                        <th style="width: 40px">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($houses as $house)
                                        <tr>
                                            <td>
                                                <img src="{{asset($house->img)}}" height="200px">
                                            </td>
                                            <td>{{$house->user()->email}}</td>
                                            <td>{{$house->title}}</td>
                                            <td>{{$house->about}}</td>
                                            <td>{{$house->country()->title}}</td>
                                            <td>{{$house->city()->title}}</td>
                                            <td>{{$house->district()->title}}</td>
                                            <td>{{$house->street}}</td>
                                            <td>{{$house->countRooms()}}</td>
                                            <td>
                                                <form action="{{ route('moderator.house.update', $house->id) }}"
                                                      method="post">
                                                    @method('patch')
                                                    @csrf
                                                    <button type="submit"
                                                            class="btn btn-light btn-sm"> {{$house->status == 'approved' ? 'Return to moderation' : 'Approve'}}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('user.house.destroy', $house->id) }}"
                                                      method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-light btn-sm"><i
                                                            class="fas fa-trash">
                                                        </i> Delete
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
                                    {{ $houses->withQueryString()->links() }}
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
