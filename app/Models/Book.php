<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "publication_year",
        "category_id",
        "description"
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_book', 'book_id', 'author_id');
    }
}
