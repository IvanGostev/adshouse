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
                                <h3 class="card-title">Editing plan</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('moderator.tariff.update', $tariff->id) }}" method="post">
                                @csrf
                                @method('patch')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" name="title" class="form-control"
                                                       placeholder="Enter ..." required value="{{$tariff->title}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Type:</label>
                                                <br>
                                                <label>{{$tariff->type}}</label>
                                            </div>
                                            <div class="form-group">
                                                <label>Method:</label>
                                                <br>
                                                <label>{{$tariff->method}}</label>
                                            </div>
                                        </div>
                                        @if ($tariff->method == 'transitions')
                                            <div class="col-sm-6 method-transitions">
                                                <div class="form-group">
                                                    <label>Number of transitions</label>
                                                    <input type="number" name="transitions" class="form-control"
                                                           placeholder="Enter ..." min="1"
                                                           value="{{$tariff->transitions}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Percentage of the room owner</label>
                                                    <input type="number" name="percent_owner" class="form-control"
                                                           placeholder="Enter ..." min="1" max="100" step="0.1"
                                                           value="{{$tariff->percent_owner}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Percentage of scanning cashback</label>
                                                    <input type="number" name="percent_user" class="form-control"
                                                           placeholder="Enter ..." min="1" max="100" step="0.1"
                                                           value="{{$tariff->percent_user}}">
                                                </div>


                                            </div>
                                        @else
                                            <div class="col-sm-6 method-rooms">
                                                <div class="form-group">
                                                    <label>Days</label>
                                                    <input type="number" name="days" class="form-control"
                                                           placeholder="Enter ..." min="1" value="{{$tariff->days}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Amount of the room owner</label>
                                                    <input type="number" name="amount_owner" class="form-control"
                                                           placeholder="Enter ..." min="1" max="100" step="0.1"
                                                           value="{{$tariff->amount_owner}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Amount of scanning cashback</label>
                                                    <input type="number" name="amount_user" class="form-control"
                                                           placeholder="Enter ..." min="1" max="100" step="0.1"
                                                           value="{{$tariff->amount_user}}">
                                                </div>
                                            </div>
                                        @endif


                                    </div>


                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Price </label>
                                                <input type="number" name="price" class="form-control" step="0.1"
                                                       placeholder="Enter ..." value="{{$tariff->price}}">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Number rooms</label>
                                                <input type="text" name="number_rooms" class="form-control"
                                                       placeholder="Enter ..." value="{{$tariff->number_rooms}}"
                                                       min="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea required="" class="form-control" rows="5" placeholder="Enter ..." name="about">{{$tariff->about}}</textarea>
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
    =
@endsection
