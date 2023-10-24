<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Insurance;
use App\Models\Appointment;
use Illuminate\Support\Str;
use App\Tables\Appointments;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use ProtoneMedia\Splade\Facades\SEO;
use App\Rules\UniqueEmailAcrossTables;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\Splade\Facades\Splade;

class UserController extends Controller
{
    public function index() {
        if(Session::get('locale') == 'en') {
            SEO::title('Dashboard | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('لوحة التحكم | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        $db = Appointment::where('patient_id',Auth::user()->id)->get();
        $appDoc = [];
        $appDate = [];
        foreach ($db as $appointment) {
            $appDoc[] = $appointment->doctor_id;
            $appDate[] = $appointment->date;
        }
        $topDoctors = Doctor::latest()->limit(6)->get();
        Session::put('sidebar_size', 'large');
        return view('dashboard.user.home', [
            'user'=>Auth::user(),
            'doctor'=>$appDoc,
            'date'=>$appDate,
            'doctors' => $topDoctors,
        ]);
    }
    public function file() {
        $insurances = Insurance::all();
        if(Session::get('locale') == 'en') {
            SEO::title('Files | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('الملفات الطبية | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        return view('dashboard.user.medical',compact('insurances'));
    }
    public function investigation(Request $req) {
        $imgs = array();
        if($files = $req->file('investigations')) {
            foreach ($files as $file) {
                $image = $file;
                $filename = time() . '_' . Str::random(10) . '_' . uniqid().'.'.$image->getClientOriginalExtension();
                $path = $image->storeAs('images/medical/investigations/users', $filename, 'public');
                $imgs[] = $path;
            }
        }
        $user = User::find(Auth::user()->id);
        if(null != $user->investigations) {
            $oldInsuranceCardImages = explode(',', $user->investigations);
            foreach ($oldInsuranceCardImages as $image) {
                unlink(public_path('storage/'.$image));
            }
        }
        $user->investigations = implode(',',$imgs);
        $user->update(['investigations' => $user->investigations]);
        Toast::success(Lang::get('toast.investigations_add'));
        return redirect()->back();
    }
    public function insurance(Request $req) {
        $card = array();
        if($files = $req->file('insurance_card')) {
            foreach ($files as $file) {
                $image = $file;
                $filename = time() . '_' . Str::random(10) . '_' . uniqid().'.'.$image->getClientOriginalExtension();
                $path = $image->storeAs('images/medical/insurance/users', $filename, 'public');
                $card[] = $path;
            }
        }
        $id = array();
        if($files = $req->file('insurance_id')) {
            foreach ($files as $file) {
                $image = $file;
                $filename = time() . '_' . Str::random(10) . '_' . uniqid().'.'.$image->getClientOriginalExtension();
                $path = $image->storeAs('images/medical/insurance/users', $filename, 'public');
                $id[] = $path;
            }
        }
        $user = User::find(Auth::user()->id);
        if(null != $user->insurance_card && count($card) > 0) {
            $oldInsuranceCardImages = explode(',', $user->insurance_card);
            foreach ($oldInsuranceCardImages as $image) {
                unlink(public_path('storage/'.$image));
            }
        }
        if(null != $user->insurance_id && count($id) > 0) {
            $oldInsuranceIdImages = explode(',', $user->insurance_id);
            foreach ($oldInsuranceIdImages as $image) {
                unlink(public_path('storage/'.$image));
            }
        }
        if(count($card) > 0) {
            $user->insurance_card =  implode(',',$card);
        }else {
            $user->insurance_card =  $user->insurance_card;
        }
        if(count($id) > 0) {
            $user->insurance_id =  implode(',',$id);
        }else {
            $user->insurance_id = $user->insurance_id;
        }
        $user->insurance = $req->insurance;
        $user->save();
        Toast::success(Lang::get('toast.insurance_add'));
        return redirect()->back();
    }
    public function create(Request $req) {
        $req->validate([
            'name'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'email' => ['required', 'email', new UniqueEmailAcrossTables],
            'date_of_brith'=>'required',
            'gender'=>'required',
            'password'=>'required',
            'cpassword'=>'required|same:password',
        ]);

        $verify_code = random_int(100000, 999999);
        $verify_code = str_pad($verify_code, 6, 0, STR_PAD_LEFT);

        $user = new User();
        $user->name = $req->name;
        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->email = $req->email;
        $user->gender = $req->gender;
        $user->date_of_brith = $req->date_of_brith;
        $user->image = 'images/profiles/default.jpg';
        $user->password = Hash::make($req->password);
        $user->verification_code = $verify_code;
        $user->verified = '0';
        $user->save();
        Auth::guard('web')->login($user);
        return redirect()->route('send-code');
    }
    public function check(Request $req) {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $creds = $req->only('email','password');
        if(Auth::guard('web')->attempt($creds)) {
            Toast::success(Lang::get('toast.login'));
            // Toast::info('You can provide us with more info via profile page!');
            return redirect()->route('home');
        }else {
            Toast::danger('Invallid Credintiols :(');
            return redirect()->route('user.login');
        }
    }
    public function logout(Request $req) {
        Auth::guard('web')->logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        Toast::success(Lang::get('toast.logout'));
        return redirect()->route('home');
    }
    public function profile() {
        if(Session::get('locale') == 'en') {
            SEO::title('Profile | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('الملف الشخصي | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        return view('dashboard.user.profile.index', [
            'user'=>Auth::user(),
        ]);
    }
    public function profile_update(Request $req) {
        $formField = $req->validate(
            [
                'name' => 'required',
                'email' => ['required', 'email', new UniqueEmailAcrossTables($req->user()->id)],
                'image'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );
        $user = User::find(Auth::user()->id);
        $oldImage = $user->image; // get the old image path

        // check if the user did not change anything
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
        Toast::title(Lang::get('toast.profile_updated'));
        return redirect()->back();
    }
    public function personal_update(Request $req) {
        $formField = $req->validate(
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'date_of_brith' => 'required',
                'phone'=> 'nullable|numeric',
                'gender'=> 'nullable',
                'national_id'=> 'nullable|numeric',
                'height'=> 'nullable|numeric',
                'weight'=> 'nullable|numeric',
            ]
        );
        $user = User::find(Auth::user()->id);
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
        Toast::title(Lang::get('toast.profile_updated'));
        return redirect()->back();
    }
    public function medical_update(Request $req) {
        $formField = $req->validate(
            [
                'disease' => 'nullable',
                'blood' => 'nullable',
            ]
        );
        $user = User::find(Auth::user()->id);
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
        Toast::title(Lang::get('toast.profile_updated'));
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

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($req->input('password'));
        $user->save();

        Toast::success(Lang::get('toast.pwd_update'));
        return redirect()->back();
    }
    public function delete_profile(Request $req) {
        $user = User::find($req->id);
        $relative_appointments = Appointment::where('patient_id', $req->id)->get();
        foreach ($relative_appointments as $appointment) {
            $appointment->user_state = 'deleted';
            $appointment->save();
        }
        $oldImage = $user->image;
        if($oldImage && file_exists(public_path('storage/'.$oldImage))) {
            unlink(public_path('storage/'.$oldImage));
        }
        $user->delete();
        Auth::logout();
        Toast::info(Lang::get('toast.acc_deleted'));
        return redirect()->route('home');
    }

}
