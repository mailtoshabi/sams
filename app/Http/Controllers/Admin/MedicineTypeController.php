<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicineType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class MedicineTypeController extends Controller
{
    public function index(Request $request)
    {
        $query = MedicineType::query();

        // 🔍 Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 🏷️ Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $medicine_types = $query->oldest()->paginate(15)->appends($request->all());

        return view('admin.medicine_types.index', compact('medicine_types'));
    }

    public function create()
    {
        return view('admin.medicine_types.create');
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

        MedicineType::create($validated);

        return redirect()->route('admin.medicine_types.index')->with('success', 'Medicine Type created successfully.');
    }

    public function show(MedicineType $medicine_type)
    {
        return view('admin.medicine_types.show', compact('medicine_type'));
    }

    public function edit(MedicineType $medicine_type)
    {
        return view('admin.medicine_types.edit', compact('medicine_type'));
    }

    public function update(Request $request, MedicineType $medicine_type)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ayurveda_name' => 'required|string|max:255'
        ]);

        $medicine_type->update([
            'name' => $request->name,
            'ayurveda_name' => $request->ayurveda_name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.medicine_types.index')->with('success', 'Medicine Type updated successfully.');
    }

    public function destroy(MedicineType $medicine_type)
    {
        $medicine_type->delete();
        return redirect()->route('admin.medicine_types.index')->with('success', 'Medicine Type deleted.');
    }
}
