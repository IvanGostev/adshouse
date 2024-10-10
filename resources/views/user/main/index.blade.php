@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1302.4px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="container">
                    <h1>
                        Scans statistics
                    </h1>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-gradient-primary">
                            <div class="inner">
                                <h3>{{$incomeToday . ' AED'}}</h3>
                                <p>Income today</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-verydark">
                            <div class="inner">
                                <h3>{{$incomeAll . ' AED'}}</h3>
                                <p>Income all</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">

                        <div class="small-box bg-verydark">
                            <div class="inner">
                                <h3>{{$numberTransitionsToday}}</h3>
                                <p>Scans today</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">

                        <div class="small-box bg-verydark">
                            <div class="inner">
                                <h3>{{$numberTransitionsWeek}}</h3>
                                <p>Scans per week</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">

                        <div class="small-box bg-verydark">
                            <div class="inner">
                                <h3>{{$numberTransitionsMonth}}</h3>
                                <p>Scans per month</p>
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
                    </section>

                    <section class="col-lg-5 connectedSortable">
                        <div class="card bg-gradient-primary">
                            <div class="card-header border-0">

                                <h3 class="card-title">
                                    <i class="far fa-calendar-alt"></i>
                                    Calendar
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
    </script>

    <script>
            $(document).ready(function () {
                $("#chartAdvertiser").shieldChart({
                    theme: "dark",
                    primaryHeader: {
                        text: "Monthly scan statistics"
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
                        collectionAlias: "Number of scans",
                        data: [
                            @foreach($transitionsForChartAdvertiser as $transition)
                                {{$transition->views}},
                            @endforeach
                        ]
                    }],
                    backgroundColor: "#212529",
                });
            });

        </script><!-- /.График -->

@endsection
