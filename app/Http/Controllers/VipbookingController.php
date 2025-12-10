<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VipbookingModel;
use DataTables;

class VipbookingController extends Controller
{
    public function Vipbooking(Request $request)
    {
        if ($request->ajax()) {
            $data = VipbookingModel::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $imgUrl = asset($row->image);
                    return "<img src='{$imgUrl}' width='100' height='100' />";
                })
                ->addColumn('title', fn($row) => $row->title)
                ->addColumn('description', function ($row) {
                    return '<button type="button" class="btn btn-sm btns view-description" data-bs-toggle="modal" data-bs-target="#descriptionModal" data-description="' . e($row->description) . '">View</button>';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-vip-bookings', ['vip_booking_id' => $row->vip_booking_id]);
                    $deleteUrl = route('delete-vip-bookings', ['vip_booking_id' => $row->vip_booking_id]);

                    $actionBtn = '
        <a href="' . $editUrl . '" class="btn btn-success btn-sm">Edit</a>
        <button class="btn btn-danger btn-sm sweet-delete-btn" data-url="' . $deleteUrl . '">Delete</button>
    ';

                    return $actionBtn;
                })
                ->rawColumns(['image', 'description', 'action'])
                ->make(true);
        }
    
        return view('vip-bookings.vip-bookings');
    }

    public function Addvipbooking()
    {
        return view('vip-bookings.add-vip-bookings');
    }


    public function Addstorevipbooking(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);

        $identification_proofimg = null;
        if ($request->hasFile('image')) {
            $path_image = 'dashboard-assets/assets/img/vip-bookings/';
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($path_image), $filename);
            $identification_proofimg = $path_image . $filename;
        }

        $data = [
            'title' => $request->title,
            'image' => $identification_proofimg,
            'description' => $request->description
        ];

        VipbookingModel::create($data);
        return redirect()->route('vip-bookings')->with('success', 'Vip Booking Added successfully!');
    }

    public function Editvipbooking($vip_booking_id)
    {
        $vipbooking = VipbookingModel::findOrFail($vip_booking_id);
        return view('vip-bookings.edit-vip-bookings', compact('vipbooking'));
    }


    public function Editstorevipbooking(Request $request, $vip_booking_id)
    {
        $popularritual = VipbookingModel::findOrFail($vip_booking_id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $popularritual->title = $request->title;
        $popularritual->description = $request->description;

        if ($request->hasFile('image')) {
            $path_image = 'dashboard-assets/assets/img/vip-bookings/';
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($path_image), $filename);
            $popularritual->image = $path_image . $filename;
        } else {
            $popularritual->image = $request->hidden_image;
        }
        $popularritual->save();
        return redirect()->route('vip-bookings')->with('success', 'Vip Booking updated successfully!');
    }


    public function Deletevipbooking($vip_booking_id)
    {
        $vipbooking = VipbookingModel::findOrFail($vip_booking_id);
        $vipbooking->delete();
        return redirect()->route('vip-bookings')->with('success', 'Vip Booking deleted successfully!');
}
}