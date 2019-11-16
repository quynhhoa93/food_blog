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
                                <form method="POST" action="{{route('item.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Name</label>
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
                                                <label class="bmd-label-floating">Category</label>
                                                <select class="form-control" name="category">
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if ($errors->has('category'))
                                                <p class="help is-danger" style="color: #b91d19">{{ $errors->first('category') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">description</label>
                                                <textarea type="text" class="form-control" name="description"></textarea>
                                            </div>
                                            @if ($errors->has('description'))
                                                <p class="help is-danger" style="color: #b91d19">{{ $errors->first('description') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Price</label>
                                                <input type="number" class="form-control" name="price">
                                            </div>
                                            @if ($errors->has('price'))
                                                <p class="help is-danger" style="color: #b91d19">{{ $errors->first('price') }}</p>
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
                                    <a href="{{route('item.index')}}" class="btn btn-danger">back</a>
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