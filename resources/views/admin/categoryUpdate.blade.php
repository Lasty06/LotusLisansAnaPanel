{{ (Auth::user()->permission != 2 && Auth::user()->permission != 3) ? dd('Yetkisiz Erişim') : '' }}
@extends('layouts.front')
@section('title')
Admin | Kategori Düzenle > {{ $category->title }}
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
            <form action="{{ route('admin.categoryupdatePost') }}" method="POST" id="createproduct-form" autocomplete="off" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <?php $subCategorys = DB::table('category')->get(); ?>
                                    <label class="form-label" for="subCategory">Alt Kategori</label>
                                    <select class="form-select mb-3" id="subCategory" name="subCategory" aria-label="Kategori Seçin">
                                        <option value="0">Kategori</option>
                                        @foreach ($subCategorys as $subCategory)
                                        <option value="{{ $subCategory->id }}" {{ ($subCategory->id == $category->subCategory) ? "selected" : ""}}>{{ $subCategory->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="title">Kategori Başlığı</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $category->title }}" placeholder="Kategori Başlığı" required>
                                    <input name="id" value="{{ $category->id }}" hidden>
                                </div>
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