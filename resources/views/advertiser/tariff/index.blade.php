@extends('layouts.main')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.4px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                {{--              <h3 class="card-title">--}}
                {{--                  Plans--}}
                {{--              </h3>--}}
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
                                <form class="card-body" action="{{route('advertiser.tariff.bye', $tariff->id)}}"
                                      method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="align-items-center text-center">
                                        <strong>Days: {{$tariff->days}}</strong>
                                        <br>
                                        <strong>Price: {{$tariff->price}} AED</strong>
                                    </div>
                                    <br>
                                    <p class="text-muted">
                                        {{$tariff->about}}
                                    </p>

                                    @if($tariff->type == 'shared')
                                        <div class="form-group">
                                            <label>
                                                Preview
                                                Recommended size: 1080 x 1080 pixels
                                                Aspect Ratio: 1:1
                                            </label>
                                            <input type="file" class="form-control my-colorpicker1 colorpicker-element"
                                                   name="img" data-colorpicker-id="1" data-original-title="" title="">
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label>Advertised link</label>
                                        <input type="url" name="url"
                                               class="form-control my-colorpicker1 colorpicker-element"
                                               data-colorpicker-id="1" data-original-title="" title="">
                                    </div>
                                    <div class="form-group country">
                                        <label>Country</label>
                                        <select name="country_id"
                                                class="country_id form-control my-colorpicker1 colorpicker-element">
                                            <option value="all">All</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group city" style="display: none">
                                        <label>City</label>
                                        <select name="city_id" class="city_id form-control my-colorpicker1 colorpicker-element">
                                            <option value="all">All</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}">{{$city->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group district" style="display: none">
                                        <label>Area</label>
                                        <select name="district_id"
                                                class="district_id form-control my-colorpicker1 colorpicker-element">
                                            <option value="all">All</option>
                                            @foreach($districts as $district)
                                                <option value="{{$district->id}}">{{$district->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn btn-light btn-block" type="submit">Pay</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
    <script>
        document.addEventListener('change', (e) => {
            $target = e.target
            if ($target.classList.contains('country_id')) {
                let $city = $target.parentNode.parentNode.querySelector('.city')
                if ($target.options[$target.selectedIndex].value !== "all") {
                    $city.style.display = "block"
                } else {
                    $city.style.display = "none"
                    let $district = $target.parentNode.parentNode.querySelector('.district')
                    $district.style.display = "none"
                }
            }
            if ($target.classList.contains('city_id')) {
                let $district = $target.parentNode.parentNode.querySelector('.district')
                if ($target.options[$target.selectedIndex].value !== "all") {
                    $district.style.display = "block"
                } else {
                    $district.style.display = "none"
                }
            }
        })
    </script>
@endsection
