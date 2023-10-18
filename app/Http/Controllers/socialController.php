<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Jorenvh\Share\Share;
use Illuminate\Http\Request;

class socialController extends Controller
{
    public function index()
    {

        return view('posts.index', compact('buttons', 'articles'));
    }
}
