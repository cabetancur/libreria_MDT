<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_books_can_be_created_listed_updated_and_deleted_with_authors(): void
    {
        $category = Category::create([
            'name' => 'Novela',
            'description' => 'Narrativa.',
        ]);
        $author = Author::create([
            'name' => 'Autora de prueba',
        ]);

        $this->get('/books')
            ->assertOk()
            ->assertSee('Libros');

        $this->get('/books/create')
            ->assertOk()
            ->assertSee('Crear libro');

        $this->post('/books', [
            'title' => 'Libro de prueba',
            'publication_year' => 2020,
            'category_id' => $category->id,
            'authors' => [$author->id],
            'description' => 'Descripción del libro.',
        ])->assertRedirect('/books');

        $book = Book::firstOrFail();

        $this->assertDatabaseHas('author_book', [
            'book_id' => $book->id,
            'author_id' => $author->id,
        ]);

        $this->get("/books/{$book->id}/edit")
            ->assertOk()
            ->assertSee('Libro de prueba');

        $this->put("/books/{$book->id}", [
            'title' => 'Libro actualizado',
            'publication_year' => 2021,
            'category_id' => $category->id,
            'authors' => [],
            'description' => 'Descripción actualizada.',
        ])->assertRedirect('/books');

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Libro actualizado',
            'publication_year' => 2021,
        ]);
        $this->assertDatabaseMissing('author_book', ['book_id' => $book->id]);

        $this->delete("/books/{$book->id}")
            ->assertRedirect('/books');

        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    public function test_book_requires_a_title_and_valid_category(): void
    {
        $this->post('/books', [])
            ->assertSessionHasErrors(['title', 'category_id']);
    }
}
