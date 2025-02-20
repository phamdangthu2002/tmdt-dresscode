<?php

namespace App\Http\Controllers\admin\sanpham;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SanphamController extends Controller
{
    public function index()
    {
        return view('admin.san-pham.index');
    }
}
