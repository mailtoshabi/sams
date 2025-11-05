<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formulation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class FormulationController extends Controller
{
    public function index(Request $request)
    {
        $query = Formulation::query();

        // 🔍 Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 🏷️ Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $formulations = $query->latest()->paginate(15)->appends($request->all());

        return view('admin.formulations.index', compact('formulations'));
    }

    public function create()
    {
        return view('admin.formulations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:published,draft',
        ]);
        $validated['slug'] = Str::slug($validated['name']);
        $validated['user_id'] = auth()->id() ?? 1;

        Formulation::create($validated);

        return redirect()->route('admin.formulations.index')->with('success', 'Formulation created successfully.');
    }

    public function show(Formulation $formulation)
    {
        return view('admin.formulations.show', compact('formulation'));
    }

    public function edit(Formulation $formulation)
    {
        return view('admin.formulations.edit', compact('formulation'));
    }

    public function update(Request $request, Formulation $formulation)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $formulation->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'status' => 'nullable|string|in:published,draft',
        ]);

        return redirect()->route('admin.formulations.index')->with('success', 'Formulation updated successfully.');
    }

    public function destroy(Formulation $formulation)
    {
        $formulation->delete();
        return redirect()->route('admin.formulations.index')->with('success', 'Formulation deleted.');
    }
}
