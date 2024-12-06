@extends('layouts.main')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.4px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                {{--                <h2 class="card-title">--}}
                {{--                    Current plans--}}
                {{--                </h2>--}}
            </div><!-- /.container-fluid -->
        </section>

        <section id="bs-pricing-five" class="bs-pricing-four roomy-50">
            <div class="container">
                <div class="row">
                    @foreach($tariffs as $tariff)
                        <div class="col-md-3">
                            <div class="card {{$tariff->deleted_at == null ? "card-light" : "card-red" }}">
                                <div class="card-header">
                                    <h3 class="card-title">{{$tariff->title}}</h3>
                                </div>
                                <div class="card-body">
                                    @if($tariff->method == 'rooms')
                                        <div class="align-items-center text-center">
                                            @if ($tariff->deleted_at)
                                                <strong class="text-red">The tariff has expired</strong>
                                            @endif
                                            <strong>Days: {{$tariff->days}}</strong>
                                            <br>
                                            <strong>Price: {{$tariff->price}} AED</strong>
                                        </div>
                                    @else

                                        <div class="align-items-center text-center">
                                            @if ($tariff->deleted_at)
                                                <strong class="text-red">The tariff has expired</strong>
                                            @endif
                                            <strong>Transitions: {{$tariff->fulfilled_transitions . '/' . $tariff->transitions}}</strong>
                                            <br>
                                            <strong>Price: {{$tariff->price}} AED</strong>
                                        </div>
                                    @endif
                                    <br>
                                    <p class="text-muted">
                                        {{$tariff->about}}
                                    </p>
                                    @if($tariff->type == 'shared')
                                        <div class="form-group">
                                            <label>Banner</label> <br>
                                            <a href="{{asset($tariff->img)}}"> <img src="{{asset($tariff->img)}}" alt=""
                                                                                    style="height: 100%; width: 100%"></a>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label>Advertised link</label>
                                        <input type="url" class="form-control my-colorpicker1 colorpicker-element"
                                               value="{{$tariff->url}}" data-colorpicker-id="1" disabled
                                               data-original-title="" title="">
                                    </div>
                                    @if (!$tariff->deleted_at)
                                        <div class="form-group">
                                            <a class="btn btn-light btn-block"
                                               href="{{route('advertiser.tariff.show', $tariff->id)}}">Statistic</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>


    </div>
@endsection
