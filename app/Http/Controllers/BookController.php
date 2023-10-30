<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Booking;
use App\Models\Feedback;
use Auth;

class BookController extends Controller
{

    public function allBook() {
        $bookAll = Book::latest()->take(4)->get();

        return view('welcome', compact('bookAll'));
    }

    public function catalogBook(Request $request) {
        $query = Book::query();
    
        // Фильтрация по категории
        if ($request->has('genre')) {
            $query->where('genre', $request->input('genre'));
        }
    
        // Фильтрация по автору
        if ($request->has('author')) {
            $query->where('author', $request->input('author'));
        }
    
        $bookCatalog = $query->get();
    
        return view('catalog', compact('bookCatalog'));
    }

    public function search(Request $request) {
        $query = $request->input('query');
    
        $bookCatalog = Book::where('name', 'like', "%$query%")
            ->orWhere('genre', 'like', "%$query%")
            ->orWhere('author', 'like', "%$query%")
            ->get();
    
        return view('catalog', compact('bookCatalog'));
    }

    public function book($id) {
        $book = Book::find($id);
        $feedbacks = $book->feedback;

        return view('product', compact('book', 'feedbacks'));
    }

    public function bookEdit($id) {
        $bookEdit = Book::find($id);

        return view('product-edit', compact('bookEdit'));
    }

    public function bookEditSubmit($id, Request $request) {
        $bookEdit = Book::find($id);

        $bookEdit->name = $request->input('name');
        $bookEdit->author = $request->input('author');
        $bookEdit->year = $request->input('year');
        $bookEdit->genre = $request->input('genre');
        $bookEdit->list = $request->input('list');
        $bookEdit->age = $request->input('age');
        $bookEdit->price = $request->input('price');
        $bookEdit->description = $request->input('description');

        // Проверьте, есть ли новое изображение
        if ($request->hasFile('image')) {
            
            // Загрузите новое изображение
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $bookEdit->image = $imageName;
        }

        $bookEdit->save();

        return back();
    }

    public function productDelete($id) {
        $book = Book::find($id);

        $bookings = Booking::where('book_id', $id)->get();
    
        foreach ($bookings as $booking) {
            $booking->delete();
        }
    
        // Удалите саму книгу
        $book->delete();
    
        return redirect()->route('profile', Auth::user()->id);
    }

    public function productCreate(Request $request) {
        $bookCreate = new Book;

        $bookCreate->availability = $request->input('availability');
        $bookCreate->name = $request->input('name');
        $bookCreate->author = $request->input('author');
        $bookCreate->year = $request->input('year');
        $bookCreate->genre = $request->input('genre');
        $bookCreate->list = $request->input('list');
        $bookCreate->age = $request->input('age');
        $bookCreate->price = $request->input('price');
        $bookCreate->description = $request->input('description');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $bookCreate->image = $imageName;
        }

        $bookCreate->save();

        return redirect()->route('profile', Auth::user()->id);
    }
}
