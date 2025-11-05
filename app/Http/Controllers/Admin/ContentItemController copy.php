<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Category,
    Division,
    Chapter,
    Formulation,
    Medicine,
    Disease,
    Proceedure,
    ContentItem,
    Title
};
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ContentItemController extends Controller
{
    /**
     * Display all content items.
     */
    // public function index()
    // {
    //     $contentItems = ContentItem::with(['category', 'division', 'chapter', 'formulation', 'medicine', 'disease', 'proceedure'])
    //         ->latest()
    //         ->paginate(20);

    //     return view('admin.content-items.index', compact('contentItems'));
    // }

    public function index(Request $request)
    {
        $query = ContentItem::with(['category', 'division', 'chapter', 'formulation', 'medicine', 'disease', 'proceedure']);

        // 🔹 Filter by Category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 🔹 Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 🔹 Filter by Type (medicine/disease/proceedure)
        if ($request->filled('type')) {
            $query->whereNotNull("{$request->type}_id");
        }

        // 🔹 Keyword Search (by linked item name)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('medicine', fn($m) => $m->where('name', 'like', "%$search%"))
                ->orWhereHas('disease', fn($d) => $d->where('name', 'like', "%$search%"))
                ->orWhereHas('proceedure', fn($p) => $p->where('name', 'like', "%$search%"))
                ->orWhereHas('category', fn($c) => $c->where('name', 'like', "%$search%"))
                ->orWhereHas('division', fn($dv) => $dv->where('name', 'like', "%$search%"))
                ->orWhereHas('chapter', fn($ch) => $ch->where('name', 'like', "%$search%"))
                ->orWhereHas('formulation', fn($f) => $f->where('name', 'like', "%$search%"));
            });
        }

        $contentItems = $query->latest()->paginate(20);

        return view('admin.content-items.index', compact('contentItems'));
    }

    /**
     * Show form to create a content item.
     */
    public function create(Request $request)
    {
        $default_category = Category::first(); // or pass via route param if dynamic
        $titles = Title::all();

        return view('admin.content-items.create', compact('default_category', 'titles'));
    }

    /**
     * Store a new content item.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'division_id' => 'nullable|exists:divisions,id',
            'chapter_id' => 'nullable|exists:chapters,id',
            'formulation_id' => 'nullable|exists:formulations,id',
            'medicine_id' => 'nullable|exists:medicines,id',
            'disease_id' => 'nullable|exists:diseases,id',
            'proceedure_id' => 'nullable|exists:proceedures,id',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'published';

        $item = ContentItem::create($validated);

        return redirect()->route('admin.content-items.index')
            ->with('success', 'Content item created successfully.');
    }

    /**
     * Edit a content item.
     */
    public function edit(ContentItem $contentItem)
    {
        $titles = Title::all();
        $default_category = $contentItem->category;
        return view('admin.content-items.edit', compact('contentItem', 'titles', 'default_category'));
    }


    public function specific($id)
    {
        $default_category = Category::findOrFail(decrypt($id));
        if($default_category->id == 1) {
            return view('admin.content-items.create', [
                'categories' => Category::all(),

                'default_category' => $default_category,
            ]);
        }else {
            abort(404);
        }
    }

    /**
     * Update content item.
     */
    public function update(Request $request, ContentItem $contentItem)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'division_id' => 'nullable|exists:divisions,id',
            'chapter_id' => 'nullable|exists:chapters,id',
            'formulation_id' => 'nullable|exists:formulations,id',
            'medicine_id' => 'nullable|exists:medicines,id',
            'disease_id' => 'nullable|exists:diseases,id',
            'proceedure_id' => 'nullable|exists:proceedures,id',
        ]);

        $validated['user_id'] = auth()->id();

        $contentItem->update($validated);

        return redirect()->route('admin.content-items.index')
            ->with('success', 'Content item updated successfully.');
    }

    /**
     * Delete a content item.
     */
    public function destroy(ContentItem $contentItem)
    {
        $contentItem->delete();

        return back()->with('success', 'Content item deleted successfully.');
    }

    /**
     * AJAX helper – dynamically load fields by category.
     */
    public function getCategoryFields($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $html = '';

        $name = strtolower($category->name);

        if (str_contains($name, 'classical disease')) {
            $html = View::make('admin.content-items.partials._classical_fields', [
                'divisions' => Division::all(),
                'chapters' => Chapter::all(),
                'formulations' => Formulation::all(),
                'medicines' => Medicine::all(),
            ])->render();

        } elseif (str_contains($name, 'commercial') || str_contains($name, 'proprietary')) {
            $html = View::make('admin.content-items.partials._medicine_fields', [
                'formulations' => Formulation::all(),
                'medicines' => Medicine::all(),
            ])->render();

        } elseif (str_contains($name, 'patent') || str_contains($name, 'modern')) {
            $html = View::make('admin.content-items.partials._disease_fields', [
                'diseases' => Disease::all(),
            ])->render();

        } elseif (str_contains($name, 'ayurvedic')) {
            $html = View::make('admin.content-items.partials._proceedure_fields', [
                'divisions' => Division::all(),
                'proceedures' => Proceedure::all(),
            ])->render();

        } else {
            $html = '<div class="alert alert-secondary">No specific fields for this category.</div>';
        }

        return response()->json(['status' => true, 'html' => $html]);
    }
}
