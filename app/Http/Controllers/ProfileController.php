<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Book;
use Illuminate\Support\Facades\Hash;
use Auth;

class ProfileController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }


    public function index($id) {
        $user = User::find($id);
        $allUsers = User::all();
        $booking = Booking::all();
        
        $book = Book::all();

        return view('profile', compact('user', 'allUsers' , 'booking', 'book'));
    }

    public function personalEdit($id, Request $request) {        
        $user = User::find($id);

        $user->surname = $request->input('surname');
        $user->name = $request->input('name');
        $user->patronymic = $request->input('patronymic');
        $user->date = $request->input('date');
        $user->email = $request->input('email');

        $user->save();

        return back();
    }

    public function profileDelete($id) {
        $user = User::with('booking')->find($id);
    
        // Сначала получите список бронирований пользователя
        $userBookings = $user->booking;
    
        // Измените значение поля `availability` для соответствующих книг
        foreach ($userBookings as $booking) {
            $booking->book->update(['availability' => 1]);
            $booking->forceDelete();
        }
    
        // Удалите пользователя
        $user->delete();
    
        return back();
    }

    public function profileCreate(Request $request) {

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'date' => 'required|date',
            'password' => 'required|string|min:8|confirmed', 
        ]);

        User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'date' => $request->date,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('profile', Auth::user()->id);
    }
}
