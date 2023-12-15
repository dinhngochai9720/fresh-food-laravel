<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterCompany;
use Illuminate\Http\Request;

class FooterCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $footer_companies = FooterCompany::orderBy('id', 'DESC')->get();
        return view('admin.footer.footer-company.index', compact('footer_companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer.footer-company.create');
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

        $footer_company = new FooterCompany();

        $footer_company->name = $request->name;
        $footer_company->url = $request->url;
        $footer_company->status = $request->status;
        $footer_company->save();

        toastr()->success('Thêm mới thành công!', ' ');
        return redirect()->route('admin.footer-company.create');
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
        $footer_company = FooterCompany::findOrFail($id);
        return view('admin.footer.footer-company.edit', compact('footer_company'));
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

        $footer_company = FooterCompany::findOrFail($id);

        $footer_company->name = $request->name;
        $footer_company->url = $request->url;
        $footer_company->status = $request->status;
        $footer_company->save();

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->route('admin.footer-company.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footer_company = FooterCompany::findOrFail($id);

        $footer_company->delete();

        return response(['status' => 'success', 'message' => 'Xóa thành công dữ liệu']);
    }

    public function changeStatus(Request $request)
    {
        $footer_company = FooterCompany::findOrFail($request->id);
        $footer_company->status = $request->status == 'true' ? 1 : 0;
        $footer_company->save();

        if ($footer_company->status == 1) {
            return response(['message' => 'Hiển thị về Fresh Food']);
        } else if ($footer_company->status == 0) {
            return response(['message' => 'Ẩn về Fresh Food']);
        }
    }
}
