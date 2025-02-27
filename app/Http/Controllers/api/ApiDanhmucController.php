<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Danhmuc;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiDanhmucController extends Controller
{
    public function uploadFile(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $dateFolder = date('Y/m/d'); // Tạo thư mục theo ngày
            $fileName = time() . '_' . $file->getClientOriginalName(); // Tránh trùng tên

            // Lưu vào thư mục storage
            $filePath = $file->storeAs("public/uploads/$dateFolder", $fileName);
            $url = Storage::url(str_replace('public/', '', $filePath)); // Tạo URL truy cập

            return response()->json([
                'success' => true,
                'url' => $url,
                'message' => 'Upload thành công!'
            ]);
        }
        return response()->json(['error' => 'Không có file được tải lên!'], 400);
    }
    public function addDanhmuc(Request $request)
    {
        // dd($request->all());
        try {
            // Xác thực dữ liệu đầu vào
            $validator = Validator::make(
                $request->all(),
                [
                    'ten_danh_muc' => 'required|string|max:255|unique:danhmucs,ten_danh_muc',
                    'mo_ta' => 'nullable|string',
                    'trang_thai' => 'required|in:active,inactive',
                    'hinh_anh' => 'required', // Kiểm tra đường dẫn hợp lệ
                ],
                [
                    'ten_danh_muc.required' => 'Tên danh mục là bắt buộc.',
                    'ten_danh_muc.unique' => 'Tên danh mục đã tồn tại.',
                    'ten_danh_muc.string' => 'Tên danh mục phải là chuỗi.',
                    'ten_danh_muc.max' => 'Tên danh mục không được quá 255 ký tự.',
                    'trang_thai.required' => 'Trạng thái là bắt buộc.',
                    'trang_thai.in' => 'Trạng thái phải là "active" hoặc "inactive".',
                    'hinh_anh.required' => 'Hình ảnh là bắt buộc.',
                ]
            );

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            // Tạo danh mục và lưu vào DB
            $danhmuc = Danhmuc::create([
                'ten_danh_muc' => $request->ten_danh_muc,
                'mo_ta' => $request->mo_ta,
                'trang_thai' => $request->trang_thai,
                'hinh_anh' => $request->hinh_anh, // Lưu đường dẫn ảnh
                'danh_muc_id' => $request->danh_muc_id,
            ]);

            return response()->json([
                'message' => 'Danh mục đã được thêm thành công!',
                'data' => $danhmuc
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
        }
    }//add danh mục
    public function loadDanhmuc()
    {
        try {
            $danhmucs = Danhmuc::paginate(5); // Lấy danh sách danh mục theo trang
            return response()->json(['danhmucs' => $danhmucs], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
        }
    }// Load danh mục

    public function loadParent()
    {
        try {
            $parent_id = Danhmuc::select('danh_muc_id', 'id', 'ten_danh_muc')->get(); // Lấy danh sách danh mục theo trang
            return response()->json(['parent_id' => $parent_id], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
        }
    }// Load danh mục

    public function updateDanhmuc(Request $request, $id)
    {
        // dd($request->all());
        try {
            $validator = Validator::make($request->all(), [
                'ten_danh_muc' => 'required|string|max:255|unique:danhmucs',
                'mo_ta' => 'required|string',
                'trang_thai' => 'required|in:active,inactive',
                'hinh_anh' => 'required',
            ], [
                'ten_danh_muc.required' => 'Tên danh mục là bắt buộc.',
                'ten_danh_muc.string' => 'Tên danh mục phải là chuỗi.',
                'ten_danh_muc.max' => 'Tên danh mục không được quá 255 ký tự.',
                'ten_danh_muc.unique' => 'Tên danh mục đã tồn tại.',
                'trang_thai.required' => 'Trạng thái là bắt buộc.',
                'trang_thai.in' => 'Trạng thái phải là "active" hoặc "inactive".',
                'hinh_anh.required' => 'Hình ảnh là bắt buộc.',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 422);
            }
            $danhmuc = Danhmuc::find($id);
            if (!$danhmuc) {
                return response()->json(['error' => 'Không tìm thấy danh mục!'], 404);
            }
            $danhmuc->update([
                'ten_danh_muc' => $request->ten_danh_muc,
                'mo_ta' => $request->mo_ta,
                'trang_thai' => $request->trang_thai,
                'hinh_anh' => $request->filled('hinh_anh_edit') ? $request->hinh_anh_edit : $danhmuc->hinh_anh,
                'danh_muc_id' => $request->danh_muc_id,
            ]);
            return response()->json([
                'message' => 'Danh mục đã được cập nhật thành công!',
                'data' => $danhmuc
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
        }
    }

    public function deleteDanhmuc($id)
    {
        // dd($id);
        try {
            $danhmuc = Danhmuc::find($id);
            if (!$danhmuc) {
                return response()->json(['error' => 'Không tìm thấy danh mục!'], 404);
            }
            $danhmuc->delete();
            return response()->json(['message' => 'Danh mục đã được xóa thành công!'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
        }
    }
}
