<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductMultiImage;
use App\Traits\HandlerImage;
use Illuminate\Http\Request;
// use Yajra\DataTables\DataTables;

class ProductMultiImageController extends Controller
{
    use HandlerImage;
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        return view('admin.product.multi-image.index', compact('product'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'image' => ['required'],
                'image.*' => ['image'],
            ],
            [
                'image.required' => 'Vui lòng chọn ảnh.',
                'image.*.image' => 'Vui lòng chọn đúng định dạng file ảnh.',
            ]
        );

        $array_image_paths = $this->uploadMultiImage($request, 'image', 'uploads/product/multi-product', 202, 202);
        foreach ($array_image_paths as $key => $path) {
            $product_multi_image = new ProductMultiImage();
            $product_multi_image->image = $path;
            $product_multi_image->product_id = $request->product_id;
            $product_multi_image->save();
        }

        toastr()->success('Tải lên thành công!', ' ');
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product_image = ProductMultiImage::findOrFail($id);

        //delete image in folder public/uploads/product/multi-image
        $this->deleteImage($product_image->image);

        $product_image->delete();

        return response(['status' => 'success', 'message' => 'Xóa thành công dữ liệu']);
    }
}
