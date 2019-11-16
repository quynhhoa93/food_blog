@extends('layouts.app')
@section('title','slider')
{{--@push('css')--}}
{{--<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">--}}
{{--@endpush--}}
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
@endpush
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
                                    <th>phone</th>
                                    <th>email</th>
                                    <th>lich hen</th>
                                    <th>loi nhan cua khach</th>
                                    <th>trang thai</th>
                                    <th>action</th>
                                    </thead>
                                    <tbody>
                                    @foreach($reservations as $key=>$reservation)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$reservation->name}}</td>
                                            <td>{{$reservation->phone}}</td>
                                            <td>{{$reservation->email}}</td>
                                            <td>{{$reservation->date_and_time}}</td>
                                            <td>
                                                @if($reservation->message == null)
                                                    khach khong yeu cau gi them
                                                @else
                                                    {{$reservation->message}}
                                                @endif
                                            </td>
                                            <td>
                                                @if($reservation->status == true)
                                                    <span class="label label-info" >da goi</span>
                                                @else
                                                    <span class="label label-danger" style="color: #b91d19">chua goi</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($reservation->status == false)
                                                    <form id="status-form-{{ $reservation->id }}" action="{{ route('reservation.status',$reservation->id) }}" style="display: none;" method="POST">
                                                        @csrf
                                                    </form>
                                                    <button type="button" class="btn btn-info btn-sm" onclick="if(confirm('Are you verify this request by phone?')){
                                                            event.preventDefault();
                                                            document.getElementById('status-form-{{ $reservation->id }}').submit();
                                                            }else {
                                                            event.preventDefault();
                                                            }"><i class="material-icons">done</i></button>
                                                @endif
                                                <form id="delete-form-{{ $reservation->id }}" action="{{ route('reservation.destroy',$reservation->id) }}" style="display: none;" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Bạn chắc chắn muốn xóa?')){
                                                        event.preventDefault();
                                                        document.getElementById('delete-form-{{ $reservation->id }}').submit();
                                                        }else {
                                                        event.preventDefault();
                                                        }"><i class="material-icons">delete</i></button>
                                            </td>
                                        </tr>
                                    @endforeach
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
@push('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        } );
    </script>
@endpush