<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class DivisionController extends Controller
{
    public function index(Request $request)
{
    $query = Division::query();

    // 🔍 Search by name
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // 🏷️ Filter by status
    if ($request->filled('status') && $request->status !== 'all') {
        $query->where('status', $request->status);
    }

    $divisions = $query->oldest()->paginate(15)->appends($request->all());

    return view('admin.divisions.index', compact('divisions'));
}

    public function create()
    {
        return view('admin.divisions.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'ayurveda_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => $request->status,
        ]);
        $validated['slug'] = Str::slug($validated['name']);
        $validated['user_id'] = auth()->id() ?? 1;

        Division::create($validated);

        return redirect()->route('admin.divisions.index')->with('success', 'Division created successfully.');
    }

    public function show(Division $division)
    {
        return view('admin.divisions.show', compact('division'));
    }

    public function edit(Division $division)
    {
        return view('admin.divisions.edit', compact('division'));
    }

    public function update(Request $request, Division $division)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ayurveda_name' => 'required|string|max:255',
        ]);

        $division->update([
            'name' => $request->name,
            'ayurveda_name' => $request->ayurveda_name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.divisions.index')->with('success', 'Division updated successfully.');
    }

    public function destroy(Division $division)
    {
        $division->delete();
        return redirect()->route('admin.divisions.index')->with('success', 'Division deleted.');
    }
}
