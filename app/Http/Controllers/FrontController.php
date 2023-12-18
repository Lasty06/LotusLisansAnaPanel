<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }
    public function login()
    {
        return view('pages.login');
    }
    public function faq()
    {
        return view('pages.faq');
    }
    public function adminIndex()
    {
        return view('admin.index');
    }
    public function categoryAdd()
    {
        return view('admin.categoryAdd');
    }
    public function productAdd()
    {
        return view('admin.productAdd');
    }
    public function stockAdd()
    {
        return view('admin.stockAdd');
    }
    public function userAdd()
    {
        return view('admin.userAdd');
    }
    public function sssAdd()
    {
        return view('admin.faqAdd');
    }
    public function fiyatListesi()
    {
        return view('pages.excel');
    }
    
    
}
