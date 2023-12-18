{{ (Auth::user()->permission != 2) ? dd('Yetkisiz Erişim') : '' }}
@extends('layouts.front')
@section('title')
Admin | Kullanıcı Ekle
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
                        <h4 class="mb-sm-0">Kullanıcı Ekle</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Panel</a></li>
                                <li class="breadcrumb-item active">Kullanıcı Ekle</li>
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
            <form action="{{ route('admin.useraddPost') }}" method="POST" id="createproduct-form" autocomplete="off" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Kullanıcı Adı</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Kullanıcı Adı" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="password">Şifre</label>
                                    <input type="text" class="form-control" id="password" name="password" placeholder="Şifre" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="credit">Kredi</label>
                                    <input type="text" class="form-control" id="credit" name="credit" placeholder="Kredi" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="chatId">Telegram Chat Id</label>
                                    <input type="text" class="form-control" id="chatId" name="chatId" placeholder="Chat Id" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="permission">Yetki</label>
                                    <select class="form-select mb-3" id="permission" name="permission" aria-label="Yetki">
                                        <option selected>Yetki Seçiniz</option>
                                        <option value="1">Bayi</option>
                                        <option value="2">Yönetici</option>
                                        <option value="3">Editör</option>
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