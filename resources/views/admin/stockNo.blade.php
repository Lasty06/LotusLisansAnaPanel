{{ (Auth::user()->permission != 2 && Auth::user()->permission != 3) ? dd('Yetkisiz Erişim') : '' }}
@extends('layouts.front')
@section('title')
Stoksuz Siparişler
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
                        <h4 class="mb-sm-0">Stoksuz Siparişler</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Panel</a></li>
                                <li class="breadcrumb-item active">Stoksuz Siparişler</li>
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
                                <table id="alternative-pagination" class="table nowrap dt-responsive align-middle table-hover table-bordered responsive" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Kullanıcı</th>
                                            <th>Kategori</th>
                                            <th>Ürün</th>
                                            <th>İçerik</th>
                                            <th>Oluşturma Tarihi</th>
                                            <th>İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stocks as $stock)
                                        <tr>
                                            <td>{{ $stock->id }}</td>
                                            @php
                                              $user = \App\Models\User::where('id', $stock->userId)->first();
                                            @endphp
    
                                            <td>{{ $user->name }}</td>
                                            <?php $product = DB::table('product')->where('id', $stock->productId)->first(); ?>
                                            @if ($product)
                                                <?php $category = DB::table('category')->where('id', $product->categoryId)->first() ?>
                                                <td>{{ ($category == null) ? 'Kategori Silinmiş' : $category->title }}</td>
                                            @else
                                                <td>Kategoriye Erişilemedi!!!</td>
                                            @endif
                                            <td>{{ ($product == null) ? 'Ürün Silinmiş' : $product->title }}</td>
                                            <td>{{ $stock->content }}</td>
                                            <td>{{ $stock->created_at }}</td>
                                            <td>
                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#bilgileriAl{{ $stock->id }}"><button class="btn btn-sm btn-soft-info">Teslim Et</button></a>
                                                <a href="{{ route('admin.stocknoCancel',$stock->id) }}"><button class="btn btn-sm btn-soft-danger">İptal Et</button></a>
                                            </td>
                                        </tr>
    
                                        <div class="modal fade" id="bilgileriAl{{ $stock->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <form action="{{ route('admin.stocknoupdatePost') }}" method="POST">
                                                @csrf
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Ürün Bilgileri</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="content">Ürün Bilgisi(Hesap giriş bilgileri)</label>
                                                                <input type="text" class="form-control" value="{{ $stock->content }}" id="content" name="content" placeholder="Ürün Bilgisi" required>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" hidden value="1" name="delivery">
                                                        <input type="text" class="form-control" hidden value="{{ $stock->id }}" name="id">
                                                        <div class="modal-footer">
                                                        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Teslim Et</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
    
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