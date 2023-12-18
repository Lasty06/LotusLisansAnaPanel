@extends('layouts.front')
@section('title')
{{ Auth::user()->name }} Siparişlerim
@endsection

@section('css')

<!--datatable css-->
<link rel="stylesheet" href="{{ asset('cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css') }}" />
<!--datatable responsive css-->
<link rel="stylesheet" href="{{ asset('cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css') }}" />

<link rel="stylesheet" href="{{ asset('cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css') }}">

@endsection

@section('contant')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Envanter</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Profil</a></li>
                                <li class="breadcrumb-item active">Envanter</li>
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
                            <h5 class="card-title mb-0"></h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="alternative-pagination" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Ürün</th>
                                        <th>Not</th>
                                        <th>Ödenen Ücret</th>
                                        <th>Satın Alındığı Zaman</th>
                                        <th>Bilgileri Al</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inventories as $inventory)
                                    <?php  $product = DB::table('product')->where('id', $inventory->productId)->first(); ?>
                                    <tr>
                                        <td>{{ $inventory->id }}</td>
                                        <td>{{ ($product == null) ? 'Ürün Silinmiş' : $product->title }}</td>
                                        <td>{{ $inventory->not }}</td>
                                        <td>{{ $inventory->productAmount }}₺</td>
                                        <td>{{ $inventory->created_at }}</td>
                                        <td>
                                            @if ($inventory->delivery == 1)
                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#bilgileriAl{{ $inventory->id }}"><button class="btn btn-sm btn-soft-info">Bilgileri Al</button></a>
                                            @elseif ($inventory->delivery == 3)
                                        <a class="dropdown-item">
                                            <button class="btn btn-sm btn-soft-danger">İptal Edildi</button>
                                        </a>
                                            @else
                                                <a class="dropdown-item"><button class="btn btn-sm btn-soft-warning">Teslim Edilmesi Bekleniyor</button></a>
                                            @endif
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="bilgileriAl{{ $inventory->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Ürün Bilgileri</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body" id="modalContent{{ $inventory->id }}">
                                            {{ $inventory->content }}
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                                            <button class="btn btn-info" onclick="copyModalBody('modalContent{{ $inventory->id }}')">Bilgileri Kopyala</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
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

<script src="{{ asset('code.jquery.com/jquery-3.6.0.min.js') }}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!--datatable js-->
<script src="{{ asset('cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js') }}"></script>
<script src="{{ asset('cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js') }}"></script>
<script src="{{ asset('cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#alternative-pagination').DataTable().destroy();
        $('#alternative-pagination').DataTable({
            "order": [[0, "desc"]]
        });
    });
</script>


<script>
/*
function copyModalBody(id) {
  var modalContent = document.getElementById(id); // Modal content elementini seç
  var range = document.createRange(); // Range oluştur
  range.selectNode(modalContent); // Range'i modal content ile ayarla
  window.getSelection().removeAllRanges(); // Mevcut seçimi temizle
  window.getSelection().addRange(range); // Yeni seçimi ekle
  document.execCommand("copy"); // Kopyala komutunu çalıştır
  alert("Ürün içeriği kopyalandı!"); // Kopyalandı mesajı göster
}
*/

function copyModalBody(id) {
  var modalContent = document.getElementById(id);

  // iOS'ta çalışacak şekilde güncellenmiş range oluşturma
  var range = document.createRange();
  range.selectNode(modalContent);

  // iOS uyumluluğu için text range kullanma
  var selection = window.getSelection();
  selection.removeAllRanges();
  selection.addRange(range);

  // Kopyalama işlemini manuel olarak gerçekleştirme
  try {
    document.execCommand('copy');
    var msg = 'Ürün içeriği kopyalandı!';
    alert(msg);
  } catch (err) {
    console.error('Kopyalama işlemi sırasında bir hata oluştu:', err);
    var msg = 'Kopyalama işlemi başarısız oldu. Lütfen manuel olarak kopyalayın.';
    alert(msg);
  }

  // Seçim aralığını temizleme
  selection.removeAllRanges();
}
</script>

@endsection