<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Danhmuc;
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

    public function search($keyword)
    {
        return view('user.tim-kiem.index', ['keyword' => $keyword]);
    }

    public function danhmuc($id)
    {
        $danhmuc = Danhmuc::find($id);
        return view('user.danh-muc.index', ['danhmuc' => $danhmuc]);
    }
}
