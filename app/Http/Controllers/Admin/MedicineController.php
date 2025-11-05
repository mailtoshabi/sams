<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\Title;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MedicineController extends Controller
{
    /**
     * Display all medicines.
     */
    public function index()
    {
        $medicines = Medicine::with('titles')->latest()->paginate(20);
        return view('admin.medicines.index', compact('medicines'));
    }

    /**
     * Show the form to create a new medicine.
     */
    public function create()
    {
        $titles = Title::where('status', 'published')->orderBy('name')->get();
        return view('admin.medicines.create', compact('titles'));
    }

    /**
     * Store a newly created medicine.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:published,draft',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['user_id'] = auth()->id() ?? 1;

        // Save medicine
        $medicine = Medicine::create($validated);

        // Handle pivot titles (only if heading provided)
        if ($request->has('titles')) {
            foreach ($request->titles as $titleId => $data) {
                $heading = trim($data['heading'] ?? '');
                $description = trim($data['description'] ?? '');
                $image = $data['image'] ?? null;

                if ($heading !== '') {
                    $imagePath = null;

                    if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $imagePath = $data['image']->store('medicines', 'public');
                    }

                    $medicine->titles()->attach($titleId, [
                        'heading' => $heading,
                        'description' => $description,
                        'image_path' => $imagePath,
                    ]);
                }
            }
        }

        return redirect()->route('admin.medicines.index')
            ->with('success', 'Medicine created successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit(Medicine $medicine)
    {
        $titles = Title::where('status', 'published')->orderBy('name')->get();;
        $medicine->load('titles');
        return view('admin.medicines.edit', compact('medicine', 'titles'));
    }

    /**
     * Update the specified medicine.
     */
    public function update(Request $request, Medicine $medicine)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:published,draft',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            if ($medicine->image_path) {
                Storage::disk('public')->delete($medicine->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('medicines', 'public');
        }

        $medicine->update($validated);

        // Update pivot table
        $medicine->titles()->detach();

        if ($request->has('titles')) {
            foreach ($request->titles as $titleId => $data) {
                $heading = trim($data['heading'] ?? '');
                $description = trim($data['description'] ?? '');
                $imagePath = null;

                if ($heading !== '') {
                    if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $imagePath = $data['image']->store('medicines', 'public');
                    }

                    $medicine->titles()->attach($titleId, [
                        'heading' => $heading,
                        'description' => $description,
                        'image_path' => $imagePath,
                    ]);
                }
            }
        }

        return redirect()->route('admin.medicines.index')
            ->with('success', 'Medicine updated successfully.');
    }

    public function show(Medicine $medicine)
    {
        $medicine->load(['titles', 'user']);
        return view('admin.medicines.show', compact('medicine'));
    }


    /**
     * Delete a medicine.
     */
    public function destroy(Medicine $medicine)
    {
        // Remove associated images
        if ($medicine->image_path) {
            Storage::disk('public')->delete($medicine->image_path);
        }

        foreach ($medicine->titles as $title) {
            if ($title->pivot->image_path) {
                Storage::disk('public')->delete($title->pivot->image_path);
            }
        }

        $medicine->titles()->detach();
        $medicine->delete();

        return back()->with('success', 'Medicine deleted successfully.');
    }
}
