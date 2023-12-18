{{ (Auth::user()->permission != 2 && Auth::user()->permission != 3) ? dd('Yetkisiz Erişim') : '' }}
@extends('layouts.front')
@section('title')
Admin | SSS Düzenle > {{ $faq->title }}
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
                        <h4 class="mb-sm-0">Sss Güncelle</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Panel</a></li>
                                <li class="breadcrumb-item active">Sss Güncelle</li>
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
            <form action="{{ route('admin.sssupdatePost') }}" method="POST" id="createproduct-form" autocomplete="off" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="title">Soru</label>
                                    <input type="text" class="form-control" value="{{ $faq->title }}" id="title" name="title" placeholder="Soru" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="content">Cevap</label>
                                    <!--
                                    <input type="text" class="form-control" value="{{ $faq->content }}" id="content" name="content" placeholder="Cevap" required>
                                    -->
                                    <textarea id="editor" name="content" rows="7" cols="100" placeholder="Cevap Girin">{{ $faq->content }}</textarea>
                                </div>
                                    <input name="id" value="{{ $faq->id }}" hidden>
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
<!-- ckeditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection