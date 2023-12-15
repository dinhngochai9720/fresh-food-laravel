<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::orderBy('id', 'DESC')->get();
        return view('admin.transaction.index', compact('transactions'));
    }

    public function transactionPayPalIndex()
    {
        $transactions_paypal = Transaction::where('payment_method', 'paypal')->orderBy('id', 'DESC')->get();
        return view('admin.transaction.paypal', compact('transactions_paypal'));
    }

    public function transactionVNPayIndex()
    {
        $transactions_vnpay = Transaction::where('payment_method', 'vnpay')->orderBy('id', 'DESC')->get();
        return view('admin.transaction.vnpay', compact('transactions_vnpay'));
    }

    public function transactionStripeIndex()
    {
        $transactions_stripe = Transaction::where('payment_method', 'stripe')->orderBy('id', 'DESC')->get();
        return view('admin.transaction.stripe', compact('transactions_stripe'));
    }

    public function transactionCashIndex()
    {
        $transactions_cash = Transaction::where('payment_method', 'cash')->orderBy('id', 'DESC')->get();
        return view('admin.transaction.cash', compact('transactions_cash'));
    }
}
