<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function Room(){
        return view('rooms.rooms');
    }

    public function Addrooms(){
        return view('rooms.add-rooms');
    }

    public function Addstoreroom(Request $request){
        // ✅ Validation
    $request->validate([
        'room_number'      => 'required|string|max:50|unique:room_header,room_number',
        'room_title'       => 'required|string|max:255',
        'room_type'        => 'required|string|max:50',
        'category'         => 'required|string|max:50',
        'total_rooms'      => 'required|integer|min:1',
        'base_price'       => 'required|numeric|min:0',
        'extra_bed_price'  => 'required|numeric|min:0',
        'max_adults'       => 'required|integer|min:1',
        'max_children'     => 'required|integer|min:0',
        'bed_type'         => 'required|string|max:100',
        'amenities'        => 'required|string',
        'description'      => 'required|string',
        'floor_number'     => 'required|string|max:50',
        'room_size'        => 'required|integer|min:0',
        'image'            => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    $data = [
        'dharmashala_id'   => 1, // you can change to dynamic
        'room_number'      => $request->room_number,
        'room_title'       => $request->room_title,
        'room_type'        => $request->room_type,
        'category'         => $request->category,
        'total_rooms'      => $request->total_rooms,
        'base_price'       => $request->base_price,
        'extra_bed_price'  => $request->extra_bed_price,
        'max_adults'       => $request->max_adults,
        'max_children'     => $request->max_children,
        'bed_type'         => $request->bed_type,
        'amenities'        => $request->amenities,
        'description'      => $request->description,
        'floor_number'     => $request->floor_number,
        'room_size'        => $request->room_size,
    ];

    // ✅ Insert into DB
    Room::create($data);

    // ✅ Redirect with success message
    return redirect()->route('rooms')->with('success', 'Room added successfully!');
    }
}
