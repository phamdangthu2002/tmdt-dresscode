<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('user.san-pham.index');
    }

    public function detail()
    {
        return view('user.san-pham.detail');
    }
}
