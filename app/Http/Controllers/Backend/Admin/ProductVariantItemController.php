<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($product_id, $variant_id)
    {
        $product = Product::findOrFail($product_id);
        $variant = ProductVariant::findOrFail($variant_id);
        return view('admin.product.variant-item.index', compact('product', 'variant'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(string $product_id, string $variant_id)
    {
        $variant = ProductVariant::findOrFail($variant_id);
        $product = Product::findOrFail($product_id);

        return view('admin.product.variant-item.create', compact('product', 'variant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'variant_id' => ['integer', 'required'],
                'name' => ['required', 'max:255'],
                'price' => ['required', 'numeric', 'min:0'],
                'is_default' => ['required'],
                'status' => ['required'],
            ],
            [
                'name.required' => 'Vui lòng nhập tên.',
                'name.max' => 'Nhập tối đa 255 ký tự.',
                'price.required' => 'Vui lòng nhập giá.',
                'price.min' => 'Vui lòng nhập giá > 0.',
                'is_default.required' => 'Vui lòng chọn mặc định có hoặc không.',
                'status.required' => 'Vui lòng chọn trạng thái hoạt động.',
            ]
        );

        $variant_item = new ProductVariantItem();
        $variant_item->variant_id = $request->variant_id;
        $variant_item->name = $request->name;
        $variant_item->price = $request->price;
        $variant_item->is_default = $request->is_default;
        $variant_item->status = $request->status;
        $variant_item->save();

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
    public function edit(string $variant_item_id)
    {

        $variant_item = ProductVariantItem::findOrFail($variant_item_id);
        return view('admin.product.variant-item.edit', compact('variant_item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $variant_item_id)
    {

        $request->validate(
            [
                'name' => ['required', 'max:255'],
                'price' => ['required', 'numeric', 'min:0'],
                'is_default' => ['required'],
                'status' => ['required'],
            ],
            [
                'name.required' => 'Vui lòng nhập tên.',
                'name.max' => 'Nhập tối đa 255 ký tự.',
                'price.required' => 'Vui lòng giá.',
                'price.min' => 'Vui lòng nhập giá > 0.',
                'is_default.required' => 'Vui lòng chọn mặc định có hoặc không.',
                'status.required' => 'Vui lòng chọn trạng thái hoạt động.',
            ]
        );

        $variant_item =  ProductVariantItem::findOrFail($variant_item_id);
        $variant_item->name = $request->name;
        $variant_item->price = $request->price;
        $variant_item->is_default = $request->is_default;
        $variant_item->status = $request->status;
        $variant_item->save();

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->route('admin.product-variant-item.index', ["product_id" => $variant_item->variant->product_id, "variant_id" => $variant_item->variant_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $variant_item_id)
    {
        $variant_item =  ProductVariantItem::findOrFail($variant_item_id);
        $variant_item->delete();

        return response(['status' => 'success', 'message' => 'Xóa thành công dữ liệu']);
    }

    public function changeStatus(Request $request)
    {
        $variant_item = ProductVariantItem::findOrFail($request->id);
        $variant_item->status = $request->status == 'true' ? 1 : 0;
        $variant_item->save();

        if ($variant_item->status == 1) {
            return response(['message' => 'Hiển thị chi tiết thuộc tính']);
        } else if ($variant_item->status == 0) {
            return response(['message' => 'Ẩn chi tiết thuộc tính']);
        }
    }
}
