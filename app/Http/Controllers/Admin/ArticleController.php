<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Author;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        if ($request->filled('search')) {
            $query->where('heading', 'like', '%' . $request->search . '%')
                  ->orWhere('article', 'like', '%' . $request->search . '%')
                  ->orWhereHas('author', function ($q) use ($request) {
                      $q->where('name', 'like', '%' . $request->search . '%');
                  });
        }

        $articles = $query->with('author')->oldest()->paginate(15)->appends($request->all());
        $authors = Author::oldest()->get();

        return view('admin.articles.index', compact('articles', 'authors'));
    }

    public function create()
    {
        $authors = Author::oldest()->get();
        return view('admin.articles.create', compact('authors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'heading' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'article' => 'required|string',
        ]);

        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Article created successfully.');
    }

    public function edit(Article $article)
    {
        $authors = Author::oldest()->get();
        return view('admin.articles.create', compact('article', 'authors'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'heading' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'article' => 'required|string',
        ]);

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully.');
    }
}
