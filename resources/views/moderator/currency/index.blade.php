@extends('moderator.layouts.main')
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
                                <a href="{{ route('moderator.currency.create') }}"
                                   class="btn btn-block btn-outline-light">{{__('admin.Add')}}</a>
                                <br>
                                <h3 class="card-title">{{__('admin.Currencies')}}</h3>
                                <br>
                                <p>All currencies should be indicated with a multiplier for the AED</p>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>{{__('admin.Title')}}</th>
                                            <th>{{__('admin.Value')}}</th>
                                            <th style="width: 40px">{{__('admin.Edit')}}</th>
                                            <th style="width: 40px">{{__('admin.Delete')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($currencies as $currency)
                                            <tr>
                                                <td>{{$currency->title}}</td>
                                                <td>{{$currency->value}}</td>
                                                <td>
                                                    <a class="btn btn-light btn-sm"
                                                       href="{{route('moderator.currency.edit', $currency->id)}}">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                        {{__('admin.Edit')}}
                                                    </a>
                                                </td>

                                                <td>
                                                    <form
                                                        action="{{ route('moderator.currency.destroy', $currency->id) }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-light btn-sm"><i
                                                                class="fas fa-trash">
                                                            </i> {{__('admin.Delete')}}
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
                                    {{ $currencies->links() }}
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
