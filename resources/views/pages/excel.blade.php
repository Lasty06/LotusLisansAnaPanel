@extends('layouts.front')
@section('title')
Fiyat Listesi
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
                        <h4 class="mb-sm-0">Fiyat Listesi</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Fiyat Listesi</a></li>
                                <li class="breadcrumb-item active">Fiyat Listesi</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="row row-cols-12 row-cols-sm-12 row-cols-md-12 row-cols-lg-12 p-2 m-2">
                        <iframe src="https://docs.google.com/spreadsheets/d/e/2PACX-1vTxBC9I1T_PKI6o2YA3tJrxAUbUg9f3w784yTs-LRo_RJfH_V73wRTqESnragRyvaoRQy1a3qBgrWTy/pubhtml?gid=0&amp;single=true&amp;widget=true&amp;headers=false" width="100%" height="800"></iframe>

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