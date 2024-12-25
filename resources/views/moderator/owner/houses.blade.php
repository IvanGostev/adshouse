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
                                <h3 class="card-title">{{__('admin.Apartments')}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>{{__('admin.Date of creation')}} </th>
                                        <th>{{__('admin.Email user')}}</th>
                                        <th>{{__('admin.Description')}}</th>
                                        <th>{{__('admin.Country')}}</th>
                                        <th>{{__('admin.City')}}</th>
                                        <th>{{__('admin.District')}}</th>
                                        <th>{{__('admin.Street')}}</th>
                                        <th>{{__('admin.Building/Community name')}}</th>
                                        <th>{{__('admin.Number/Name apartment')}}</th>
                                        <th>{{__('admin.Room number')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($houses as $house)
                                        <tr>
                                            <td>{{$house->id}}</td>
                                            <td>{{$house->created_at}}</td>
                                            <td>{{$house->user()->email}}</td>
                                            <td>{{$house->about}}</td>
                                            <td>{{$house->country()->title}}</td>
                                            <td>{{$house->city()->title}}</td>
                                            <td>{{$house->district()->title}}</td>
                                            <td>{{$house->street}}</td>
                                            <td>{{$house->number}}</td>
                                            <td>{{$house->apartment_number}}</td>
                                            <td>{{$house->countRooms()}}</td>
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
