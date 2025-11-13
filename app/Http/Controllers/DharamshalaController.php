<?php

namespace App\Http\Controllers;

use App\Models\DharamshalaModel;
use App\Models\PartnerwithusModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\PartnerApprovedMail;
use Illuminate\Support\Facades\Mail;
use DataTables;
use App\Models\User;

class DharamshalaController extends Controller
{
    public function Dharamshala(Request $request)
    {
        return view('dharamshala.dharamshala');
    }


    public function DharamshalaData(Request $request)
    {

        if ($request->ajax()) {
            $data = DharamshalaModel::latest()->get();

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
                    $editUrl = route('edit-dharamshala', ['dharamshala_id' => $row->dharamshala_id]);
                    $deleteUrl = route('delete-dharamshala', ['dharamshala_id' => $row->dharamshala_id]);

                    $actionBtn = '
        <a href="' . $editUrl . '" class="btn btn-success btn-sm">Edit</a>
        <button class="btn btn-danger btn-sm sweet-delete-btn" data-url="' . $deleteUrl . '">Delete</button>
    ';

                    return $actionBtn;
                })
                ->rawColumns(['image', 'description', 'action'])
                ->make(true);
        }
    }

    public function Adddharamshala()
    {
        return view('dharamshala.add-dharamshala');
    }

    public function Addstoredharamshala(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'dharamshala_id' => 'required',
            'name' => 'required|string|max:255',
            'dharamshala_name' => 'required|string|max:255',
            'phone_number' => 'required|digits:10',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'dharamshala_address' => 'required|string|max:255',
            'auth_sign' => 'required',
            'auth_img' => 'required',
            'auth_aadhar' => 'required|digits:12',
        ]);

        $path = 'website-partner/partner-with-us/';
        // Handle auth_sign
        if ($request->hasFile('auth_sign')) {
            $file1 = $request->file('auth_sign');
            $filename1 = 'auth_sign' . time() . '.' . $file1->getClientOriginalExtension();
            $file1->move(public_path($path), $filename1);
            $auth_sign = $path . $filename1;
        } else {
            $auth_sign = null;
        }

        // Handle auth_img
        if ($request->hasFile('auth_img')) {
            $file1 = $request->file('auth_img');
            $filename1 = 'auth_img' . time() . '.' . $file1->getClientOriginalExtension();
            $file1->move(public_path($path), $filename1);
            $auth_img = $path . $filename1;
        } else {
            $auth_img = null;
        }

        $data = PartnerwithusModel::create(array_merge($validated, [
            'auth_sign' => $auth_sign,
            'auth_img' => $auth_img,
            'status' => 1,
            'admin_status' => 1,
        ]));

        if ($request) {
            // Generate secure random password
            $partnerPassword = Str::random(10);

            // Check if user already exists (avoid duplicate)
            $userExists = User::where('email', $request->email)->exists();

            if (! $userExists) {
                User::create([
                    'name'              => $request->name,
                    'email'             => $request->email,
                    'phone_number'      => $request->phone_number,
                    'password'          => Hash::make($partnerPassword),
                    'remember_token'    => Str::random(10),
                    'email_verified_at' => now(),
                    'user_type'         => '3',
                ]);

                // Send email with login details
                Mail::to($request->email)->send(
                    new PartnerApprovedMail($request->name, $request->email, $partnerPassword)
                );
            }

            $message = 'Partner approved successfully! Mail sent successfully!';
            $alertType = 'success';
        } else {
            $message = 'Partner rejected!';
            $alertType = 'error';
        }
        return redirect()->route('dharamshala')->with('success', 'Dharamshala Added successfully!');
    }

    public function Editdharamshala($dharamshala_id)
    {
        $dharamshala = DharamshalaModel::findOrFail($dharamshala_id);
        return view('dharamshala.edit-dharamshala', compact('dharamshala'));
    }

    public function Editstoredharamshala(Request $request, $dharamshala_id)
    {
        $dharamshala = DharamshalaModel::findOrFail($dharamshala_id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $dharamshala->title = $request->title;
        $dharamshala->description = $request->description;

        if ($request->hasFile('image')) {
            $path_image = 'dashboard-assets/assets/img/dharamshala/';
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($path_image), $filename);
            $dharamshala->image = $path_image . $filename;
        } else {
            $dharamshala->image = $request->hidden_image;
        }
        $dharamshala->save();
        return redirect()->route('dharamshala')->with('success', 'Dharamshala updated successfully!');
    }

    public function Deletedharamshala($dharamshala_id)
    {
        $dharamshala = DharamshalaModel::findOrFail($dharamshala_id);

        // Delete image from public folder if exists
        if ($dharamshala->image && file_exists(public_path($dharamshala->image))) {
            unlink(public_path($dharamshala->image));
        }

        $dharamshala->delete();
        return redirect()->route('dharamshala')->with('success', 'Dharamshala deleted successfully!');
    }
}
