<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function feedbackCreate(Request $request) {
        $feedback = new Feedback();

        $feedback->username = $request->input('username');
        $feedback->book_id = $request->input('book_id');
        $feedback->title = $request->input('title');
        $feedback->message = $request->input('message');

        $feedback->save();
    
        return back();
    }

    public function feedbackDelete($id) {
        $feedbackDelete = Feedback::find($id);

        $feedbackDelete->delete();
    
        return back();
    }
}
