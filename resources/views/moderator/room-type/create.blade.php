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
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">{{__('admin.Adding')}} {{__('admin.type')}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('moderator.room-type.store') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('admin.Language')}}</label>
                                            <select name="language" class="form-control">
                                                <option value="en">English</option>
                                                <option value="ru">Русский</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>{{__('admin.Title')}}</label>
                                            <input type="text" name="title" class="form-control">
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-light">{{__('admin.Submit')}}</button>
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
