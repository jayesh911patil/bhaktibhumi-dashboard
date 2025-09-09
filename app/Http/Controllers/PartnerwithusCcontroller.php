<?php

namespace App\Http\Controllers;

use App\Models\PartnerwithusModel;
use Illuminate\Http\Request;
use DataTables;

class PartnerwithusCcontroller extends Controller
{
    public function Partnerwithus(Request $request)
    {
        if ($request->ajax()) {
            $data = PartnerwithusModel::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', fn($row) => $row->name)
                ->addColumn('email', fn($row) => $row->email)
                ->addColumn('phone_number', fn($row) => $row->phone_number)
                ->addColumn('dharamshala_name', fn($row) => $row->dharamshala_name)
                ->addColumn('address', fn($row) => $row->address)
                ->addColumn('admin_status', function ($row) {
                    switch ($row->admin_status) {
                        case 0:
                            return '<span class="badge bg-warning">Pending</span>';
                        case 1:
                            return '<span class="badge bg-success">Approved</span>';
                        case 2:
                            return '<span class="badge bg-danger">Rejected</span>';
                        default:
                            return '<span class="badge bg-secondary">Unknown</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $viewBtn = '<a href="' . route('partner-with-us-data', ['partner_with_us_id' => $row->partner_with_us_id]) . '" 
               class="btn btn-sm btn-primary me-1">
               <i class="bi bi-eye"></i> View
            </a>';

                    $editBtn = '<a href="' . route('edit-partner-with-us', ['partner_with_us_id' => $row->partner_with_us_id]) . '" class="btn btn-sm btn-warning me-1">
                   <i class="bi bi-pencil-square"></i> Edit
                </a>';

                    //     $deleteBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-danger delete-btn">
                    //     <i class="bi bi-trash"></i> Delete
                    //   </a>';

                    return $viewBtn . $editBtn;
                })
                ->rawColumns(['action', 'admin_status']) // 👈 important for rendering HTML
                ->make(true);
        }
        return view('partnerwithus.partnerwithus');
    }

    public function ViewPartnerwithus($partner_with_us_id)
    {
        $data = PartnerwithusModel::where('partner_with_us_id', $partner_with_us_id)->first();
        // dd( $data);
        return view('partnerwithus.view-partner-with-us', compact('data'));
    }


    public function Editpartnerwithus($partner_with_us_id)
    {
        $data = PartnerwithusModel::findOrFail($partner_with_us_id);
        // dd( $data);
        return view('partnerwithus.edit-partner-with-us', compact('data'));
    }

    public function Editstorepartnerwithus(Request $request, $partner_with_us_id)
    {
        $request->validate([
            'name' => 'required',
            'dharamshala_name' => 'required',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email',
            'address' => 'required',
            'dharamshala_address' => 'required',
            'auth_aadhar' => 'required',
        ]);

         $data = PartnerwithusModel::findOrFail($partner_with_us_id);

        $data->name = $request->name;
        $data->dharamshala_name = $request->dharamshala_name;
        $data->phone_number = $request->phone_number;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->dharamshala_address = $request->dharamshala_address;
        $data->auth_aadhar = $request->auth_aadhar;
        $data->save();
        return redirect()->route('partner-with-us')->with('success', 'Partner with us details updated successfully!');
    }

    public function Updatestatuspartnerwithus(Request $request, $partner_with_us_id)
    {
        $partner = PartnerwithusModel::findOrFail($partner_with_us_id);
        $partner->admin_status = $request->status; // 1 = approve, 2 = reject
        $partner->save();

    $message = $request->status == 1 ? 'Partner approved successfully!' : 'Partner rejected!';
    $alertType = $request->status == 1 ? 'success' : 'error';

    return redirect()->route('partner-with-us')->with($alertType, $message);
    }
}
