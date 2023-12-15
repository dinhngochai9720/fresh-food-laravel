<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\FlashSaleItem;
use App\Models\Product;
use App\Models\ProductMultiImage;
use App\Models\ProductVariant;
use App\Models\SubCategory;
use App\Traits\HandlerImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class ProductController extends Controller
{
    use HandlerImage;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('vendor_id', Auth::user()->vendor->id)->orderBy('id', 'DESC')->get();
        return view('vendor.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('vendor.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'thumbnail_image' => ['required', 'image'],
                'name' => ['required', 'max:255'],
                'category_id' => ['required'],
                'brand_id' => ['required'],
                'price' => ['required', 'numeric', 'min:0'],
                'offer_price' => ['nullable', 'numeric', 'min:0'],
                'quantity' => ['required', 'integer', 'min:0'],
                'short_description' => ['required', 'max:1024'],
                'long_description' => ['required'],
                'seo_title' => ['nullable', 'max:255'],
                'seo_description' => ['nullable', 'max:255'],
                'status' => ['required'],
                // 'offer_start_date' => ['after_or_equal:today'],
                // 'offer_end_date' => ['after_or_equal:today'],
            ],
            [
                'thumbnail_image.required' => 'Vui lòng chọn ảnh',
                'thumbnail_image.image' => 'Vui lòng chọn lại đúng định dạng file ảnh',
                'name.required' => 'Vui lòng nhập tên sản phẩm.',
                'name.max' => 'Nhập tối đa 255 ký tự.',
                'category_id.required' => 'Vui lòng chọn danh mục.',
                'brand_id.required' => 'Vui lòng chọn thương hiệu.',
                'price.required' => 'Vui lòng nhập giá.',
                'price.min' => 'Vui lòng nhập giá > 0.',
                'offer_price.min' => 'Vui lòng nhập giá ưu đãi > 0.',
                'quantity.min' => 'Vui lòng nhập số lượng > 0.',
                'quantity.required' => 'Vui lòng nhập số lượng.',
                'short_description.required' => 'Vui lòng nhập mô tả ngắn.',
                'short_description.max' => 'Nhập tối đa 1024 ký tự.',
                'long_description.required' => 'Vui lòng nhập mô tả chi tiết.',
                'seo_title.max' => 'Nhập tối đa 255 ký tự.',
                'seo_description.max' => 'Nhập tối đa 255 ký tự.',
                'status.required' => 'Vui lòng chọn trạng thái hoat động.',
                // 'offer_start_date.after_or_equal' => 'Vui lòng chọn ngày lớn hơn hoặc bằng ngày hiện tại.',
                // 'offer_end_date.after_or_equal' => 'Vui lòng chọn ngày lớn hơn hoặc bằng ngày hiện tại.',
            ]
        );

        $product = new Product();

        // Handle file image upload
        $image_path = $this->uploadImage($request, 'thumbnail_image', 'uploads/product', 306, 290);

        $product->thumbnail_image = $image_path;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->child_category_id = $request->child_category_id;
        $product->brand_id = $request->brand_id;
        $product->quantity = $request->quantity;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->is_approved = 0;
        $product->status = $request->status;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;



        $product->save();

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
        $product = Product::findOrFail($id);

        // check product is not vendor created -> do no access
        if ($product->vendor_id !== Auth::user()->vendor->id) {
            abort(404);
        }
        $categories = Category::all();
        $sub_categories = SubCategory::where('category_id', $product->category_id)->get();
        $child_categories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        $brands = Brand::all();

        return view('vendor.product.edit', compact('product', 'categories', 'brands', 'sub_categories', 'child_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'thumbnail_image' => ['nullable', 'image'],
                'name' => ['required', 'max:255'],
                'category_id' => ['required'],
                'brand_id' => ['required'],
                'price' => ['required', 'numeric', 'min:0'],
                'offer_price' => ['nullable', 'numeric', 'min:0'],
                'quantity' => ['required', 'integer', 'min:0'],
                'short_description' => ['required', 'max:1024'],
                'long_description' => ['required'],
                'seo_title' => ['nullable', 'max:255'],
                'seo_description' => ['nullable', 'max:255'],
                'status' => ['required'],
                // 'offer_start_date' => ['after_or_equal:today'],
                // 'offer_end_date' => ['after_or_equal:today'],
            ],
            [
                'thumbnail_image.image' => 'Vui lòng chọn lại đúng định dạng file ảnh',
                'name.required' => 'Vui lòng nhập tên sản phẩm.',
                'name.max' => 'Nhập tối đa 255 ký tự.',
                'category_id.required' => 'Vui lòng chọn danh mục.',
                'brand_id.required' => 'Vui lòng chọn thương hiệu.',
                'price.required' => 'Vui lòng nhập giá.',
                'price.min' => 'Vui lòng nhập giá > 0.',
                'offer_price.min' => 'Vui lòng nhập giá ưu đãi > 0.',
                'quantity.min' => 'Vui lòng nhập số lượng > 0.',
                'quantity.required' => 'Vui lòng nhập số lượng.',
                'short_description.required' => 'Vui lòng nhập mô tả ngắn.',
                'short_description.max' => 'Nhập tối đa 1024 ký tự.',
                'long_description.required' => 'Vui lòng nhập mô tả chi tiết.',
                'seo_title.max' => 'Nhập tối đa 255 ký tự.',
                'seo_description.max' => 'Nhập tối đa 255 ký tự.',
                'status.required' => 'Vui lòng chọn trạng thái hoat động.',
                // 'offer_start_date.after_or_equal' => 'Vui lòng chọn ngày lớn hơn hoặc bằng ngày hiện tại.',
                // 'offer_end_date.after_or_equal' => 'Vui lòng chọn ngày lớn hơn hoặc bằng ngày hiện tại.',
            ]
        );

        $product = Product::findOrFail($id);

        // product is not vendor created -> do no update
        if ($product->vendor_id !== Auth::user()->vendor->id) {
            abort(404);
        }

        // Handle file image upload
        $image_path = $this->updateImage($request, 'thumbnail_image', 'uploads/product', 306, 290, $product->thumbnail_image);

        $product->thumbnail_image = !empty($image_path) ? $image_path : $product->thumbnail_image;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->child_category_id = $request->child_category_id;
        $product->brand_id = $request->brand_id;
        $product->quantity = $request->quantity;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->is_approved =  $product->is_approved;
        $product->status = $request->status;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;

        $product->save();

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->route('vendor.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $multi_images_product = ProductMultiImage::where('product_id', $product->id)->get();

        // product is not vendor created -> do not destroy
        if ($product->vendor_id !== Auth::user()->vendor->id) {
            abort(404);
        }

        // delete main image in public/uploads/product folder
        $this->deleteImage($product->thumbnail_image);

        //delete multi images
        foreach ($multi_images_product as $key => $image) {
            //delete multi images in public/uploads/product/multi-product folder
            $this->deleteImage($image->image);
        }

        $product->delete();

        return response(['status' => 'success', 'message' => 'Xóa thành công dữ liệu']);
    }

    public function getSubCategories(Request $request)
    {
        //  $request->id is id of category get in ajax request
        $sub_categories = SubCategory::where('category_id', $request->id)->where('status', 1)->get();
        return $sub_categories;
    }

    public function getChildCategories(Request $request)
    {
        //  $request->id is id of sub category get in ajax request
        $child_categories = ChildCategory::where('sub_category_id', $request->id)->where('status', 1)->get();
        return $child_categories;
    }

    public function changeStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->status = $request->status == 'true' ? 1 : 0;
        $product->save();

        if ($product->status == 1) {
            return response(['message' => 'Hiển thị sản phẩm']);
        } else if ($product->status == 0) {
            return response(['message' => 'Ẩn sản phẩm']);
        }
    }
}
