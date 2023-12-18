{{ (Auth::user()->permission != 2 && Auth::user()->permission != 3) ? dd('Yetkisiz Erişim') : '' }}
@extends('layouts.front')
@section('title')
Admin | Stok Ekle
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
                        <h4 class="mb-sm-0">Stok Ekle</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Panel</a></li>
                                <li class="breadcrumb-item active">Stok Ekle</li>
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
            <form action="{{ route('admin.stockaddPost') }}" method="POST" id="createproduct-form" enctype="multipart/form-data" autocomplete="off" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <?php $categorys = DB::table('category')->get(); ?>
                                    <label class="form-label" for="productId">Ürün Başlığı</label>
                                    <select class="form-select mb-3" id="productId" name="productId" aria-label="Ürün Seçin">
                                        <option value="0" selected>Ürün Seçin</option>
                                        @foreach ($categorys as $category)
                                            <?php $products = DB::table('product')->where('categoryId', $category->id)->get(); ?>
                                            <optgroup label="{{ $category->title }}">
                                                @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->title }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="content">Ürün Bilgisi(Hesap giriş bilgileri)</label>
                                    <textarea type="text" class="form-control" id="content" name="content" placeholder="Ürün Bilgisi" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="noStock">Teslimat</label>
                                    <select class="form-select mb-3" id="noStock" name="noStock" aria-label="Teslimat">
                                        <option>Teslimat Seçiniz</option>
                                        <option selected value="1">Stoklu</option>
                                        <option value="2">Stoksuz</option>
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
