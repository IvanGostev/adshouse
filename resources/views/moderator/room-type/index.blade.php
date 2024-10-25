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
                                <a href="{{ route('moderator.room-type.create') }}"
                                   class="btn btn-block btn-outline-light">Add</a>
                                <br>
                                <h3 class="card-title">Types rooms</h3>
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
                                        @foreach($types as $type)
                                            <tr>
                                                <td>{{$type->title}}</td>
                                                <td>
                                                    <a class="btn btn-light btn-sm"
                                                       href="{{route('moderator.room-type.edit', $type->id)}}">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                        Edit
                                                    </a>
                                                </td>

                                                <td>
                                                    <form action="{{ route('moderator.room-type.destroy', $type->id) }}"
                                                          method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="mit" class="btn btn-light btn-sm"><i
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
                                    {{ $types->links() }}
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
