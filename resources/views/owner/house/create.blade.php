@extends('layouts.main')
@section('content')

    <div class="content-wrapper">
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
                        <!-- general form elements -->
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">Adding apartment</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('owner.house.store')}}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select name="country_id" class="form-control">
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->id}}">{{$country->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>City</label>
                                                <select name="city_id" class="form-control">
                                                    @foreach($cities as $city)
                                                        <option value="{{$city->id}}">{{$city->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Area</label>
                                                <select name="district_id" class="form-control">
                                                    @foreach($districts as $district)
                                                        <option value="{{$district->id}}">{{$district->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Street</label>
                                                <input type="text" name="street" class="form-control"
                                                       placeholder="Enter ...">
                                            </div>
                                            <div class="form-group">
                                                <label>Building/Community name</label>
                                                <input type="text" name="number" class="form-control"
                                                       placeholder="Enter ..." required>
                                            </div>
                                            <div class="form-group">
                                                <label>Number/Name apartment (not necessary if you have a private house)</label>
                                                <input type="text" name="apartment_number" class="form-control"
                                                       placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea  class="form-control" rows="19"
                                                           name="about" placeholder="Enter..." ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">

                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-light">Submit for moderation</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- /.card -->


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