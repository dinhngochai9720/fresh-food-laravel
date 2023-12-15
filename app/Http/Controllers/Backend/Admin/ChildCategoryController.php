<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Str;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $child_categories = ChildCategory::latest()->get();
        return view('admin.child-category.index', compact('child_categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.child-category.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => ['required'],
            'sub_category_id' => ['required'],
            'name' => ['required', 'max:255'],
            'status' => ['required'],
        ], [
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'sub_category_id.required' => 'Vui lòng chọn danh mục con.',
            'name.required' => 'Vui lòng nhập tên.',
            'name.max' => 'Nhập tối đa 255 ký tự.',
            'status.required' => 'Vui lòng chọn trạng thái hoat động.',
        ]);

        $child_category = new ChildCategory();
        $child_category->category_id = $request->category_id;
        $child_category->sub_category_id = $request->sub_category_id;
        $child_category->name = $request->name;
        $child_category->slug = Str::slug($request->name);
        $child_category->status = $request->status;
        $child_category->save();

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
        $child_category = ChildCategory::findOrFail($id);
        $sub_categories = SubCategory::where('category_id', $child_category->category_id)->get();
        return view('admin.child-category.edit', compact('categories', 'sub_categories', 'child_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => ['required'],
            'sub_category_id' => ['required'],
            'name' => ['required', 'max:255'],
            'status' => ['required'],
        ], [
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'sub_category_id.required' => 'Vui lòng chọn danh mục con.',
            'name.required' => 'Vui lòng nhập tên.',
            'name.max' => 'Nhập tối đa 255 ký tự.',
            'status.required' => 'Vui lòng chọn trạng thái hoat động.',
        ]);

        $child_category =  ChildCategory::findOrFail($id);
        $child_category->category_id = $request->category_id;
        $child_category->sub_category_id = $request->sub_category_id;
        $child_category->name = $request->name;
        $child_category->slug = Str::slug($request->name);
        $child_category->status = $request->status;
        $child_category->save();

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->route('admin.child-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $child_category = ChildCategory::findOrFail($id);

        $products = Product::where('child_category_id', $child_category->id)->count();

        $home_page_settings = HomePageSetting::all();
        foreach ($home_page_settings as $key => $item) {
            $array = json_decode($item->value, true);
            $collection = collect($array);

            if ($collection->contains('child_category', $child_category->id)) {
                return response(['status' => 'error', 'message' => 'Vui lòng thay đổi danh mục con cấp 2 trong cài đặt giao diện trang chủ trước khi thực hiện xóa']);
            }
        }

        if ($products > 0) {
            return response(['status' => 'error', 'message' => 'Vui lòng xóa các sản phẩm thuộc danh mục con cấp 2 này trước khi thực hiện xóa']);
        }
        $child_category->delete();
        return response(['status' => 'success', 'message' => 'Xóa thành công dữ liệu']);
    }

    public function changeStatus(Request $request)
    {
        $child_category = ChildCategory::findOrFail($request->id);
        $child_category->status = $request->status == 'true' ? 1 : 0;
        $child_category->save();

        if ($child_category->status == 1) {
            return response(['message' => 'Hiển thị danh mục con cấp 2']);
        } else if ($child_category->status == 0) {
            return response(['message' => 'Ẩn danh mục con cấp 2']);
        }
    }

    public function getSubCategories(Request $request)
    {
        //  $request->id is id of category get in ajax request
        $sub_categories = SubCategory::where('category_id', $request->id)->where('status', 1)->get();
        return $sub_categories;
    }
}
