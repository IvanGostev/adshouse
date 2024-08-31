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
                                <h3 class="card-title">Добавление тарифа</h3>
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
                                                <label>Название</label>
                                                <input type="text" value="{{$tariff->title}}" name="title" class="form-control"
                                                       placeholder="Текст ..." required>
                                            </div>

                                        </div>

                                        <div class="col-sm-6">

                                            <div class="form-group">
                                                <label>Количество дней</label>
                                                <input type="text" value="{{$tariff->days}}" name="days" class="form-control"
                                                       placeholder="Текст ..." min="1" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Цена</label>
                                                <input type="text" value="{{$tariff->price}}" name="price" class="form-control"
                                                       placeholder="Текст ..." >
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Число комнат</label>
                                                <input type="text" value="{{$tariff->number_rooms}}" name="number_rooms" class="form-control"
                                                       placeholder="Текст ..."  min="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>The amount of the client's earnings per redirect</label>
                                                <input type="number" name="user_income_from_redirect" class="form-control"
                                                       placeholder="Enter ..." value="0.01" step="0.001">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Описание</label>
                                                <textarea required="" class="form-control" rows="5"
                                                          placeholder="Текст ..."  name="about">{{$tariff->about}}</textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-light">Отправить</button>
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
