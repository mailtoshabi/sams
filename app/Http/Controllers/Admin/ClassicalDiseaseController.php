<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassicalDisease;
use App\Models\Division;
use App\Models\Chapter;
use App\Models\MedicineType;
use App\Models\Formulation;
use App\Models\Medicine;

class ClassicalDiseaseController extends Controller
{
    /**
     * Display a listing of classical disease links.
     */
    public function index(Request $request)
    {
        $query = ClassicalDisease::with(['division', 'chapter', 'medicineType', 'formulation', 'medicine']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('division', function ($dv) use ($search) {
                    $dv->where('name', 'like', "%{$search}%");
                })->orWhereHas('chapter', function ($ch) use ($search) {
                    $ch->where('name', 'like', "%{$search}%");
                })->orWhereHas('medicineType', function ($mt) use ($search) {
                    $mt->where('name', 'like', "%{$search}%");
                })->orWhereHas('formulation', function ($f) use ($search) {
                    $f->where('name', 'like', "%{$search}%");
                })->orWhereHas('medicine', function ($m) use ($search) {
                    $m->where('name', 'like', "%{$search}%");
                });
            });
        }

        $classicalDiseases = $query->oldest()->paginate(Utility::PAGINATE_COUNT)->appends($request->all());
        return view('admin.classical_diseases.index', compact('classicalDiseases'));
    }

    /**
     * Show the form for creating a new classical disease link.
     */
    public function create()
    {
        $divisions = Division::where('status', 'published')->oldest()->get();
        $chapters = Chapter::where('status', 'published')->oldest()->get();
        $medicine_types = MedicineType::where('status', 'published')->oldest()->get();
        $formulations = Formulation::where('status', 'published')->oldest()->get();
        $medicines = Medicine::where('status', 'published')->oldest()->get();

        return view('admin.classical_diseases.create', compact('divisions', 'chapters', 'medicine_types', 'formulations', 'medicines'));
    }

    /**
     * Store a newly created classical disease link.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'chapter_id' => 'required|exists:chapters,id',
            'medicine_type_id' => 'required|exists:medicine_types,id',
            'formulation_id' => 'required|exists:formulations,id',
            'medicine_id' => 'required|exists:medicines,id',
        ]);

        // Check uniqueness
        $exists = ClassicalDisease::where('division_id', $validated['division_id'])
            ->where('chapter_id', $validated['chapter_id'])
            ->where('medicine_type_id', $validated['medicine_type_id'])
            ->where('formulation_id', $validated['formulation_id'])
            ->where('medicine_id', $validated['medicine_id'])
            ->exists();

        if ($exists) {
            return back()->withInput()->withErrors(['medicine_id' => 'This combination of fields is already linked.']);
        }

        ClassicalDisease::create($validated);

        return redirect()->route('admin.classical_diseases.index')->with('success', 'Classical disease link created successfully.');
    }

    /**
     * Display the specified classical disease link.
     */
    public function show(ClassicalDisease $classicalDisease)
    {
        $classicalDisease->load(['division', 'chapter', 'medicineType', 'formulation', 'medicine']);
        return view('admin.classical_diseases.show', compact('classicalDisease'));
    }

    /**
     * Show the form for editing the specified classical disease link.
     */
    public function edit(ClassicalDisease $classicalDisease)
    {
        $divisions = Division::where('status', 'published')->oldest()->get();
        $chapters = Chapter::where('status', 'published')->oldest()->get();
        $medicine_types = MedicineType::where('status', 'published')->oldest()->get();
        $formulations = Formulation::where('status', 'published')->oldest()->get();
        $medicines = Medicine::where('status', 'published')->oldest()->get();

        $classicalDisease->load(['division', 'chapter', 'medicineType', 'formulation', 'medicine']);

        return view('admin.classical_diseases.edit', compact('classicalDisease', 'divisions', 'chapters', 'medicine_types', 'formulations', 'medicines'));
    }

    /**
     * Update the specified classical disease link.
     */
    public function update(Request $request, ClassicalDisease $classicalDisease)
    {
        $validated = $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'chapter_id' => 'required|exists:chapters,id',
            'medicine_type_id' => 'required|exists:medicine_types,id',
            'formulation_id' => 'required|exists:formulations,id',
            'medicine_id' => 'required|exists:medicines,id',
        ]);

        // Check uniqueness excluding current record
        $exists = ClassicalDisease::where('division_id', $validated['division_id'])
            ->where('chapter_id', $validated['chapter_id'])
            ->where('medicine_type_id', $validated['medicine_type_id'])
            ->where('formulation_id', $validated['formulation_id'])
            ->where('medicine_id', $validated['medicine_id'])
            ->where('id', '!=', $classicalDisease->id)
            ->exists();

        if ($exists) {
            return back()->withInput()->withErrors(['medicine_id' => 'This combination of fields is already linked.']);
        }

        $classicalDisease->update($validated);

        return redirect()->route('admin.classical_diseases.index')->with('success', 'Classical disease link updated successfully.');
    }

    /**
     * Remove the specified classical disease link.
     */
    public function destroy(ClassicalDisease $classicalDisease)
    {
        $classicalDisease->delete();
        return redirect()->route('admin.classical_diseases.index')->with('success', 'Classical disease link deleted successfully.');
    }
}
