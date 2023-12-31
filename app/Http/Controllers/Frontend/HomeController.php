<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Brand;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\HomePageSetting;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Slider;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index()
    {
        $orders = Order::where('payment_status', 1)->where('status', 'delivered')->get();
        $products = Product::where(['is_approved' => 1, 'status' => 1])->get();
        $sliders = Slider::where('status', 1)->orderBy('serial', 'asc')->orderBy('id', 'DESC')->get();
        $flash_sale_date = FlashSale::first();
        $flash_sale_items = FlashSaleItem::where('show_home_page', 1)->where('status', 1)->orderBy('id', 'DESC')->take(8)->get();
        $brands = Brand::where('status', 1)->where('is_featured', 1)->take(8)->orderBy('id', 'DESC')->get();

        $featured_category = HomePageSetting::where('key', 'featured_category',)->first();

        $type_products = ['new_arrival', 'best_product', 'top_product'];

        $new_arrival_products = Product::where(['is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(4)->get();

        $best_products = Product::with('reviews')
            ->withAvg('reviews', 'rating')
            ->whereHas('reviews', function ($query) {
                $query->where('status', 1);
            })
            ->having('reviews_avg_rating', '>', 0) // Filter out products without reviews (reviews_avg_rating là cột tạm thời do withAvg tạo ra)
            ->orderByDesc('reviews_avg_rating')
            ->limit(4)
            ->get();

        $top_products = Product::select('products.*', DB::raw('SUM(order_details.product_qty) as total_sold'))
            ->join('order_details', 'products.id', '=', 'order_details.product_id')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->where('orders.status', 'delivered')
            ->where('orders.payment_status',  1)
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->limit(4)
            ->get();

        // $top_products = Product::select('products.id', 'products.name', 'products.slug', 'products.category_id', 'products.thumbnail_image', 'products.quantity', 'products.price', 'products.offer_price', DB::raw('SUM(order_details.product_qty) as total_sold'))
        //     ->join('order_details', 'products.id', '=', 'order_details.product_id')
        //     ->join('orders', 'order_details.order_id', '=', 'orders.id')
        //     ->where('orders.status', 'delivered')
        //     ->where('orders.payment_status',  1)
        //     ->groupBy('products.id') // Sử dụng tên bảng để nhóm theo id
        //     ->orderByDesc('total_sold')
        //     ->limit(4)
        //     ->get();


        $category_slider_one = HomePageSetting::where('key', 'category_slider_one',)->first();
        $category_slider_two = HomePageSetting::where('key', 'category_slider_two',)->first();
        $category_slider_three = HomePageSetting::where('key', 'category_slider_three',)->first();

        $home_page_banner_one = Advertisement::where('key', 'home_page_banner_one')->first();
        $home_page_banner_one = json_decode($home_page_banner_one->value);

        $home_page_banner_two = Advertisement::where('key', 'home_page_banner_two')->first();
        $home_page_banner_two = json_decode($home_page_banner_two->value);

        $home_page_banner_three = Advertisement::where('key', 'home_page_banner_three')->first();
        $home_page_banner_three = json_decode($home_page_banner_three->value);

        $home_page_banner_four = Advertisement::where('key', 'home_page_banner_four')->first();
        $home_page_banner_four = json_decode($home_page_banner_four->value);

        return view(
            'frontend.home.home',
            compact(
                'orders',
                'sliders',
                'flash_sale_date',
                'flash_sale_items',
                'featured_category',
                'brands',
                'products',
                'type_products',
                'new_arrival_products',
                'best_products',
                'top_products',
                'category_slider_one',
                'category_slider_two',
                'category_slider_three',
                'home_page_banner_one',
                'home_page_banner_two',
                'home_page_banner_three',
                'home_page_banner_four'
            )
        );
    }
}
