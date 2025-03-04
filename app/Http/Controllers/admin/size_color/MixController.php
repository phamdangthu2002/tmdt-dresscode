<?php

namespace App\Http\Controllers\admin\size_color;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MixController extends Controller
{
    public function indexSize()
    {
        $sizeid = null;
        $sizes = Size::paginate(5);
        return view('admin.size.index', [
            'sizes' => $sizes,
            'sizeid' => $sizeid
        ]);
    }

    public function addSize(Request $request)
    {
        $size = new Size();
        $size->name = $request->name;
        $size->slug = Str::slug($request->name);
        $size->save();
        return redirect()->back()->with('success', 'Size added successfully');
    }

    public function getSizeID(Request $request, $id)
    {
        $sizeid = Size::find($id);
        $sizes = Size::paginate(5);
        return view('admin.size.index', [
            'sizeid' => $sizeid,
            'sizes' => $sizes
        ]);
    }

    public function updateSize(Request $request, $id)
    {
        $size = Size::find($id);
        $size->name = $request->name;
        $size->slug = Str::slug($request->name);
        $size->save();
        return redirect()->back()->with('success', 'Size updated successfully');
    }

    public function deleteSize($id)
    {
        $size = Size::find($id);
        if ($size) {
            $size->delete();
            return redirect()->back()->with('success', 'Xóa size thành công!');
        }
        return redirect()->back()->with('error', 'Size không tồn tại!');
    }

    public function indexColor()
    {
        $colorid = null;
        $colors = Color::paginate(5);
        return view('admin.color.index', [
            'colors' => $colors,
            'colorid' => $colorid
        ]);
    }

    public function addColor(Request $request)
    {
        $color = new Color();
        $color->name = $request->name;
        $color->slug = Str::slug($request->name);
        $color->save();
        return redirect()->back()->with('success', 'Color added successfully');
    }

    public function getColorID($id)
    {
        $colorid = Color::find($id);
        $colors = Color::paginate(5);
        return view('admin.color.index', [
            'colors' => $colors,
            'colorid' => $colorid
        ]);
    }

    public function updateColor(Request $request, $id)
    {
        $color = Color::find($id);
        $color->name = $request->name;
        $color->slug = Str::slug($request->name);
        $color->save();
        return redirect()->back()->with('success', 'Color updated successfully');
    }

    public function deleteColor($id)
    {
        $color = Color::find($id);
        if ($color) {
            $color->delete();
            return redirect()->back()->with('success', 'Xóa color thành công!');
        }
        return redirect()->back()->with('error', 'Color không tồn tại!');
    }

    public function loadSize()
    {
        $sizes = Size::all();
        return response()->json([
            'sizes' => $sizes
        ], 200);
    }

    public function loadColor()
    {
        $colors = Color::all();
        return response()->json([
            'colors' => $colors
        ], 200);
    }
}
