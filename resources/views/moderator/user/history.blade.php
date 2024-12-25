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




                    <div class="col-md-12">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"{{__('admin.Operation history')}}></h3>
                                </div>

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>{{__('admin.Type')}}</th>
                                            <th>{{__('admin.Amount')}}</th>
                                            <th>{{__('admin.Status')}}</th>
                                            <th>{{__('admin.Date')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($transactions as $transaction)
                                            <tr>
                                                <td>{{$transaction->id}}</td>
                                                <td>{{$transaction->type}}</td>
                                                <td>{{$transaction->amount . ' AED'}}</td>
                                                <td>{{$transaction->status}}</td>
                                                <td>{{$transaction->created_at}}</td>
                                            </tr>
                                        @endforeach

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
