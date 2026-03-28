<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TherapeuticDifference;
use App\Models\TherapeuticDifferencePoint;
use App\Models\Medicine;
use Illuminate\Http\Request;

class TherapeuticDifferenceController extends Controller
{
    public function index(Request $request)
    {
        $query = TherapeuticDifference::query();

        // 🔍 Search by introduction or medicine names
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where('introduction', 'like', $searchTerm)
                  ->orWhereHas('medicine1', function ($q) use ($searchTerm) {
                      $q->where('name', 'like', $searchTerm);
                  })
                  ->orWhereHas('medicine2', function ($q) use ($searchTerm) {
                      $q->where('name', 'like', $searchTerm);
                  });
        }

        $items = $query->with(['medicine1', 'medicine2', 'points'])->oldest()->paginate(15)->appends($request->all());

        return view('admin.therapeutic_differences.index', compact('items'));
    }

    public function create()
    {
        $medicines = Medicine::oldest()->get();
        return view('admin.therapeutic_differences.create', compact('medicines'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'introduction' => 'nullable|string',
            'medicine_1_id' => 'required|exists:medicines,id|different:medicine_2_id',
            'medicine_2_id' => 'required|exists:medicines,id',
            'points' => 'required|array|min:1',
            'points.*.medicine_1_description' => 'required|string',
            'points.*.medicine_2_description' => 'required|string',
        ]);

        // Create therapeutic difference
        $difference = TherapeuticDifference::create([
            'introduction' => $validated['introduction'],
            'medicine_1_id' => $validated['medicine_1_id'],
            'medicine_2_id' => $validated['medicine_2_id'],
        ]);

        // Create points
        foreach ($validated['points'] as $index => $point) {
            TherapeuticDifferencePoint::create([
                'therapeutic_difference_id' => $difference->id,
                'medicine_1_description' => $point['medicine_1_description'],
                'medicine_2_description' => $point['medicine_2_description'],
                'point_number' => $index + 1,
            ]);
        }

        return redirect()->route('admin.therapeutic_differences.index')->with('success', 'Therapeutic Difference created successfully.');
    }

    public function edit(TherapeuticDifference $therapeuticDifference)
    {
        $medicines = Medicine::oldest()->get();
        $therapeuticDifference->load(['medicine1', 'medicine2', 'points']);
        return view('admin.therapeutic_differences.create', compact('therapeuticDifference', 'medicines'));
    }

    public function update(Request $request, TherapeuticDifference $therapeuticDifference)
    {
        $validated = $request->validate([
            'introduction' => 'nullable|string',
            'medicine_1_id' => 'required|exists:medicines,id|different:medicine_2_id',
            'medicine_2_id' => 'required|exists:medicines,id',
            'points' => 'required|array|min:1',
            'points.*.medicine_1_description' => 'required|string',
            'points.*.medicine_2_description' => 'required|string',
        ]);

        // Update therapeutic difference
        $therapeuticDifference->update([
            'introduction' => $validated['introduction'],
            'medicine_1_id' => $validated['medicine_1_id'],
            'medicine_2_id' => $validated['medicine_2_id'],
        ]);

        // Delete old points and create new ones
        $therapeuticDifference->points()->delete();
        foreach ($validated['points'] as $index => $point) {
            TherapeuticDifferencePoint::create([
                'therapeutic_difference_id' => $therapeuticDifference->id,
                'medicine_1_description' => $point['medicine_1_description'],
                'medicine_2_description' => $point['medicine_2_description'],
                'point_number' => $index + 1,
            ]);
        }

        return redirect()->route('admin.therapeutic_differences.index')->with('success', 'Therapeutic Difference updated successfully.');
    }

    public function destroy(TherapeuticDifference $therapeuticDifference)
    {
        $therapeuticDifference->delete();
        return redirect()->route('admin.therapeutic_differences.index')->with('success', 'Therapeutic Difference deleted successfully.');
    }
}
