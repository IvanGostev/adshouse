@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1302.4px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="container">
                    <h1>
                        {{__('main.Statistics of visitings')}}
                    </h1>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-6">

                        <div class="small-box bg-gradient-primary">
                            <div class="inner">
                                <h3>{{$numberTransitionsToday}}</h3>
                                <p>{{__('main.Scan today')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">

                        <div class="small-box bg-verydark">
                            <div class="inner">
                                <h3>{{$incomeWeek * activeCountry()->currency()->value . ' ' . activeCountry()->currency()->title}}</h3>
                                <p>{{__('main.Weekly income')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">

                        <div class="small-box bg-verydark">
                            <div class="inner">
                                <h3>{{$incomeAll * activeCountry()->currency()->value . ' ' . activeCountry()->currency()->title}}</h3>
                                <p>{{__('main.All income')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @for($i = 0; $i < count($apartments); $i++)
                    <div class="row">
                        <section>
                            <h3 class="title">{{__('main.Apartment')}} {{$i + 1}}</h3>
                        </section>
                        <section class="col-lg-7 connectedSortable">
                            <div class="card">
                                <div id="chart-{{$i}}">
                                </div>
                            </div>
                        </section>

                        <section class="col-lg-5 connectedSortable">
                            <div class="col-lg-12 col-6">

                                <div class="small-box bg-verydark">
                                    <div class="inner">
                                        <h3>{{$apartments[$i]['numberTransitionsToday']}}</h3>
                                        <p>{{__('main.Scans today')}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-6">

                                <div class="small-box bg-verydark">
                                    <div class="inner">
                                        <h3>{{$apartments[$i]['numberTransitionsWeek']}}</h3>
                                        <p>{{__('main.Scans per week')}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-6">

                                <div class="small-box bg-verydark">
                                    <div class="inner">
                                        <h3>{{$apartments[$i]['numberTransitionsMonth']}}</h3>
                                        <p>{{__('main.Scans per month')}}</p>
                                    </div>
                                </div>

                            </div>
                        </section>
                        <!-- right col -->
                    </div>
                @endfor

                <div class="row">
                    <section class="col-lg-7 connectedSortable">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{__('main.Resources of our advertisers')}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th style="width: 40px">ID</th>
                                        <th>{{__('main.URL')}}</th>
                                        <th>{{__('main.Statistic')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($links as $link)
                                        <tr>
                                            <td>{{$link->id}}</td>
                                            <td><a href="{{$link->url}}">{{$link->url}}</a></td>
                                            <td><a href="{{route('owner.link.statistic', $link->id)}}" class="btn btn-primary">{{__('main.Statistic')}}</a>  </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {{ $links->links() }}
                                </ul>
                            </div>
                        </div>

                    </section>
                    <section class="col-lg-5 connectedSortable">
                        <div class="card bg-gradient-primary">


                            <div class="card-header border-0">

                                <h3 class="card-title">
                                    <i class="far fa-calendar-alt"></i>
                                    {{__('main.Calendar')}}
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body pt-0">
                                <!--The calendar -->
                                <div id="calendar" style="width: 100%"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </section>
                </div>
            </div>


        </section>
    </div>
    @include('includes.scripts')
    <script>

        $('#calendar').datetimepicker({
            format: 'L',
            inline: true
        })


    </script>

    <script>
        @for($i = 0; $i < count($apartments); $i++)
        $(document).ready(function () {
            $("#chart-{{$i}}").shieldChart({
                theme: "dark",
                primaryHeader: {
                    text: "{{__('main.Scans')}}"
                },
                exportOptions: {
                    image: false,
                    print: false
                },
                axisX: {
                    categoricalValues: [
                        @foreach($apartments[$i]['transitionsForChart'] as $transition)
                            "{{$transition['date']}}",
                        @endforeach
                    ]
                },
                tooltipSettings: {
                    chartBound: true,
                    axisMarkers: {
                        enabled: true,
                        mode: 'xy'
                    }
                },
                dataSeries: [{
                    seriesType: 'line',
                    collectionAlias: "{{__('main.Number of clicks')}}",
                    data: [
                        @foreach($apartments[$i]['transitionsForChart'] as $transition)
                            {{$transition['views']}},
                        @endforeach
                    ]
                }],
                backgroundColor: "#212529",
            });
        });
        @endfor


    </script><!-- /.График -->

@endsection
