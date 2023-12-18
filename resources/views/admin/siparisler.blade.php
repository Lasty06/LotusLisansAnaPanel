{{ (Auth::user()->permission != 2 && Auth::user()->permission != 3) ? dd('Yetkisiz Erişim') : '' }}
@extends('layouts.front')
@section('title')
Tüm Siparişler
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
                        <h4 class="mb-sm-0">Tüm Siparişler</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Panel</a></li>
                                <li class="breadcrumb-item active">Tüm Siparişler</li>
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
                                        <th>Kullanıcı</th>
                                        <th>Oluşturma Tarihi</th>
                                        <th>Ürün</th>
                                        <th>İçerik</th>
                                        <th>Not</th>
                                        <th>Kategori</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siparisler as $siparis)
                                    <tr>
                                        <td>{{ $siparis->id }}</td>
                                        @php
                                          $user = \App\Models\User::where('id', $siparis->userId)->first();
                                        @endphp

                                        <td>{{ $user->name ?? 'Kullanıcı bulunamadı!!'; }}</td>
                                        <td>{{ $siparis->created_at }}</td>
                                        <?php $product = DB::table('product')->where('id', $siparis->productId)->first(); ?>
                                        <td>{{ ($product == null) ? 'Ürün Silinmiş' : $product->title }}</td>
                                        <td>{{ $siparis->content }}</td>
                                        <td>{{ $siparis->not }}</td>
                                        @if ($product)
                                            <?php $category = DB::table('category')->where('id', $product->categoryId)->first() ?>
                                            <td>{{ ($category == null) ? 'Kategori Silinmiş' : $category->title }}</td>
                                        @else
                                            <td>Kategoriye Erişilemedi!!!</td>
                                        @endif
                                    </tr>
                                    
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $siparisler->links() }}
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
            "deferRender": true
        });
    });

<!--
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>

<script>
$(document).ready(function(){
    
    fetch_data();
    
    function fetch_data(query = '') 
    {
        $.ajax({
            url:"{{ route('searchSiparisler') }}",
            method: 'GET',
            data:{query:query},
            dataType: 'json',
            success:function(data)
            {
                //var table = document.getElementById("1");
                //table.style.display = "none";
                //$('tbody').html(data.table_data);
                //$('#total_records').text(data.total_data);
            }
        })
    }
    
    $(document).on('keyup', '#search', function(){
        var query = $(this).val();
        fetch_data(query);
    });
});

</script>
-->

@endsection