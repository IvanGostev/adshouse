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
                                <h3 class="card-title">Editing room</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('user.room.update', $room->id)}}" enctype="multipart/form-data"
                                  method="post">
                                @csrf
                                @method('patch')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            {!! $qrcode !!}
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>ADS URL</label>
                                                <input type="text" class="form-control"
                                                       disabled
                                                       value="{{route('ads', ['room' => $room->id, 'slug' => $slug])}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <input type="text" class="form-control"
                                                       disabled
                                                       value="{{$room->status}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Condition</label>
                                                <input type="text" class="form-control"
                                                       disabled
                                                       value="{{$room->condition}}">
                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" name="title" class="form-control"
                                                       placeholder="Текст ..." required value="{{$room->title}}">
                                            </div>
                                            <div class="form-group">
                                                <!-- <label for="customFile">Custom File</label> -->
                                                <div style="height: 180px">
                                                    <img id="blah1" alt="insert an image" width="auto" height="180px"
                                                         src="{{asset($room->img ?? '/images/room-placeholder.jpg')}}">
                                                </div>
                                                <br>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="customFile"
                                                           name="img"
                                                           onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])">
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        preview</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Type room</label>
                                                <select name="room_type_id" class="form-control">
                                                    @foreach($types as $type)
                                                        <option
                                                            {{$room->type_id == $type->id ? 'selected' : ''}} value="{{$type->id}}">{{$type->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea required="" class="form-control" rows="5"
                                                          name="about">{{$room->about}}</textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-light">Submit for moderation</button>
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
