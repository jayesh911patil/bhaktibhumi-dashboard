<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use DataTables;

class RoomController extends Controller
{
    public function Room(Request $request)
    {
        if ($request->ajax()) {
            $data = Room::where('added_by', auth()->user()->partner_with_us_id)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('room_number', function ($row) {
                    return $row->room_number;
                })
                ->addColumn('room_type', function ($row) {
                    return config('constants.ROOM_TYPE')[$row->room_type] ?? 'Unknown';
                })
                ->addColumn('ac_no_ac', function ($row) {
                    if ($row->ac_no_ac == 1) {
                        return 'AC';
                    } elseif ($row->ac_no_ac == 0) {
                        return 'Non-AC';
                    } else {
                        return 'Unknown';
                    }
                })
                ->addColumn('bed_capacity', function ($row) {
                    return $row->bed_capacity;
                })
                ->addColumn('rent', function ($row) {
                    return $row->rent;
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-rooms', ['room_id' => $row->room_id]);
                    $deleteUrl = route('delete-room', ['room_id' => $row->room_id]);

                    $csrfToken = csrf_token();

                    $actionBtn = '
                    <a href="' . $editUrl . '" class="edit btn btn-success btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm sweet-delete-btn" data-url="' . $deleteUrl . '">Delete</button>';
                    return $actionBtn;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
        return view('rooms.rooms');
    }

    public function Addrooms()
    {
        return view('rooms.add-rooms');
    }

    public function Addstoreroom(Request $request)
    {
        // dd($request);
        $request->validate([
            'room_number'  => 'required|string|max:20',
            'room_type'    => 'required',
            'ac_no_ac'     => 'required',
            'bed_capacity' => 'required|integer|min:1|max:10',
            'rent'         => 'required|numeric|min:0|max:999999.99',
        ], [

            'room_number.required' => 'Room number is required.',
            'room_number.unique' => 'This room number already exists.',
            'room_number.max' => 'Room number can be a maximum of 20 characters.',
            'room_type.in' => 'Room type must be one of: Standard, Deluxe, Super Deluxe, Executive, or Suite.',
            'ac_no_ac.in' => 'Please select either AC or Non-AC.',
            'bed_capacity.integer' => 'Bed capacity must be a valid number.',
            'bed_capacity.max' => 'Bed capacity cannot exceed 10.',
            'rent.numeric' => 'Rent must be a numeric value.',
            'rent.max' => 'Rent value too high.',
        ]);

        $images = [];

        if ($request->hasFile('room_imgs')) {
            foreach ($request->file('room_imgs') as $file) {

                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Your custom folder
                $path = public_path('dashboard-partner/room-imgs');

                // Create folder if not exists
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                // Move file
                $file->move($path, $filename);

                $images[] = $filename;
            }
        }

        $data = [
            'room_number'  => $request->room_number,
            'room_type'    => $request->room_type,
            'ac_no_ac'     => $request->ac_no_ac,
            'bed_capacity' => $request->bed_capacity,
            'rent'         => $request->rent,
            'status' => 1,
            'dharmashala_id' => auth()->user()->id,
            'added_by' => auth()->user()->partner_with_us_id,
            'room_imgs'  => json_encode($images),
        ];


        Room::create($data);


        return redirect()->route('rooms')->with('success', 'Room added successfully!');
    }


    public function Editrooms($room_id)
    {
        $room = Room::findOrFail($room_id);
        return view('rooms.edit-rooms', compact('room'));
    }


    public function Editstoreroom(Request $request, $room_id)
    {
        $room = Room::findOrFail($room_id);

        $request->validate([
            'room_number'  => 'required|string|max:20',
            'room_type'    => 'required',
            'ac_no_ac'     => 'required',
            'bed_capacity' => 'required|integer|min:1|max:10',
            'rent'         => 'required|numeric|min:0|max:999999.99',
        ], [

            'room_number.required' => 'Room number is required.',
            'room_number.unique' => 'This room number already exists.',
            'room_number.max' => 'Room number can be a maximum of 20 characters.',
            'room_type.in' => 'Room type must be one of: Standard, Deluxe, Super Deluxe, Executive, or Suite.',
            'ac_no_ac.in' => 'Please select either AC or Non-AC.',
            'bed_capacity.integer' => 'Bed capacity must be a valid number.',
            'bed_capacity.max' => 'Bed capacity cannot exceed 10.',
            'rent.numeric' => 'Rent must be a numeric value.',
            'rent.max' => 'Rent value too high.',
        ]);

        // Convert DB images to array
    $oldImages = json_decode($room->room_imgs, true) ?? [];

    // Your required image upload folder
    $uploadPath = public_path('dashboard-partner/room-imgs');

    // Create folder if missing
    if (!file_exists($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    // -----------------------------
    // 1️⃣ DELETE SELECTED OLD IMAGES
    // -----------------------------
    if ($request->has('delete_images')) {
        foreach ($request->delete_images as $delImage) {

            $filePath = $uploadPath . '/' . $delImage;

            // Delete file from disk
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Remove from array
            $oldImages = array_diff($oldImages, [$delImage]);
        }
    }

    // -----------------------------
    // 2️⃣ UPLOAD NEW IMAGES
    // -----------------------------
    if ($request->hasFile('room_imgs')) {
        foreach ($request->file('room_imgs') as $file) {
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $oldImages[] = $filename;
        }
    }

    // Re-index array
    $oldImages = array_values($oldImages);

        $room->update([
            'room_number'  => $request->room_number,
            'room_type'    => $request->room_type,
            'ac_no_ac'     => $request->ac_no_ac,
            'bed_capacity' => $request->bed_capacity,
            'rent'         => $request->rent,
            'room_imgs'  => json_encode(array_values($oldImages)),
        ]);

        return redirect()->route('rooms')->with('success', 'Room updated successfully!');
    }



    public function Deletestoreroom($room_id)
    {
        $room = Room::findOrFail($room_id);
        $room->delete();

        return redirect()->route('rooms')->with('success', 'Room deleted successfully!');
    }
}
