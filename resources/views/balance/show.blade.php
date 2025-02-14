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
                                    <h3>{{auth()->user()->balance * activeCountry()->currency()->value . ' ' . activeCountry()->currency()->title}}</h3>
                                    <p>{{__('main.Balance')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8" style="display: flex; flex-direction: column; justify-content: center; ">
                            <div class="card card-verydark">
                                <div class="card-header">
                                    <h3 class="card-title">{{auth()->user()->role == 'advertiser' ? __('main.Replenishment of the balance') : __('main.Withdrawal of the balance')}}</h3>
                                </div>


                                <form action="{{route('balance.handler')}}" method="post">
                                    @csrf
                                    <input name="type" hidden
                                           value="{{auth()->user()->role == 'advertiser' ? 'replenish' : 'withdraw'}}">
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">{{__('main.Amount')}}</label>
                                            <div class="input-group">
                                                <input type="number" step="0.1" class="form-control"
                                                       min="1" required
                                                       {{auth()->user()->role != 'advertiser' ? 'value=' . auth()->user()->balance * activeCountry()->currency()->value : ''}}
                                                       id="exampleInputEmail1"
                                                       name="amount">
                                                <div class="input-group-append">
                                                    <span
                                                        class="input-group-text">{{activeCountry()->currency()->title}}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-1">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{{__('main.Method')}}</label>
                                                <select class="form-select" required name="method">
                                                    <option value="account">{{__('main.Account')}}</option>
                                                    @if(auth()->user()->role == 'advertiser')
                                                        <option value="online">{{__('main.Online payment by card')}}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 account">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{{__('main.Account/Card Information')}}</label>
                                                <input name="information" class="form-control" required placeholder="0000 0000 0000 0000">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-light">{{__('main.Continue')}}</button>
                                    </div>
                                </form>
                            </div>


                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{__('main.Operation history')}}</h3>
                                </div>

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>{{__('main.Type')}}</th>
                                            <th>{{__('main.Method')}}</th>
                                            <th>{{__('main.Amount')}}</th>
                                            <th>{{__('main.Status')}}</th>
                                            <th>{{__('main.Date')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($transactions as $transaction)
                                            <tr>
                                                <td>{{$transaction->id}}</td>
                                                <td>{{__('main.'. $transaction->type)}}</td>
                                                <td>{{__('main.'. $transaction->method)}}</td>
                                                <td>{{$transaction->amount * $transaction->currency()->value . $transaction->currency()->title}}</td>
                                                <td>{{__('main.'. $transaction->status)}}</td>
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
    <script>
        let $method = document.querySelector('[name="method"]');
        $method.addEventListener("change", function() {
            let $group = document.querySelector('.account');
            let $input = document.querySelector('[name="information"]');
            if ($method.value === 'online') {
                $group.hidden = true;
                $input.required = false;
            } else {
                $group.hidden = false;
                $input.required = true;
            }
        });

    </script>
@endsection
