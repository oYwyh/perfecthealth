<?php

namespace App\Http\Controllers\Receptionist;
use Mpdf\Mpdf;
use App\Models\Patient;
use App\Tables\Patients;
use Illuminate\Support\Str;
use App\Models\Receptionist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use ProtoneMedia\Splade\Facades\SEO;
use App\Rules\UniqueEmailAcrossTables;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;
use ProtoneMedia\Splade\FileUploads\HandleSpladeFileUploads;

class ReceptionistController extends Controller
{
    public function home() {
        if(Session::get('locale') == 'en') {
            SEO::title('Dashboard | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('لوحة التحكم | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        return view('dashboard.receptionist.home');
    }
    public function profile(Receptionist $receptionist) {
        if(Session::get('locale') == 'en') {
            SEO::title('Profile | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('الملف الشخصي | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        $gender = [
            'male',
            'female'
        ];
        return view('dashboard.receptionist.profile.index',
        [
            'receptionist'=>Auth::user(),
            'gender' => $gender,
        ]);
    }
    public function profile_update(Request $req) {
        $formField = $req->validate(
            [
                'name' => 'required',
                'email' => ['required', 'email', new UniqueEmailAcrossTables($req->user()->id)],
                'image'=> 'nullable',
            ]
        );
        $receptionist = Receptionist::find(Auth::user()->id);
        $oldImage = $receptionist->image; // get the old image path
        // check if the user did not change anything
        if ($formField['name'] == $receptionist->name && $formField['email'] == $receptionist->email && (!$req->hasFile('image') || $oldImage == $formField['image'])) {
            Toast::danger(Lang::get('toast.data_changed'));
            return redirect()->back();
        }
        $oldImage = $receptionist->image; // get the old image path
        if($req->hasFile('image')) {
            $image = $req->file('image');
            $filename = time() . '_' . Str::random(10) . '_' . uniqid().'.'.$image->getClientOriginalExtension();
            $path = $image->storeAs('images/profiles/receptionists', $filename, 'public');
            $formField['image'] = $path;
            $receptionist->image = $path;
            // delete the old image file
            if($oldImage && file_exists(public_path('storage/'.$oldImage))) {
                unlink(public_path('storage/'.$oldImage));
            }
        } else {
            unset($formField['image']); // remove 'image' from the form fields if no new image is uploaded
        }
        $receptionist->update($formField);
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
            ]
        );
        $receptionist = Receptionist::find(Auth::user()->id);
        // check if the data was not changed
        $isDataChanged = false;
        foreach ($formField as $key => $value) {
            if ($value != $receptionist->$key) {
                $isDataChanged = true;
                break;
            }
        }
        if (!$isDataChanged) {
            Toast::danger(Lang::get('toast.data_changed'));
            return redirect()->back();
        }
        $receptionist->first_name = $req->first_name;
        $receptionist->last_name = $req->last_name;
        $receptionist->date_of_brith = $req->date_of_brith;
        $receptionist->phone = $req->phone;
        $receptionist->gender = $req->gender;
        $receptionist->national_id = $req->national_id;
        $receptionist->update($formField);
        Toast::success(Lang::get('toast.profile_updated'));

        return redirect()->back();
    }
    public function work_update(Request $req) {
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
        $receptionist = Receptionist::find(Auth::user()->id);
        $isDataChanged = false;
        foreach ($formField as $key => $value) {
            if ($value != $receptionist->$key) {
                $isDataChanged = true;
                break;
            }
        }
        if (!$isDataChanged) {
            Toast::danger(Lang::get('toast.data_changed'));
            return redirect()->back();
        }
        $receptionist->disease = $req->disease;
        $receptionist->blood = $req->blood;
        $receptionist->update($formField);
        Toast::success(Lang::get('toast.profile_updated'));
        return redirect()->back();
    }
    public function pwd_update(Request $req) {
        $formField = $req->validate(
            [
                'current_password' => ['required', function ($attribute, $value, $fail) use ($req) {
                    if (!Hash::check($value, $req->user()->password)) {
                        return $fail(__('The current password is incorrect.'));
                    }
                }],
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
            ]
        );

        $receptionist = Receptionist::find(Auth::user()->id);
        $receptionist->password = Hash::make($req->input('password'));
        $receptionist->save();

        Toast::success(Lang::get('toast.pwd_update'));
        return redirect()->back();
    }
    public function delete_profile(Request $req) {
        $receptionist = Receptionist::find($req->id);
        $oldImage = $receptionist->image;
        if($oldImage && file_exists(public_path('storage/'.$oldImage))) {
            unlink(public_path('storage/'.$oldImage));
        }
        $receptionist->delete();
        Auth::logout();
        Toast::info(Lang::get('toast.acc_deleted'));
        return redirect()->route('home');
    }

}
