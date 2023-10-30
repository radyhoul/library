<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Feedback extends Model
{
    public function book() {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
