@extends('layouts.main')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.4px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">



                        <div class="card card-light">
                            <div class="card-header">
                                <h3 class="card-title">Операции со средствами</h3>
                            </div>


                            <form action="{{route('balace.')}}">
                                <div class="card-body">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Сумма в рублях</label>
                                            <input type="number" step="0.1" class="form-control" id="exampleInputEmail1"
                                                   value="{{auth()->user()->balance}}" min="1" max="{{auth()->user()->balance}}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Тип операции</label>
                                            <select class="form-select">
                                                <option value=replenish"">Пополнить</option>
                                                <option value="w">Снять</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-light">Далее</button>
                                </div>
                            </form>
                        </div>


                    </div>


                    <div class="col-md-6">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">История операция</h3>
                                </div>

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Тип операции</th>
                                            <th>Статус</th>
                                            <th>Дата</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>183</td>
                                            <td>John Doe</td>
                                            <td>11-7-2014</td>
                                            <td>11-7-2014</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>


                    </div>

                </div>

            </div>
        </section>
    </div>
@endsection
