<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DanhmucController extends Controller
{
    public function addDanhmuc(Request $request)
    {
        dd($request->all());
    }
}
