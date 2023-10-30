<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;
use App\Models\Feedback;

class Book extends Model
{
    protected $fillable = [
        'name',
        'author',
        'year',
        'genre',
        'list',
        'age',
        'price',
        'description',
        'availability', // Добавьте поле 'availability' в массив $fillable
    ];

    
    public function bookings() {
        return $this->hasMany(Booking::class, 'book_id', 'id');
    }

    public function feedback() {
        return $this->hasMany(Feedback::class, 'book_id');
    }

}
