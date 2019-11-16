@extends('layouts.app')
@section('title','slider')
{{--@push('css')--}}
{{--<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">--}}
{{--@endpush--}}
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Simple Table</h4>
                            <p class="card-category"> Here is a subtitle for this table</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{route('category.store')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">name</label>
                                                <input type="text" class="form-control" name="name">
                                            </div>
                                            @if ($errors->has('name'))
                                                <p class="help is-danger" style="color: #b91d19">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Slug</label>
                                                <input type="text" class="form-control" name="slug">
                                            </div>
                                            @if ($errors->has('slug'))
                                                <p class="help is-danger" style="color: #b91d19">{{ $errors->first('slug') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <br>
                                    <a href="{{route('category.index')}}" class="btn btn-danger">back</a>
                                    <button type="submit" class="btn btn-primary">Save</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--@push('scripts')--}}
{{--<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>--}}
{{--<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>--}}
{{--<script>--}}
{{--$(document).ready( function () {--}}
{{--$('#table').DataTable();--}}
{{--} );--}}
{{--</script>--}}
{{--@endpush--}}