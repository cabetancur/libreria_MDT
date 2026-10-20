<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with(['category', 'authors'])->get();

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();

        return view('books.create', compact('categories', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'publication_year' => ['nullable', 'integer', 'min:0', 'max:2155'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'authors' => ['nullable', 'array'],
            'authors.*' => ['integer', 'distinct', 'exists:authors,id'],
        ]);

        DB::transaction(function () use ($validated): void {
            $book = Book::create(collect($validated)->except('authors')->all());
            $book->authors()->sync($validated['authors'] ?? []);
        });

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $book->load('authors');
        $categories = Category::all();
        $authors = Author::all();

        return view('books.edit', compact('book', 'categories', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'publication_year' => ['nullable', 'integer', 'min:0', 'max:2155'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'authors' => ['nullable', 'array'],
            'authors.*' => ['integer', 'distinct', 'exists:authors,id'],
        ]);

        DB::transaction(function () use ($validated, $book): void {
            $book->update(collect($validated)->except('authors')->all());
            $book->authors()->sync($validated['authors'] ?? []);
        });

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->authors()->detach();
        $book->delete();

        return redirect()->route('books.index');
    }
}
