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
                                <h3 class="card-title">{{__('admin.Adding')}} {{__('admin.plan')}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('moderator.tariff.store') }}" method="post">
                                @csrf
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('admin.Country')}}</label>
                                                <select name="country_id" class="form-control">
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->id}}">{{$country->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>{{__('admin.Title')}}</label>
                                                <input type="text" name="title" class="form-control"
                                                       placeholder="Enter ..." required>
                                            </div>
                                            <div class="form-group">
                                                <label>{{__('admin.Type')}}</label>
                                                <select class="form-control" name="type">
                                                    <option value="standard">{{__('admin.Standard')}}</option>
                                                    <option value="shared">{{__('admin.Shared')}}</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>{{__('admin.Method')}}</label>
                                                <select class="form-control" name="method">
                                                    <option value="rooms">{{__('admin.Rooms')}}</option>
                                                    <option value="transitions">{{__('admin.Transitions')}}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 method-transitions" style="display: none">
                                            <div class="form-group">
                                                <label>{{__('admin.Number of transitions')}}</label>
                                                <input type="number" name="transitions" class="form-control"
                                                       placeholder="Enter ..." min="1" value="20">
                                            </div>
                                            <div class="form-group">
                                                <label>{{__('admin.Percentage of the room owner')}}</label>
                                                <input type="number" name="percent_owner" class="form-control"
                                                       placeholder="Enter ..." min="1" step="0.1" max="100" value="2">
                                            </div>
                                            <div class="form-group">
                                                <label>{{__('admin.Percentage of scanning cashback')}}</label>
                                                <input type="number" name="percent_user" class="form-control"
                                                       placeholder="Enter ..." min="1" step="0.1" max="100" value="2">
                                            </div>


                                        </div>
                                        <div class="col-sm-6 method-rooms">
                                            <div class="form-group">
                                                <label>{{__('admin.Days')}}</label>
                                                <input type="number" name="days" class="form-control"
                                                       placeholder="Enter ..." step="1" min="1" value="2">
                                            </div>

                                            <div class="form-group">
                                                <label>{{__('admin.Amount of the room owner')}}</label>
                                                <input type="number" name="amount_owner" class="form-control"
                                                       placeholder="Enter ..." min="1" step="0.1" max="100" value="2">
                                            </div>
                                            <div class="form-group">
                                                <label>{{__('admin.Amount of scanning cashback')}}</label>
                                                <input type="number" name="amount_user" class="form-control"
                                                       placeholder="Enter ..." min="1" step="0.1" max="100" value="2">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('admin.Price')}}</label>
                                                <input type="number" name="price" class="form-control"
                                                       value="100" step="0.1" placeholder="Enter ...">
                                                {{--                                                placeholder="if the transitions method is the price per transition"--}}
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('admin.Number rooms')}}</label>
                                                <input type="text" name="number_rooms" class="form-control"
                                                       placeholder="Enter ..." value="1" min="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>{{__('admin.Description')}}</label>
                                                <textarea required id="summernote" class="form-control" rows="10"
                                                          placeholder="Enter ..." name="about"></textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-light">{{__('admin.Submit')}}</button>
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
    <!-- include summernote css/js -->

@endsection
