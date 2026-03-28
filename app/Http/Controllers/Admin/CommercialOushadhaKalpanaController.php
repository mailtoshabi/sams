<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommercialOushadhaKalpana;
use App\Models\Formulation;
use Illuminate\Http\Request;

class CommercialOushadhaKalpanaController extends Controller
{
    public function index(Request $request)
    {
        $query = CommercialOushadhaKalpana::query();

        // 🔍 Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $items = $query->with('formulation')->oldest()->paginate(15)->appends($request->all());

        return view('admin.commercial_oushadha_kalpanas.index', compact('items'));
    }

    public function create()
    {
        $formulations = Formulation::where('status', 'published')->oldest()->get();
        return view('admin.commercial_oushadha_kalpanas.create', compact('formulations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'formulation_id' => 'required|exists:formulations,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        CommercialOushadhaKalpana::create($validated);

        return redirect()->route('admin.commercial_oushadha_kalpanas.index')->with('success', 'Commercial Oushadha Kalpana created successfully.');
    }

    public function edit(CommercialOushadhaKalpana $commercialOushadhaKalpana)
    {
        $formulations = Formulation::where('status', 'published')->oldest()->get();
        return view('admin.commercial_oushadha_kalpanas.create', compact('commercialOushadhaKalpana', 'formulations'));
    }

    public function update(Request $request, CommercialOushadhaKalpana $commercialOushadhaKalpana)
    {
        $validated = $request->validate([
            'formulation_id' => 'required|exists:formulations,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $commercialOushadhaKalpana->update($validated);

        return redirect()->route('admin.commercial_oushadha_kalpanas.index')->with('success', 'Commercial Oushadha Kalpana updated successfully.');
    }

    public function destroy(CommercialOushadhaKalpana $commercialOushadhaKalpana)
    {
        $commercialOushadhaKalpana->delete();
        return redirect()->route('admin.commercial_oushadha_kalpanas.index')->with('success', 'Commercial Oushadha Kalpana deleted successfully.');
    }
}
