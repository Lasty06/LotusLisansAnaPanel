{{ (Auth::user()->permission != 2 && Auth::user()->permission != 3) ? dd('Yetkisiz Erişim') : '' }}
@extends('layouts.front')
@section('title')
Admin | Anasayfa
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
                    <h4 class="mb-sm-0">Admin Paneli</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anaysafa</a></li>
                            <li class="breadcrumb-item active">Admin Paneli</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xxl-5">
                <div class="d-flex flex-column h-100">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="fw-medium text-muted mb-0">Toplam Kredi</p>
                                            <h2 class="mt-4 ff-secondary fw-semibold"><span>{{ DB::table('users')->sum('credit'); }}₺</span></h2>
                                        </div>
                                        <div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                    <i data-feather="activity" class="text-info"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="fw-medium text-muted mb-0">Toplam Bayi</p>
                                            <h2 class="mt-4 ff-secondary fw-semibold"><span>{{ DB::table('users')->where('permission', 1)->count() }}</span></h2>
                                        </div>
                                        <div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                    <i data-feather="activity" class="text-info"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="fw-medium text-muted mb-0">Toplam Ürün</p>
                                            <h2 class="mt-4 ff-secondary fw-semibold"><span>{{ DB::table('product')->where('active', 1)->count() }}</span></h2>
                                        </div>
                                        <div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                    <i data-feather="activity" class="text-info"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="fw-medium text-muted mb-0">Toplam Stok</p>
                                            <h2 class="mt-4 ff-secondary fw-semibold"><span>{{ DB::table('stock')->where('delivery', 1)->count() }}</span></h2>
                                        </div>
                                        <div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                    <i data-feather="activity" class="text-info"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="fw-medium text-muted mb-0">Toplam Satış</p>
                                            <h2 class="mt-4 ff-secondary fw-semibold"><span>{{ DB::table('inventory')->count(); }}</span></h2>
                                        </div>
                                        <div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                    <i data-feather="activity" class="text-info"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="fw-medium text-muted mb-0">Harcanan Toplam Kredi</p>
                                            <h2 class="mt-4 ff-secondary fw-semibold"><span>{{ DB::table('inventory')->sum('productAmount'); }}₺</span></h2>
                                        </div>
                                        <div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                    <i data-feather="activity" class="text-info"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        @php
                           // Bu haftanın ilk gününün tarihini al
                           $startOfWeek = date('Y-m-d', strtotime('this week monday'));
                        
                           // Bu haftanın son gününün tarihini al
                           $endOfWeek = date('Y-m-d', strtotime('this week sunday'));
                        
                           // Bu hafta oluşturulan verilerin toplam kredi miktarını al
                           $totalCreditThisWeek = DB::table('inventory')
                                                  ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                                                  ->sum('productAmount');
                        @endphp
                        <div class="col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="fw-medium text-muted mb-0">Harcanan Haftalık Kredi</p>
                                            <h2 class="mt-4 ff-secondary fw-semibold"><span>{{ $totalCreditThisWeek }}₺</span></h2>
                                        </div>
                                        <div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                    <i data-feather="activity" class="text-info"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        
                        @php
                       // Bu ayın ilk gününün tarihini al
                       $startOfMonth = date('Y-m-01');
                    
                       // Bu ayın son gününün tarihini al
                       $endOfMonth = date('Y-m-t');
                    
                       // Bu ay oluşturulan verileri al
                       $inventoryDataMonth = DB::table('inventory')
                                       ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                                       ->get();
                        @endphp
                        <div class="col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="fw-medium text-muted mb-0">Harcanan Aylık Kredi</p>
                                            <h2 class="mt-4 ff-secondary fw-semibold"><span>{{ $inventoryDataMonth->sum('productAmount'); }}₺</span></h2>
                                        </div>
                                        <div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                    <i data-feather="activity" class="text-info"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div> <!-- end row-->
                </div>
            </div> <!-- end col-->
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection

@section('js')
@endsection