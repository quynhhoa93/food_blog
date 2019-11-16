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
                                <form method="POST" action="{{route('slider.update',$slider->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Title</label>
                                                <input type="text" class="form-control" name="title" value="{{$slider->title}}">
                                            </div>
                                            @if ($errors->has('title'))
                                                <p class="help is-danger" style="color: #b91d19">{{ $errors->first('title') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Sub-title</label>
                                                <input type="text" class="form-control" name="sub_title" value="{{$slider->sub_title}}">
                                            </div>
                                            @if ($errors->has('sub_title'))
                                                <p class="help is-danger" style="color: #b91d19">{{ $errors->first('sub_title') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="bmd-label-floating">image</label>
                                            <br>
                                            <input type="file" name="image">
                                            @if ($errors->has('image'))
                                                <p class="help is-danger" style="color: #b91d19">{{ $errors->first('image') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <br>
                                    <a href="{{route('slider.index')}}" class="btn btn-danger">back</a>
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