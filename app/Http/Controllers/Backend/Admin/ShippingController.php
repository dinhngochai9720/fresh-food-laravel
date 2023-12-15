<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shippings = Shipping::latest()->get();
        return view('admin.shipping.index', compact('shippings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shipping.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'max:255'],
                'type' => ['required'],
                'min_order' => ['nullable', 'numeric', "min:0"],
                'cost' => ['required', 'numeric', 'min:0'],
                'status' => ['required'],
            ],
            [
                'name.required' => 'Vui lòng nhập tên phương thức vận chuyển',
                'name.max' => 'Nhập tối đa 255 ký tự.',
                'type.required' => 'Vui lòng chọn loại phương thức vận chuyển.',
                'min_order.min' => 'Vui lòng nhập đơn hàng tối thiểu > 0.',
                'cost.required' => 'Vui lòng nhập chi phí.',
                'cost.min' => 'Vui lòng nhập chi phí > 0.',
                'status.required' => 'Vui lòng chọn trạng thái hoạt động.',

            ]
        );

        $shipping = new Shipping();
        $shipping->name = $request->name;
        $shipping->type = $request->type;
        $shipping->min_order = $request->min_order;
        $shipping->cost = $request->cost;
        $shipping->status = $request->status;
        $shipping->save();


        toastr()->success('Thêm mới thành công!', ' ');
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
        $shipping = Shipping::findOrFail($id);

        return view('admin.shipping.edit', compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name' => ['required', 'max:255'],
                'type' => ['required'],
                'min_order' => ['nullable', 'numeric', "min:0"],
                'cost' => ['required', 'numeric', 'min:0'],
                'status' => ['required'],
            ],
            [
                'name.required' => 'Vui lòng nhập tên phương thức vận chuyển',
                'name.max' => 'Nhập tối đa 255 ký tự.',
                'type.required' => 'Vui lòng chọn loại phương thức vận chuyển.',
                'min_order.min' => 'Vui lòng nhập đơn hàng tối thiểu > 0.',
                'cost.required' => 'Vui lòng nhập chi phí.',
                'cost.min' => 'Vui lòng nhập chi phí > 0.',
                'status.required' => 'Vui lòng chọn trạng thái hoạt động.',

            ]
        );

        $shipping =  Shipping::findOrFail($id);
        $shipping->name = $request->name;
        $shipping->type = $request->type;
        $shipping->min_order = $request->min_order;
        $shipping->cost = $request->cost;
        $shipping->status = $request->status;
        $shipping->save();


        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->route('admin.shipping.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $shipping = Shipping::findOrFail($id);

        $shipping->delete();

        return response(['status' => 'success', 'message' => 'Xóa thành công dữ liệu']);
    }

    public function changeStatus(Request $request)
    {
        $shipping = Shipping::findOrFail($request->id);
        $shipping->status = $request->status == 'true' ? 1 : 0;
        $shipping->save();

        if ($shipping->status == 1) {
            return response(['message' => 'Hiển thị phương thức vận chuyển']);
        } else if ($shipping->status == 0) {
            return response(['message' => 'Ẩn phương thức vận chuyển']);
        }
    }
}
