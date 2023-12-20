<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showProductDetail(string $slug, $id)
    {
        $orders = Order::where('payment_status', 1)->where('status', 'delivered')->get();

        $reviews = ProductReview::where('product_id', $id)->where('status', 1)->orderBy('id', 'DESC')->paginate(5);

        $product = Product::with(['vendor', 'category', 'images', 'variants', 'brand'])->where('id', $id)->first();

        $related_products = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->orderBy('id', 'DESC')->limit(6)->get();

        return view('frontend.pages.product-detail', compact('product', 'reviews', 'orders', 'related_products'));
    }

    public function viewProducts(Request $request)
    {
        $orders = Order::where('payment_status', 1)->where('status', 'delivered')->get();

        $product_page_banner = Advertisement::where('key', 'product_page_banner')->first();
        $product_page_banner = json_decode($product_page_banner->value);

        $categories = Category::where('status', 1)->orderBy('name', 'ASC')->get();
        $brands = Brand::where('status', 1)->where('is_featured', 1)->take(8)->orderBy('id', 'DESC')->get();

        // find follow category
        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->first();
            $products = Product::where(['category_id' => $category->id, 'status' => 1, 'is_approved' => 1])
                ->when($request->has('price_range'), function ($query) use ($request) {
                    $price = explode(';', $request->price_range);
                    $min_price = $price[0];
                    $max_price = $price[1];

                    // get price (min_price <= price <= max_price)
                    return $query->where('price', '>=', $min_price)->where('price', '<=', $max_price);
                })
                ->orderBy('id', 'DESC')
                ->paginate(9);
        }
        // find follow sub category
        elseif ($request->has('sub_category')) {
            $category = SubCategory::where('slug', $request->sub_category)->first();
            $products = Product::where(['sub_category_id' => $category->id, 'status' => 1, 'is_approved' => 1])
                ->when($request->has('price_range'), function ($query) use ($request) {
                    $price = explode(';', $request->price_range);
                    $min_price = $price[0];
                    $max_price = $price[1];

                    // get price (min_price <= price <= max_price)
                    return $query->where('price', '>=', $min_price)->where('price', '<=', $max_price);
                })
                ->orderBy('id', 'DESC')->paginate(9);
        }
        // find follow child category
        elseif ($request->has('child_category')) {
            $category = ChildCategory::where('slug', $request->child_category)->first();
            $products = Product::where(['child_category_id' => $category->id, 'status' => 1, 'is_approved' => 1])
                ->when($request->has('price_range'), function ($query) use ($request) {
                    $price = explode(';', $request->price_range);
                    $min_price = $price[0];
                    $max_price = $price[1];

                    // get price (min_price <= price <= max_price)
                    return $query->where('price', '>=', $min_price)->where('price', '<=', $max_price);
                })
                ->orderBy('id', 'DESC')
                ->paginate(9);
        }
        // find follow brand
        elseif ($request->has('brand')) {
            $brand = Brand::where('slug', $request->brand)->first();
            $products = Product::where([
                "brand_id" => $brand->id,
                'status' => 1,
                'is_approved' => 1
            ])
                ->when($request->has('price_range'), function ($query) use ($request) {
                    $price = explode(';', $request->price_range);
                    $min_price = $price[0];
                    $max_price = $price[1];

                    // get price (min_price <= price <= max_price)
                    return $query->where('price', '>=', $min_price)->where('price', '<=', $max_price);
                })
                ->orderBy('id', 'DESC')
                ->paginate(9);
        }
        // find follow search...
        elseif ($request->has('search')) {
            $products = Product::where([
                'status' => 1,
                'is_approved' => 1
            ])->where(function ($query) use ($request) {
                // find follow name product
                $query->where('name', 'like', '%' . $request->search . '%')
                    // ->orWhere('long_description', 'like', '%' . $request->search . '%');

                    // find follow name category (category is relationship)
                    ->orWhereHas('category', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->search . '%');
                    })

                    // find follow name brand (brand is relationship)
                    ->orWhereHas('brand', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->search . '%');
                    });
            })
                ->orderBy('id', 'DESC')
                ->paginate(9);
        } else {
            $products = Product::where(['status' => 1, 'is_approved' => 1])
                ->orderBy('id', 'DESC')
                ->paginate(9);
        }
        return view('frontend.pages.product', compact('products', 'categories', 'brands', 'orders', 'product_page_banner'));
    }
}
