<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PharmaceuticalForm;
use Illuminate\Http\Request;

class PharmaceuticalFormController extends Controller
{
    public function index(Request $request)
    {
        $query = PharmaceuticalForm::query();

        // 🔍 Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $items = $query->oldest()->paginate(15)->appends($request->all());

        return view('admin.pharmaceutical_forms.index', compact('items'));
    }

    public function create()
    {
        return view('admin.pharmaceutical_forms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:pharmaceutical_forms,name',
        ]);

        PharmaceuticalForm::create($validated);

        return redirect()->route('admin.pharmaceutical_forms.index')->with('success', 'Pharmaceutical Form created successfully.');
    }

    public function edit(PharmaceuticalForm $pharmaceuticalForm)
    {
        return view('admin.pharmaceutical_forms.create', compact('pharmaceuticalForm'));
    }

    public function update(Request $request, PharmaceuticalForm $pharmaceuticalForm)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:pharmaceutical_forms,name,' . $pharmaceuticalForm->id,
        ]);

        $pharmaceuticalForm->update($validated);

        return redirect()->route('admin.pharmaceutical_forms.index')->with('success', 'Pharmaceutical Form updated successfully.');
    }

    public function destroy(PharmaceuticalForm $pharmaceuticalForm)
    {
        $pharmaceuticalForm->delete();
        return redirect()->route('admin.pharmaceutical_forms.index')->with('success', 'Pharmaceutical Form deleted successfully.');
    }
}
