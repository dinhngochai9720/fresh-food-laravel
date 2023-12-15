<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sub_categories = SubCategory::latest()->get();
        return view('admin.sub-category.index', compact('sub_categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => ['required'],
            'name' => ['required', 'max:255'],
            'status' => ['required'],
        ], [
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'name.required' => 'Vui lòng nhập tên.',
            'name.max' => 'Nhập tối đa 255 ký tự.',
            'status.required' => 'Vui lòng chọn trạng thái hoat động.',
        ]);

        $sub_category = new SubCategory();
        $sub_category->category_id = $request->category_id;
        $sub_category->name = $request->name;
        $sub_category->slug = Str::slug($request->name);
        $sub_category->status = $request->status;
        $sub_category->save();

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
        $categories = Category::all();
        $sub_category = SubCategory::findOrFail($id);
        return view('admin.sub-category.edit', compact('sub_category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => ['required'],
            'name' => ['required', 'max:255'],
            'status' => ['required'],
        ], [
            'category_id.required' => 'Vui lòng chọn danh mục cha.',
            'name.required' => 'Vui lòng nhập tên.',
            'name.max' => 'Nhập tối đa 255 ký tự.',
            'status.required' => 'Vui lòng chọn trạng thái hoat động.',
        ]);

        $sub_category =  SubCategory::findOrFail($id);
        $sub_category->category_id = $request->category_id;
        $sub_category->name = $request->name;
        $sub_category->slug = Str::slug($request->name);
        $sub_category->status = $request->status;
        $sub_category->save();

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->route('admin.sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sub_category = SubCategory::findOrFail($id);

        // count child categories of sub category 
        // $child_categories = ChildCategory::where('sub_category_id', $sub_category->id)->count();

        $products = Product::where('sub_category_id', $sub_category->id)->count();

        if ($products > 0) {
            return response(['status' => 'error', 'message' => 'Vui lòng xóa các sản phẩm thuộc danh mục con này trước khi thực hiện xóa']);
        }

        $sub_category->delete();
        return response(['status' => 'success', 'message' => 'Xóa thành công dữ liệu']);
    }

    public function changeStatus(Request $request)
    {
        $sub_category = SubCategory::findOrFail($request->id);
        $sub_category->status = $request->status == 'true' ? 1 : 0;
        $sub_category->save();

        if ($sub_category->status == 1) {
            return response(['message' => 'Hiển thị danh mục con']);
        } else if ($sub_category->status == 0) {
            return response(['message' => 'Ẩn danh mục con']);
        }
    }
}
