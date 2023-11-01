<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Models\Review;
use App\Tables\Reviews;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use ProtoneMedia\Splade\Facades\SEO;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;

class AdminReviewController extends Controller
{
    public function index() {
        if(Session::get('locale') == 'en') {
            SEO::title('Reviews | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('الآراء | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        return view('dashboard.admin.manage.reviews.index',
            [
                'reviews' => Reviews::class
            ]
        );
    }
    public function add(Request $req) {
        return view('dashboard.admin.manage.reviews.add');
    }
    public function create(Request $req) {
        $req->validate([
            'fullname' => 'required',
            'username' => 'required',
            'content' => 'required',
            'stars' => 'required|numeric|max:5|min:1',
        ]);
        $review = new Review();
        $review->author = null;
        $review->fullname = $req->fullname;
        $review->username = $req->username;
        $review->content = $req->content;
        $review->stars = $req->stars;
        $review->verified = 1;
        $review->save();
        Toast::success(Lang::get('toast.review_created'));
        return redirect()->route('admin.manage.reviews.index');
    }
    public function delete(Request $req) {
        $review = Review::find($req->id);
        $review->delete();
        Toast::success(Lang::get('toast.review_deleted'));
        return redirect()->route('admin.manage.reviews.verify');
    }
    public function verify_form(Request $req) {

        return view('dashboard.admin.manage.reviews.verify',
            [
                'review' => Review::find($req->id),
            ]
        );
    }
    public function verify(Request $req) {
        $review = Review::find($req->id);
        $review->verified = 1;
        $review->save();
        Toast::success(Lang::get('toast.review_verified'));
        return redirect()->route('admin.manage.reviews.index');
    }
    public function disprove(Request $req) {
        $review = Review::find($req->id);
        $review->verified = 0;
        $review->save();
        Toast::success(Lang::get('toast.review_disprove'));
        return redirect()->route('admin.manage.reviews.index');
    }
}
