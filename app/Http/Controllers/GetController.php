<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Category;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Stock;
use App\Models\Logs;
use App\Models\User;
use App\Models\GeneralSettings;
use Illuminate\Support\Facades\Auth;
use Telegram\Bot\Api;
use App\Models\IpLog;

class getController extends Controller
{
    
    public function siparisler()
    {
        $siparisler = DB::table('inventory')->paginate(500);
        return view('admin.siparisler', compact('siparisler'));
    }
    
    public function faq()
    {
        $faq = DB::table('faq')->get();
        return view('pages.faq', compact('faq'));
    }

    public function category()
    {
        $categorys = DB::table('category')->where('subCategory', 0)->get();
        return view('pages.category', compact('categorys'));
    }

    public function product($slug, $id)
    {
        $category = Category::where('id', $id)->where('slug', $slug)->first();
        $subCategorys = Category::where('subCategory', $id)->get();
        $id = $category->id;
        $products = Product::where('categoryId', $id)->where('active', 1)->get();
        return view('pages.product', compact('category', 'products', 'subCategorys'));
    }

    public function inventory()
    {
        $inventories = Inventory::where('userId', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('pages.inventory', compact('inventories'));
    }

    /*
    public function buy($id)
    {
        $products = Product::where('id', $id)->where('active', 1)->first();
        if ($products->amount <= Auth::user()->credit) {
            //satın alm işlemi burada başlıyor stok çekiyor
            $stockAmount = Stock::where('productId', $products->id)->where('delivery', 1)->count();
            $stock1 = Stock::where('productId', $products->id)->where('delivery', 1)->where('noStock', 1)->first();
            if ($stock1 === Null) {
                $stock = Stock::where('productId', $products->id)->where('delivery', 1)->where('noStock', 2)->first();
                if ($stock == Null) {
                    $stock = $stock1;
                }
            }
            if ($stockAmount >= 1) {
                $delivery = DB::table('inventory')->insert([
                    'userId' => Auth::user()->id,
                    'productId' => $products->id,
                    'productAmount' => $products->amount,
                    'content' => $stock->content,
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
                        'content' => $products->title." Adlı ürünü satın aldın. Kalan kredin ". $credit .". Ödenen kredi ". $products->amount,
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

                            $message = "Sipariş Alındı!
                            \nÜrün => ". $products->title ."
                            \nSatın Alan => ". Auth::user()->name ."
                            \nÖdeme => ".$products->amount." Kredi";

                            $response = $telegram->sendMessage([
                                'chat_id' => $generalSettings->chatId,
                                'text' => $message,
                                'parse_mode' => 'HTML',
                            ]);

                            return redirect('/envanter')->withDelay(3);
                        //stock tablosunda teslim edilen ürün telsim değeri 0 olacak
                    }
                    }
                }
            }else {
                dd('Stok yok yöneticiye ulaşın.');
            }
        }else {
            dd('Yeterli krediye sahip değilsiniz. Kredi yüklemek için yöneticiye ulaşın.');
        }
    }
    */

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/login');
        //route('login');
    }

