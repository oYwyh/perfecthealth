<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Models\User;
use App\Tables\Users;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use ProtoneMedia\Splade\Facades\SEO;
use App\Rules\UniqueEmailAcrossTables;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;

class AdminUserController extends Controller
{
    public function index() {

        if(Session::get('locale') == 'en') {
            SEO::title('Users | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('المستخدمون | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        return view('dashboard.admin.manage.users.index',[
            'users' => Users::class,
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
        return view('dashboard.admin.manage.users.edit',[
            'id'=> $req->id,
            'user' => User::find($req->id),
        ]);
    }
    public function update(Request $req) {
        $user = User::find($req->id);
        $user->update($req->validate(
            [
                'name' => 'required',
                'email' => ['required', 'email', new UniqueEmailAcrossTables($user->id)],
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'date_of_brith' => 'required',
                'national_id' => 'required|numeric',
                'phone' => 'nullable|numeric',
                'password'=>'required|confirmed',
                'password_confirmation'=>'required',
            ]
        ));
        Toast::success(Lang::get('toast.profile_updated'));
        return redirect()->route('admin.manage.users.index');
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
        return view('dashboard.admin.manage.users.add');
    }
    public function register(Request $req) {
        $req->validate(
            [
                'name' => 'required',
                'email' => ['required', 'email', new UniqueEmailAcrossTables],
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'date_of_brith' => 'required',
                'national_id' => 'required|numeric',
                'phone' => 'nullable|numeric',
                'password'=>'required|confirmed',
                'password_confirmation'=>'required',
            ]
        );
        $verify_code = random_int(100000, 999999);
        $verify_code = str_pad($verify_code, 6, 0, STR_PAD_LEFT);
        $user = new User();
        $user->name = $req->name;
        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->email = $req->email;
        $user->gender = $req->gender;
        $user->phone = $req->phone;
        $user->national_id = $req->national_id;
        $user->date_of_brith = $req->date_of_brith;
        $user->password = Hash::make($req->password);
        $user->verification_code = $verify_code;
        $user->verified = '0';
        $user->save();
        Toast::success(Lang::get('toast.acc_register'));
        return redirect()->route('admin.manage.users.index');
    }
    public function delete(Request $req) {
        User::find($req->id)->delete();
        Toast::success(Lang::get('toast.employee_delete'));
        return redirect()->back();
    }
    public function control(Request $req) {
        if(Session::get('locale') == 'en') {
            SEO::title('Control | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('التحكم | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        $user = User::find($req->id);
        return view('dashboard.admin.manage.users.profile',compact('user'));
    }
    public function profile_update(Request $req) {
        $formField = $req->validate(
            [
                'name' => 'required',
                'email' => ['required', 'email', new UniqueEmailAcrossTables($req->id)],
                'image'=> 'nullable',
            ]
        );
        $user = User::find($req->id);
        $oldImage = $user->image; // get the old image path
        // check if the doctor did not change anything
        if ($formField['name'] == $user->name && $formField['email'] == $user->email && (!$req->hasFile('image') || $oldImage == $formField['image'])) {
            Toast::danger(Lang::get('toast.data_changed'));
            return redirect()->back();
        }
        $oldImage = $user->image; // get the old image path
        if($req->hasFile('image')) {
            $image = $req->file('image');
            $filename = time() . '_' . Str::random(10) . '_' . uniqid().'.'.$image->getClientOriginalExtension();
            $path = $image->storeAs('images/profiles/users', $filename, 'public');
            $formField['image'] = $path;
            $user->image = $path;
            // delete the old image file
            if($oldImage && file_exists(public_path('storage/'.$oldImage))) {
                unlink(public_path('storage/'.$oldImage));
            }
        } else {
            unset($formField['image']); // remove 'image' from the form fields if no new image is uploaded
        }
        $user->update($formField);
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
                'national_id'=> 'required|numeric',
                'height'=> 'required|numeric',
                'weight'=> 'required|numeric',
            ]
        );
        $user = User::find($req->id);
        // check if the data was not changed
        $isDataChanged = false;
        foreach ($formField as $key => $value) {
            if ($value != $user->$key) {
                $isDataChanged = true;
                break;
            }
        }
        if (!$isDataChanged) {
            Toast::danger(Lang::get('toast.data_changed'));
            return redirect()->back();
        }
        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->date_of_brith = $req->date_of_brith;
        $user->phone = $req->phone;
        $user->gender = $req->gender;
        $user->national_id = $req->national_id;
        $user->height = $req->height;
        $user->weight = $req->weight;
        $user->update($formField);
        Toast::success(Lang::get('toast.profile_updated'));
        return redirect()->back();
    }
    public function medical_update(Request $req) {
        $formField = $req->validate(
            [
                'disease' => 'required',
                'blood' => 'required',
            ]
        );
        $user = User::find($req->id);
        $isDataChanged = false;
        foreach ($formField as $key => $value) {
            if ($value != $user->$key) {
                $isDataChanged = true;
                break;
            }
        }
        if (!$isDataChanged) {
            Toast::danger(Lang::get('toast.data_changed'));
            return redirect()->back();
        }
        $user->disease = $req->disease;
        $user->blood = $req->blood;
        $user->update($formField);
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
        $user = User::find($req->id);
        $user->password = Hash::make($req->input('password'));
        $user->save();
        Toast::success(Lang::get('toast.pwd_update'));
        return redirect()->back();
    }
    public function delete_profile(Request $req) {
        $user = User::find($req->id);
        $oldImage = $user->image;
        if($oldImage && file_exists(public_path('storage/'.$oldImage))) {
            unlink(public_path('storage/'.$oldImage));
        }
        $user->delete();
        Toast::success(Lang::get('toast.acc_delete'));
        return redirect()->route('admin.manage.users.index');
    }
}
