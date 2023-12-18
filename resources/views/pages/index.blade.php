@extends('layouts.front')
@section('title')
Anasayfa
@endsection

@section('css')
@endsection

@section('contant')

<?php $general = DB::table('generalsettings')->first() ?>
@if (Auth::user()->credit < $general->creditAlert)
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Düşük Bakiye Bildirimi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              {{ $general->creditAlertContent }}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tamam</button>
            </div>
          </div>
        </div>
    </div>
@endif

<?php
$now = new DateTime();
$start_time = new DateTime($general->startDate);
$end_time = new DateTime($general->endDate);

if ($now >= $start_time && $now <= $end_time) {
    if (!session()->has('last_activity')) {
        session()->put('last_activity', '+', 30);
        ?>
        <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="popupTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">{{ $general->title }}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! $general->content !!}
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tamam</button>
                </div>
              </div>
            </div>
        </div>
        <?php
    }
}
?>

<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Bayi Paneli</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anaysafa</a></li>
                            <li class="breadcrumb-item active">Bayi Paneli</li>
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
                                            <p class="fw-medium text-muted mb-0">Bakiye</p>
                                            <h2 class="mt-4 ff-secondary fw-semibold"><span>{{ Auth::user()->credit }}₺</span></h2>
                                        </div>
                                        <div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                                    <i data-feather="credit-card" class="text-info"></i>
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
                                            <p class="fw-medium text-muted mb-0">Alınan Ürün</p>
                                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{ $count = DB::table('inventory')->where('userId', Auth::user()->id)->count(); }}">0</span></h2>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('#exampleModalCenter').modal('show');
    });
    $(document).ready(function(){
        $('#popup').modal('show');
    });
</script>
@endsection