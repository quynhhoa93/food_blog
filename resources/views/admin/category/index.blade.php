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
                    @if(session('successMsg'))
                        <div class="alert alert-success">
                            <button type="button" aria-hidden="true" class="close" onclick="this.parentElement.style.display='none'">×</button>
                            <span>
                                    <b> Success - </b> {{ session('successMsg') }}</span>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Simple Table</h4>
                            <p class="card-category"> Here is a subtitle for this table</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table" class="table table-striped table-bordered" cellspacing="0" style="width:100%">
                                    <thead class=" text-primary">
                                    <th>ID</th>
                                    <th>name</th>
                                    <th>slug</th>
                                    <th>action</th>
                                    </thead>
                                    <tbody>
                                    @foreach($category as $key=>$cate)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$cate->name}}</td>
                                            <td>{{$cate->slug}}</td>
                                            <td>
                                                <a href="{{route('category.edit',$cate->id)}}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>
                                                <form id="delete-form-{{ $cate->id }}" action="{{ route('category.destroy',$cate->id) }}" style="display: none;" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Bạn chắc chắn muốn xóa?')){
                                                        event.preventDefault();
                                                        document.getElementById('delete-form-{{ $cate->id }}').submit();
                                                        }else {
                                                        event.preventDefault();
                                                        }"><i class="material-icons">delete</i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <a href="{{route('category.create')}}" class="btn btn-primary">Thêm mới</a>
                                    <br>
                                    </tbody>
                                </table>
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