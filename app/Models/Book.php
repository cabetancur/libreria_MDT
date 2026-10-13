<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        "Title",
        "Publication_Year",
        "Category_id",
        "description"
    ];
    public function Category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function Authors(){
        return $this->belongsToMany(Author::class, 'Author_book','book_id','Author_id');
    }
}
