<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\SEO;
use Illuminate\Support\Facades\Session;

class infoController extends Controller
{
    public function index(Request $req) {
        $carbon = new Carbon();
        if(Session::get('locale') == 'en') {
            SEO::title('Dr Waleed Haikal Clinic | Info')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('أعرف | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        return view('frontend.info',[
            'carbon' => $carbon,
        ]);
    }
}
