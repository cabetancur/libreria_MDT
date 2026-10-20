<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_categories_can_be_created_listed_updated_and_deleted(): void
    {
        $this->get('/categories')
            ->assertOk()
            ->assertSee('Categorías');

        $this->get('/categories/create')
            ->assertOk()
            ->assertSee('Crear categoría');

        $this->post('/categories', [
            'name' => 'Novela',
            'description' => 'Novelas de todos los géneros.',
        ])->assertRedirect('/categories');

        $category = Category::firstOrFail();

        $this->get("/categories/{$category->id}/edit")
            ->assertOk()
            ->assertSee('Novela');

        $this->put("/categories/{$category->id}", [
            'name' => 'Ciencia ficción',
            'description' => 'Historias futuristas.',
        ])->assertRedirect('/categories');

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Ciencia ficción',
        ]);

        $this->delete("/categories/{$category->id}")
            ->assertRedirect('/categories');

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_category_fields_are_required(): void
    {
        $this->post('/categories', [])
            ->assertSessionHasErrors(['name', 'description']);
    }
}
