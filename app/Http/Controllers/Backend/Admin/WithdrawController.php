<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\WithdrawMethod;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function getWithdrawMethod()
    {
        $withdraw_methods = WithdrawMethod::orderBy('id', 'DESC')->get();
        return view('admin.withdraw.method.index', compact('withdraw_methods'));
    }

    public function createWithdrawMethod()
    {
        return view('admin.withdraw.method.create');
    }


    public function storeWithdrawMethod(Request $request)
    {
        $request->validate(
            [
                'name' => ['required'],
                'minimum_amount' => ['required', 'numeric', 'min:1', 'lt:maximum_amount'],
                'maximum_amount' => ['required', 'numeric', 'min:1', 'gt:minimum_amount'],
                'withdraw_charge' => ['required', 'numeric', 'min:0'],
                'description' => ['required'],
            ],
            [
                'name.required' => 'Vui lòng nhập tên phương thức.',
                'minimum_amount.required' => 'Vui lòng nhập số tiền tối thiểu.',
                'minimum_amount.min' => 'Vui lòng nhập số tiền tối thiểu > 0.',
                'minimum_amount.lt' => 'Vui lòng nhập số tiền tối thiểu < số tiền tối đa.',
                'maximum_amount.required' => 'Vui lòng nhập số tiền tối đa.',
                'maximum_amount.min' => 'Vui lòng nhập số tiền tối đa > 0.',
                'maximum_amount.gt' => 'Vui lòng nhập số tiền tối đa > số tiền tối thiểu.',
                'withdraw_charge.required' => 'Vui lòng nhập chiết khấu.',
                'withdraw_charge.min' => 'Vui lòng nhập chiết khấu >= 0.',
                'description.required' => 'Vui lòng nhập mô tả.',
            ]
        );

        $withdraw_method = new WithdrawMethod();
        $withdraw_method->name = $request->name;
        $withdraw_method->minimum_amount = $request->minimum_amount;
        $withdraw_method->maximum_amount = $request->maximum_amount;
        $withdraw_method->withdraw_charge = $request->withdraw_charge;
        $withdraw_method->description = $request->description;

        $withdraw_method->save();
        toastr()->success('Thêm mới thành công!', ' ');
        return redirect()->back();
    }

    public function editWithdrawMethod($id)
    {
        $withdraw_method = WithdrawMethod::findOrFail($id);
        return view('admin.withdraw.method.edit', compact('withdraw_method'));
    }

    public function updateWithdrawMethod(Request $request, $id)
    {
        $request->validate(
            [
                'name' => ['required'],
                'minimum_amount' => ['required', 'numeric', 'min:1', 'lt:maximum_amount'],
                'maximum_amount' => ['required', 'numeric', 'min:1', 'gt:minimum_amount'],
                'withdraw_charge' => ['required', 'numeric', 'min:0'],
                'description' => ['required'],
            ],
            [
                'name.required' => 'Vui lòng nhập tên phương thức.',
                'minimum_amount.required' => 'Vui lòng nhập số tiền tối thiểu.',
                'minimum_amount.min' => 'Vui lòng nhập số tiền tối thiểu > 0.',
                'minimum_amount.lt' => 'Vui lòng nhập số tiền tối thiểu < số tiền tối đa.',
                'maximum_amount.required' => 'Vui lòng nhập số tiền tối đa.',
                'maximum_amount.min' => 'Vui lòng nhập số tiền tối đa > 0.',
                'maximum_amount.gt' => 'Vui lòng nhập số tiền tối đa > số tiền tối thiểu.',
                'withdraw_charge.required' => 'Vui lòng nhập chiết khấu.',
                'withdraw_charge.min' => 'Vui lòng nhập chiết khấu >= 0.',
                'description.required' => 'Vui lòng nhập mô tả.',
            ]
        );

        $withdraw_method = WithdrawMethod::findOrFail($id);
        $withdraw_method->name = $request->name;
        $withdraw_method->minimum_amount = $request->minimum_amount;
        $withdraw_method->maximum_amount = $request->maximum_amount;
        $withdraw_method->withdraw_charge = $request->withdraw_charge;
        $withdraw_method->description = $request->description;

        $withdraw_method->save();
        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->route('admin.withdraw-method.index');
    }

    public function  destroyWithdrawMethod($id)
    {
        $withdraw_method =  WithdrawMethod::findOrFail($id);
        $withdraw_method->delete();
        return response(['status' => 'success', 'message' => 'Xóa thành công dữ liệu']);
    }

    public function getWithdrawRequest()
    {
        $withdraw_requests = WithdrawRequest::orderBy('id', 'DESC')->get();
        return view('admin.withdraw.request.index', compact('withdraw_requests'));
    }

    public function showDetailWithdrawRequest($id)
    {
        $withdraw_request = WithdrawRequest::findOrFail($id);
        return view('admin.withdraw.request.detail', compact('withdraw_request'));
    }

    public function updateWithdrawRequest(Request $request, $id)
    {
        $request->validate(
            [
                'status' => ['required', 'in:pending,paid,declines']

            ],
            [
                'status.required' => 'Vui lòng chọn trạng thái.',

            ]
        );

        $withdraw_request = WithdrawRequest::findOrFail($id);
        $withdraw_request->status = $request->status;
        $withdraw_request->save();

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->route('admin.withdraw-request.index');
    }
}
