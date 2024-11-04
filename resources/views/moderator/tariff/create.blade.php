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
                                <h3 class="card-title">Adding plan</h3>
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
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select class="form-control" name="type">
                                                    <option value="standard">Standard</option>
                                                    <option value="shared">Shared</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Method</label>
                                                <select class="form-control" name="method">
                                                    <option value="rooms">Rooms</option>
                                                    <option value="transitions">Transitions</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 method-transitions" style="display: none">
                                            <div class="form-group">
                                                <label>Number of transitions</label>
                                                <input type="number" name="transitions" class="form-control"
                                                       placeholder="Enter ..." min="1" value="20" >
                                            </div>
                                            <div class="form-group">
                                                <label>Percentage of the room owner</label>
                                                <input type="number" name="percent_owner" class="form-control"
                                                       placeholder="Enter ..." min="1" max="100" value="2">
                                            </div>
                                            <div class="form-group">
                                                <label>Percentage of scanning cashback</label>
                                                <input type="number" name="percent_user" class="form-control"
                                                       placeholder="Enter ..." min="1" max="100" value="2">
                                            </div>


                                        </div>
                                        <div class="col-sm-6 method-rooms">
                                            <div class="form-group">
                                                <label>Days</label>
                                                <input type="number" name="days" class="form-control"
                                                       placeholder="Enter ..." min="1" value="2">
                                            </div>

                                            <div class="form-group">
                                                <label>Amount of the room owner</label>
                                                <input type="number" name="amount_owner" class="form-control"
                                                       placeholder="Enter ..." min="1" max="100" value="2">
                                            </div>
                                            <div class="form-group">
                                                <label>Amount of scanning cashback</label>
                                                <input type="number" name="amount_user" class="form-control"
                                                       placeholder="Enter ..." min="1" max="100" value="2">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Price  </label>
                                                <input type="number" name="price" class="form-control"
                                                      value="100"  placeholder="Enter ...">
{{--                                                placeholder="if the transitions method is the price per transition"--}}
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
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea required="" class="form-control" rows="5"
                                                          placeholder="Enter ..." name="about"></textarea>
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
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js')}}"></script>
    <script>
        $('[name="method"]').change(function () {
            if ($('[name="method"]').val() === 'transitions') {
                $('.method-transitions').css("display", "block");
                $('.method-rooms').css("display", "none");
            } else {
                $('.method-transitions').css("display", "none");
                $('.method-rooms').css("display", "block");
            }
        })
    </script>
@endsection
