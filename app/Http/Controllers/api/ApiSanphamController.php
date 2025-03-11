<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Anh;
use App\Models\Sanpham;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiSanphamController extends Controller
{
    public function addSanpham(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'tensp' => 'required',
                'danh_muc_id' => 'required',
                'gia_goc' => 'required|numeric|min:0',
                'gia_km_phan_tram' => 'required|numeric|between:0,90',
                'color_id' => 'required',
                'anhsp' => 'required|array|min:1', // 🛠 Đảm bảo là mảng và có ít nhất 1 ảnh
            ],
            [
                'tensp.required' => 'Tên sản phẩm không được để trống',
                'danh_muc_id.required' => 'Vui lòng chọn danh mục',
                'gia_goc.required' => 'Giá gốc không được để trống',
                'gia_goc.numeric' => 'Giá gốc phải là số',
                'gia_goc.min' => 'Giá gốc phải lớn hơn 0',
                'gia_km_phan_tram.required' => 'Giá khuyến mãi không được để trống',
                'gia_km_phan_tram.numeric' => 'Giá khuyến mãi phải là số',
                'gia_km_phan_tram.between' => 'Giá khuyến mãi phải lớn hơn 0 và nhỏ hơn 90',
                'color_id.required' => 'Vui lòng chọn màu sắc',
                'anhsp.required' => 'Ảnh sản phẩm không được để trống',
                'anhsp.array' => 'Ảnh phải là danh sách',
                'anhsp.min' => 'Cần ít nhất một ảnh',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction(); // 🔄 Bắt đầu transaction

            // 🛠 Tạo sản phẩm
            $sanpham = Sanpham::create([
                'tensp' => $request->tensp,
                'slug' => Str::slug($request->tensp),
                'danh_muc_id' => $request->danh_muc_id,
                'color_id' => $request->color_id,
                'mo_ta' => $request->mo_ta,
                'mota_chitiet' => $request->mota_chitiet,
                'gia_goc' => $request->gia_goc,
                'gia_km_phan_tram' => $request->gia_km_phan_tram,
                'anhsp' => $request->anhsp[0], // Lấy ảnh đầu tiên làm ảnh đại diện
                'trang_thai' => "active",
            ]);

            if (!$sanpham->id) {
                throw new \Exception("Không thể tạo sản phẩm");
            }
            // 🖼 Lưu từng ảnh vào bảng `anhs`
            foreach ($request->anhsp as $anh) {
                Anh::create([
                    'san_pham_id' => $sanpham->id, // ✅ Đảm bảo có `sanpham_id`
                    'url_anh' => $anh,
                ]);
            }

            DB::commit(); // ✅ Lưu vào database

            return response()->json([
                'message' => 'Sản phẩm đã thêm thành công!',
                'sanpham' => $sanpham,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack(); // ❌ Hoàn tác nếu có lỗi
            return response()->json([
                'error' => 'Lỗi khi thêm sản phẩm: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function loadSanpham()
    {
        $sanpham = Sanpham::paginate(10);
        return response()->json(['data' => $sanpham], 200);
    }
    public function loadSanphamID($id)
    {
        $sanpham = Sanpham::with(['anhs', 'color'])->where('id', $id)->firstOrFail();
        return response()->json(['data' => $sanpham], 200);
    }
    public function loadSanphamHome()
    {
        $sanpham = Sanpham::with(['anhs', 'color'])->paginate(4);
        return response()->json(['data' => $sanpham], 200);
    }

    public function loadSanphamDanhmuc($id)
    {
        $sanpham = Sanpham::with(['anhs', 'color'])
            ->where('danh_muc_id', $id)
            ->limit(4) // Lấy 4 sản phẩm
            ->get();

        return response()->json(['data' => $sanpham], 200);
    }

    public function loadSanphamRandom()
    {
        // Lấy 4 sản phẩm ngẫu nhiên
        $sanpham = Sanpham::with(['anhs', 'color'])->inRandomOrder()->limit(4)->get();

        // Kiểm tra nếu không có sản phẩm nào
        if ($sanpham->isEmpty()) {
            return response()->json(['message' => 'Không có sản phẩm nào'], 404);
        }

        return response()->json(['data' => $sanpham], 200);
    }



    public function updateSanpham(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'tensp' => 'required',
                'danh_muc_id' => 'required',
                'gia_goc' => 'required|numeric|min:0',
                'gia_km_phan_tram' => 'required|numeric|between:0,90',
                'anhsp' => 'required|min:1', // 🛠 Đảm bảo là mảng và có ít nhất 1 ảnh
            ],
            [
                'tensp.required' => 'Tên sản phẩm không được để trống',
                'danh_muc_id.required' => 'Vui lòng chọn danh mục',
                'gia_goc.required' => 'Giá gốc không được để trống',
                'gia_goc.numeric' => 'Giá gốc phải là số',
                'gia_goc.min' => 'Giá gốc phải lớn hơn 0',
                'gia_km_phan_tram.required' => 'Giá khuyến mãi không được để trống',
                'gia_km_phan_tram.numeric' => 'Giá khuyến mãi phải là số',
                'gia_km_phan_tram.between' => 'Giá khuyến mãi phải lớn hơn 0 và nhỏ hơn 90',
                'anhsp.required' => 'Ảnh sản phẩm không được để trống',
                'anhsp.min' => 'Cần ít nhất một ảnh',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $sanpham = Sanpham::find($id);
        if (!$sanpham) {
            return response()->json(['error' => 'Sản phẩm không tồn tại'], 404);
        }
        $sanpham->update([
            'tensp' => $request->tensp,
            'danh_muc_id' => $request->danh_muc_id,
            'gia_goc' => $request->gia_goc,
            'gia_km_phan_tram' => $request->gia_km_phan_tram,
            'anhsp' => $request->filled('anhsp_edit') ? $request->anhsp_edit : $sanpham->anhsp,
            'mo_ta' => $request->mo_ta,
            'mota_chitiet' => $request->mota_chitiet,
            'trang_thai' => "active",
            'updated_at' => Carbon::now(),
        ]);
        return response()->json([
            'message' => 'Danh mục đã được cập nhật thành công!',
            'data' => $sanpham
        ], 200);
    }

    public function deleteSanpham($id)
    {
        $sanpham = Sanpham::find($id);
        if (!$sanpham) {
            return response()->json(['error' => 'Sản phẩm không tồn tại'], 404);
        }
        $sanpham->delete();
        return response()->json([
            'message' => 'Sản phẩm đã được xóa thành công!'
        ], 200);
    }
}