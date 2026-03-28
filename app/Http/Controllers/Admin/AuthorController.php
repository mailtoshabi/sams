<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $query = Author::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('designation', 'like', '%' . $request->search . '%');
        }

        $items = $query->oldest()->paginate(15)->appends($request->all());

        return view('admin.authors.index', compact('items'));
    }

    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
        ]);

        Author::create($validated);

        return redirect()->route('admin.authors.index')->with('success', 'Author created successfully.');
    }

    public function edit(Author $author)
    {
        return view('admin.authors.create', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
        ]);

        $author->update($validated);

        return redirect()->route('admin.authors.index')->with('success', 'Author updated successfully.');
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('admin.authors.index')->with('success', 'Author deleted successfully.');
    }
}
