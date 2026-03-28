<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RawDrugIndex;
use Illuminate\Http\Request;

class RawDrugIndexController extends Controller
{
    public function index(Request $request)
    {
        $query = RawDrugIndex::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('local_name', 'like', '%' . $request->search . '%')
                  ->orWhere('sanskrit_name', 'like', '%' . $request->search . '%')
                  ->orWhere('botanical_name', 'like', '%' . $request->search . '%');
        }

        $items = $query->oldest()->paginate(15)->appends($request->all());

        return view('admin.raw_drug_indices.index', compact('items'));
    }

    public function create()
    {
        return view('admin.raw_drug_indices.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'local_name' => 'nullable|string|max:255',
            'sanskrit_name' => 'nullable|string|max:255',
            'botanical_name' => 'nullable|string|max:255',
            'part_used' => 'nullable|string|max:255',
        ]);

        RawDrugIndex::create($validated);

        return redirect()->route('admin.raw_drug_indices.index')->with('success', 'Raw Drug Index created successfully.');
    }

    public function edit(RawDrugIndex $rawDrugIndex)
    {
        return view('admin.raw_drug_indices.create', compact('rawDrugIndex'));
    }

    public function update(Request $request, RawDrugIndex $rawDrugIndex)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'local_name' => 'nullable|string|max:255',
            'sanskrit_name' => 'nullable|string|max:255',
            'botanical_name' => 'nullable|string|max:255',
            'part_used' => 'nullable|string|max:255',
        ]);

        $rawDrugIndex->update($validated);

        return redirect()->route('admin.raw_drug_indices.index')->with('success', 'Raw Drug Index updated successfully.');
    }

    public function destroy(RawDrugIndex $rawDrugIndex)
    {
        $rawDrugIndex->delete();
        return redirect()->route('admin.raw_drug_indices.index')->with('success', 'Raw Drug Index deleted successfully.');
    }
}
