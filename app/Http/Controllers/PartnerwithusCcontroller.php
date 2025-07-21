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
                ->addColumn('dharamshala', fn($row) => $row->dharamshala)
                ->addColumn('address', fn($row) => $row->address)
                ->make(true);
        }
        return view('partnerwithus.partnerwithus');
    }
}
