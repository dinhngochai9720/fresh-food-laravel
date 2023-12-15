<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {

        $orders = Order::orderBy('id', 'DESC')->get();
        return view('admin.order.index', compact('orders'));
    }

    public function showOrderDetail(string $id)
    {
        $order = Order::findOrFail($id);

        return view('admin.order.detail', compact('order'));
    }

    public function ordersUnPaidIndex()
    {

        $orders_unpaid = Order::where('payment_status', 0)->orderBy('id', 'DESC')->get();
        return view('admin.order.unpaid', compact('orders_unpaid'));
    }


    public function ordersPaidIndex()
    {

        $orders_paid = Order::where('payment_status', 1)->orderBy('id', 'DESC')->get();
        return view('admin.order.paid', compact('orders_paid'));
    }


    public function ordersPendingIndex()
    {

        $orders_pending = Order::where('status', 'pending')->orderBy('id', 'DESC')->get();
        return view('admin.order.pending', compact('orders_pending'));
    }

    public function ordersConfirmedIndex()
    {

        $orders_confirmed = Order::where('status', 'confirmed')->orderBy('id', 'DESC')->get();
        return view('admin.order.confirmed', compact('orders_confirmed'));
    }

    public function ordersPreparingTheGoodsIndex()
    {

        $orders_preparing_the_goods = Order::where('status', 'preparing_the_goods')->orderBy('id', 'DESC')->get();
        return view('admin.order.preparing-the-goods', compact('orders_preparing_the_goods'));
    }

    public function ordersWarehouseIndex()
    {

        $orders_warehouse = Order::where('status', 'warehouse')->orderBy('id', 'DESC')->get();
        return view('admin.order.warehouse', compact('orders_warehouse'));
    }


    public function ordersDeliveringIndex()
    {

        $orders_delivering = Order::where('status', 'delivering')->orderBy('id', 'DESC')->get();
        return view('admin.order.delivering', compact('orders_delivering'));
    }


    public function ordersDeliveredIndex()
    {

        $orders_delivered = Order::where('status', 'delivered')->orderBy('id', 'DESC')->get();
        return view('admin.order.delivered', compact('orders_delivered'));
    }


    public function ordersCancelledIndex()
    {

        $orders_cancelled = Order::where('status', 'cancelled')->orderBy('id', 'DESC')->get();
        return view('admin.order.cancelled', compact('orders_cancelled'));
    }

    public function changeStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);


        if ($request->status == 'delivered') {
            // decrement product quantity after order status change (status == 'delivered')
            foreach ($order->orderDetail as $key => $order_detail) {
                $product = Product::findOrFail($order_detail->product_id);
                $product_quantity = $product->quantity;
                $product_quantity -= $order_detail->product_qty;

                if ($product_quantity < 0) {
                    $product->quantity = 0;
                    $product->save();
                } else {
                    $product->quantity = $product_quantity;
                    $product->save();
                }
            }

            // decrement voucher quantity after order status change (status == 'delivered')
            if ($order->voucher !== 'null') {
                $voucher_decode = json_decode($order->voucher);
                $voucher = Voucher::findOrFail($voucher_decode->voucher_id);
                $voucher_qty = $voucher->quantity;
                $voucher_qty -= 1;

                if ($voucher_qty < 0) {
                    $voucher->quantity = 0;
                    $voucher->save();
                } else {
                    $voucher->quantity = $voucher_qty;
                    $voucher->save();
                }
            }
        }

        $order->status = $request->status;

        $order->save();

        return response(['status' => 'success', 'message' => 'Cập nhật thành công!']);
    }

    public function changePaymentStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->payment_status = $request->payment_status;
        $order->save();

        return response(['status' => 'success', 'message' => 'Cập nhật thành công!']);
    }

    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);

        $order->delete();
        return response(['status' => 'success', 'message' => 'Xóa thành công dữ liệu']);
    }
}
