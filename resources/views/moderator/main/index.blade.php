@extends('moderator.layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1302.4px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="container">
                    <h1>
                        Statistics of visitings
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
                                <h3>150</h3>
                                <p>Unique visitors today</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">

                        <div class="small-box bg-verydark">
                            <div class="inner">
                                <h3>150</h3>
                                <p>Unique visitors per week</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">

                        <div class="small-box bg-verydark">
                            <div class="inner">
                                <h3>150</h3>
                                <p>The number of unique visitors per month</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-7 connectedSortable">

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

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Browser Usage</h3>
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
                                            <li><i class="far fa-circle text-danger"></i> Chrome</li>
                                            <li><i class="far fa-circle text-success"></i> IE</li>
                                            <li><i class="far fa-circle text-warning"></i> FireFox</li>
                                            <li><i class="far fa-circle text-info"></i> Safari</li>
                                            <li><i class="far fa-circle text-primary"></i> Opera</li>
                                            <li><i class="far fa-circle text-secondary"></i> Navigator</li>
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
                'Chrome',
                'IE',
                'FireFox',
                'Safari',
                'Opera',
                'Navigator'
            ],
            datasets: [
                {
                    data: [700, 500, 400, 600, 300, 100],
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
@endsection