    public function logs()
    {
        $logs = Logs::where('userId', Auth::user()->id )->get();
        return view('pages.logs', compact('logs'));
    }
    public function adminCategory()
    {
        $categorys = Category::get();
        return view('admin.category', compact('categorys'));
    }
    public function adminProduct()
    {
        $products = Product::get();
        return view('admin.product', compact('products'));
    }
    public function adminStock()
    {
        $stocks = Stock::where('delivery', 1)->get();
        return view('admin.stock', compact('stocks'));
    }
    public function adminUser()
    {
        $users = User::get();
        return view('admin.user', compact('users'));
    }
    public function categoryUpdate($id)
    {
        $category = Category::find($id);
        return view('admin.categoryUpdate', compact('category'));
    }
    public function productUpdate($id)
    {
        $product = Product::find($id);
        return view('admin.productUpdate', compact('product'));
    }
    public function stockUpdate($id)
    {
        $stock = Stock::find($id);
        return view('admin.stockUpdate', compact('stock'));
    }
    public function userUpdate($id)
    {
        $user = User::find($id);
        $logs = Logs::where('userId', $id )->get();
        $Iplogs = IpLog::where('userId', $user->email )->get();
        return view('admin.userUpdate', compact('user','logs','Iplogs'));
    }
    public function categoryDelete(Request $request)
    {
        if (Auth::user()->permission == 2) {

        $category = Category::find($request->id);
        $category->delete();

        return redirect()->route('admin.category')->with('success', 'Kategori başarıyla silindi.');
        }else {
            dd('Yetkisiz erişim');
        }
    }
    public function productDelete(Request $request)
    {
        if (Auth::user()->permission == 2) {
            
        $product = Product::find($request->id);
        $product->delete();

        return redirect()->route('admin.product')->with('success', 'Ürün başarıyla silindi.');
        }else {
            dd('Yetkisiz erişim');
        }
    }
    public function stockDelete(Request $request)
    {
        if (Auth::user()->permission == 2) {

        $stock = Stock::find($request->id);
        $stock->delete();
        
        return redirect()->route('admin.stock')->with('success', 'Stok başarıyla silindi.');
        }else {
            dd('Yetkisiz erişim');
        }
    }
    public function userDelete(Request $request)
    {
        if (Auth::user()->permission == 2) {
            
        $user = User::find($request->id);
        $user->delete();
        
        return redirect()->route('admin.user')->with('success', 'Kullanıcı başarıyla silindi.');
        }else {
            dd('Yetkisiz erişim');
        }
    }
    public function adminGeneralSettings()
    {
        $generalSettings = GeneralSettings::first();
        return view('admin.settings', compact('generalSettings'));
    }
    public function profile()
    {
        $profile = User::where('email', Auth::user()->email)->first();
        return view('pages.profile', compact('profile'));
    }
    public function adminSss()
    {
        $faqs = Faq::get();
        return view('admin.faq', compact('faqs'));
    }
    public function sssDelete(Request $request)
    {
        $faq = Faq::find($request->id);
        $faq->delete();
        
        return redirect()->route('admin.sss')->with('success', 'Soru başarıyla silindi.');
    }
    public function sssUpdate($id)
    {
        $faq = Faq::where('id', $id)->first();
        return view('admin.faqUpdate', compact('faq'));
    }
    public function adminStockNo()
    {
        $stocks = Inventory::where('delivery', 2)->get();
        return view('admin.stockNo', compact('stocks'));
    }
    public function stockNoCancel($id)
    {
    $inventory = Inventory::find($id);

    $inventory->delivery = "3";
    $inventory->save();

    if ($inventory) {
        $product = Product::find($inventory->productId);
        $user = User::find($inventory->userId);

        $generalSettings = GeneralSettings::find(1);

        $telegram = new Api($generalSettings->botTokens);

        $message = "Ürününüz iptal edilmiştir.\n" . url('/siparislerim');

        $response = $telegram->sendMessage([
            'chat_id' => $user->chatId,
            'text' => $message,
            'parse_mode' => 'HTML',
        ]);

        $user->credit += $product->amount; // Kullanıcının kredisini arttır
        $user->save();
    }
    
    Logs::create([
        'userId' => $user->id,
        'content' => 'İade',
        'remainingCredit' => $user->credit,
        'paidCredit' => '+'.$product->amount
    ]);

    return redirect()->back()->with('success', 'İade İşlemi Yapıldı');
    }
    public function backup()
    {
        // veritabanı bağlantısı
        $db = DB::connection()->getPdo();

        // tüm tabloları alalım
        $tables = DB::select('SHOW TABLES');

        // dosyaya yazdırılacak SQL sorguları
        $return = '';

        // tablolar içerisinde dönelim
        foreach ($tables as $table) {
            $table = get_object_vars($table);
            $table = $table[array_key_first($table)];

            $result = $db->query("SELECT * FROM $table");
            $numColumns = $result->columnCount();

            $result2 = $db->query("SHOW CREATE TABLE $table");
            $row2 = $result2->fetch();

            $return .= "\n\n".$row2[1].";\n\n";

            while ($row = $result->fetch()) {
                $return .= "INSERT INTO $table VALUES(";
                for ($j = 0; $j < $numColumns; $j++) {
                    $rowValue = $row[$j];
                    $rowValue = addslashes($rowValue);
                    $rowValue = str_replace("\n", "\\n", $rowValue);
                    if (isset($rowValue)) {
                        $return .= '"' . $rowValue . '"';
                    } else {
                        $return .= '""';
                    }
                    if ($j < ($numColumns-1)) {
                        $return .= ',';
                    }
                }
                $return .= ");\n";
            }

            $return .= "\n\n\n";
        }

        // dosyayı kaydedelim
        $filename = 'backups/db-backup-'.time().'.sql';
        if (Storage::put($filename, $return)) {
            echo "Sql yedeklendi storge/app/$filename";
        } else {
            echo "Sistemsel sorun";
        }
    }
    
    
    public function listBackups()
    {
        $files = Storage::files('backups');
        return view('admin.backups', compact('files'));
    }
    public function downloadBackup($file)
    {
        $path = Storage::path($file);
        return response()->download($path);
    }
    
    
    public function searchSiparisler(Request $request)
    {
        if($request->ajax())
        {
            $output = '';
            $query = $request->get('query');
            if ($query != '')
            {
                $data = Inventory::where('content', 'like', '%'.$query.'%')
                ->orWhere('amount', 'like', '%'.$query.'%')
                ->orWhere('not', 'like', '%'.$query.'%')
                ->orderBy('id', 'desc')
                ->get();
            }else{
                $data = Inventory::orderBy('id','desc')->get();
            }
            
            $total_row = $data->count();
            if($total_row > 0)
            {
                foreach($data as $row)
                {
                    $output = '
                    <tr>
                    <td>'. $row->amount .'</td>
                    <td>'. $row->content .'</td>
                    <td>'. $row->not .'</td>
                    </tr>
                    ';
                }
            }else{
                $output = '
                <tr>
                    <td align="center" colspan="5"> Veri Bulunamadı </td>
                </tr>
                ';
            }
            
            $data = array(
                'table_data' => $output,
                'total_data' => $total_row
            );
            
            echo json_encode($data);
            
        }
    }

    
}
