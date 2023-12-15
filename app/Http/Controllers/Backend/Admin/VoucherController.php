<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $vouchers = Voucher::latest()->get();
        return view('admin.voucher.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'code' => ['required', 'max:255'],
            'quantity' => ['required', 'integer', 'min:0'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'voucher_type' => ['required'],
            'discount' => ['required', 'numeric', 'min:0'],
            'status' => ['required'],

        ], [
            'name.required' => 'Vui lòng nhập tên',
            'name.max' => 'Nhập tối đa 255 ký tự',
            'code.required' => 'Vui lòng nhập mã code',
            'code.max' => 'Nhập tối đa 255 ký tự',
            'quantity.required' => 'Vui lòng nhập số lượng',
            'quantity.min' => 'Vui lòng nhập số lượng > 0',
            'start_date.required' => 'Vui lòng chọn ngày bắt đầu',
            'end_date.required' => 'Vui lòng chọn ngày kết thúc',
            'voucher_type.required' => 'Vui lòng chọn loại voucher',
            'discount.required' => 'Vui lòng nhập giá trị',
            'discount.min' => 'Vui lòng nhập giá trị > 0',
            'status.required' => 'Vui lòng chọn trạng thái',

        ]);

        $voucher = new Voucher();
        $voucher->name = $request->name;
        $voucher->code = $request->code;
        $voucher->quantity = $request->quantity;
        $voucher->start_date = $request->start_date;
        $voucher->end_date = $request->end_date;
        $voucher->voucher_type = $request->voucher_type;
        $voucher->discount = $request->discount;
        $voucher->status = $request->status;
        $voucher->save();


        // Use yoeunes/toastr laravel
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
        //
        $voucher = Voucher::findOrFail($id);
        return view('admin.voucher.edit', compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'code' => ['required', 'max:255'],
            'quantity' => ['required', 'integer', 'min:0'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'voucher_type' => ['required'],
            'discount' => ['required', 'numeric', 'min:0'],
            'status' => ['required'],

        ], [
            'name.required' => 'Vui lòng nhập tên',
            'name.max' => 'Nhập tối đa 255 ký tự',
            'code.required' => 'Vui lòng nhập mã code',
            'code.max' => 'Nhập tối đa 255 ký tự',
            'quantity.required' => 'Vui lòng nhập số lượng',
            'quantity.min' => 'Vui lòng nhập số lượng > 0',
            'start_date.required' => 'Vui lòng chọn ngày bắt đầu',
            'end_date.required' => 'Vui lòng chọn ngày kết thúc',
            'voucher_type.required' => 'Vui lòng chọn loại voucher',
            'discount.required' => 'Vui lòng nhập giá trị',
            'discount.min' => 'Vui lòng nhập giá trị > 0',
            'status.required' => 'Vui lòng chọn trạng thái hoạt động',

        ]);

        $voucher = Voucher::findOrFail($id);
        $voucher->name = $request->name;
        $voucher->code = $request->code;
        $voucher->quantity = $request->quantity;
        $voucher->start_date = $request->start_date;
        $voucher->end_date = $request->end_date;
        $voucher->voucher_type = $request->voucher_type;
        $voucher->discount = $request->discount;
        $voucher->status = $request->status;
        $voucher->save();


        // Use yoeunes/toastr laravel
        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->route('admin.voucher.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();

        return response(['status' => 'success', 'message' => 'Xóa thành công dữ liệu']);
    }

    public function changeStatus(Request $request)
    {
        $voucher = Voucher::findOrFail($request->id);
        $voucher->status = $request->status == 'true' ? 1 : 0;
        $voucher->save();

        if ($voucher->status == 1) {
            return response(['message' => 'Hiển thị voucher']);
        } else if ($voucher->status == 0) {
            return response(['message' => 'Ẩn voucher']);
        }
    }
}
