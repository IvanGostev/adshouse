@extends('layouts.main')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.4px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            </div><!-- /.container-fluid -->
        </section>

        <section id="bs-pricing-five" class="bs-pricing-four roomy-50">
            <div class="container">
                <div class="row">
                    @foreach($tariffs as $tariff)
                        <div class="col-md-3">
                            <div class="card card-light">
                                <div class="card-header">
                                    <h3 class="card-title">{{$tariff->title}}</h3>
                                </div>
                                <form class="card-body" method="post">
                                    @csrf
                                    <div class="align-items-center text-center">
                                        <strong>Days: {{$tariff->days}}</strong>
                                        <br>
                                        <strong>Apartments: {{$tariff->number_rooms}} </strong>
                                        <br>
                                        <strong>Price: {{$tariff->price}} AED</strong>
                                    </div>
                                    <br>
                                    <p class="text-muted">
                                        {{$tariff->about}}
                                    </p>
                                    @if($tariff->type == 'shared')
                                        <div class="form-group">
                                            <label>Banner</label> <br>
                                            <a href="{{asset($tariff->img)}}"> <img src="{{asset($tariff->img)}}" alt="" style="height: 50px; width: 100%"></a>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label>Advertised link</label>
                                        <input type="url" class="form-control my-colorpicker1 colorpicker-element"
                                               value="{{$tariff->url}}" data-colorpicker-id="1" disabled
                                               data-original-title="" title="">
                                    </div>
                                    <div class="form-group">
                                        <a class="btn btn-light btn-block"
                                           href="{{route('advertiser.tariff.show', $tariff->id)}}">Statistic</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>











    </div>
@endsection
