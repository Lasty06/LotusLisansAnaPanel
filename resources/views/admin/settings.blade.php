{{ (Auth::user()->permission != 2 && Auth::user()->permission != 3) ? dd('Yetkisiz Erişim') : '' }}
@extends('layouts.front')
@section('title')
Admin | Genel Ayar Düzenle
@endsection

@section('css')
<link href="{{ asset('assets/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('contant')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Genel Ayar Güncelle</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Panel</a></li>
                                <li class="breadcrumb-item active">Genel Ayar Güncelle</li>
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
            <form action="{{ route('admin.generalUpdatePost') }}" method="POST" enctype="multipart/form-data" id="createproduct-form" autocomplete="off" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="panelName">Panel Adı</label>
                                    <input type="text" class="form-control" value="{{ $generalSettings->panelName }}" id="panelName" name="panelName" placeholder="Panel Adı" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="botTokens">Telegram Bot Token</label>
                                    <input type="text" class="form-control" value="{{ $generalSettings->botTokens }}" id="botTokens" name="botTokens" placeholder="Telegram Bot Token" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="chatId">Telegram Chat Id</label>
                                    <input type="text" class="form-control" value="{{ $generalSettings->chatId }}" id="chatId" name="chatId" placeholder="Telegram Chat Id" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="creditAlert">Düşük Kredi Bildirimi</label>
                                    <input type="text" class="form-control" value="{{ $generalSettings->creditAlert }}" id="creditAlert" name="creditAlert" placeholder="Düşük Kredi Bildirimi" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="creditAlertContent">Düşük Kredi Metni</label>
                                    <input type="text" class="form-control" value="{{ $generalSettings->creditAlertContent }}" id="creditAlertContent" name="creditAlertContent" placeholder="Düşük Kredi Metni" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="title">Bildirim Başlığı</label>
                                    <input type="text" class="form-control" value="{{ $generalSettings->title }}" id="title" name="title" placeholder="Bildiirm Başlığı" required>
                                </div>
                            </div>

                                    <textarea id="editor" name="content" rows="7" cols="100">{{ $generalSettings->content }}</textarea>

                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="startDate">Duyuru İlk Gösterim Tarihi</label>
                                    <input type="datetime-local" class="form-control" value="{{ $generalSettings->startDate }}" id="startDate" name="startDate" placeholder="Bildirim Başlangıç Tarihi" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="endDate">Duyuru Son Gösterim Tarihi</label>
                                    <input type="datetime-local" class="form-control" value="{{ $generalSettings->endDate }}" id="endDate" name="endDate" placeholder="Bildirim Sonlanma Tarihi" required>
                                </div>
                            </div>

                        </div>
                        <!-- end card -->

                        <div class="text-end mb-3">
                            <button type="submit" class="btn btn-success w-sm">Güncelle</button>
                        </div>
                    </div>
                    </form>
                    
                        <div class="col-lg-6">
                            <form method="POST" action="{{ route('admin.generalTelegramMessage') }}">
                                @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <?php
                                            $users = DB::table('users')->where('status', '1')->get()->toArray();
                                            $usersChunks = array_chunk($users, 30);
                                            ?>
                                            
                                            <label class="form-label" for="userId">Mesaj Atılacak Kullanıcıları Seçin</label>
                                            <select class="form-select mb-3" id="userId" name="userId[]" aria-label="Kullanıcı Seçin" multiple size="35">
                                                @foreach ($usersChunks as $groupIndex => $group)
                                                    <optgroup label="{{ ($groupIndex + 1) . '. Grup' }}">
                                                        @foreach ($group as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }} || {{ $user->email }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                                <textarea name="content" rows="7" cols="100" placeholder="Gönderilecek Mesajı Girin"></textarea>
                                
                            </div>
                            <!-- end card -->
    
                            <div class="text-end mb-3">
                                <button type="submit" class="btn btn-success w-sm">Gönder</button>
                            </div>
                        </div>
                        <!-- end col -->
                    </form>
                </div>
                <!-- end row -->
                
        </div>
        <!-- container-fluid -->
    </div>

@endsection

@section('js')

<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'imageUpload', 'undo', 'redo' ],
            language: 'tr',
            image: {
                // Configure the available styles.
                styles: [ 'alignLeft', 'alignCenter', 'alignRight' ],

                // Configure the available image resize options.
                resizeOptions: [
                    {
                        name: 'resizeImage:original',
                        label: 'Original',
                        value: null
                    },
                    {
                        name: 'resizeImage:50',
                        label: '50%',
                        value: '50'
                    },
                    {
                        name: 'resizeImage:75',
                        label: '75%',
                        value: '75'
                    }
                ],

                // You need to configure the image toolbar, too, so it shows the new style
                // buttons as well as the resize buttons.
                toolbar: [
                    'imageStyle:alignLeft',
                    'imageStyle:alignCenter',
                    'imageStyle:alignRight',
                    '|',
                    'imageResize',
                    '|',
                    'imageTextAlternative'
                ]
            },
            simpleUpload: {
                uploadUrl: '/laravel-filemanager/upload?type=editor',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        } )
        .catch( error => {
            console.error( error );
        } );
        
        
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.getElementById("userId").addEventListener("click", function(e) {
    var target = e.target;
    
    // Eğer tıklanan eleman bir OPTION ise
    if (target.tagName === "OPTION") {
        return;
    }
    
    // Eğer tıklanan eleman bir OPTGROUP ise
    if (target.tagName === "OPTGROUP") {
        var options = this.querySelectorAll("option");
        options.forEach(function(option) {
            option.selected = false;
        });
        var groupOptions = target.querySelectorAll("option");
        groupOptions.forEach(function(option) {
            option.selected = true;
        });
        return;
    }
});
</script>

Bu kod, <optgroup> etiketini tıkladığınızda altındaki tüm seçenekleri seçmeyi engeller ve yalnızca tek bir seçenek seçilir. Ayrıca, diğer tıklamalarda seçili seçenekleri kaldırır.






@endsection