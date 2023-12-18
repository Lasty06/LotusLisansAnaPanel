{{ (Auth::user()->permission != 2 && Auth::user()->permission != 3) ? dd('Yetkisiz Erişim') : '' }}
@extends('layouts.front')
@section('title')
Admin | Ürün Düzenle > {{ $product->title }}
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
            <form action="{{ route('admin.productupdatePost') }}" method="POST" id="createproduct-form" autocomplete="off" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <?php $categorys = DB::table('category')->get(); ?>
                                    <label class="form-label" for="categoryId">Ürün Kategorisi</label>
                                    <select class="form-select mb-3" id="categoryId" name="categoryId" aria-label="Kategori Seçin">
                                        <option value="0">Kategori Seçin</option>
                                        @foreach ($categorys as $category)
                                        <option {{ ($product->categoryId == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="title">Ürün Başlığı</label>
                                    <input type="text" class="form-control" value="{{ $product->title }}" id="title" name="title" placeholder="Ürün Başlığı" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="amount">Ürün Fiyatı</label>
                                    <input type="text" class="form-control" value="{{ $product->amount }}" id="amount" name="amount" placeholder="Ürün fiyatı" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="content">Açıklama</label>
                                    <input type="text" class="form-control" value="{{ $product->content }}" id="content" name="content" placeholder="Ürün fiyatı" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="active">Aktif/Pasif</label>
                                    <select class="form-select mb-3" id="active" name="active" aria-label="Aktif/Pasif">
                                        <option>Aktiflik Seçin</option>
                                        <option {{ ($product->active == 0) ? 'selected' : '' }} value="0">Pasif</option>
                                        <option {{ ($product->active == 1) ? 'selected' : '' }} value="1">Aktif</option>
                                    </select>
                                </div>
                                    <input name="id" value="{{ $product->id }}" hidden>
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
@endsection