{{ (Auth::user()->permission != 2) ? dd('Yetkisiz Erişim') : '' }}
@extends('layouts.front')
@section('title')
Admin | Kullanıcı Düzenle > {{ $user->name }}
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
                        <h4 class="mb-sm-0">Kategori Güncelle</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Panel</a></li>
                                <li class="breadcrumb-item active">Kategori Güncelle</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            @if ($errors->any())
                @foreach ($error->all as $hatalar)
                    <div class="col-lg-8 alert alert-danger">{{ $hatalar }}</div>
                @endforeach
            @endif
            @if (session('success'))
                <div class="col-lg-8 alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('admin.userupdatePost') }}" method="POST" id="createproduct-form" autocomplete="off" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Kullanıcı Adı</label>
                                    <input type="text" class="form-control" value="{{ $user->name }}" id="name" name="name" placeholder="Kullanıcı Adı" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" class="form-control" value="{{ $user->email }}" id="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="password">Şifre</label>
                                    <input type="text" class="form-control" id="password" name="password" placeholder="Şifre" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="credit">Kredi</label>
                                    <input type="text" class="form-control" value="{{ $user->credit }}" id="credit" name="credit" placeholder="Kredi" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="chatId">Telegram Chat Id</label>
                                    <input type="text" class="form-control" value="{{ $user->chatId }}" id="chatId" name="chatId" placeholder="Chat Id" required>
                                </div>
                                
                                <div class="col-12">
                                    <div class="col-6">
                                        <label class="form-label" for="permission">Yetki</label>
                                        <select class="form-select mb-3" id="permission" name="permission" aria-label="Yetki">
                                            <option>Yetki Seçiniz</option>
                                            <option {{ ($user->permission == 1) ? 'selected' : '' }} value="1">Bayi</option>
                                            <option {{ ($user->permission == 2) ? 'selected' : '' }} value="2">Yönetici</option>
                                            <option {{ ($user->permission == 3) ? 'selected' : '' }} value="3">Editör</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-6">
                                        <label class="form-label" for="statuss">Durum</label>
                                        <select class="form-select mb-3" id="statuss" name="statuss" aria-label="Durum">
                                            <option>Durum Seçiniz</option>
                                            <option {{ ($user->status == 1) ? 'selected' : '' }} value="1">Aktif</option>
                                            <option {{ ($user->status == 0) ? 'selected' : '' }} value="0">Pasif</option>
                                        </select>
                                    </div>
                                </div>







                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0"></h5>
                                            </div>
                                            <div class="card-body">
                                                <table id="alternative-pagination" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>İşlem Açıklaması</th>
                                                        <th>Tarih</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($logs as $log)
                                                        <tr>
                                                            <td>{{ $log->id }}</td>
                                                            <td>{{ $log->content }}</td>
                                                            <td>{{ $log->created_at }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->


                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0"></h5>
                                            </div>
                                            <div class="card-body">
                                                <table id="alternative-pagination2" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>İşlem Açıklaması</th>
                                                        <th>Tarih</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($Iplogs as $Iplog)
                                                        <tr>
                                                            <td>{{ $Iplog->id }}</td>
                                                            <td>{{ $Iplog->content }}</td>
                                                            <td>{{ $Iplog->created_at }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                                
                                    <input name="id" value="{{ $user->id }}" hidden>
                            </div>
                        </div>
                        <!-- end card -->

                        <div class="text-end mb-3">
                            <button type="submit" class="btn btn-success w-sm">Güncelle</button>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </form>

        </div>
        <!-- container-fluid -->
    </div>

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

<script>
    $(document).ready(function() {
        $('#alternative-pagination').DataTable().destroy();
        $('#alternative-pagination').DataTable({
            "order": [[0, "desc"]]
        });
    });
    $(document).ready(function() {
        $('#alternative-pagination2').DataTable().destroy();
        $('#alternative-pagination2').DataTable({
            "order": [[0, "desc"]]
        });
    });
</script>
@endsection