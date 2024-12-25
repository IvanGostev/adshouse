@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1302.4px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="container">
                    <h1>
                        {{__('main.Visit statistics')}}
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
                                <p>{{__('main.Unique visitors today')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">

                        <div class="small-box bg-verydark">
                            <div class="inner">
                                <h3>{{$numberTransitionsWeek}}</h3>
                                <p>{{__('main.Unique visitors per week')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">

                        <div class="small-box bg-verydark">
                            <div class="inner">
                                <h3>{{$numberTransitionsMonth}}</h3>
                                <p>{{__('main.Unique visitors per month')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-7 connectedSortable">
                        <div class="card">
                            <div id="chartAdvertiser">
                            </div>
                        </div>

                        <div class="card">
                            <div id="chartLastAdvertiser">
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
                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{__('main.Browser Usage')}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="chart-responsive">
                                            <canvas id="pieChart" height="150"></canvas>
                                        </div>
                                        <!-- ./chart-responsive -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-4">
                                        <ul class="chart-legend clearfix">
                                            @php
                                            $colors = [
                                                'danger', 'success', 'warning', 'info', 'primary', 'secondary'];
                                            @endphp
                                            @for($i = 0; $i < count($browsers); $i++)
                                                <li><i class="far fa-circle text-{{$colors[$i]}}"></i> {{$browsers[$i]->title}}</li>
                                            @endfor
                                        </ul>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-body -->

                            <!-- /.footer -->
                        </div>
                    </section>
                    <!-- right col -->
                </div>
            </div>


    </section>
    </div>
    @include('includes.scripts')
    <script >

        $('#calendar').datetimepicker({
            format: 'L',
            inline: true
        })

        // - PIE CHART -

        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData = {
            labels: [
                @foreach($browsers as $browser)
                    '{{$browser->title}}',
                @endforeach
            ],
            datasets: [
                {data: [
                        @foreach($browsers as $browser)
                            {{$browser->count}},
                        @endforeach],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
                }
            ]
        }
        var pieOptions = {
            legend: {
                display: false
            }
        }
        var pieChart = new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: pieData,
            options: pieOptions
        })


        // - END PIE CHART -




    </script>

    <script>
            $(document).ready(function () {
                $("#chartAdvertiser").shieldChart({
                    theme: "dark",
                    primaryHeader: {
                        text: "{{__('main.Visits this month')}}"
                    },
                    exportOptions: {
                        image: false,
                        print: false
                    },
                    axisX: {
                        categoricalValues: [
                            @foreach($transitionsForChartAdvertiser as $transition)
                                "{{$transition->date}}",
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
                            @foreach($transitionsForChartAdvertiser as $transition)
                                {{$transition->views}},
                            @endforeach
                        ]
                    }],
                    backgroundColor: "#212529",
                });
            });
            $(document).ready(function () {
                $("#chartLastAdvertiser").shieldChart({
                    theme: "dark",
                    primaryHeader: {
                        text: "{{__('main.Visits this month')}}"
                    },
                    exportOptions: {
                        image: false,
                        print: false
                    },
                    axisX: {
                        categoricalValues: [
                            @foreach($transitionsForChartLastAdvertiser as $transition)
                                "{{$transition->date}}",
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
                            @foreach($transitionsForChartLastAdvertiser as $transition)
                                {{$transition->views}},
                            @endforeach
                        ]
                    }],
                    backgroundColor: "#212529",
                });
            });
        </script><!-- /.График -->

@endsection
