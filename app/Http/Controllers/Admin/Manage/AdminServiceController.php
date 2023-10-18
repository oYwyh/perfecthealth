<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Models\Service;
use App\Tables\Services;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use ProtoneMedia\Splade\Facades\SEO;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;


class AdminServiceController extends Controller
{
    public function index() {
        if(Session::get('locale') == 'en') {
            SEO::title('Services | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('الخدمات | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        return view('dashboard.admin.manage.services.index',[
            'services' => Services::class,
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
        return view('dashboard.admin.manage.services.edit',[
            'id'=> $req->id,
            'oldImage' => $oldImage,
            'service' => Service::find($req->id),
        ]);
    }
    public function translate(Request $req) {
        $formField = $req->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'tags' => 'required',
                'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'lang' => 'required',
            ]
        );
        if($req->file('image')) {
            $image = $req->file('image');
            $filename = time() . '_' . Str::random(10) . '_' . uniqid().'.'.$image->getClientOriginalExtension();
            $path = $image->storeAs('images/services/logos', $filename, 'public');
            $formField['image'] = $path;
            Session::put('uploaded_image_service', $path);
        }
        $translated = \translate(null, $req->lang,$path, ['title' => $req->title, 'description' => $req->description, 'tags' => $req->tags]);
        if($req->lang == 'en') {
            $native = [
                'id' => $req->query('id'),
                'oldImage' => $req->query('oldImage'),
                'title' => $req->title,
                'description' => $req->description,
                'tags' => $req->tags,
                'frontpage' => $req->frontpage,
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
                'frontpage' => $req->frontpage,
                'image' => $path,
                'lang' => 'ar',
            ];
        }
        $prevRoute = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
        Session::put('translated', $translated);
        Session::put('native', $native);
        Session::put('prevRoute', $prevRoute);
        return redirect()->route('admin.manage.services.translator');
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
        return view('dashboard.admin.manage.services.translator',compact('translated','native','prevRoute'));
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
        return view('dashboard.admin.manage.services.add');
    }
    public function create(Request $req) {
        $native = Session::get('native');
        $formField = $req->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'tags' => 'required',
            ]
        );
        if($req->lang == 'en') {
            $service = new Service();
            $service->title = $req->title;
            $service->description = $req->description;
            $service->tags = $req->tags;
            $service->title_ar = $native['title'];
            $service->description_ar = $native['description'];
            $service->tags_ar = $native['tags'];
            $service->image = $native['image'];
            $service->image_ar = $native['image'];
            $frontpage = $native['frontpage'];
            if($frontpage == 0) {
                $frontpage = 0;
            }else {
                $frontpage = 1;
            }
            $service->frontpage = $frontpage;
        }else {
            $service = new Service();
            $service->title = $native['title'];
            $service->description = $native['description'];
            $service->tags = $native['tags'];
            $service->image = $native['image'];
            $service->image_ar = $native['image'];
            $service->title_ar = $req->title;
            $service->description_ar = $req->description;
            $service->tags_ar = $req->tags;
            $frontpage = $native['frontpage'];
            if($frontpage == 0) {
                $frontpage = 0;
            }else {
                $frontpage = 1;
            }
            $service->frontpage = $frontpage;
        }
        $save = $service->save();
        Session::forget('uploaded_image_service');
        Toast::success(Lang::get('toast.service_created'));
        return redirect()->route('admin.manage.services.index');
    }
    public function update(Request $req) {
        $native = Session::get('native');
        $formField = $req->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'tags' => 'required',
                'lang' => 'nullable',
            ]
        );
        $oldImage = Session::get('native')['oldImage'];
        if(null != $oldImage) {
            unlink(public_path('storage/'.$oldImage));
        }
        $service = Service::find($native['id']);
        if($req->lang == 'en') {
            $service->title = $req->title;
            $service->description = $req->description;
            $service->tags = $req->tags;
            $service->title_ar = $native['title'];
            $service->description_ar = $native['description'];
            $service->tags_ar = $native['tags'];
            $service->image = $native['image'];
            $service->image_ar = $native['image'];
            $frontpage = $req->frontpage;
            if($frontpage == 0) {
                $frontpage = 0;
            }else {
                $frontpage = 1;
            }
            $service->frontpage = $frontpage;
        }else {
            $service->title = $native['title'];
            $service->description = $native['description'];
            $service->tags = $native['tags'];
            $service->image = $native['image'];
            $service->image_ar = $native['image'];
            $service->title_ar = $req->title;
            $service->description_ar = $req->description;
            $service->tags_ar = $req->tags;
            $frontpage = $req->frontpage;
            if($frontpage == 0) {
                $frontpage = 0;
            }else {
                $frontpage = 1;
            }
            $service->frontpage = $frontpage;
        }
        $service->save();
        Toast::success(Lang::get('toast.service_updated'));
        Session::forget('uploaded_image_service');
        return redirect()->route('admin.manage.services.index');
    }
    public function delete(Request $req) {
        $service = Service::find($req->id);
        $oldImage = $service->image;
        if($oldImage && file_exists(public_path('storage/'.$oldImage))) {
            unlink(public_path('storage/'.$oldImage));
        }
        $service->delete();
        Toast::success(Lang::get('toast.service_deleted'));
        return redirect()->back();
    }
    public function verify(Request $req) {
        $service = Service::find($req->id);
        $service->frontpage = 1;
        $service->save();
        Toast::success(Lang::get('toast.service_verified'));

        return redirect()->route('admin.manage.services.index');
    }
    public function disprove(Request $req) {
        $service = Service::find($req->id);
        $service->frontpage = 0;
        $service->save();
        Toast::success(Lang::get('toast.service_disprove'));
        return redirect()->route('admin.manage.services.index');
    }
}
