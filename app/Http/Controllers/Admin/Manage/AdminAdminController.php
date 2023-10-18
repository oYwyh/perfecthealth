<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Models\Admin;
use App\Tables\Admins;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use ProtoneMedia\Splade\Facades\SEO;
use App\Rules\UniqueEmailAcrossTables;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;

class AdminAdminController extends Controller
{
    public function index() {
        if(Session::get('locale') == 'en') {
            SEO::title('Admins | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('المدراء | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        return view('dashboard.admin.manage.admins.index',[
            'admins' => Admins::class,
        ]);
    }
    public function edit(Request $req) {
        return view('dashboard.admin.manage.admins.edit',[
            'id'=> $req->id,
            'admin' => Admin::find($req->id),
        ]);
    }
    public function update(Request $req) {
        $admin = Admin::find($req->id);
        $admin->update($req->validate(
            [
                'name' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => ['required', 'email', new UniqueEmailAcrossTables($admin->id)],
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
                'phone' => 'required|numeric',
                'gender' => 'required',
                'date_of_brith' => 'required',
            ]
        ));
        Toast::success(Lang::get('toast.profile_updated'));
        return redirect()->route('admin.manage.admins.index');
    }
    public function add(Request $req) {
        return view('dashboard.admin.manage.admins.add');
    }
    public function register(Request $req) {
        $req->validate(
            [
                'name' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => ['required', 'email', new UniqueEmailAcrossTables],
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
                'phone' => 'required|numeric',
                'gender' => 'required',
                'date_of_brith' => 'required',
            ]
        );
        $admin = new Admin();
        $admin->name = $req->name;
        $admin->first_name = $req->first_name;
        $admin->last_name = $req->last_name;
        $admin->email = $req->email;
        $admin->gender = $req->email;
        $admin->date_of_brith = $req->email;
        $admin->phone = $req->phone;
        $admin->password = Hash::make($req->password);
        $save = $admin->save();
        Toast::success(Lang::get('toast.acc_register'));
        return redirect()->route('admin.manage.admins.index');
    }
    public function delete(Request $req) {
        Admin::find($req->id)->delete();
        Toast::success(Lang::get('toast.acc_deleted'));
        return redirect()->back();
    }
    public function control(Request $req) {
        $admin = Admin::find($req->id);
        return view('dashboard.admin.manage.admins.profile',compact('admin'));
    }
    public function super(Request $req) {
        $admin = Admin::find($req->id);
        if($req->superadmin == 1) {
            $admin->superadmin = $req->superadmin;
        }else {
            $admin->superadmin = 0;
        }
        $admin->save();
        Toast::success(Lang::get('toast.profile_updated'));
        return redirect()->back();
    }
    public function profile_update(Request $req) {
        $formField = $req->validate(
            [
                'name' => 'required',
                'email' => ['required', 'email', new UniqueEmailAcrossTables($req->id)],
                'image'=> 'nullable',
            ]
        );
        $admin = Admin::find($req->id);
        $oldImage = $admin->image; // get the old image path
        // check if the user did not change anything
        if ($formField['name'] == $admin->name && $formField['email'] == $admin->email && (!$req->hasFile('image') || $oldImage == $formField['image'])) {
            Toast::danger(Lang::get('toast.data_changed'));
            return redirect()->back();
        }
        if($req->hasFile('image')) {
            $image = $req->file('image');
            $filename = time() . '_' . Str::random(10) . '_' . uniqid().'.'.$image->getClientOriginalExtension();
            $path = $image->storeAs('images/profiles/admins', $filename, 'public');
            $formField['image'] = $path;
            $admin->image = $path;
            // delete the old image file
            if($oldImage && file_exists(public_path('storage/'.$oldImage))) {
                unlink(public_path('storage/'.$oldImage));
            }
        } else {
            unset($formField['image']); // remove 'image' from the form fields if no new image is uploaded
        }
        $admin->update($formField);
        Toast::success(Lang::get('toast.profile_updated'));
        return redirect()->back();
    }

    public function personal_update(Request $req) {
        $formField = $req->validate(
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'date_of_brith' => 'required',
                'phone'=> 'required|numeric',
                'gender'=> 'required',
            ]
        );
        $admin = Admin::find($req->id);
        // check if the data was not changed
        $isDataChanged = false;
        foreach ($formField as $key => $value) {
            if ($value != $admin->$key) {
                $isDataChanged = true;
                break;
            }
        }
        if (!$isDataChanged) {
            Toast::danger(Lang::get('toast.data_changed'));
            return redirect()->back();
        }
        $admin->first_name = $req->first_name;
        $admin->last_name = $req->last_name;
        $admin->date_of_brith = $req->date_of_brith;
        $admin->phone = $req->phone;
        $admin->gender = $req->gender;
        $admin->update($formField);
        Toast::success(Lang::get('toast.profile_updated'));
        return redirect()->back();
    }
    public function social_update(Request $req) {
        $formField = $req->validate(
            [
                'facebook' => 'nullable|url|regex:/^https:\/\/www\.facebook\.com\/[A-Za-z0-9_.\-]+(\/?)$/',
                'twitter' => 'nullable|url|regex:/^https:\/\/www\.twitter\.com\/[A-Za-z0-9_.\-]+(\/?)$/',
                'instagram' => 'nullable|url|regex:/^https:\/\/www\.instagram\.com\/[A-Za-z0-9_.\-]+(\/?)$/',
                'linkedin' => 'nullable|url|regex:/^https:\/\/www\.linkedin\.com\/(in)\/[A-Za-z0-9_.\-]+(\/?)$/',
            ]
        );
        $admin = Admin::find($req->id);
        $isDataChanged = false;
        foreach ($formField as $key => $value) {
            if ($value != $admin->$key) {
                $isDataChanged = true;
                break;
            }
        }
        if (!$isDataChanged) {
            Toast::danger(Lang::get('toast.data_changed'));
            return redirect()->back();
        }
        $admin->facebook = $req->facebook;
        $admin->instagram = $req->instagram;
        $admin->linkedin = $req->linkedin;
        $admin->twitter = $req->twitter;
        $admin->update($formField);
        Toast::success(Lang::get('toast.profile_updated'));
        return redirect()->back();
    }
    public function pwd_update(Request $req) {
        $formField = $req->validate(
            [
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
            ]
        );

        $admin = Admin::find($req->id);
        $admin->password = Hash::make($req->input('password'));
        $admin->save();

        Toast::success(Lang::get('toast.pwd_update'));
        return redirect()->back();
    }
    public function delete_profile(Request $req) {
        $admin = Admin::find($req->id);
        $oldImage = $admin->image;
        if($oldImage && file_exists(public_path('storage/'.$oldImage))) {
            unlink(public_path('storage/'.$oldImage));
        }
        $admin->delete();
        Toast::success(Lang::get('toast.employee_delete'));
        return redirect()->route('admin.manage.admins.index');
    }
}
