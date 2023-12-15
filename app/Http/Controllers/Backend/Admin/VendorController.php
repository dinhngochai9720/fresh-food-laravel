<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function approvedVendors()
    {
        $approved_vendors = Vendor::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('admin.vendor.approved.index', compact('approved_vendors'));
    }

    public function pendingVendors()
    {

        $pending_vendors = Vendor::where('status', 0)->orderBy('id', 'DESC')->get();
        return view('admin.vendor.pending.index', compact('pending_vendors'));
    }

    public function showDetailApprovedVendor(string $id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('admin.vendor.approved.detail', compact('vendor'));
    }


    public function showDetailPendingVendor(string $id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('admin.vendor.pending.detail', compact('vendor'));
    }

    public function changeStatusApprovedVendor(Request $request, string $id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->status = $request->status;
        $vendor->save();

        $user = User::findOrFail($vendor->user->id);
        $user->role = 'user';
        $user->save();

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->route('admin.vendor-approved.index');
    }

    public function changeStatusPendingVendor(Request $request, string $id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->status = $request->status;
        $vendor->save();

        $user = User::findOrFail($vendor->user->id);
        $user->role = 'vendor';
        $user->save();

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->route('admin.vendor-pending.index');
    }
}
