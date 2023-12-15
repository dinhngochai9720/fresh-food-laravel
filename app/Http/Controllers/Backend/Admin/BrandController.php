<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Traits\HandlerImage;
use Illuminate\Http\Request;
use Str;


class BrandController extends Controller
{
    use HandlerImage;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'logo' => ['required', 'image'],
                'name' => ['required', 'max:255'],
                'is_featured' => ['required'],
                'status' => ['required'],
            ],
            [
                'logo.required' => 'Vui lòng chọn ảnh.',
                'logo.image' => 'Vui lòng chọn lại đúng định dạng file ảnh.',
                'name.required' => 'Vui lòng nhập tên thương hiệu.',
                'name.max' => 'Nhập tối đa 255 ký tự.',
                'is_featured.required' => 'Vui lòng chọn nổi bật có hoặc không.',
                'status.required' => 'Vui lòng chọn trạng thái hoạt động.',
            ]
        );

        $brand = new Brand();

        // Handle file image upload
        $image_path = $this->uploadImage($request, 'logo', 'uploads/brand', 196, 98);

        $brand->logo = $image_path;
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;
        $brand->save();

        toastr()->success('Thêm mới thành công!', ' ');
        return redirect()->route('admin.brand.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'logo' => ['image'],
                'name' => ['required', 'max:255'],
                'is_featured' => ['required'],
                'status' => ['required'],
            ],
            [
                'logo.image' => 'Vui lòng chọn lại đúng định dạng file ảnh.',
                'name.required' => 'Vui lòng nhập tên thương hiệu.',
                'name.max' => 'Nhập tối đa 255 ký tự.',
                'is_featured.required' => 'Vui lòng chọn nổi bật có hoặc không.',
                'status.required' => 'Vui lòng chọn trạng thái hoạt động.',
            ]
        );



        $brand = Brand::findOrFail($id);

        // Handle file image upload
        $image_path = $this->updateImage($request, 'logo', 'uploads/brand', 196, 98, $brand->logo);

        $brand->logo = !empty($image_path) ? $image_path : $brand->logo;
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;
        $brand->save();

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);

        // count products of brand 
        $products = Product::where('brand_id', $brand->id)->count();

        if ($products > 0) {
            return response(['status' => 'error', 'message' => 'Vui lòng xóa các sản phẩm thuộc thương hiệu này trước khi thực hiện xóa']);
        }

        $this->deleteImage($brand->logo);
        $brand->delete();

        return response(['status' => 'success', 'message' => 'Xóa thành công dữ liệu']);
    }

    public function changeStatus(Request $request)
    {
        $brand = Brand::findOrFail($request->id);
        $brand->status = $request->status == 'true' ? 1 : 0;
        $brand->save();

        if ($brand->status == 1) {
            return response(['message' => 'Hiển thị thương hiệu']);
        } else if ($brand->status == 0) {
            return response(['message' => 'Ẩn thương hiệu']);
        }
    }
}
