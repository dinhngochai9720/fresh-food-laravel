<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\HandlerImage;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use HandlerImage;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'banner' => ['required', 'image'],
                'type' => ['required', 'max:255'],
                'title' => ['required', 'max:255'],
                'starting_price' => ['nullable', 'numeric', "min:0"],
                'btn_url' => ['url'],
                'serial' => ['required', 'integer'],
                'status' => ['required'],
            ],
            [
                'banner.image' => 'Vui lòng chọn lại đúng định dạng file ảnh',
                'banner.required' => 'Vui lòng chọn ảnh.',
                'type.required' => 'Vui lòng nhập loại.',
                'title.required' => 'Vui lòng nhập tiêu đề.',
                'starting_price.min' => 'Vui lòng nhập giá khởi điểm > 0.',
                'btn_url.url' => 'Vui lòng nhập đúng đường link.',
                'serial.required' => 'Vui lòng nhập vị trí hiện thị.',
                'status.required' => 'Vui lòng chọn trạng thái hoạt động.',

            ]
        );

        $slider = new Slider();

        // Handle file image upload
        $imagePath = $this->uploadImage($request, 'banner', 'uploads/slider', 1300, 500);

        $slider->banner = $imagePath;
        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->starting_price = $request->starting_price;
        $slider->btn_url = $request->btn_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;
        $slider->save();

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
        $slider = Slider::findOrFail($id);

        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'banner' => ['nullable', 'image'],
                'type' => ['required', 'max:255'],
                'title' => ['required', 'max:255'],
                'starting_price' => ['nullable', 'numeric', "min:0"],
                'btn_url' => ['url'],
                'serial' => ['required', 'integer'],
                'status' => ['required'],
            ],
            [
                'banner.image' => 'Vui lòng chọn lại đúng định dạng file ảnh',
                'type.required' => 'Vui lòng nhập loại.',
                'title.required' => 'Vui lòng nhập tiêu đề.',
                'title.max' => 'Nhập tối đa 255 ký tự.',
                'starting_price.min' => 'Vui lòng nhập giá khởi điểm > 0.',
                'btn_url.url' => 'Vui lòng nhập đúng đường link.',
                'serial.required' => 'Vui lòng nhập vị trí hiện thị.',
                'status.required' => 'Vui lòng chọn trạng thái hoạt động.',

            ]
        );

        $slider = Slider::findOrFail($id);

        // Handle file image upload
        $imagePath = $this->updateImage($request, 'banner', 'uploads/slider', 1300, 500, $slider->banner);

        $slider->banner = !empty($imagePath) ? $imagePath : $slider->banner;
        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->starting_price = $request->starting_price;
        $slider->btn_url = $request->btn_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;
        $slider->save();

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->route('admin.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);

        $this->deleteImage($slider->banner);
        $slider->delete();

        return response(['status' => 'success', 'message' => 'Xóa thành công dữ liệu']);
    }

    public function changeStatus(Request $request)
    {
        $slider = Slider::findOrFail($request->id);
        $slider->status = $request->status == 'true' ? 1 : 0;
        $slider->save();

        if ($slider->status == 1) {
            return response(['message' => 'Hiển thị slider']);
        } else if ($slider->status == 0) {
            return response(['message' => 'Ẩn slider']);
        }
    }
}
