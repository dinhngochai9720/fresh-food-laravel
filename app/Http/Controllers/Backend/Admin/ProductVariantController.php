<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        return view('admin.product.variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        return view('admin.product.variant.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'product_id' => ['integer', 'required'],
                'name' => ['required', 'max:255'],
                'status' => ['required'],
            ],
            [
                'name.required' => 'Vui lòng nhập tên.',
                'name.max' => 'Nhập tối đa 255 ký tự.',
                'status.required' => 'Vui lòng chọn trạng thái hoạt động.',
            ]
        );

        $variant = new ProductVariant();
        $variant->product_id = $request->product_id;
        $variant->name = $request->name;
        $variant->status = $request->status;
        $variant->save();

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

        $variant = ProductVariant::findOrFail($id);
        return view('admin.product.variant.edit', compact('variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name' => ['required', 'max:255'],
                'status' => ['required'],
            ],
            [
                'name.required' => 'Vui lòng nhập tên.',
                'name.max' => 'Nhập tối đa 255 ký tự.',
                'status.required' => 'Vui lòng chọn trạng thái hoạt động.',
            ]
        );

        $variant =  ProductVariant::findOrFail($id);
        $variant->name = $request->name;
        $variant->status = $request->status;
        $variant->save();

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->route('admin.product-variant.index', ['product_id' => $variant->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variant = ProductVariant::findOrFail($id);

        $variant->delete();
        return response(['status' => 'success', 'message' => 'Xóa thành công dữ liệu']);
    }

    public function changeStatus(Request $request)
    {
        $variant = ProductVariant::findOrFail($request->id);
        $variant->status = $request->status == 'true' ? 1 : 0;
        $variant->save();

        if ($variant->status == 1) {
            return response(['message' => 'Hiển thị thuộc tính']);
        } else if ($variant->status == 0) {
            return response(['message' => 'Ẩn thuộc tính']);
        }
    }
}
