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
                                <h3 class="card-title">Operation with funds</h3>
                            </div>


                            <form action="{{route('balance.handler')}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">


                                            <label for="exampleInputEmail1">Amount</label>
                                            <div class="input-group">
                                                <input type="number" step="0.1" class="form-control"
                                                       id="exampleInputEmail1"
                                                       value="{{auth()->user()->balance}}" min="1" required
                                                       name="amount">
                                                <div class="input-group-append">
                                                <span class="input-group-text">AED</span>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Type operation</label>
                                            <select class="form-select" required name="type">
                                                <option value="replenish">Replenish</option>
                                                <option value="withdraw">Withdraw</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Account/Card Information</label>
                                            <textarea name="information" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-light">Continue</button>
                        </div>
                        </form>
                    </div>


                </div>


                <div class="col-md-6">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Operation history</h3>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
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
