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
                                <h3 class="card-title">Editing room in apartment/house </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('owner.room.update', $room->id)}}" enctype="multipart/form-data"
                                  method="post">
                                @csrf
                                @method('patch')
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Type room</label>
                                                <select name="room_type_id" class="form-control">
                                                    @foreach($types as $type)
                                                        <option
                                                            {{$type->id == $room->room_type_id ? 'selected' : ''}} value="{{$type->id}}">{{$type->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" rows="5"
                                                          name="about" placeholder="Enter ...">{{$room->about}}</textarea>
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
