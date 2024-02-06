<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Review;
use App\Models\Article;
use App\Models\Service;
use Jorenvh\Share\Share;
use App\Models\Insurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use ProtoneMedia\Splade\Facades\SEO;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class HomeController extends Controller
{

    public function index(){

        $articles = Article::latest()->where('verified',1)->take(6)->get();
        $reviews = Review::latest()->with('author')->take(6)->get();
        $services = Service::latest()->where('frontpage',1)->take(4)->get();
        $insurances = Insurance::all()->where('frontpage',1);
        $carbon = new Carbon();
        if(Session::get('locale') == 'en') {
            SEO::title('Dr Waleed Haikal Clinic | Home ')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('الرئيسية | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        if(null != Session::get('login_need')) {
            Toast::info(Lang::get('messages.login_need'));
            Session::remove('login_need');
            return view('frontend.home',
                [
                    "articles" => $articles,
                    "reviews" => $reviews,
                    'carbon' => $carbon,
                    'services' => $services,
                    'insurances' => $insurances,
                ]
            );
        }
        return view('frontend.home',
            [
                "articles" => $articles,
                "reviews" => $reviews,
                'carbon' => $carbon,
                'services' => $services,
                'insurances' => $insurances,
            ]
        );
    }
    public function homeRed() {
        return redirect()->route('home');
    }
    public function login() {
        return view('auth.auth');
    }
    public function test() {
        return view('test');
    }
    public function logout(Request $req) {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        Toast::title(Lang::get('toast.logout'));
        return redirect()->back();
    }



}
