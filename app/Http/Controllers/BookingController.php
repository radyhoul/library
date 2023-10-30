<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Book;
use Auth;

class BookingController extends Controller
{
    public function booking(Request $request) {
        $booking = new Booking();
        $booking->user_id = $request->input('user_id');
        $booking->book_id = $request->input('book_id');
        $booking->status = $request->input('status');
        $booking->save();
    
        // Здесь вы можете получить связанный объект книги
        $book = Book::find($request->input('book_id'));
    
        // Если книга найдена, обновите ее поле availability
        if ($book) {
            $book->availability = 0;
            $book->save();
        }
    
        return redirect()->route('profile', Auth::user()->id);
    }

    public function bookingDelete($id) {
        $booking = Booking::find($id);
    
        $book = Book::find($booking->book_id);
    
        if ($book) {
            $book->availability = 1;
            $book->save();
        }
    
        // Удаляем бронь
        $booking->delete();
    
        return redirect()->route('profile', Auth::user()->id);
    }

    public function bookingIssue($id, Request $request) {
        $bookingIssue = Booking::find($id);
    
        $bookingIssue->status = $request->input('status');

        $bookingIssue->save();
    
        return back();
    }

    public function bookingTake($id, Request $request) {
        $bookingIssue = Booking::find($id);
    
        $bookingIssue->status = $request->input('status');

        $bookingIssue->save();
    
        return back();
    }
}
