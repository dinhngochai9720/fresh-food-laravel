<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\HandlerImage;
use Illuminate\Http\Request;
use Str;

class CategoryController extends Controller
{
    use HandlerImage;

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image'],
            'name' => ['required', 'max:255', 'unique:categories,name'],
            'status' => ['required'],
        ], [
            'image.required' => 'Vui lòng chọn ảnh',
            'image.image' => 'Vui lòng chọn lại đúng định dạng file ảnh',
            'name.required' => 'Vui lòng nhập tên.',
            'name.max' => 'Nhập tối đa 255 ký tự.',
            'name.unique' => 'Tên danh mục đã tồn tại.',
            'btn_url.url' => 'Vui lòng nhập đúng giá trị url.',
            'status.required' => 'Vui lòng chọn trạng thái hoat động.',
        ]);

        $category = new Category();

        // Handle file image upload
        $image_path = $this->uploadImage($request, 'image', 'uploads/category', 30, 30);

        $category->image = $image_path;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;
        $category->save();

        toastr()->success('Thêm mới thành công!', ' ');
        return redirect()->back();
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
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['image'],
            'name' => ['required', 'max:255', 'unique:categories,name,' . $id],
            'status' => ['required'],
        ], [
            'image.image' => 'Vui lòng chọn lại đúng định dạng file ảnh.',
            'name.required' => 'Vui lòng nhập tên.',
            'name.unique' => 'Tên danh mục đã tồn tại.',
            'btn_url.url' => 'Vui lòng nhập đúng giá trị url.',
            'status.required' => 'Vui lòng chọn trạng thái hoat động.',
        ]);

        $category =  Category::findOrFail($id);

        // Handle file image upload
        $image_path = $this->updateImage($request, 'image', 'uploads/category', 30, 30, $category->image);

        $category->image = !empty($image_path) ? $image_path : $category->image;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;
        $category->save();

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // count products of category 
        $products = Product::where('category_id', $category->id)->count();

        if ($products > 0) {
            return response(['status' => 'error', 'message' => 'Vui lòng xóa các sản phẩm thuộc danh mục này trước khi thực hiện xóa']);
        }

        $this->deleteImage($category->image);
        $category->delete();
        return response(['status' => 'success', 'message' => 'Xóa thành công dữ liệu']);
    }

    public function changeStatus(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        if ($category->status == 1) {
            return response(['message' => 'Hiển thị danh mục']);
        } else if ($category->status == 0) {
            return response(['message' => 'Ẩn danh mục']);
        }
    }
}
