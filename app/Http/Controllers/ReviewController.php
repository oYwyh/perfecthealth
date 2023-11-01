<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use ProtoneMedia\Splade\Facades\Toast;

class ReviewController extends Controller
{
    public function index() {
        return view('components.review');
    }
    public function post(Request $req) {
        $formField = $req->validate([
            'stars' => 'required',
            'content' => 'required',
        ]);
        $review = new Review();
        $review->author = Auth::user()->id;
        $review->fullname = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $review->username = Auth::user()->name;
        $review->image = Auth::user()->image;
        $review->content = $req->content;
        $review->stars = $req->stars;
        $review->verified = 0;
        $review->save();
        Toast::title(Lang::get('toast.review_post'));
        return redirect()->back();
    }
}
