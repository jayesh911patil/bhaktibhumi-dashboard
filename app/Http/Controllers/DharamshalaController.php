<?php

namespace App\Http\Controllers;

use App\Models\DharamshalaModel;
use Illuminate\Http\Request;
use DataTables;

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
        $validated = $request->validate([
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);

        $identification_proofimg = null;
        if ($request->hasFile('image')) {
            $path_image = 'dashboard-assets/assets/img/dharamshala/';
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

        DharamshalaModel::create($data);
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
