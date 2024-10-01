@extends('layouts.main')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.4px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            </div><!-- /.container-fluid -->
        </section>

        <section class="jumbotron text-center   mr-5  ml-5" style="background-image: url('/images/tariff.jpg');">
            <div class="container" >
                <h1>Advertising in apartments</h1>
                <p>Choose the tariff below</p>
            </div>
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
                                <form class="card-body" action="{{route('advertiser.tariff.bye', $tariff->id)}}" method="post" enctype="multipart/form-data">
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
                                            <label>Preview</label>
                                            <input type="file" class="form-control my-colorpicker1 colorpicker-element" name="img" data-colorpicker-id="1" data-original-title="" title="">
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label>Advertised link</label>
                                        <input type="url" name="url" class="form-control my-colorpicker1 colorpicker-element" data-colorpicker-id="1" data-original-title="" title="">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn btn-light btn-block" type="submit">Bye</button>
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
