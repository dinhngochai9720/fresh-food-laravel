<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use App\Traits\HandlerImage;

class AdvertisementController extends Controller
{
    use HandlerImage;

    public function index()
    {
        $home_page_banner_one = Advertisement::where('key', 'home_page_banner_one')->first();
        // $home_page_banner_one = json_decode($home_page_banner_one->value, true); //true is covert  to array
        $home_page_banner_one = json_decode($home_page_banner_one->value);


        $home_page_banner_two = Advertisement::where('key', 'home_page_banner_two')->first();
        $home_page_banner_two = json_decode($home_page_banner_two->value);

        $home_page_banner_three = Advertisement::where('key', 'home_page_banner_three')->first();
        $home_page_banner_three = json_decode($home_page_banner_three->value);

        $home_page_banner_four = Advertisement::where('key', 'home_page_banner_four')->first();
        $home_page_banner_four = json_decode($home_page_banner_four->value);

        $product_page_banner = Advertisement::where('key', 'product_page_banner')->first();
        $product_page_banner = json_decode($product_page_banner->value);

        $cart_page_banner = Advertisement::where('key', 'cart_page_banner')->first();
        $cart_page_banner = json_decode($cart_page_banner->value);

        return view('admin.advertisement.index', compact('home_page_banner_one', 'home_page_banner_two', 'home_page_banner_three', 'home_page_banner_four', 'product_page_banner', 'cart_page_banner'));
    }

    public function homePageBannerOne(Request $request)
    {
        $request->validate(
            [
                'image' => ['image'],
                'url' => ['required', 'url'],
                'status' => ['required'],
            ],
            [
                'image.image' => 'Vui lòng chọn lại đúng định dạng file ảnh.',
                'url.required' => 'Vui lòng nhập url.',
                'url.url' => 'Vui lòng nhập đúng đường link.',
                'status.required' => 'Vui lòng chọn trạng thái hoạt động.',
            ]
        );

        $image_path = $this->updateImage($request, 'image', 'uploads/banner', 1296, 150);

        $value = [
            'banner_one' => [
                'url' => $request->url,
                'status' => $request->status
            ]
        ];

        if (!empty($image_path)) {
            $value['banner_one']['image'] = $image_path;
        } else {
            $value['banner_one']['image'] = $request->old_image;
        }

        $value = json_encode($value);

        Advertisement::updateOrCreate(
            ['key' => 'home_page_banner_one'],
            ['value' => $value]
        );

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->back();
    }

    public function homePageBannerTwo(Request $request)
    {
        $request->validate(
            [
                'image_one' => ['image'],
                'url_one' => ['required', 'url'],
                'status_one' => ['required'],

                'image_two' => ['image'],
                'url_two' => ['required', 'url'],
                'status_two' => ['required'],
            ],
            [
                'image_one.image' => 'Vui lòng chọn lại đúng định dạng file ảnh.',
                'url_one.required' => 'Vui lòng nhập url.',
                'url_one.url' => 'Vui lòng nhập đúng đường link.',
                'status_one.required' => 'Vui lòng chọn trạng thái hoạt động.',

                'image_two.image' => 'Vui lòng chọn lại đúng định dạng file ảnh.',
                'url_two.required' => 'Vui lòng nhập url.',
                'url_two.url' => 'Vui lòng nhập đúng đường link.',
                'status_two.required' => 'Vui lòng chọn trạng thái hoạt động.',
            ]
        );

        $image_path_one = $this->updateImage($request, 'image_one', 'uploads/banner', 636, 270);
        $image_path_two = $this->updateImage($request, 'image_two', 'uploads/banner', 636, 270);

        $value = [
            'banner_one' => [
                'url_one' => $request->url_one,
                'status_one' => $request->status_one,
            ],
            'banner_two' => [
                'url_two' => $request->url_two,
                'status_two' => $request->status_two
            ]
        ];

        // image_one
        if (!empty($image_path_one)) {
            $value['banner_one']['image_one'] = $image_path_one;
        } else {
            $value['banner_one']['image_one'] = $request->old_image_one;
        }

        // image_two
        if (!empty($image_path_two)) {
            $value['banner_two']['image_two'] = $image_path_two;
        } else {
            $value['banner_two']['image_two'] = $request->old_image_two;
        }

        $value = json_encode($value);

        Advertisement::updateOrCreate(
            ['key' => 'home_page_banner_two'],
            ['value' => $value]
        );

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->back();
    }

