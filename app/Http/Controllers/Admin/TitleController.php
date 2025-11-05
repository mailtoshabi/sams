<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TitleController extends Controller
{
    public function index(Request $request)
    {
        $query = Title::query();

        // 🔍 Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        // 🏷️ Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $titles = $query->latest()->paginate(15)->appends($request->all());

        return view('admin.titles.index', compact('titles'));
    }

    public function create()
    {
        return view('admin.titles.create', ['title' => new Title()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:titles,name',
            'description' => 'nullable|string',
            'status' => 'required|in:draft,published',
        ]);

        $validated['status'] = $validated['status'] ?? 'draft';
        $validated['slug'] = Str::slug($request->name);
        $validated['user_id'] = auth()->id();

        Title::create($validated);

        return redirect()->route('admin.titles.index')
            ->with('success', 'Title created successfully.');
    }

    public function edit(Title $title)
    {
        return view('admin.titles.edit', compact('title'));
    }

    public function update(Request $request, Title $title)
    {
        $validated = $request->validate([
            'name' => 'required|unique:titles,name,' . $title->id,
            'description' => 'nullable|string',
            'status' => 'required|in:draft,published',
        ]);

        $validated['slug'] = Str::slug($request->name);

        $title->update($validated);

        return redirect()->route('admin.titles.index')
            ->with('success', 'Title updated successfully.');
    }

    public function destroy(Title $title)
    {
        $title->delete();

        return redirect()->route('admin.titles.index')
            ->with('success', 'Title deleted successfully.');
    }
}
