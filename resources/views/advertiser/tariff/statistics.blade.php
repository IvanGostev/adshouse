@extends('layouts.main')
@section('content')

    <div class="content-wrapper" style="min-height: 1302.4px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-2">
                            <div id="chartAdvertiserLink">
                            </div>
                        </div>
                        <div class="col-md-6 col-md-offset-2">
                            @foreach($historyRooms as $key => $historyRoom)
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">History date {{$key}}</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-hover text-nowrap">
                                                <thead>
                                                <tr>
                                                    <th style="width: 30px">Address</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($historyRoom as $room)
                                                    <tr>
                                                        <td>
                                                            {{$room->room()->house()->country()->title . ' ' . $room->room()->house()->city()->title . ' ' .   $room->room()->house()->district()->title . ' ' . $room->room()->house()->street . ' ' . $room->room()->type()->title}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>


@endsection
