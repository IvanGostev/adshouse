@extends('layouts.main')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.4px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid d-flex align-items-center">

                <div class="container">
                    <div class="row d-flex align-items-center justify-content-center ">


                        <div class="col-lg-8 col-6">

                            <div class="small-box bg-verydark">
                                <div class="inner">
                                    <h3>{{auth()->user()->balance . ' AED'}}</h3>
                                    <p>Balance</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8" style="display: flex; flex-direction: column; justify-content: center; ">
                            <div class="card card-verydark">
                                <div class="card-header">
                                    <h3 class="card-title">{{auth()->user()->role == 'advertiser' ? 'Replenishment of the balance' : 'Withdrawal of the balance'}}</h3>
                                </div>


                                <form action="{{route('balance.handler')}}" method="post">
                                    @csrf
                                    <input name="type" hidden value="{{auth()->user()->role == 'advertiser' ? 'replenish' : 'withdraw'}}">
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Amount</label>
                                            <div class="input-group">
                                                <input type="number" step="0.1" class="form-control"  {{auth()->user()->role != 'advertiser' ? 'value=' . auth()->user()->balance : ''}}
                                                       id="exampleInputEmail1"
                                                       name="amount" >
                                                <div class="input-group-append">
                                                    <span class="input-group-text">AED</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-1">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Method</label>
                                                <select class="form-select" required name="method">
                                                    <option value="account">Account</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Account/Card Information</label>
                                                <input name="information" class="form-control" required placeholder="0000 0000 0000 0000">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-light">Continue</button>
                                    </div>
                                </form>
                            </div>


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
                                            <th>Method</th>
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
                                                <td>{{$transaction->method}}</td>
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

    </div>
@endsection
