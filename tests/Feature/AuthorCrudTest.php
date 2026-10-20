<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_authors_can_be_created_listed_updated_and_deleted(): void
    {
        $this->get('/authors')
            ->assertOk()
            ->assertSee('Autores');

        $this->get('/authors/create')
            ->assertOk()
            ->assertSee('Crear autor');

        $this->post('/authors', [
            'name' => 'Gabriel García Márquez',
            'nationality' => 'Colombiana',
            'birth_date' => '1927-03-06',
        ])->assertRedirect('/authors');

        $author = Author::firstOrFail();

        $this->get("/authors/{$author->id}/edit")
            ->assertOk()
            ->assertSee('Gabriel García Márquez');

        $this->put("/authors/{$author->id}", [
            'name' => 'Gabriel García Márquez',
            'nationality' => 'Colombiana',
            'birth_date' => '1927-03-06',
        ])->assertRedirect('/authors');

        $this->assertDatabaseHas('authors', [
            'id' => $author->id,
            'name' => 'Gabriel García Márquez',
        ]);

        $this->delete("/authors/{$author->id}")
            ->assertRedirect('/authors');

        $this->assertDatabaseMissing('authors', ['id' => $author->id]);
    }

    public function test_author_name_is_required(): void
    {
        $this->post('/authors', [
            'nationality' => 'Mexicana',
        ])->assertSessionHasErrors(['name']);
    }
}
