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
                    $viewBtn = '<a href="#" class="btn btn-sm btn-primary me-1">
                   <i class="bi bi-eye"></i> View
                </a>';

                    $editBtn = '<a href="#" class="btn btn-sm btn-warning me-1">
                   <i class="bi bi-pencil-square"></i> Edit
                </a>';

                    $deleteBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-danger delete-btn">
                    <i class="bi bi-trash"></i> Delete
                  </a>';

                    return $viewBtn . $editBtn . $deleteBtn;
                })
                ->rawColumns(['action','admin_status']) // 👈 important for rendering HTML
                ->make(true);
        }
        return view('partnerwithus.partnerwithus');
    }
}
