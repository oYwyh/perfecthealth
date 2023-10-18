<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Article;
use Jorenvh\Share\Share;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\SEO;
use Illuminate\Support\Facades\Session;

class ArticleController extends Controller
{
    public function index(Request $req) {
        $carbon = new Carbon();
        if(Session::get('locale') == 'en') {
            SEO::title('Dr Waleed Haikal Clinic | Articles ')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('المقالات | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        return view('frontend.articles.index',[
            'articles' => Article::latest()->where('verified',1)->filter(request(['tag','search']))->paginate(8),
            'carbon' => $carbon,
        ]);
    }
    public function show(Article $article, Share $share) {
        $carbon = new Carbon();
        $shareLinks = $share->page(url("/articles/{$article->id}"), $article->title)
            ->facebook()
            ->twitter()
            ->linkedin()
            ->whatsapp()
            ->getRawLinks();
            $startsWithAdmin = Str::startsWith($article->author, 'admin-');
            if($startsWithAdmin) {
                $author = Admin::find(str_replace('admin-', '', $article->author));
            }else {
                $author = Doctor::find(str_replace('doctor-', '', $article->author));
            }

        return view('frontend.articles.show', [
            'article' => $article,
            'author' => $author,
            'carbon' => $carbon,
            'shareLinks' => $shareLinks,
        ]);
    }
}
