<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ManufacturingCompany;
use Illuminate\Http\Request;

class ManufacturingCompanyController extends Controller
{
    public function index(Request $request)
    {
        $query = ManufacturingCompany::query();

        // 🔍 Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $items = $query->oldest()->paginate(15)->appends($request->all());

        return view('admin.manufacturing_companies.index', compact('items'));
    }

    public function create()
    {
        return view('admin.manufacturing_companies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:manufacturing_companies,name',
        ]);

        ManufacturingCompany::create($validated);

        return redirect()->route('admin.manufacturing_companies.index')->with('success', 'Manufacturing Company created successfully.');
    }

    public function edit(ManufacturingCompany $manufacturingCompany)
    {
        return view('admin.manufacturing_companies.create', compact('manufacturingCompany'));
    }

    public function update(Request $request, ManufacturingCompany $manufacturingCompany)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:manufacturing_companies,name,' . $manufacturingCompany->id,
        ]);

        $manufacturingCompany->update($validated);

        return redirect()->route('admin.manufacturing_companies.index')->with('success', 'Manufacturing Company updated successfully.');
    }

    public function destroy(ManufacturingCompany $manufacturingCompany)
    {
        $manufacturingCompany->delete();
        return redirect()->route('admin.manufacturing_companies.index')->with('success', 'Manufacturing Company deleted successfully.');
    }
}
