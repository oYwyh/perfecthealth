<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Mail;
use App\Models\User;
use App\Models\Admin;
use App\Tables\Mails;
use App\Tables\Users;
use App\Models\Doctor;
use App\Models\Review;
use App\Tables\Admins;
use App\Models\Article;
use App\Models\Patient;
use App\Models\Service;
use App\Tables\Doctors;
use App\Tables\Reviews;
use App\Tables\Articles;
use App\Tables\Services;
use App\Models\Appointment;
use App\Tables\Newsletters;
use Illuminate\Support\Str;
use App\Models\Receptionist;
use App\Tables\Appointments;
use Illuminate\Http\Request;
use App\Tables\Receptionists;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use ProtoneMedia\Splade\Facades\SEO;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;
use App\Rules\UniqueEmailAcrossTables;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Reader\Xls\RC4;
use ProtoneMedia\Splade\Components\Form\Input;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use ProtoneMedia\Splade\FileUploads\HandleSpladeFileUploads;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Month;

class AdminController extends Controller
{
    public function check(Request $req) {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $creds = $req->only('email','password');
        if(Auth::guard('admin')->attempt($creds)) {
            Toast::success(Lang::get('toast.login'));
            return redirect()->route('home');
        }else {
            Toast::danger(Lang::get('toast.invalid_email_pwd'));
            return redirect()->route('home');
        }
    }
    public function logout(Request $req) {
        Auth::guard('admin')->logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        Toast::success(Lang::get('toast.logout'));
        return redirect()->route('home');
    }
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
        $patientMale = User::where('gender','male')->get()->count();
        $patientFemale = User::where('gender','female')->get()->count();
        $patientGender = $patientMale . ',' . $patientFemale;
        $counts = [
            'doctors' => Doctor::count(),
            'users' => User::count(),
            'receptionists' => Receptionist::count(),
            'outPatient' => Patient::where('type','out_patient')->count(),
            'inPatient' => Patient::where('type','in_patient')->count(),
        ];
        $percentageChanges = [
            'doctors' =>  \calculatePercentageChange(Doctor::class),
            'users' =>  \calculatePercentageChange(User::class),
            'receptionists' =>  \calculatePercentageChange(Receptionist::class),
            'outPatient' =>  \calculatePercentageChange(Patient::class),
            'inPatient' =>  \calculatePercentageChange(Patient::class),
        ];
        $doctors = Doctor::all()->filter(function ($doctor) {
            $days = explode('|', $doctor->days);
            $today = Carbon::now()->format('l'); // 'l' returns the full text representation of the day of the week
            return in_array(strtolower($today), $days);
        })->map(function ($doctor) {
            $schedules = explode('|', $doctor->hours);
            $today = strtolower(Carbon::now()->format('l')); // 'l' returns the full text representation of the day of the week
            foreach ($schedules as $schedule) {
                $dayAndHours = explode('_', $schedule);
                if ($dayAndHours[0] == $today) {
                    $doctor->today_hours = explode(',', $dayAndHours[1]);
                }
            }
            return $doctor;
        });
        $receptionists = Receptionist::all()->filter(function ($receptionist) {
            $days = explode('|', $receptionist->days);
            $today = Carbon::now()->format('l'); // 'l' returns the full text representation of the day of the week
            return in_array(strtolower($today), $days);
        })->map(function ($receptionist) {
            $schedules = explode('|', $receptionist->hours);
            $today = strtolower(Carbon::now()->format('l')); // 'l' returns the full text representation of the day of the week
            foreach ($schedules as $schedule) {
                $dayAndHours = explode('_', $schedule);
                if ($dayAndHours[0] == $today) {
                    $receptionist->today_hours = explode(',', $dayAndHours[1]);
                }
            }
            return $receptionist;
        });
        $carbon = new Carbon();
        return view('dashboard.admin.home', compact('doctors','receptionists','carbon','patientGender','counts','percentageChanges'));
    }
    public function doctors_date() {
        $doctors = Doctor::all()->filter(function ($doctor) {
            $days = explode('|', $doctor->days);
            $today = Carbon::parse(request()->date)->format('l'); // 'l' returns the full text representation of the day of the week
            return in_array(strtolower($today), $days);
        })->map(function ($doctor) {
            $schedules = explode('|', $doctor->hours);
            $today = strtolower(Carbon::parse(request()->date)->format('l')); // 'l' returns the full text representation of the day of the week
            foreach ($schedules as $schedule) {
                $dayAndHours = explode('_', $schedule);
                if ($dayAndHours[0] == $today) {
                    $doctor->today_hours = explode(',', $dayAndHours[1]);
                }
            }
            return $doctor;
        });
        Session::put('doctors_date',request()->date);
        Session::put('doctors',$doctors);
        return redirect()->back();
    }
    public function doctors_reset() {
        Session::remove('doctors_date');
        Session::remove('doctors');
        return redirect()->back();
    }
    public function receptionists_date() {
        $receptionists = Receptionist::all()->filter(function ($receptionist) {
            $days = explode('|', $receptionist->days);
            $today = Carbon::parse(request()->date)->format('l'); // 'l' returns the full text representation of the day of the week
            return in_array(strtolower($today), $days);
        })->map(function ($receptionist) {
            $schedules = explode('|', $receptionist->hours);
            $today = strtolower(Carbon::parse(request()->date)->format('l')); // 'l' returns the full text representation of the day of the week
            foreach ($schedules as $schedule) {
                $dayAndHours = explode('_', $schedule);
                if ($dayAndHours[0] == $today) {
                    $receptionist->today_hours = explode(',', $dayAndHours[1]);
                }
            }
            return $receptionist;
        });
        Session::put('receptionists_date',request()->date);
        Session::put('receptionists',$receptionists);
        return redirect()->back();
    }
    public function receptionists_reset() {
        Session::remove('receptionists_date');
        Session::remove('receptionists');
        return redirect()->back();
    }
    public function total_date(Request $req) {
        $months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];
        $month = $req->month;

        $counts = [
            'doctors' => Doctor::whereMonth('created_at',$month)->count(),
            'users' => User::whereMonth('created_at',$month)->count(),
            'receptionists' => Receptionist::whereMonth('created_at',$month)->count(),
            'outPatient' => Patient::where('type','out_patient')->whereMonth('created_at',$month)->count(),
            'inPatient' => Patient::where('type','in_patient')->whereMonth('created_at',$month)->count(),
        ];
        $percentageChanges = [
            'doctors' =>  \calculatePercentageChangeDate(Doctor::class,'created_at',$month),
            'users' =>  \calculatePercentageChangeDate(User::class,'created_at',$month),
            'receptionists' =>  \calculatePercentageChangeDate(Receptionist::class,'created_at',$month),
            'outPatient' =>  \calculatePercentageChangeDate(Patient::class,'created_at',$month),
            'inPatient' =>  \calculatePercentageChangeDate(Patient::class,'created_at',$month),
        ];
        Session::put('month',$month);
        Session::put('counts',$counts);
        Session::put('percentageChanges',$percentageChanges);
        return redirect()->back();
    }
    public function total_reset(Request $req) {
        $months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];
        Session::remove('percentageChanges');
        Session::remove('counts');
        Session::remove('month');
        return redirect()->back();
    }
    public function profile(Admin $admin) {
        if(Session::get('locale') == 'en') {
            SEO::title('Profile | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('الملف الشخصي | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        return view('dashboard.admin.profile.index',
        [
            'admin'=>Auth::user(),
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
        $admin = Admin::find(Auth::user()->id);
        $oldImage = $admin->image; // get the old image path
        // check if the user did not change anything
        if ($formField['name'] == $admin->name && $formField['email'] == $admin->email && (!$req->hasFile('image') || $oldImage == $formField['image'])) {
            Toast::danger(Lang::get('toast.data_changed'));
            return redirect()->back();
        }
        $oldImage = $admin->image; // get the old image path
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
        $admin = Admin::find(Auth::user()->id);
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

        $admin = Admin::find(Auth::user()->id);
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
                'current_password' => ['required', function ($attribute, $value, $fail) use ($req) {
                    if (!Hash::check($value, $req->user()->password)) {
                        return $fail(__('The current password is incorrect.'));
                    }
                }],
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
            ]
        );

        $admin = Admin::find(Auth::user()->id);
        $admin->password = Hash::make($req->input('password'));
        $admin->save();

        Toast::success(Lang::get('toast.pwd_update'));
        return redirect()->back();
    }
    public function delete_profile(Request $req) {
        $admin = Admin::find($req->id);
        $oldImage = $admin->image;
        if($oldImage && file_exists(public_path('storage/'.$oldImage)) && $oldImage != 'images/profiles/default.jpg') {
            unlink(public_path('storage/'.$oldImage));
        }
        $admin->delete();
        Auth::logout();
        Toast::info(Lang::get('toast.acc_delete'));
        return redirect()->route('home');
    }
}
