<?php

namespace App\Http\Controllers;

use App\Models\PartnerwithusModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\PartnerApprovedMail;
use Illuminate\Support\Facades\Mail;
use PDF; 
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

    // public function Updatestatuspartnerwithus(Request $request, $partner_with_us_id)
    // {
    //     $partner = PartnerwithusModel::findOrFail($partner_with_us_id);
    //     $partner->admin_status = $request->status; // 1 = approve, 2 = reject
    //     $partner->save();

    //     if ($request->status == 1) {
    //         $partnerPassword = rand(100000, 999999); // generate 6-digit password (optional)

    //         User::create([
    //             'name'              => $partner->name,
    //             'email'             => $partner->email,
    //             'phone_number'      => $partner->phone_number,
    //             'password'          => Hash::make($partnerPassword),
    //             'remember_token'    => Str::random(10),
    //             'email_verified_at' => now(),
    //             'user_type'         => '3',
    //         ]);

    //         Mail::to($partner->email)->send(
    //         new PartnerApprovedMail($partner->name, $partner->email, $partnerPassword)
    //     );
    //     }

    //     $message = $request->status == 1 ? 'Partner approved successfully! Mail sent successfully!' : 'Partner rejected!';
    //     $alertType = $request->status == 1 ? 'success' : 'error';

    //     return redirect()->route('partner-with-us')->with($alertType, $message);
    // }

    public function Updatestatuspartnerwithus(Request $request, $partner_with_us_id)
    {
        $partner = PartnerwithusModel::findOrFail($partner_with_us_id);

        // If status is already same → show message
        if ($partner->admin_status == $request->status) {
            $message = $request->status == 1
                ? 'Partner is already approved!'
                : 'Partner is already rejected!';
            $alertType = 'info';

            return redirect()->route('partner-with-us')->with($alertType, $message);
        }

        // Update partner status
        $partner->admin_status = $request->status; // 1 = approve, 2 = reject
        $partner->save();

        if ($request->status == 1) {
            // Generate secure random password
            $partnerPassword = Str::random(10);

            // Check if user already exists (avoid duplicate)
            $userExists = User::where('email', $partner->email)->exists();

            if (! $userExists) {
                User::create([
                    'name'              => $partner->name,
                    'email'             => $partner->email,
                    'phone_number'      => $partner->phone_number,
                    'password'          => Hash::make($partnerPassword),
                    'remember_token'    => Str::random(10),
                    'email_verified_at' => now(),
                    'user_type'         => '3',
                ]);

                // Send email with login details
                Mail::to($partner->email)->send(
                    new PartnerApprovedMail($partner->name, $partner->email, $partnerPassword)
                );
            }

            $message = 'Partner approved successfully! Mail sent successfully!';
            $alertType = 'success';
        } else {
            $message = 'Partner rejected!';
            $alertType = 'error';
        }

        return redirect()->route('partner-with-us')->with($alertType, $message);
    }


    public function downloadPdf($id)
{
    $data = PartnerwithusModel::findOrFail($id);

    $pdf = PDF::loadView('pdf.partner-details', compact('data'));

    $filename = 'partner_' . Str::slug($data->name, '_') . '.pdf';
    return $pdf->download($filename);

}
}
