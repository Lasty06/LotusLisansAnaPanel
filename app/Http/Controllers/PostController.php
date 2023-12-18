<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Faq;
use App\Models\Logs;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use App\Models\Inventory;
use App\Models\GeneralSettings;
use Illuminate\Support\Facades\Auth;
use Telegram\Bot\Api;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StockImport;
use Illuminate\Support\Facades\Storage;
use App\Models\IpLog;



class PostController extends Controller
{
    public function loginPost(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $ipAddress = $request->ip();

            IpLog::create([
                'userId' => $request->email,
                'content' => $ipAddress.' Adresinden giriş yapıldı.',
            ]);

            return redirect()->intended('/');
        }else {
            return redirect()->back()->with('error', 'Hatalı e-posta adresi veya şifre.');
        }
    }
    
    public function categoryAddPost(Request $request)
    {
        $category = new Category;

        $category->subCategory = $request->subCategory;
        $category->title = $request->title;
        $category->slug = Str::slug($request->title);

        $category->save();

        return redirect()->route('admin.categoryadd')->with('success', 'Kategori başarıyla eklendi.');
    }
    public function productAddPost(Request $request)
    {
        if($request->content == null) {
            $productContent = " ";
        }else{
            $productContent = $request->content;
        }
        
        $product = new Product;

        $product->categoryId = $request->categoryId;
        $product->title = $request->title;
        $product->content = $productContent;
        $product->amount = $request->amount;
        $product->active = $request->active;

        $product->save();

        return redirect()->route('admin.productadd')->with('success', 'Ürün başarıyla eklendi.');
    }
    public function stockAddPost(Request $request)
    {

        if($request->content == ""){
            $content = "-";
        }else{
            $content = $request->content;
        }

        // Satırları diziye ayır
        $veriDizisi = explode("\n", $content);

        // Her bir veriyi SQL'e kaydet
        foreach ($veriDizisi as $veri) {

            $stock = new Stock;

            $stock->productId = $request->productId;
            $stock->content = trim($veri);
            $stock->delivery = "1";
            $stock->noStock = $request->noStock;

            $stock->save();

        }

        return redirect()->route('admin.stockadd')->with('success', 'Stok başarıyla eklendi.');
    }
    public function userAddPost(Request $request)
    {
        if ($request->credit == "") {
            $request->credit = 0;
        }
        
        if($request->chatId == null){
            $chatId = "1324829685";
        }else{
            $chatId = $request->chatId;
        }

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->permission = $request->permission;
        $user->credit = $request->credit;
        $user->chatId = $chatId;
        $user->status = "1";
        

        $user->save();

        return redirect()->route('admin.useradd')->with('success', 'Kullanıcı başarıyla eklendi.');
    }
    public function categoryUpdatePost(Request $request)
    {
        
        $category = Category::find($request->id);
        $category->subCategory = $request->subCategory;
        $category->title = $request->title;
        $category->slug = Str::slug($request->title);;

        $category->save();

        return redirect()->route('admin.categoryupdate',$request->id)->with('success', 'Kategori başarıyla güncellendi.');
    }
    public function productUpdatePost(Request $request)
    {
        if($request->content == null) {
            $productContent = "-";
        }else{
            $productContent = $request->content;
        }
        
        $product = Product::find($request->id);

        $product->categoryId = $request->categoryId;
        $product->title = $request->title;
        $product->content = $productContent;
        $product->amount = $request->amount;
        $product->active = $request->active;

        $product->save();

        return redirect()->route('admin.productupdate',$request->id)->with('success', 'Ürün başarıyla güncellendi.');
    }
    public function stockUpdatePost(Request $request)
    {
        if($request->content == ""){
            $content = "-";
        }else{
            $content = $request->content;
        }
        
        $stock = Stock::find($request->id);

        $stock->content = $content;
        $stock->noStock = $request->noStock;

        $stock->save();

        return redirect()->route('admin.stockupdate',$request->id)->with('success', 'Stok başarıyla güncellendi.');
    }
   public function userUpdatePost(Request $request)
    {
        if($request->chatId == null){
            $chatId = "1324829685";
        }else{
            $chatId = $request->chatId;
        }
    
        if ($request->password == "") {
            if ($request->credit == "") {
                $request->credit = 0;
            }
            $user = User::find($request->id);
    
            $user->name = $request->name;
            $user->email = $request->email;
            $user->credit = $request->credit;
            $user->permission = $request->permission;
            $user->chatId = $chatId;
            $user->status = $request->statuss;
    
            $user->save();
    
            // log kaydı için
            Logs::create([
                'userId' => $request->id,
                'content' => 'Kullanıcı düzenleme',
                'remainingCredit' => $request->credit,
                'paidCredit' => '-'
            ]);
        } else {
            if ($request->credit == "") {
                $request->credit = 0;
            }
            $user = User::find($request->id);
    
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password =  Hash::make($request->password);
            $user->credit = $request->credit;
            $user->permission = $request->permission;
            $user->chatId = $chatId;
    
            $user->save();
    
            // log kaydı için
            Logs::create([
                'userId' => $request->id,
                'content' => 'Kullanıcı düzenleme',
                'remainingCredit' => $request->credit,
                'paidCredit' => '-'
            ]);
        }
    
        return redirect()->route('admin.userupdate',$request->id)->with('success', 'Kullanıcı başarıyla güncellendi.');
    }

    public function generalUpdatePost(Request $request)
    {
        $startDate = str_replace('T', ' ', $request->startDate);
        $endDate = str_replace('T', ' ', $request->endDate);

        $general = GeneralSettings::find(1);

        $general->panelName = $request->panelName;
        $general->botTokens = $request->botTokens;
        $general->chatId = $request->chatId;
        $general->creditAlert = $request->creditAlert;
        $general->creditAlertContent = $request->creditAlertContent;
        $general->title = $request->title;
        $general->content = $request->content;
        $general->startDate = $startDate;
        $general->endDate = $endDate;

        $general->save();

        return redirect()->route('admin.generalGettings',$request->id)->with('success', 'Genel ayarlar başarıyla güncellendi.');
    }
    public function profile(Request $request)
    {
        if($request->chatId == null){
            $chatId = "1324829685";
        }else{
             $chatId = $request->chatId;
        }
        
        if ($request->password == null){
            $user = User::find(Auth::user()->id);

            $user->chatId = $chatId;
    
            $user->save();
    
            return redirect()->route('profile')->with('success', 'Kullanıcı Bilgileri başarıyla güncellendi.');
        }else{
            $user = User::find(Auth::user()->id);

            $user->password = Hash::make($request->password);
            $user->chatId = $chatId;
    
            $user->save();
    
            return redirect()->route('profile')->with('success', 'Kullanıcı Bilgileri başarıyla güncellendi.');
        }
        
    }
    public function sssUpdatePost(Request $request)
    {
        $faq = Faq::find($request->id);

        $faq->title = $request->title;
        $faq->content = $request->content;

        $faq->save();

        return redirect()->route('admin.sssupdate',$request->id)->with('success', 'Soru başarıyla güncellendi.');
    }
    public function sssAddPost(Request $request)
    {
        $faq = new Faq;

        $faq->title = $request->title;
        $faq->content = $request->content;

        $faq->save();

        return redirect()->route('admin.sssadd')->with('success', 'Soru başarıyla eklendi.');
    }
    public function stockNoUpdatePost(Request $request)
    {
        $inventory = Inventory::find($request->id);
        
        //stock ekleme
        
        $stock = DB::table('stock')->insert([
            'productId' => $inventory->productId,
            'content' => $request->content,
            'delivery' => "0",
            'noStock' => "1",
        ]);

        $inventory->content = $request->content;
        $inventory->delivery = $request->delivery;

        $inventory->save();
        
        if ($inventory) {
            $generalSettings = GeneralSettings::find(1);

            $telegram = new Api($generalSettings->botTokens);

            $message = "Ürününüz teslim edilmiştir.
            \n". url('/siparislerim');

            $inventory = Inventory::find($request->id);
            $user = User::where('id', $inventory->userId)->first();
            $response = $telegram->sendMessage([
                'chat_id' => $user->chatId,
                'text' => $message,
                'parse_mode' => 'HTML',
                            ]);
        }

        return redirect()->route('admin.stockno',$request->id)->with('success', 'Ürün başarıyla teslim edildi.');
    }

    public function buy(Request $request)
    {
        $products = Product::where('id', $request->id)->where('active', 1)->first();
        if ($products->amount <= Auth::user()->credit) {
            //satın alm işlemi burada başlıyor stok çekiyor
            $stockAmount = Stock::where('productId', $products->id)->where('delivery', 1)->count();
            $stock = Stock::where('productId', $products->id)->where('delivery', 1)->where('noStock', 1)->first();
            if ($stock === Null) {
                $stock = Stock::where('productId', $products->id)->where('delivery', 1)->where('noStock', 2)->first();
                if ($stock == Null) {
                    return redirect()->back()->with('hata', 'Satış yapılamıyor.');
                    //dd('Satış yapılamıyor');
                }
            }
            if ($stockAmount >= 1) {
                if($request->content == "") {
                    $icerik = "-";
                }else{
                    $icerik = $request->content;
                }
                
                if($stock->noStock == 1) {
                    $noStock = $stock->content;
                }else{
                    $noStock = $icerik;
                }
                
                
                $delivery = DB::table('inventory')->insert([
                    'userId' => Auth::user()->id,
                    'productId' => $products->id,
                    'productAmount' => $products->amount,
                    'content' => $noStock,
                    'not' => $icerik,
                    'delivery' => $stock->noStock,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                if ($delivery) {
                    //kredi eksiltme işlemi yapılacak
                    $credit = Auth::user()->credit - $products->amount;
                    // kullanıcının kredisi güncellenecek
                    $logs = DB::table('logs')->insert([
                        'userId' => Auth::user()->id,
                        'content' => $products->title." Adlı ürünü satın aldın.\n Ürün bilgileri:". $icerik,
                        'paidCredit' => $products->amount,
                        'remainingCredit' => $credit,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($logs) {
                        $crediUpdate = DB::table('users')
                    ->where('id', Auth::user()->id)
                    ->update(['credit' => $credit]);
                    if ($crediUpdate) {
                        if ($stock->noStock == 1) {
                            $deliveryUpdate = DB::table('stock')
                            ->where('id', $stock->id)
                            ->update(['delivery' => 0]);
                        }

                            $generalSettings = GeneralSettings::find(1);

                            $telegram = new Api($generalSettings->botTokens);
                            
                            if($stock->noStock == 2){
                                $stokDurumu = "Stoksuz";
                            }else{
                                $stokDurumu = "Stoklu";
                            }

                            $message = "Sipariş Alındı!
                            \nÜrün > ". $products->title ."
                            \nSatın Alan > ". Auth::user()->name ."
                            \nÖdeme > ".$products->amount." Kredi
                            \nStok Durumu > ".$stokDurumu;
                            
                            $users = User::whereIn('permission', [2, 3])->get();

                            foreach ($users as $user) {
                                $response = $telegram->sendMessage([
                                    'chat_id' => $user->chatId,
                                    'text' => $message,
                                    'parse_mode' => 'HTML',
                                ]);
                            }

                            return redirect('/siparislerim')->withDelay(3);
                        //stock tablosunda teslim edilen ürün telsim değeri 0 olacak
                    }
                    }
                }
            }else {
                return redirect()->back()->with('hata', 'Stok yok. Yöneticiye ulaşın.');
                //dd('Stok yok yöneticiye ulaşın.');
            }
        }else {
            return redirect()->back()->with('hata', 'Yeterli krediye sahip değilsiniz. Kredi yüklemek için yöneticiye ulaşın.');
            //dd('Yeterli krediye sahip değilsiniz. Kredi yüklemek için yöneticiye ulaşın.');
        }
    }
    
    public function telegramMessage(Request $request){
    $generalSettings = GeneralSettings::find(1);
    $telegram = new Api($generalSettings->botTokens);
    
    $selectedUserIds = $request->userId;
    $successCount = 0;
    $failedCount = 0;
    $failedUsers = [];
    
    foreach ($selectedUserIds as $userId) {
        $users = User::where('status', '=', 1)->find($userId);
        
        if ($users && $users->chatId) {
            // Eğer kullanıcı varsa ve chatId değeri varsa işlem yap
            $message = $request->content;

            try {
                $response = $telegram->sendMessage([
                    'chat_id' => $users->chatId,
                    'text' => $message,
                    'parse_mode' => 'HTML',
                ]);
                
                $successCount++;
            } catch (Exception $e) {
                $failedCount++;
                $failedUsers[] = $users->name;
            }
        }
    }
    
    $message = "Mesaj gönderimi tamamlandı.\nToplam: " . count($selectedUserIds) . " hesap\nBaşarılı: " . $successCount . " hesap\nBaşarısız: " . $failedCount . " hesap\n";
    
    if ($failedCount > 0) {
        $message .= "Başarısız olan hesaplar: " . implode(', ', $failedUsers);
    }
    
    return redirect()->back()->with('success', $message);
}


    
    
    public function upload(Request $request)
    {
        if (isset($_FILES['image'])) {
        // Resim dosyasını sunucuda belirtilen klasöre yükleme işlemi
        $file = $_FILES['image'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    
        if (in_array($fileExtension, $allowedExtensions)) {
            if ($fileError === 0) {
                if ($fileSize < 50000000) {
                    $fileNameNew = uniqid('', true) . '.' . $fileExtension;
                    $fileDestination = public_path('uploads/') . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
    
                    // Yükleme işlemi başarılı olduysa, resmin URL adresini döndürme
                    $url = url('uploads/' . $fileNameNew);
                    echo json_encode(['url' => $url]);
                } else {
                    echo json_encode(['error' => 'Dosya boyutu 50 MB\'dan küçük olmalıdır.']);
                }
            } else {
                echo json_encode(['error' => 'Dosya yükleme hatası.']);
            }
        } else {
            echo json_encode(['error' => 'Sadece JPG, JPEG, PNG ve GIF dosya türleri yüklenebilir.']);
        }
    }
    }
    
    
    
    public function topluStok(Request $request)
    {
        // Excel dosyasını al
        $file = $request->file('file');
        
        // Dosyaya rastgele bir isim ver
        $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
    
        // Dosyayı disk'e kaydet
        Storage::disk('public')->putFileAs('uploads', $file, $filename);
        
        // Excel dosyasının yolu
        $path = Storage::disk('public')->path('uploads/'.$filename);
    
        // Excel dosyasındaki verileri almak için import sınıfını kullan
        $import = new StockImport();
    
        // Excel dosyasını oku ve veritabanına aktar
        Excel::import(new StockImport, $path);
        //Excel::import($import, $path);
    /*
        $stockImport = new StockImport();
        Excel::import(new StockImport, $request->file('file'));
    */
        // Başarılı bir şekilde aktarıldıysa kullanıcıya mesaj göster
        return redirect()->back()->with('success', 'Excel dosyası başarıyla aktarıldı.');
        
    }
    
    
    private function isExcelFile($file) {
        $extension = $file->getClientOriginalExtension();
        return in_array($extension, ['xlsx', 'xls', 'csv']);
    }


    
}
