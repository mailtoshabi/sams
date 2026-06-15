<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModernDisease;
use App\Models\Division;
use App\Models\Disease;
use App\Models\Medicine;
use App\Models\Proceedure;

class ModernDiseaseController extends Controller
{
    /**
     * Display a listing of modern disease links.
     */
    public function index(Request $request)
    {
        $query = ModernDisease::with(['division', 'disease', 'medicines', 'proceedures']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('division', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('disease', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $modernDiseases = $query->oldest()->paginate(Utility::PAGINATE_COUNT)->appends($request->all());
        return view('admin.modern_diseases.index', compact('modernDiseases'));
    }

    /**
     * Show the form for creating a new modern disease link.
     */
    public function create()
    {
        $divisions = Division::where('status', 'published')->oldest()->get();
        $diseases = Disease::where('status', 'published')->oldest()->get();
        $oldMedicines = [];
        if (old('medicines')) {
            $oldMedicines = Medicine::whereIn('id', old('medicines'))->get();
        }
        $oldProceedures = [];
        if (old('proceedures')) {
            $oldIds = array_keys(old('proceedures'));
            $oldProceedures = Proceedure::whereIn('id', $oldIds)->get()->map(function ($proc) {
                $proc->old_description = old('proceedures.' . $proc->id . '.description');
                return $proc;
            });
        }
        return view('admin.modern_diseases.create', compact('divisions', 'diseases', 'oldMedicines', 'oldProceedures'));
    }

    /**
     * Store a newly created modern disease link.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'disease_id' => 'required|exists:diseases,id',
            'medicines' => 'nullable|array',
            'medicines.*' => 'exists:medicines,id',
            'proceedures' => 'nullable|array',
            'proceedures.*' => 'array',
            'proceedures.*.description' => 'nullable|string',
        ]);

        $proceedureInput = $request->input('proceedures', []);
        if (!empty($proceedureInput)) {
            $proceedureIds = array_keys($proceedureInput);
            $validCount = Proceedure::whereIn('id', $proceedureIds)->count();
            if (count($proceedureIds) !== $validCount) {
                return back()->withInput()->withErrors(['proceedures' => 'One or more selected procedures are invalid.']);
            }
        }

        // Check uniqueness
        $exists = ModernDisease::where('division_id', $validated['division_id'])
            ->where('disease_id', $validated['disease_id'])
            ->exists();

        if ($exists) {
            return back()->withInput()->withErrors(['disease_id' => 'This Division and Disease are already linked.']);
        }

        $modernDisease = ModernDisease::create([
            'division_id' => $validated['division_id'],
            'disease_id' => $validated['disease_id'],
        ]);

        $modernDisease->medicines()->sync($validated['medicines'] ?? []);
        $modernDisease->proceedures()->sync($proceedureInput);

        return redirect()->route('admin.modern_diseases.index')->with('success', 'Modern disease link created successfully.');
    }

    /**
     * Display the specified modern disease link.
     */
    public function show(ModernDisease $modernDisease)
    {
        $modernDisease->load(['division', 'disease', 'medicines', 'proceedures']);
        return view('admin.modern_diseases.show', compact('modernDisease'));
    }

    /**
     * Show the form for editing the specified modern disease link.
     */
    public function edit(ModernDisease $modernDisease)
    {
        $divisions = Division::where('status', 'published')->oldest()->get();
        $diseases = Disease::where('status', 'published')->oldest()->get();
        $modernDisease->load(['division', 'disease', 'medicines', 'proceedures']);
        return view('admin.modern_diseases.edit', compact('modernDisease', 'divisions', 'diseases'));
    }

    /**
     * Update the specified modern disease link.
     */
    public function update(Request $request, ModernDisease $modernDisease)
    {
        $validated = $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'disease_id' => 'required|exists:diseases,id',
            'medicines' => 'nullable|array',
            'medicines.*' => 'exists:medicines,id',
            'proceedures' => 'nullable|array',
            'proceedures.*' => 'array',
            'proceedures.*.description' => 'nullable|string',
        ]);

        $proceedureInput = $request->input('proceedures', []);
        if (!empty($proceedureInput)) {
            $proceedureIds = array_keys($proceedureInput);
            $validCount = Proceedure::whereIn('id', $proceedureIds)->count();
            if (count($proceedureIds) !== $validCount) {
                return back()->withInput()->withErrors(['proceedures' => 'One or more selected procedures are invalid.']);
            }
        }

        // Check uniqueness excluding current record
        $exists = ModernDisease::where('division_id', $validated['division_id'])
            ->where('disease_id', $validated['disease_id'])
            ->where('id', '!=', $modernDisease->id)
            ->exists();

        if ($exists) {
            return back()->withInput()->withErrors(['disease_id' => 'This Division and Disease are already linked.']);
        }

        $modernDisease->update([
            'division_id' => $validated['division_id'],
            'disease_id' => $validated['disease_id'],
        ]);

        $modernDisease->medicines()->sync($validated['medicines'] ?? []);
        $modernDisease->proceedures()->sync($proceedureInput);

        return redirect()->route('admin.modern_diseases.index')->with('success', 'Modern disease link updated successfully.');
    }

    /**
     * Remove the specified modern disease link.
     */
    public function destroy(ModernDisease $modernDisease)
    {
        $modernDisease->delete();
        return redirect()->route('admin.modern_diseases.index')->with('success', 'Modern disease link deleted successfully.');
    }
}