    public function homePageBannerThree(Request $request)
    {
        $request->validate(
            [
                'image_one' => ['image'],
                'url_one' => ['required', 'url'],
                'status_one' => ['required'],

                'image_two' => ['image'],
                'url_two' => ['required', 'url'],
                'status_two' => ['required'],

                'image_three' => ['image'],
                'url_three' => ['required', 'url'],
                'status_three' => ['required'],
            ],
            [
                'image_one.image' => 'Vui lòng chọn lại đúng định dạng file ảnh.',
                'url_one.required' => 'Vui lòng nhập url.',
                'url_one.url' => 'Vui lòng nhập đúng đường link.',
                'status_one.required' => 'Vui lòng chọn trạng thái hoạt động.',

                'image_two.image' => 'Vui lòng chọn lại đúng định dạng file ảnh.',
                'url_two.required' => 'Vui lòng nhập url.',
                'url_two.url' => 'Vui lòng nhập đúng đường link.',
                'status_two.required' => 'Vui lòng chọn trạng thái hoạt động.',

                'image_three.image' => 'Vui lòng chọn lại đúng định dạng file ảnh.',
                'url_three.required' => 'Vui lòng nhập url.',
                'url_three.url' => 'Vui lòng nhập đúng đường link.',
                'status_three.required' => 'Vui lòng chọn trạng thái hoạt động.',
            ]
        );

        $image_path_one = $this->updateImage($request, 'image_one', 'uploads/banner', 624, 565);
        $image_path_two = $this->updateImage($request, 'image_two', 'uploads/banner', 624, 270);
        $image_path_three = $this->updateImage($request, 'image_three', 'uploads/banner', 624, 270);

        $value = [
            'banner_one' => [
                'url_one' => $request->url_one,
                'status_one' => $request->status_one,
            ],
            'banner_two' => [
                'url_two' => $request->url_two,
                'status_two' => $request->status_two
            ],
            'banner_three' => [
                'url_three' => $request->url_three,
                'status_three' => $request->status_three
            ]
        ];

        // image_one
        if (!empty($image_path_one)) {
            $value['banner_one']['image_one'] = $image_path_one;
        } else {
            $value['banner_one']['image_one'] = $request->old_image_one;
        }

        // image_two
        if (!empty($image_path_two)) {
            $value['banner_two']['image_two'] = $image_path_two;
        } else {
            $value['banner_two']['image_two'] = $request->old_image_two;
        }

        // image_three
        if (!empty($image_path_three)) {
            $value['banner_three']['image_three'] = $image_path_three;
        } else {
            $value['banner_three']['image_three'] = $request->old_image_three;
        }

        $value = json_encode($value);

        Advertisement::updateOrCreate(
            ['key' => 'home_page_banner_three'],
            ['value' => $value]
        );

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->back();
    }

    public function homePageBannerFour(Request $request)
    {
        $request->validate(
            [
                'image' => ['image'],
                'url' => ['required', 'url'],
                'status' => ['required'],
            ],
            [
                'image.image' => 'Vui lòng chọn lại đúng định dạng file ảnh.',
                'required' => 'Vui lòng nhập url.',
                'url' => 'Vui lòng nhập đúng đường link.',
                'status.required' => 'Vui lòng chọn trạng thái hoạt động.',
            ]
        );

        $image_path = $this->updateImage($request, 'image', 'uploads/banner', 1650, 380);

        $value = [
            'banner_one' => [
                'url' => $request->url,
                'status' => $request->status
            ]
        ];

        if (!empty($image_path)) {
            $value['banner_one']['image'] = $image_path;
        } else {
            $value['banner_one']['image'] = $request->old_image;
        }

        $value = json_encode($value);

        Advertisement::updateOrCreate(
            ['key' => 'home_page_banner_four'],
            ['value' => $value]
        );

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->back();
    }


    public function productPageBanner(Request $request)
    {
        $request->validate(
            [
                'image' => ['image'],
                'url' => ['required', 'url'],
                'status' => ['required'],
            ],
            [
                'image.image' => 'Vui lòng chọn lại đúng định dạng file ảnh.',
                'url.required' => 'Vui lòng nhập url.',
                'url.url' => 'Vui lòng nhập đúng đường link.',
                'status.required' => 'Vui lòng chọn trạng thái hoạt động.',
            ]
        );

        $image_path = $this->updateImage($request, 'image', 'uploads/banner', 1296, 314);

        $value = [
            'banner_one' => [
                'url' => $request->url,
                'status' => $request->status
            ]
        ];

        if (!empty($image_path)) {
            $value['banner_one']['image'] = $image_path;
        } else {
            $value['banner_one']['image'] = $request->old_image;
        }

        $value = json_encode($value);

        Advertisement::updateOrCreate(
            ['key' => 'product_page_banner'],
            ['value' => $value]
        );

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->back();
    }

    public function cartPageBanner(Request $request)
    {
        $request->validate(
            [
                'image_one' => ['image'],
                'url_one' => ['required', 'url'],
                'status_one' => ['required'],

                'image_two' => ['image'],
                'url_two' => ['required', 'url'],
                'status_two' => ['required'],
            ],
            [
                'image_one.image' => 'Vui lòng chọn lại đúng định dạng file ảnh.',
                'url_one.required' => 'Vui lòng nhập url.',
                'url_one.url' => 'Vui lòng nhập đúng đường link.',
                'status_one.required' => 'Vui lòng chọn trạng thái hoạt động.',

                'image_two.image' => 'Vui lòng chọn lại đúng định dạng file ảnh.',
                'url_two.required' => 'Vui lòng nhập url.',
                'url_two.url' => 'Vui lòng nhập đúng đường link.',
                'status_two.required' => 'Vui lòng chọn trạng thái hoạt động.',
            ]
        );

        $image_path_one = $this->updateImage($request, 'image_one', 'uploads/banner', 636, 270);
        $image_path_two = $this->updateImage($request, 'image_two', 'uploads/banner', 636, 270);

        $value = [
            'banner_one' => [
                'url_one' => $request->url_one,
                'status_one' => $request->status_one,
            ],
            'banner_two' => [
                'url_two' => $request->url_two,
                'status_two' => $request->status_two
            ]
        ];

        // image_one
        if (!empty($image_path_one)) {
            $value['banner_one']['image_one'] = $image_path_one;
        } else {
            $value['banner_one']['image_one'] = $request->old_image_one;
        }

        // image_two
        if (!empty($image_path_two)) {
            $value['banner_two']['image_two'] = $image_path_two;
        } else {
            $value['banner_two']['image_two'] = $request->old_image_two;
        }

        $value = json_encode($value);

        Advertisement::updateOrCreate(
            ['key' => 'cart_page_banner'],
            ['value' => $value]
        );

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->back();
    }
}
