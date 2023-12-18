@extends('layouts.front')
@section('title')
Ürünler > {{ $category->title }}
@endsection

@section('css')
@endsection

@section('contant')

<div class="main-content">S

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><a href="{{ url()->previous() }}">Önceki Sayfa</a></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Kategori</a></li>
                                <li class="breadcrumb-item active">Ürünler</li>
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
                            <h5 class="card-title mb-0">Alt Kategoriler</h5>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 p-2 m-2">
                            @foreach ($subCategorys as $subCategory)
                            <div class="col">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $subCategory->title }}</h5>
                                        <a href="{{ route('product', ['slug' => $subCategory->slug, 'id' => $subCategory->id]) }}"><button class="btn btn-primary">Ürünler</button></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div><!--end col-->
            </div>
            <!--end row-->


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        @if (session('hata'))
                                <div class="col-lg-8 alert alert-danger">{{ session('hata') }}</div>
                        @endif
                        <div class="card-header">
                            <h5 class="card-title mb-0">Ürünler > {{ $category->title }}</h5>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 p-2 m-2">
                            @foreach ($products as $product)
                            <div class="col">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h4 class="card-title">{{ $product->title }}</h4>
                                        <p class="">
                                            <br>
                                            Ürün Açıklaması: <br>
                                            {{ $product->content }}</p>
                                        @if (DB::table('stock')->where('productId', $product->id)->where('delivery', 1)->count() > 0)
                                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#satinAl{{ $product->id }}">{{ $product->amount }}₺'ye Satın Al</button></a>
                                        @else
                                        <button class="btn btn-danger" disabled>Stok Yok</button>
                                        @endif
                                        @php
                                        $stok = DB::table('stock')->where('productId', $product->id)->where('delivery', 1)->where('noStock', 1)->count();
                                        
                                        if ($stok == 0) {
                                        $alt = "Ürün siparişe açıktır.";
                                        }else {
                                        $alt = "Kalan Stok: $stok ";
                                        }
                                        
                                        $stok = DB::table('stock')->where('productId', $product->id)->where('delivery', 1)->count();
                                        
                                        if($stok == 0) {
                                        $alt = "Stok yok";
                                        }
                                        
                                        @endphp
                                        
                                        <p>
                                            <br>
                                            <b>{!! $alt !!}</b></p>
                                        <p></p>
                                    </div>
                                </div>
                            </div>

                            <div style="position:fixed" class="modal fade" id="satinAl{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <form action="{{ route('buy') }}" method="POST">
                                    @csrf
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Ürün Bilgileri</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col mb-3">
                                                <label for="content" class="form-label">Açıklama (Gerekiyorsa Email, şifre benzeri veriler veya kısa not)</label>
                                                <input type="text" id="content" name="content" class="form-control" placeholder="Açıklama Girin" />
                                                </div>
                                            </div>
                                            {{ $product->amount }} Tl'ye {{ $product->title }}, ürününü satın alacaksın. Onaylıyor musun?
                                        </div>
                                        <input value="{{ $product->id }}" name="id" hidden>
                                        <div class="modal-footer">
                                        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Onayla ve satın al</button>
                                        </div>
                                    </div>
                                    </div>
                                </form>
                            </div>
                            
                            @endforeach
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
@endsection