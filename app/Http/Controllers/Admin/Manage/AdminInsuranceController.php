<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Models\Insurance;
use App\Tables\Insurances;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use ProtoneMedia\Splade\Facades\SEO;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;

class AdminInsuranceController extends Controller
{
    public function index() {
        if(Session::get('locale') == 'en') {
            SEO::title('Insurances | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('التامينات | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        return view('dashboard.admin.manage.insurances.index',[
            'insurances' => Insurances::class,
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
        return view('dashboard.admin.manage.insurances.edit',[
            'id'=> $req->id,
            'insurance' => Insurance::find($req->id),
        ]);
    }
    public function update(Request $req) {
        $formField = $req->validate(
            [
                'title' => 'required',
                'title_ar' => 'required',
                'image' => 'required|image'
            ]
        );
        $insurance = Insurance::find($req->id);
        $insurance->title = $req->title;
        $insurance->title_ar = $req->title_ar;
        $frontpage = $req->frontpage;
        if($frontpage == 0) {
            $frontpage = 0;
        }else {
            $frontpage = 1;
        }
        $insurance->frontpage = $frontpage;
        $oldImage = $insurance->image;
        if($req->hasFile('image')) {
            $image = $req->file('image');
            $filename = time() . '_' . Str::random(10) . '_' . uniqid().'.'.$image->getClientOriginalExtension();
            $path = $image->storeAs('images/insurances/logos', $filename, 'public');
            $formField['image'] = $path;
            $insurance->image = $path;
            // delete the old image file
            if($oldImage && file_exists(public_path('storage/'.$oldImage))) {
                unlink(public_path('storage/'.$oldImage));
            }
        } else {
            unset($formField['image']); // remove 'image' from the form fields if no new image is uploaded
        }
        $insurance->save();
        Toast::success(Lang::get('toast.insurance_updated'));
        return redirect()->route('admin.manage.insurances.index');
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
        return view('dashboard.admin.manage.insurances.add');
    }
    // public function translate(Request $req) {
    //     $formField = $req->validate(
    //         [
    //             'title' => 'required',
    //             'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //             'lang' => 'required',
    //         ]
    //     );
    //     if($req->file('image')) {
    //         $image = $req->file('image');
    //         $filename = time() . '_' . Str::random(10) . '_' . uniqid().'.'.$image->getClientOriginalExtension();
    //         $path = $image->storeAs('images/insurances/logos', $filename, 'public');
    //         $formField['image'] = $path;
    //     }
    //     $translated = \translate(null, $req->lang,$path, ['title' => $req->title, 'description' => $req->description, 'tags' => $req->tags]);

    //     if($req->lang == 'en') {
    //         $native = [
    //             'id' => $req->query('id'),
    //             'title' => $req->title,
    //             'frontpage' => $req->frontpage,
    //             'image' => $path,
    //             'lang' => 'en'
    //         ];
    //     }else {
    //         $native = [
    //             'id' => $req->query('id'),
    //             'title' => $req->title,
    //             'frontpage' => $req->frontpage,
    //             'image' => $path,
    //             'lang' => 'ar',
    //         ];
    //     }
    //     // dd($translated);
    //     $prevRoute = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
    //     Session::put('translated', $translated);
    //     Session::put('native', $native);
    //     Session::put('prevRoute', $prevRoute);
    //     return redirect()->route('admin.manage.insurances.translator');
    // }
    // public function translator(Request $req) {
    //     $translated = Session::get('translated');
    //     $native = Session::get('native');
    //     $prevRoute = Session::get('prevRoute');
    //     return view('dashboard.admin.manage.insurances.translator',compact('translated','native','prevRoute'));
    // }
    public function create(Request $req) {
        $formField = $req->validate(
            [
                'title' => 'required',
                'title_ar' => 'required',
                'image' => 'required|image'
            ]
        );
        $insurance = new Insurance();
        $insurance->title = $req->title;
        $insurance->title_ar = $req->title_ar;
        $frontpage = $req->frontpage;
        if($frontpage == 0) {
            $frontpage = 0;
        }else {
            $frontpage = 1;
        }
        $insurance->frontpage = $frontpage;
        if($req->file('image')) {
            $image = $req->file('image');
            $filename = time() . '_' . Str::random(10) . '_' . uniqid().'.'.$image->getClientOriginalExtension();
            $path = $image->storeAs('images/insurances/logos', $filename, 'public');
            $insurance->image = $path;
        }
        $save = $insurance->save();
        Toast::success(Lang::get('toast.insurance_created'));
        return redirect()->route('admin.manage.insurances.index');
    }
    public function delete(Request $req) {
        $insurance = Insurance::find($req->id);
        $oldImage = $insurance->image;
        if($oldImage && file_exists(public_path('storage/'.$oldImage))) {
            unlink(public_path('storage/'.$oldImage));
        }
        $insurance->delete();
        Toast::success(Lang::get('toast.insurance_deleted'));
        return redirect()->back();
    }
    public function verify(Request $req) {
        $service = Insurance::find($req->id);
        $service->frontpage = 1;
        $service->save();
        Toast::success(Lang::get('toast.insurance_verified'));
        return redirect()->route('admin.manage.insurances.index');
    }
    public function disprove(Request $req) {
        $service = Insurance::find($req->id);
        $service->frontpage = 0;
        $service->save();
        Toast::success(Lang::get('toast.insurance_disprove'));
        return redirect()->route('admin.manage.insurances.index');
    }
}
