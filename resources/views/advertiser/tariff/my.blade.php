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
                                <form class="card-body" action="{{route('advertiser.tariff.bye', $tariff->id)}}" method="post">
                                    @csrf
                                    <div class="align-items-center text-center">
                                        <strong>Дней: {{$tariff->days}}</strong>
                                        <br>
                                        <strong>Квартир: {{$tariff->number_rooms}} </strong>
                                        <br>
                                        <strong>Цена: {{$tariff->price}} руб.</strong>
                                    </div>
                                    <br>
                                    <p class="text-muted">
                                        {{$tariff->about}}
                                    </p>

                                    <div class="form-group">
                                        <label>Рекламируемая ссылку</label>
                                        <input type="url" class="form-control my-colorpicker1 colorpicker-element" value="{{$tariff->url}}" data-colorpicker-id="1" disabled data-original-title="" title="">
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
