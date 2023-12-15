<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterCustomer;
use Illuminate\Http\Request;

class FooterCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $footer_customers = FooterCustomer::orderBy('id', 'DESC')->get();
        return view('admin.footer.footer-customer.index', compact('footer_customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer.footer-customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => ['required'],
                'url' => ['required', 'url'],

            ],
            [

                'name.required' => 'Vui lòng nhập tên.',
                'url.required' => 'Vui lòng nhập url.',
                'url.url' => 'Vui lòng nhập đúng đường link url.',
            ]
        );

        $footer_customer = new FooterCustomer();

        $footer_customer->name = $request->name;
        $footer_customer->url = $request->url;
        $footer_customer->status = $request->status;
        $footer_customer->save();

        toastr()->success('Thêm mới thành công!', ' ');
        return redirect()->route('admin.footer-customer.create');
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
        $footer_customer = FooterCustomer::findOrFail($id);
        return view('admin.footer.footer-customer.edit', compact('footer_customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name' => ['required'],
                'url' => ['required', 'url'],

            ],
            [

                'name.required' => 'Vui lòng nhập tên.',
                'url.required' => 'Vui lòng nhập url.',
                'url.url' => 'Vui lòng nhập đúng đường link url.',
            ]
        );

        $footer_customer = FooterCustomer::findOrFail($id);

        $footer_customer->name = $request->name;
        $footer_customer->url = $request->url;
        $footer_customer->status = $request->status;
        $footer_customer->save();

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->route('admin.footer-customer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footer_customer = FooterCustomer::findOrFail($id);

        $footer_customer->delete();

        return response(['status' => 'success', 'message' => 'Xóa thành công dữ liệu']);
    }

    public function changeStatus(Request $request)
    {
        $footer_customer = FooterCustomer::findOrFail($request->id);
        $footer_customer->status = $request->status == 'true' ? 1 : 0;
        $footer_customer->save();

        if ($footer_customer->status == 1) {
            return response(['message' => 'Hiển thị chăm sóc khách hàng']);
        } else if ($footer_customer->status == 0) {
            return response(['message' => 'Ẩn chăm sóc khách hàng']);
        }
    }
}
