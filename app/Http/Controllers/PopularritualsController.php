<?php

namespace App\Http\Controllers;

use App\Models\PopularritualsModel;
use Illuminate\Http\Request;
use DataTables;

class PopularritualsController extends Controller
{
    public function Popularrituals()
    {
        return view('popular-rituals.popular-rituals');
    }

    public function PopularritualsData(Request $request)
    {

        if ($request->ajax()) {
            $data = PopularritualsModel::latest()->get();

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
                    $editUrl = route('edit-popular-rituals', ['popular_rituals_id' => $row->popular_rituals_id]);
                    $deleteUrl = route('delete-popular-rituals', ['popular_rituals_id' => $row->popular_rituals_id]);

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

    public function Addpopularrituals()
    {
        return view('popular-rituals.add-popular-rituals');
    }

    public function Addstorepopuarrituals(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);

        $identification_proofimg = null;
        if ($request->hasFile('image')) {
            $path_image = 'dashboard-assets/assets/img/popular-rituals/';
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

        PopularritualsModel::create($data);
        return redirect()->route('popular-rituals')->with('success', 'Popular Ritual Added successfully!');
    }

    public function Editpopularrituals($popular_rituals_id)
    {
        $popularritual = PopularritualsModel::findOrFail($popular_rituals_id);
        return view('popular-rituals.edit-popular-rituals', compact('popularritual'));
    }

    public function Editstorepopularrituals(Request $request, $popular_rituals_id)
    {
        $popularritual = PopularritualsModel::findOrFail($popular_rituals_id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $popularritual->title = $request->title;
        $popularritual->description = $request->description;

        if ($request->hasFile('image')) {
            $path_image = 'dashboard-assets/assets/img/popular-rituals/';
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($path_image), $filename);
            $popularritual->image = $path_image . $filename;
        } else {
            $popularritual->image = $request->hidden_image;
        }
        $popularritual->save();
        return redirect()->route('popular-rituals')->with('success', 'Popular Rituals updated successfully!');
    }

    public function deletepopularrituals($popular_rituals_id)
    {
        $popularritual = PopularritualsModel::findOrFail($popular_rituals_id);

        // Delete image from public folder if exists
        if ($popularritual->image && file_exists(public_path($popularritual->image))) {
            unlink(public_path($popularritual->image));
        }

        $popularritual->delete();
        return redirect()->route('popular-rituals')->with('success', 'Popular Rituals deleted successfully!');
    }
}
