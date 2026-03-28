<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewPharmaceuticalForm;
use App\Models\PharmaceuticalForm;
use App\Models\ManufacturingCompany;
use Illuminate\Http\Request;

class NewPharmaceuticalFormController extends Controller
{
    public function index(Request $request)
    {
        $query = NewPharmaceuticalForm::query();

        // 🔍 Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $items = $query->with(['pharmaceuticalForm', 'manufacturingCompanies'])->oldest()->paginate(15)->appends($request->all());

        return view('admin.new_pharmaceutical_forms.index', compact('items'));
    }

    public function create()
    {
        $pharmaceuticalForms = PharmaceuticalForm::oldest()->get();
        $manufacturingCompanies = ManufacturingCompany::oldest()->get();
        return view('admin.new_pharmaceutical_forms.create', compact('pharmaceuticalForms', 'manufacturingCompanies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pharmaceutical_form_id' => 'required|exists:pharmaceutical_forms,id',
            'name' => 'required|string|max:255',
            'manufacturing_company_ids' => 'required|array|min:1',
            'manufacturing_company_ids.*' => 'exists:manufacturing_companies,id',
        ]);

        $item = NewPharmaceuticalForm::create([
            'pharmaceutical_form_id' => $validated['pharmaceutical_form_id'],
            'name' => $validated['name'],
        ]);

        // Attach manufacturing companies
        $item->manufacturingCompanies()->sync($validated['manufacturing_company_ids']);

        return redirect()->route('admin.new_pharmaceutical_forms.index')->with('success', 'New Pharmaceutical Form created successfully.');
    }

    public function edit(NewPharmaceuticalForm $newPharmaceuticalForm)
    {
        $pharmaceuticalForms = PharmaceuticalForm::oldest()->get();
        $manufacturingCompanies = ManufacturingCompany::oldest()->get();
        $selectedCompanies = $newPharmaceuticalForm->manufacturingCompanies()->pluck('manufacturing_company_id')->toArray();
        return view('admin.new_pharmaceutical_forms.create', compact('newPharmaceuticalForm', 'pharmaceuticalForms', 'manufacturingCompanies', 'selectedCompanies'));
    }

    public function update(Request $request, NewPharmaceuticalForm $newPharmaceuticalForm)
    {
        $validated = $request->validate([
            'pharmaceutical_form_id' => 'required|exists:pharmaceutical_forms,id',
            'name' => 'required|string|max:255',
            'manufacturing_company_ids' => 'required|array|min:1',
            'manufacturing_company_ids.*' => 'exists:manufacturing_companies,id',
        ]);

        $newPharmaceuticalForm->update([
            'pharmaceutical_form_id' => $validated['pharmaceutical_form_id'],
            'name' => $validated['name'],
        ]);

        // Sync manufacturing companies
        $newPharmaceuticalForm->manufacturingCompanies()->sync($validated['manufacturing_company_ids']);

        return redirect()->route('admin.new_pharmaceutical_forms.index')->with('success', 'New Pharmaceutical Form updated successfully.');
    }

    public function destroy(NewPharmaceuticalForm $newPharmaceuticalForm)
    {
        $newPharmaceuticalForm->delete();
        return redirect()->route('admin.new_pharmaceutical_forms.index')->with('success', 'New Pharmaceutical Form deleted successfully.');
    }
}
