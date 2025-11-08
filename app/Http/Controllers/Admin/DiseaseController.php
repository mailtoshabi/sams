<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disease;
use App\Models\Title;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DiseaseController extends Controller
{
    public function index()
    {
        return '';
        $diseases = Disease::with('titles')->latest()->paginate(20);
        return view('admin.diseases.index', compact('diseases'));
    }

    public function create()
    {
        return '';
        $titles = Title::where('status', 'published')->orderBy('name')->get();;
        return view('admin.diseases.create', compact('titles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'ayurveda_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:published,draft',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['user_id'] = auth()->id() ?? 1;

        $disease = Disease::create($validated);

        // Attach only titles with non-empty heading
        if ($request->has('titles')) {
            foreach ($request->titles as $titleId => $data) {
                $heading = trim($data['heading'] ?? '');
                $description = trim($data['description'] ?? '');
                if ($heading !== '') {
                    $imagePath = null;
                    if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $imagePath = $data['image']->store('diseases', 'public');
                    }

                    $disease->titles()->attach($titleId, [
                        'heading' => $heading,
                        'description' => $description,
                        'image_path' => $imagePath,
                    ]);
                }
            }
        }

        return redirect()->route('admin.diseases.index')
            ->with('success', 'Disease created successfully.');
    }

    public function edit(Disease $disease)
    {
        $titles = Title::where('status', 'published')->orderBy('name')->get();;
        $disease->load('titles');
        return view('admin.diseases.edit', compact('disease', 'titles'));
    }

    public function update(Request $request, Disease $disease)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'ayurveda_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:published,draft',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            if ($disease->image_path) {
                Storage::disk('public')->delete($disease->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('diseases', 'public');
        }

        $disease->update($validated);

        // Refresh pivot
        $disease->titles()->detach();

        if ($request->has('titles')) {
            foreach ($request->titles as $titleId => $data) {
                $heading = trim($data['heading'] ?? '');
                $description = trim($data['description'] ?? '');
                if ($heading !== '') {
                    $imagePath = null;
                    if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $imagePath = $data['image']->store('diseases', 'public');
                    }

                    $disease->titles()->attach($titleId, [
                        'heading' => $heading,
                        'description' => $description,
                        'image_path' => $imagePath,
                    ]);
                }
            }
        }

        return redirect()->route('admin.diseases.index')
            ->with('success', 'Disease updated successfully.');
    }

        public function show(Disease $disease)
{
    $disease->load(['titles', 'user']);
    return view('admin.diseases.show', compact('disease'));
}

    public function destroy(Disease $disease)
    {
        if ($disease->image_path) {
            Storage::disk('public')->delete($disease->image_path);
        }

        foreach ($disease->titles as $title) {
            if ($title->pivot->image_path) {
                Storage::disk('public')->delete($title->pivot->image_path);
            }
        }

        $disease->titles()->detach();
        $disease->delete();

        return back()->with('success', 'Disease deleted successfully.');
    }
}
