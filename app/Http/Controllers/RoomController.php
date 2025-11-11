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
            $data = Room::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('room_number', function ($row) {
                    return $row->room_number;
                })
                ->addColumn('room_type', function ($row) {
                    return $row->room_type;
                })
                ->addColumn('ac_no_ac', function ($row) {
                    return $row->ac_no_ac;
                })
                ->addColumn('bed_capacity', function ($row) {
                    return $row->bed_capacity;
                })
                ->addColumn('rent', function ($row) {
                    return $row->rent;
                })
                ->addColumn('action', function ($row) {
                    $editUrl = "";
                    $deleteUrl = "";

                    $csrfToken = csrf_token();

                    $actionBtn = '
                    <a href="' . $editUrl . '" class="edit btn btn-success btn-sm">Edit</a>
                    <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                        ' . method_field('DELETE') . '
                        <input type="hidden" name="_token" value="' . $csrfToken . '">
                        <button data-url="' . $deleteUrl . '" class="delete btn btn-danger btn-sm delete">Delete</button>
                    </form>';
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
       
        $request->validate([
            'room_number'  => 'required|string|max:20',
            'room_type'    => 'required',
            'ac_no_ac'     => 'required',
            'bed_capacity' => 'required|integer|min:1|max:10',
            'rent'         => 'required|numeric|min:0|max:999999.99',
        ], [
            // 🛡 Custom error messages
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

        $data = [
            'room_number'  => $request->room_number,
            'room_type'    => $request->room_type,
            'ac_no_ac'     => $request->ac_no_ac,
            'bed_capacity' => $request->bed_capacity,
            'rent'         => $request->rent,
        ];

        // 🧩 Step 3: Insert into DB
        Room::create($data);

        // 🧩 Step 4: Redirect with success message
        return redirect()->route('rooms')->with('success', 'Room added successfully!');
    }
}
