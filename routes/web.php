<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\GetController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontController::class, 'index'])->middleware('auth')->name('index');
Route::get('login', [FrontController::class, 'login'])->middleware('guest')->name('login');
Route::get('/profil', [GetController::class, 'profile'])->middleware('auth')->name('profile');
Route::post('/profilUpdate', [PostController::class, 'profile'])->middleware('auth')->name('profileUpdatePost');
Route::get('/talimatlar', [GetController::class, 'faq'])->middleware('auth')->name('faq');
Route::get('/kategori', [GetController::class, 'category'])->middleware('auth')->name('category');
Route::get('/kategori/{slug}/{id}', [GetController::class, 'product'])->middleware('auth')->name('product');
//Route::get('/satin-al/{id}', [GetController::class, 'buy'])->middleware('auth')->name('buy');
Route::post('/satin-al', [PostController::class, 'buy'])->middleware('auth')->name('buy');
Route::get('/siparislerim', [GetController::class, 'inventory'])->middleware('auth')->name('inventory');
Route::get('/logout', [GetController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/logs', [GetController::class, 'logs'])->middleware('auth')->name('logs');
Route::get('/fiyatListesi', [FrontController::class, 'fiyatListesi'])->middleware('auth')->name('fiyatListesi');




Route::get('/admin', [FrontController::class, 'adminIndex'])->middleware('auth')->name('admin.index');
Route::get('/admin/genel-ayar', [GetController::class, 'adminGeneralSettings'])->middleware('auth')->name('admin.generalGettings');
Route::post('/admin/genel-ayar/guncelle', [PostController::class, 'generalUpdatePost'])->middleware('auth')->name('admin.generalUpdatePost');
Route::post('/admin/genel-ayar/telegram-gonder', [PostController::class, 'telegramMessage'])->middleware('auth')->name('admin.generalTelegramMessage');

Route::get('/admin/sss', [GetController::class, 'adminSss'])->middleware('auth')->name('admin.sss');
Route::get('/admin/sss/ekle', [FrontController::class, 'sssAdd'])->middleware('auth')->name('admin.sssadd');
Route::post('/admin/sss/eklePost', [PostController::class, 'sssAddPost'])->middleware('auth')->name('admin.sssaddPost');
Route::get('/admin/sss/duzenle/{id}', [GetController::class, 'sssUpdate'])->middleware('auth')->name('admin.sssupdate');
Route::post('/admin/sss/duzenlePost', [PostController::class, 'sssUpdatePost'])->middleware('auth')->name('admin.sssupdatePost');
Route::get('/admin/sss/delete/{id}', [GetController::class, 'sssDelete'])->middleware('auth')->name('admin.sssdelete');

Route::get('/admin/kategori', [GetController::class, 'adminCategory'])->middleware('auth')->name('admin.category');
Route::get('/admin/kategori/ekle', [FrontController::class, 'categoryAdd'])->middleware('auth')->name('admin.categoryadd');
Route::post('/admin/kategori/eklePost', [PostController::class, 'categoryAddPost'])->middleware('auth')->name('admin.categoryaddPost');
Route::get('/admin/kategori/duzenle/{id}', [GetController::class, 'categoryUpdate'])->middleware('auth')->name('admin.categoryupdate');
Route::post('/admin/kategori/duzenlePost', [PostController::class, 'categoryUpdatePost'])->middleware('auth')->name('admin.categoryupdatePost');
Route::get('/admin/kategori/delete/{id}', [GetController::class, 'categoryDelete'])->middleware('auth')->name('admin.categorydelete');


Route::get('/admin/urun', [GetController::class, 'adminProduct'])->middleware('auth')->name('admin.product');
Route::get('/admin/urun/ekle', [FrontController::class, 'productAdd'])->middleware('auth')->name('admin.productadd');
Route::post('/admin/urun/eklePost', [PostController::class, 'productAddPost'])->middleware('auth')->name('admin.productaddPost');
Route::get('/admin/urun/duzenle/{id}', [GetController::class, 'productUpdate'])->middleware('auth')->name('admin.productupdate');
Route::post('/admin/urun/duzenlePost', [PostController::class, 'productUpdatePost'])->middleware('auth')->name('admin.productupdatePost');
Route::get('/admin/urun/delete/{id}', [GetController::class, 'productDelete'])->middleware('auth')->name('admin.productdelete');

Route::get('/admin/stok', [GetController::class, 'adminStock'])->middleware('auth')->name('admin.stock');
Route::get('/admin/stoksuz', [GetController::class, 'adminStockNo'])->middleware('auth')->name('admin.stockno');
Route::get('/admin/stok/ekle', [FrontController::class, 'stockAdd'])->middleware('auth')->name('admin.stockadd');
Route::post('/admin/stok/eklePost', [PostController::class, 'stockAddPost'])->middleware('auth')->name('admin.stockaddPost');
Route::get('/admin/stok/duzenle/{id}', [GetController::class, 'stockUpdate'])->middleware('auth')->name('admin.stockupdate');
Route::post('/admin/stok/duzenlePost', [PostController::class, 'stockUpdatePost'])->middleware('auth')->name('admin.stockupdatePost');
Route::get('/admin/stok/delete/{id}', [GetController::class, 'stockDelete'])->middleware('auth')->name('admin.stockdelete');
Route::post('/admin/stoksuz/teslimat', [PostController::class, 'stockNoUpdatePost'])->middleware('auth')->name('admin.stocknoupdatePost');
Route::get('/admin/stoksuz/iptal/{id}', [GetController::class, 'stockNoCancel'])->middleware('auth')->name('admin.stocknoCancel');

Route::get('/admin/kullanici', [GetController::class, 'adminUser'])->middleware('auth')->name('admin.user');
Route::get('/admin/kullanici/ekle', [FrontController::class, 'userAdd'])->middleware('auth')->name('admin.useradd');
Route::post('/admin/kullanici/eklePost', [PostController::class, 'userAddPost'])->middleware('auth')->name('admin.useraddPost');
Route::get('/admin/kullanici/duzenle/{id}', [GetController::class, 'userUpdate'])->middleware('auth')->name('admin.userupdate');
Route::post('/admin/kullanici/duzenlePost', [PostController::class, 'userUpdatePost'])->middleware('auth')->name('admin.userupdatePost');
Route::get('/admin/kullanici/delete/{id}', [GetController::class, 'userDelete'])->middleware('auth')->name('admin.userdelete');

Route::get('/admin/siparisler', [GetController::class, 'siparisler'])->middleware('auth')->name('siparisler');

Route::post('/upload', [PostController::class, 'upload'])->name('upload.image');

Route::get('/sqlBackupYanlizcaCronGirisiYapilabilir', [GetController::class, 'backup'])->name('backup');

Route::get('/admin/backups', [GetController::class, 'listBackups'])->middleware('auth')->name('listBackups');

Route::get('/admin/backup/{file}', 'BackupController@downloadBackup')->middleware('auth')->name('backup.download');


Route::post('/topluStok', [PostController::class, 'topluStok'])->middleware('auth')->name('stok.toplu');

Route::post('/loginPost', [PostController::class, 'loginPost'])->middleware('guest')->name('loginPost');



Route::get('/searchSiparisler', [GetController::class, 'searchSiparisler'])->name('searchSiparisler');
/*
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
*/

//Route::get('logss', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
