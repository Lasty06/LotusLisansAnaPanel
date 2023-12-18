{{ (Auth::user()->permission != 2) ? dd('Yetkisiz Erişim') : '' }}
@extends('layouts.front')
@section('title')
Kategoriler
@endsection

@section('css')

<!--datatable css-->
<link rel="stylesheet" href="{{ asset('cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css') }}" />
<!--datatable responsive css-->
<link rel="stylesheet" href="{{ asset('cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css') }}" />

<link rel="stylesheet" href="{{ asset('cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css') }}">

@endsection

@section('contant')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Kullanıcılar</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Panel</a></li>
                                <li class="breadcrumb-item active">Kullanıcılar</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0"></h5>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                @foreach ($error->all as $hatalar)
                                    <div class="col-lg-8 alert alert-danger">{{ $hatalar }}</div>
                                @endforeach
                            @endif
                            @if (session('success'))
                                <div class="col-lg-8 alert alert-success">{{ session('success') }}</div>
                            @endif
                            <div class="table-responsive">
                                <table id="alternative-pagination" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>İsim</th>
                                        <th>Email</th>
                                        <th>Yetki</th>
                                        <th>Kredi</th>
                                        <th>Oluşturma Tarihi</th>
                                        <th>İşlem</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ ($user->permission == 2) ? 'Yönetici' : 'Bayi' }}</td>
                                        <td>{{ $user->credit }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.userupdate',$user->id) }}"><button class="btn btn-sm btn-soft-warning">Düzenle</button></a>
                                            <a href="{{ route('admin.userdelete',$user->id) }}"><button class="btn btn-sm btn-soft-danger">Sil</button></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

@endsection

@section('js')

<script src="{{ asset('code.jquery.com/jquery-3.6.0.min.js') }}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!--datatable js-->
<script src="{{ asset('cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js') }}"></script>
<script src="{{ asset('cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js') }}"></script>
<script src="{{ asset('cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

@endsection