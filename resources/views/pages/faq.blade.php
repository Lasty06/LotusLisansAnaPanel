@extends('layouts.front')
@section('title')
Anasayfa
@endsection

@section('css')
@endsection

@section('contant')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">

                    <div class="row justify-content-evenly">
                        <div class="col-lg-8">
                            <div class="mt-3">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0 me-1">
                                        <i class="ri-question-line fs-24 align-middle text-success me-1"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="fs-16 mb-0 fw-semibold">Sıkça Sorulan Sorular</h5>
                                    </div>
                                </div>

                                <div class="accordion accordion-border-box" id="genques-accordion">
                                    @foreach ($faq as $faqs)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="genques-heading{{ $faqs->id }}">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#genques-collapse{{ $faqs->id }}" aria-expanded="true" aria-controls="genques-collapse{{ $faqs->id }}">
                                                {{ $faqs->title }}
                                            </button>
                                        </h2>
                                        <div id="genques-collapse{{ $faqs->id }}" class="accordion-collapse collapse" aria-labelledby="genques-heading{{ $faqs->id }}" data-bs-parent="#genques-accordion">
                                            <div class="accordion-body" id="accordionBody{{ $faqs->id }}">
                                                {!! $faqs->content !!}
                                            </div>
                                            <button class="btn btn-info" onclick="copyModalBody('accordionBody{{ $faqs->id }}')">Talimatı Kopyala</button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <!--end accordion-->
                            </div>
                        </div>

                    </div>
                </div>
                <!--end col-->.
            </div>
            <!--end row-->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

@endsection

@section('js')
<script>
function copyModalBody(text) {
  var accordionBody = document.getElementById(text); // Modal content elementini seç
  var range = document.createRange(); // Range oluştur
  range.selectNode(accordionBody); // Range'i modal content ile ayarla
  window.getSelection().removeAllRanges(); // Mevcut seçimi temizle
  window.getSelection().addRange(range); // Yeni seçimi ekle
  document.execCommand("copy"); // Kopyala komutunu çalıştır
  alert("Talimat içeriği kopyalandı!"); // Kopyalandı mesajı göster
}
</script>
@endsection