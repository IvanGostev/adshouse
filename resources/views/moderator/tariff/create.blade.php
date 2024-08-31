@extends('layouts.main')
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
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">Adding tariff</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('moderator.tariff.store') }}" method="post">
                                @csrf
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" name="title" class="form-control"
                                                       placeholder="Enter ..." required>
                                            </div>

                                        </div>

                                        <div class="col-sm-6">

                                            <div class="form-group">
                                                <label>Number days</label>
                                                <input type="text" name="days" class="form-control"
                                                       placeholder="Enter ..." min="1" value="2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="number" name="price" class="form-control"
                                                       placeholder="Enter ..." value="100">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Number rooms</label>
                                                <input type="text" name="number_rooms" class="form-control"
                                                       placeholder="Enter ..." value="1" min="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>The amount per redirect</label>
                                                <input type="number" name="user_income_from_redirect" class="form-control"
                                                       placeholder="Enter ..." value="0.01" step="0.001">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Type</label>
                                              <select class="form-control">
                                                  <option value="standard">Standard</option>
                                                  <option value="shared">Shared</option>
                                              </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea required="" class="form-control" rows="5"
                                                          placeholder="Enter ..."  name="about"></textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-light">Submit</button>
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
