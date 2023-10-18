<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Models\Article;
use App\Tables\Articles;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use ProtoneMedia\Splade\Facades\SEO;
use Illuminate\Support\Facades\Route;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;
use Stichoza\GoogleTranslate\GoogleTranslate;

class AdminArticleController extends Controller
{
    public function index() {
        if(Session::get('locale') == 'en') {
            SEO::title('Articles | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('المقالات | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        return view('dashboard.admin.manage.articles.index',[
            'articles' => Articles::class,
        ]);
    }
    public function edit(Request $req) {
        if(Session::get('locale') == 'en') {
            SEO::title('Edit | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('تعديل | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        if(null != $req->oldImage) {
            $oldImage = $req->oldImage;
        }else {
            $oldImage = null;
        }
        return view('dashboard.admin.manage.articles.edit',[
            'id'=> $req->id,
            'oldImage' => $oldImage,
            'article' => Article::find($req->id),
        ]);
    }
    public function add(Request $req) {
        if(Session::get('locale') == 'en') {
            SEO::title('Add | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('إضافة | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        return view('dashboard.admin.manage.articles.add');
    }
    public function translate(Request $req) {
        $formField = $req->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'content' => 'required',
                'tags' => 'required',
                'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'lang' => 'required',
            ]
        );
        if($req->file('image')) {
            $image = $req->file('image');
            $filename = time() . '_' . Str::random(10) . '_' . uniqid().'.'.$image->getClientOriginalExtension();
            $path = $image->storeAs('images/articles/thumbnails', $filename, 'public');
            $formField['image'] = $path;
            Session::put('uploaded_image_article', $path);
        }
        $translated = \translate($req->content, $req->lang,$path, ['title' => $req->title, 'description' => $req->description, 'tags' => $req->tags]);
        if($req->lang == 'en') {
            $native = [
                'id' => $req->query('id'),
                'oldImage' => $req->query('oldImage'),
                'title' => $req->title,
                'description' => $req->description,
                'tags' => $req->tags,
                'content' => $req->content,
                'image' => $path,
                'lang' => 'en'
            ];
        }else {
            $native = [
                'id' => $req->query('id'),
                'oldImage' => $req->query('oldImage'),
                'title' => $req->title,
                'description' => $req->description,
                'tags' => $req->tags,
                'content' => $req->content,
                'image' => $path,
                'lang' => 'ar',
            ];
        }
        $prevRoute = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
        Session::put('translated', $translated);
        Session::put('native', $native);
        Session::put('prevRoute', $prevRoute);
        return redirect()->route('admin.manage.articles.translator');
    }
    public function translator(Request $req) {
        if(Session::get('locale') == 'en') {
            SEO::title('Add | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('إضافة | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        $translated = Session::get('translated');
        $native = Session::get('native');
        $prevRoute = Session::get('prevRoute');
        return view('dashboard.admin.manage.articles.translator',compact('translated','native','prevRoute'));
    }
    public function create(Request $req) {
        $native = Session::get('native');
        $formField = $req->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'content' => 'required',
                'tags' => 'required',
                'lang' => 'nullable',
            ]
        );
        if($req->lang == 'en') {
            $article = new Article();
            $article->title = $req->title;
            $article->description = $req->description;
            $article->content = $req->content;
            $article->tags = $req->tags;
            $article->title_ar = $native['title'];
            $article->description_ar = $native['description'];
            $article->content_ar = $native['content'];
            $article->tags_ar = $native['tags'];
            $article->image = $native['image'];
            $article->image_ar = $native['image'];
            $article->author = 'admin-'.Auth::user()->id;
            $article->verified = 1;
        }else {
            $article = new Article();
            $article->title = $native['title'];
            $article->description = $native['description'];
            $article->content = $native['content'];
            $article->tags = $native['tags'];
            $article->image = $native['image'];
            $article->image_ar = $native['image'];
            $article->title_ar = $req->title;
            $article->description_ar = $req->description;
            $article->content_ar = $req->content;
            $article->tags_ar = $req->tags;
            $article->author = 'admin-'.Auth::user()->id;
            $article->verified = 1;
        }
        $save = $article->save();
        Session::forget('uploaded_image_article');
        Toast::success(Lang::get('toast.article_created'));
        return redirect()->route('admin.manage.articles.index');
    }

    public function update(Request $req) {
        $native = Session::get('native');
        $formField = $req->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'content' => 'required',
                'tags' => 'required',
                'lang' => 'nullable',
            ]
        );
        $oldImage = Session::get('native')['oldImage'];
        if(null != $oldImage) {
            unlink(public_path('storage/'.$oldImage));
        }
        $article = Article::find($native['id']);
        if($req->lang == 'en') {
            $article->title = $req->title;
            $article->description = $req->description;
            $article->content = $req->content;
            $article->tags = $req->tags;
            $article->title_ar = $native['title'];
            $article->description_ar = $native['description'];
            $article->content_ar = $native['content'];
            $article->tags_ar = $native['tags'];
            $article->image_ar = $native['image'];
            $article->image = $native['image'];
            $article->author = 'admin-'.Auth::user()->id;
            $article->verified = 1;
        }else {
            $article->title = $native['title'];
            $article->description = $native['description'];
            $article->content = $native['content'];
            $article->tags = $native['tags'];
            $article->image = $native['image'];
            $article->image_ar = $native['image'];
            $article->title_ar = $req->title;
            $article->description_ar = $req->description;
            $article->content_ar = $req->content;
            $article->tags_ar = $req->tags;
            $article->author = 'admin-'.Auth::user()->id;
            $article->verified = 1;
        }
        $article->save();
        Session::forget('uploaded_image_article');
        Toast::success(Lang::get('toast.article_updated'));
        return redirect()->route('admin.manage.articles.index');
    }
    public function verify(Request $req) {
        $article = Article::find($req->id);
        $article->verified = 1;
        $article->save();
        Toast::success(Lang::get('toast.article_verified'));

        return redirect()->route('admin.manage.articles.index');
    }
    public function disprove(Request $req) {
        $article = Article::find($req->id);
        $article->verified = 0;
        $article->save();
        Toast::success(Lang::get('toast.article_disprove'));
        return redirect()->route('admin.manage.articles.index');
    }
    public function delete(Request $req) {
        $article = Article::find($req->id);
        $oldImage = $article->image;
        if($oldImage && file_exists(public_path('storage/'.$oldImage))) {
            unlink(public_path('storage/'.$oldImage));
        }
        $article->delete();
        Toast::success(Lang::get('toast.article_deleted'));
        return redirect()->back();
    }
}
