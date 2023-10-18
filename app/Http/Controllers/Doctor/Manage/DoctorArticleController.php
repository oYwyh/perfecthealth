<?php

namespace App\Http\Controllers\Doctor\Manage;

use App\Models\Article;
use App\Tables\Articles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\Splade\Facades\Toast;

class DoctorArticleController extends Controller
{
    public function index() {
        return view('dashboard.doctor.manage.articles.index',[
            'articles' => Articles::class,
        ]);
    }
    public function add(Request $req) {
        return view('dashboard.doctor.manage.articles.add');
    }
    public function create(Request $req) {
        $formField = $req->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'content' => 'required',
                'tags' => 'required',
                'image'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]
        );
        $article = new Article();
        $article->title = $req->title;
        $article->description = $req->description;
        $article->content = $req->content;
        $article->tags = $req->tags;
        $article->author = 'doctor-'.Auth::user()->id;
        if($req->file('image')) {
            $article->image = $req->file('image')->store('images/articles/thumbnails/','public');
        }else {
            unset($formField['image']); // remove 'image' from the form fields if no new image is uploaded
        }
        $save = $article->save();
        Toast::title('Article Created Successfuly!');
        return redirect()->route('doctor.manage.articles.index');
    }
    public function edit(Request $req) {
        return view('dashboard.doctor.manage.articles.edit',[
            'id'=> $req->id,
            'article' => Article::find($req->id),
        ]);
    }
    public function update(Request $req) {
        $formField = $req->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'content' => 'required',
                'tags'=> 'required'
            ]
        );
        $article = Article::find($req->id);
        $article->tags = $req->tags;
        $article->author = 'doctor-'.Auth::user()->id;
        if($req->file('image')) {
            $article->image = $req->file('image')->store('images/articles/thumbnails','public');
        }else {
            unset($formField['image']); // remove 'image' from the form fields if no new image is uploaded
        }
        $article->update($formField);
        Toast::title('Article Updated Successfuly!')
        ->autoDismiss(5);
        return redirect()->route('doctor.manage.articles.index');
    }
    public function delete(Request $req) {
        Article::find($req->id)->delete();
        Toast::success('Article Removed Successfuly!');
        return redirect()->back();
    }
}
