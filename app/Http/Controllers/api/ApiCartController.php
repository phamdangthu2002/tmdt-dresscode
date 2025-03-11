<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Chitietgiohang;
use App\Models\Giohang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiCartController extends Controller
{
    public function addTocart(Request $request)
    {
        try {
            $user_id = $request->user_id;
            $san_pham_id = $request->san_pham_id;
            $so_luong = $request->so_luong;
            $size_id = $request->size_id;
            $color_id = $request->color_id;
            $gia = $request->gia_goc;

            // Kiểm tra xem user đã có giỏ hàng chưa
            $giohang = Giohang::where('user_id', $user_id)->first();

            if (!$giohang) {
                // Nếu chưa có giỏ hàng thì tạo mới
                $giohang = Giohang::create([
                    'user_id' => $user_id,
                    'ngay_them' => Carbon::now(),
                ]);
            }

            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            $ctgh = Chitietgiohang::where([
                'gio_hang_id' => $giohang->id,
                'san_pham_id' => $san_pham_id,
                'size_id' => $size_id,
                'color_id' => $color_id,
            ])->first();

            if ($ctgh) {
                // Nếu đã có sản phẩm, thì chỉ cập nhật số lượng
                $ctgh->so_luong += $so_luong;
                $ctgh->save();
            } else {
                // Nếu chưa có, thì thêm sản phẩm mới vào giỏ hàng
                Chitietgiohang::create([
                    'gio_hang_id' => $giohang->id,
                    'san_pham_id' => $san_pham_id,
                    'so_luong' => $so_luong,
                    'size_id' => $size_id,
                    'color_id' => $color_id,
                    'gia' => $gia,
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Sản phẩm đã được thêm vào giỏ hàng',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lỗi khi thêm vào giỏ hàng: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getGiohang($id)
    {
        $giohang = Giohang::where('user_id', $id)->first();
        if (!$giohang) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không tìm thấy giỏ hàng',
            ], 404);
        }
        $chitietgiohang = Chitietgiohang::where('gio_hang_id', $giohang->id)->with(['sanpham', 'size', 'color'])->get();
        return response()->json([
            'status' => 'success',
            'data' => $chitietgiohang,
        ]);
    }

    public function countCart($id)
    {
        $giohang = Giohang::where('user_id', $id)->first();
        if (!$giohang) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không tìm thấy giỏ hàng',
            ], 404);
        }
        $chitietgiohang = Chitietgiohang::where('gio_hang_id', $giohang->id)->count();
        return response()->json([
            'status' => 'success',
            'data' => $chitietgiohang,
        ]);
    }

}
