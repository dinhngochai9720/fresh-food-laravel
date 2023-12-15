<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\HomePageSetting;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class HomePageSettingController extends Controller
{
    public function index()
    {

        $categories = Category::where('status', 1)->orderBy('id', 'DESC')->get();

        $featured_category = HomePageSetting::where('key', 'featured_category')->first();
        $category_slider_one = HomePageSetting::where('key', 'category_slider_one')->first();
        $category_slider_two = HomePageSetting::where('key', 'category_slider_two')->first();
        $category_slider_three = HomePageSetting::where('key', 'category_slider_three')->first();
        return view('admin.home-page-setting.index', compact('categories', 'featured_category', 'category_slider_one', 'category_slider_two', 'category_slider_three'));
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

    public function updateFeaturedCategory(Request $request)
    {
        // dd($request->all());

        $request->validate(
            [
                'category_one' => ['required'],
                'category_two' => ['required'],
                'category_three' => ['required'],
                'category_four' => ['required'],

            ],
            [
                'category_one.required' => 'Vui lòng chọn danh mục.',
                'category_two.required' => 'Vui lòng chọn danh mục.',
                'category_three.required' => 'Vui lòng chọn danh mục.',
                'category_four.required' => 'Vui lòng chọn danh mục.',
            ]
        );

        $data = [
            [
                'category' => $request->category_one,
                'sub_category' => $request->sub_category_one,
                'child_category' => $request->child_category_one,
            ],

            [
                'category' => $request->category_two,
                'sub_category' => $request->sub_category_two,
                'child_category' => $request->child_category_two,
            ],


            [
                'category' => $request->category_three,
                'sub_category' => $request->sub_category_three,
                'child_category' => $request->child_category_three,
            ],

            [
                'category' => $request->category_four,
                'sub_category' => $request->sub_category_four,
                'child_category' => $request->child_category_four,
            ],
        ];

        HomePageSetting::updateOrCreate(
            [
                'key' => 'featured_category',
            ],
            [
                'value' => json_encode($data),
            ]

        );

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->back();
    }

    public function updateCategorySliderOne(Request $request)
    {
        // dd($request->all());

        $request->validate(
            [
                'category' => ['required'],

            ],
            [
                'category.required' => 'Vui lòng chọn danh mục.',
            ]
        );

        $data = [
            [
                'category' => $request->category,
                'sub_category' => $request->sub_category,
                'child_category' => $request->child_category,
            ]
        ];

        HomePageSetting::updateOrCreate(
            [
                'key' => 'category_slider_one',
            ],
            [
                'value' => json_encode($data),
            ]

        );

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->back();
    }

    public function updateCategorySliderTwo(Request $request)
    {
        // dd($request->all());

        $request->validate(
            [
                'category' => ['required'],

            ],
            [
                'category.required' => 'Vui lòng chọn danh mục.',
            ]
        );

        $data = [
            [
                'category' => $request->category,
                'sub_category' => $request->sub_category,
                'child_category' => $request->child_category,
            ]
        ];

        HomePageSetting::updateOrCreate(
            [
                'key' => 'category_slider_two',
            ],
            [
                'value' => json_encode($data),
            ]

        );

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->back();
    }

    public function updateCategorySliderThree(Request $request)
    {
        // dd($request->all());

        $request->validate(
            [
                'category_one' => ['required'],
                'category_two' => ['required'],

            ],
            [
                'category_one.required' => 'Vui lòng chọn danh mục.',
                'category_two.required' => 'Vui lòng chọn danh mục.',
            ]
        );

        $data = [
            [
                'category' => $request->category_one,
                'sub_category' => $request->sub_category_one,
                'child_category' => $request->child_category_one,
            ],

            [
                'category' => $request->category_two,
                'sub_category' => $request->sub_category_two,
                'child_category' => $request->child_category_two,
            ],

        ];

        HomePageSetting::updateOrCreate(
            [
                'key' => 'category_slider_three',
            ],
            [
                'value' => json_encode($data),
            ]

        );

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->back();
    }
}
