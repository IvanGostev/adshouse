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
                                <a href="{{ route('moderator.city.create') }}" class="btn btn-block btn-outline-light">Add</a>
                                <br>
                                <h3 class="card-title">Cities</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th style="width: 40px">Edit</th>
                                            <th style="width: 40px">Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cities as $city)
                                            <tr>
                                                <td>{{$city->title}}</td>
                                                <td>
                                                    <a class="btn btn-light btn-sm"
                                                       href="{{route('moderator.city.edit', $city->id)}}">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                        Edit
                                                    </a>
                                                </td>

                                                <td>
                                                    <form action="{{ route('moderator.city.destroy', $city->id) }}"
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
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {{ $cities->links() }}
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
