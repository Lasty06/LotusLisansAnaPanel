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



class ApiController extends Controller
{

}
