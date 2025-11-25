<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
{
    public function index(Request $request)
    {
        $query = Chapter::query();

        // 🔍 Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 🏷️ Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $chapters = $query->oldest()->paginate(15)->appends($request->all());

        return view('admin.chapters.index', compact('chapters'));
    }


    public function create()
    {
        return view('admin.chapters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'ayurveda_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:published,draft',
        ]);
        $validated['slug'] = Str::slug($validated['name']);
        $validated['user_id'] = auth()->id() ?? 1;

        Chapter::create($validated);

        return redirect()->route('admin.chapters.index')->with('success', 'Chapter created successfully.');
    }

    public function show(Chapter $chapter)
    {
        return view('admin.chapters.show', compact('chapter'));
    }

    public function edit(Chapter $chapter)
    {
        return view('admin.chapters.edit', compact('chapter'));
    }

    public function update(Request $request, Chapter $chapter)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ayurveda_name' => 'required|string|max:255'
        ]);

        $chapter->update([
            'name' => $request->name,
            'ayurveda_name' => $request->ayurveda_name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.chapters.index')->with('success', 'Chapter updated successfully.');
    }

    public function destroy(Chapter $chapter)
    {
        $chapter->delete();
        return redirect()->route('admin.chapters.index')->with('success', 'Chapter deleted.');
    }
}
