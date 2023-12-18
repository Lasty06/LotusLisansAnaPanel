{{ (Auth::user()->permission != 2 && Auth::user()->permission != 3) ? dd('Yetkisiz Erişim') : '' }}
@extends('layouts.front')
@section('title')
Admin | Ürün Ekle
@endsection

@section('css')
@endsection

@section('contant')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Ürün Oluştur</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Panel</a></li>
                                <li class="breadcrumb-item active">Ürün Oluştur</li>
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
            <form action="{{ route('admin.productaddPost') }}" method="POST" id="createproduct-form" autocomplete="off" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <?php $categorys = DB::table('category')->get(); ?>
                                    <label class="form-label" for="categoryId">Ürün Kategorisi</label>
                                    <select class="form-select mb-3" id="categoryId" name="categoryId" aria-label="Kategori Seçin">
                                        <option value="0" selected>Kategori Seçin</option>
                                        @foreach ($categorys as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="title">Ürün Başlığı</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Ürün Başlığı" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="amount">Ürün Fiyatı</label>
                                    <input type="text" class="form-control" id="amount" name="amount" placeholder="Ürün fiyatı" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="content">Açıklama</label>
                                    <input type="text" class="form-control" id="content" name="content" placeholder="Ürün fiyatı" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="active">Aktif/Pasif</label>
                                    <select class="form-select mb-3" id="active" name="active" aria-label="Aktif/Pasif">
                                        <option selected>Aktiflik Seçin</option>
                                        <option value="0">Pasif</option>
                                        <option value="1">Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->

                        <div class="text-end mb-3">
                            <button type="submit" class="btn btn-success w-sm">Oluştur</button>
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
@endsection