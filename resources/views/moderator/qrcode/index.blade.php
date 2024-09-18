@extends('layouts.main')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.4px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <form action="{{ route('moderator.qrcode.store') }}" method="post">
                                    @csrf
                                    <button class="btn btn-block btn-light" type="submit">Add</button>
                                </form>
                                <br>
                                <h3 class="card-title">Qrcodes</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 50px">Qrcode</th>
                                        <th>Url</th>
                                        <th style="width: 30px">Room ID</th>
                                        <th style="width: 30px">Email</th>
                                        <th style="width: 40px">Download</th>
                                        <th style="width: 40px">Edit</th>
                                        <th style="width: 40px">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($qrcodes as $qrcode)
                                        <tr>
                                            <td>
                                                {!! $qrcode['qrcode'] !!}
                                            </td>
                                            <td>{{route('qrcode', $qrcode->id)}}</td>
                                            <td>
                                                {{$qrcode->room_id}}
                                            </td>
                                            <td>
                                                {{$qrcode->room() ? $qrcode->room()->house()->user()->email : 'No'}}
                                            </td>
                                            <td>
                                                <a class="btn btn-outline-success"
                                                   href="{{route('moderator.qrcode.edit', $qrcode->id)}}">Download</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-light"
                                                   href="{{route('moderator.qrcode.edit', $qrcode->id)}}">Edit</a>
                                            </td>

                                            <td>
                                                <form action="{{ route('moderator.qrcode.destroy', $qrcode->id) }}"
                                                      method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-light btn-sm"><i
                                                            class="fas fa-trash">
                                                        </i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {{ $qrcodes->links() }}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
