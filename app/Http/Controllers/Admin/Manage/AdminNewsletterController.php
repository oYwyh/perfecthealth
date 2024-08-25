<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Models\Newsletter;
use App\Tables\Newsletters;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use ProtoneMedia\Splade\Facades\SEO;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminNewsletterController extends Controller
{
    public function index() {
        if(Session::get('locale') == 'en') {
            SEO::title('Newsletter | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('النشرة الاخبارية | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        return view('dashboard.admin.manage.newsletter.index', [
            'newsletter' => Newsletters::class,
        ]);
    }
    public function remove(Request $req) {
        Newsletter::find($req->id)->delete();
        Toast::success(Lang::get('toast.newsletter_deleted'));
        return redirect()->back();
    }
}
