@extends('layouts.front')
@section('title')
Kategori
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
                        <h4 class="mb-sm-0">Kategori</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Kategori</a></li>
                                <li class="breadcrumb-item active">Kategoriler</li>
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
                            <h5 class="card-title mb-0">Kategoriler</h5>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 p-2 m-2">
                            @foreach ($categorys as $category)
                            <div class="col">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $category->title }}</h5>
                                        <a href="{{ route('product', ['slug' => $category->slug, 'id' => $category->id]) }}"><button class="btn btn-primary">Ürünler</button></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div><!--end col-->
            </div>
            <!--end row-->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

@endsection

@section('js')
@endsection