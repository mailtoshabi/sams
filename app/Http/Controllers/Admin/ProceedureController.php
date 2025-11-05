<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proceedure;
use App\Models\Title;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProceedureController extends Controller
{
    public function index()
    {
        return '';
        $proceedures = Proceedure::with('titles')->latest()->paginate(20);
        return view('admin.proceedures.index', compact('proceedures'));
    }

    public function create()
    {
        return '';
        $titles = Title::where('status', 'published')->orderBy('name')->get();;
        return view('admin.proceedures.create', compact('titles'));
    }

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

        $proceedure = Proceedure::create($validated);

        if ($request->has('titles')) {
            foreach ($request->titles as $titleId => $data) {
                $heading = trim($data['heading'] ?? '');
                if ($heading !== '') {
                    $description = trim($data['description'] ?? '');
                    $imagePath = null;
                    if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $imagePath = $data['image']->store('proceedures', 'public');
                    }
                    $proceedure->titles()->attach($titleId, [
                        'heading' => $heading,
                        'description' => $description,
                        'image_path' => $imagePath,
                    ]);
                }
            }
        }

        return redirect()->route('admin.proceedures.index')
            ->with('success', 'Proceedure created successfully.');
    }

    public function edit(Proceedure $proceedure)
    {
        $titles = Title::where('status', 'published')->orderBy('name')->get();;
        $proceedure->load('titles');
        return view('admin.proceedures.edit', compact('proceedure', 'titles'));
    }

    public function update(Request $request, Proceedure $proceedure)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:published,draft',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            if ($proceedure->image_path) {
                Storage::disk('public')->delete($proceedure->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('proceedures', 'public');
        }

        $proceedure->update($validated);

        $proceedure->titles()->detach();

        if ($request->has('titles')) {
            foreach ($request->titles as $titleId => $data) {
                $heading = trim($data['heading'] ?? '');
                if ($heading !== '') {
                    $description = trim($data['description'] ?? '');
                    $imagePath = null;
                    if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $imagePath = $data['image']->store('proceedures', 'public');
                    }
                    $proceedure->titles()->attach($titleId, [
                        'heading' => $heading,
                        'description' => $description,
                        'image_path' => $imagePath,
                    ]);
                }
            }
        }

        return redirect()->route('admin.proceedures.index')
            ->with('success', 'Proceedure updated successfully.');
    }

    public function show(Proceedure $proceedure)
    {
        $proceedure->load(['titles', 'user']);
        return view('admin.proceedures.show', compact('proceedure'));
    }

    public function destroy(Proceedure $proceedure)
    {
        if ($proceedure->image_path) {
            Storage::disk('public')->delete($proceedure->image_path);
        }

        foreach ($proceedure->titles as $title) {
            if ($title->pivot->image_path) {
                Storage::disk('public')->delete($title->pivot->image_path);
            }
        }

        $proceedure->titles()->detach();
        $proceedure->delete();

        return back()->with('success', 'Proceedure deleted successfully.');
    }
}
