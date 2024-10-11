<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'is_available'
    ];
    public function borrowedBooks() {
        return $this->hasMany(BorrowedBook::class);
    }
    public function borrowers()
    {
        return $this->belongsToMany(User::class, 'borrowed_books')->withPivot('borrowed_at', 'return_date');
    }
}
