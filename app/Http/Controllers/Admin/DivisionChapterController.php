<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Chapter;
use Illuminate\Http\Request;

class DivisionChapterController extends Controller
{
    public function index()
    {
        $divisions = Division::with('chapters')->get();
        $chapters = Chapter::all();
        return view('admin.divisions.chapters', compact('divisions', 'chapters'));
    }

    public function attach(Request $request)
    {
        $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'chapter_ids' => 'array|required',
        ]);

        $division = Division::findOrFail($request->division_id);
        $division->chapters()->syncWithoutDetaching($request->chapter_ids);

        return back()->with('success', 'Chapters linked to Division successfully.');
    }

    public function detach(Request $request, Division $division, Chapter $chapter)
    {
        $division->chapters()->detach($chapter->id);
        return back()->with('success', 'Chapter unlinked from Division.');
    }
}
