<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index()
    {
        $flash_sale_date = FlashSale::first();
        $flash_sale_items = FlashSaleItem::latest()->get();

        $products = Product::where('is_approved', 1)->where('status', 1)->orderBy('id', 'DESC')->get();

        return view('admin.flash-sale.index', compact('products', 'flash_sale_date', 'flash_sale_items'));
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'end_date' => ['required', 'date', 'after:' . now()]
            ],
            [
                'end_date.required' => 'Vui lòng chọn ngày kết thúc.',
                'end_date.date' => 'Vui lòng chọn đúng định dạng',
                'end_date.after' => 'Vui lòng chọn ngày lớn hơn hoặc bằng ngày hiện tại.',
            ]
        );

        FlashSale::updateOrCreate(
            ['id' => 1],
            ['end_date' => $request->end_date]
        );


        toastr()->success('Cập nhật thành công', ' ');
        return redirect()->back();
    }

    public function addProduct(Request $request)
    {
        $request->validate(
            [
                'product_id' => ['required', 'unique:flash_sale_items,product_id'],
                'show_home_page' => ['required'],
                'status' => ['required'],
            ],
            [
                'product_id.required' => 'Vui lòng chọn sản phẩm.',
                'product_id.unique' => 'Sản phẩm đã tồn tại.',
                'show_home_page.required' => 'Vui lòng chọn hiển thị trang chủ có hoặc không .',
                'status.required' => 'Vui lòng chọn trạng thái hoạt động.',
            ]
        );


        $flash_sale = FlashSale::first();

        $flash_sale_item = new FlashSaleItem();
        $flash_sale_item->product_id = $request->product_id;
        $flash_sale_item->flash_sale_id = $flash_sale->id;
        $flash_sale_item->show_home_page = $request->show_home_page;
        $flash_sale_item->status = $request->status;

        $flash_sale_item->save();

        toastr()->success('Thêm mới thành công', ' ');
        return redirect()->back();
    }



    public function changeShowHomePage(Request $request)
    {
        $flash_sale_item = FlashSaleItem::findOrFail($request->id);
        $flash_sale_item->show_home_page = $request->show_home_page == 'true' ? 1 : 0;
        $flash_sale_item->save();

        if ($flash_sale_item->show_home_page == 1) {
            return response(['message' => 'Hiển thị trên trang chủ']);
        } else if ($flash_sale_item->show_home_page == 0) {
            return response(['message' => 'Ẩn trên trang chủ']);
        }
    }

    public function changeStatus(Request $request)
    {
        $flash_sale_item = FlashSaleItem::findOrFail($request->id);
        $flash_sale_item->status = $request->status == 'true' ? 1 : 0;
        $flash_sale_item->save();

        if ($flash_sale_item->status == 1) {
            return response(['message' => 'Hiển thị sản phẩm']);
        } else if ($flash_sale_item->status == 0) {
            return response(['message' => 'Ẩn sản phẩm']);
        }
    }

    public function destroy(string $id)
    {
        $flash_sale_item = FlashSaleItem::findOrFail($id);

        $flash_sale_item->delete();

        return response(['status' => 'success', 'message' => 'Xóa thành công dữ liệu']);
    }
}
