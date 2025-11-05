<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
use Illuminate\Http\Request;
use Utility;

class ContentItemController extends Controller
{

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

    // 🟩 CREATE PAGE
    public function specific($category_id)
    {
        $default_category = Category::findOrFail(decrypt($category_id));

        if($default_category->id==1) {
            return view('admin.content-items.create', [
                'default_category' => $default_category,
                'categories' => Category::all(),
                'contentItem' => null,
            ]);
        }else {
            abort(404);
        }
    }

    // 🟦 EDIT PAGE (within category)
    public function specific_edit($category_id, $content_id)
    {
        $default_category = Category::findOrFail(decrypt($category_id));
        $contentItem = ContentItem::findOrFail(decrypt($content_id));

        return view('admin.content-items.edit', [
            'default_category' => $default_category,
            'categories' => Category::all(),
            'contentItem' => $contentItem,
        ]);
    }

    // 🟨 STORE NEW CONTENT
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

    // 🟧 UPDATE EXISTING CONTENT
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

    public function ajaxCategoryFields($id)
{
    $categoryId = (int) $id;

    $html = '';

    switch ($categoryId) {
        case Utility::CATEGORY_CLASSICAL_DISEASE:
            $html = view('admin.content-items.partials._classical_fields', [
                'divisions' => Division::all(),
                'chapters' => Chapter::all(),
                'formulations' => Formulation::all(),
                'medicines' => Medicine::all(),
            ])->render();
            break;

        case Utility::CATEGORY_COMMERCIAL_CLASSICAL_MEDICINE:
        case Utility::CATEGORY_PROPRIETARY_MEDICINE:
            $html = view('admin.content-items.partials._medicine_fields', [
                'formulations' => Formulation::all(),
                'medicines' => Medicine::all(),
            ])->render();
            break;

        case Utility::CATEGORY_PATENT_MEDICINE:
        case Utility::CATEGORY_MORDERN_DISEASE:
            $html = view('admin.content-items.partials._disease_fields', [
                'diseases' => Disease::all(),
            ])->render();
            break;

        case Utility::CATEGORY_AYURVEDIC_PROCEEDURES:
            $html = view('admin.content-items.partials._proceedure_fields', [
                'divisions' => Division::all(),
                'proceedures' => Proceedure::all(),
            ])->render();
            break;
    }

    return response()->json(['html' => $html]);
}


    // 🟥 DELETE
    public function destroy(ContentItem $contentItem)
    {
        $contentItem->delete();
        return redirect()->route('admin.content-items.index')
            ->with('success', 'Content item deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $item = ContentItem::findOrFail($id);

        // Toggle between 'draft' and 'published'
        $item->status = $item->status === 'published' ? 'draft' : 'published';
        $item->save();

        return response()->json([
            'success' => true,
            'status' => $item->status,
            'message' => "Status changed to {$item->status}",
        ]);
    }
}
