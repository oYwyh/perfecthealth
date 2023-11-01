<?php

namespace App\Http\Controllers\Doctor;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Doctor;
use Mockery\Undefined;
use App\Models\Appointment;
use Illuminate\Support\Str;
use App\Tables\Appointments;
use Illuminate\Http\Request;
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

class DoctorController extends Controller
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
        $datas = Appointment::where('doctor_id', Auth::user()->id)
                    ->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SATURDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])
                    ->select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as day_name"))
                    ->groupBy(DB::raw("day_name"))
                    ->orderBy('created_at')
                    ->pluck('count', 'day_name');
        $labels = $datas->keys()->toArray();
        $data = $datas->values()->toArray();

        $appointments = Appointment::where('doctor_id',Auth::user()->id)->get();
        $relative_appointments = Appointment::where('doctor_id',Auth::user()->id)->get();
        $appointments_id = Appointment::where('doctor_id',Auth::user()->id)->get('patient_id');
        $appointments_patients_id = [];
        foreach ($appointments_id as $id) {
            $appointments_patients_id[] = $id->patient_id;
        }
        $appointments_patients_dictionary = [];
        $relative_appointments_patients_dictionary = [];
        foreach ($appointments as $app) {
            $appointments_patients_dictionary[$app->id] = $app->patient_id;
            $relative_appointments_patients_dictionary[$app->id] = $app->patient_id;
        }
        $appointments_patients = User::whereIn('id', $appointments_patients_id)->get();
        $relative_patients = User::whereIn('id', $appointments_patients_id)->get();
        $carbon = new Carbon();
        $total_appointments = Appointment::where('doctor_id', Auth::user()->id)->get();
        return view('dashboard.doctor.home', compact('labels','total_appointments', 'data','carbon','relative_appointments','relative_appointments_patients_dictionary','relative_patients','appointments','appointments_patients_dictionary','appointments_patients'));
    }
    public function chart_date(Request $req) {
        $date = $req->date;
        if($date == 'day') {
            $datas = Appointment::where('doctor_id', Auth::user()->id)
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SATURDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])
            ->select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as day_name"))
            ->groupBy(DB::raw("day_name"))
            ->orderBy('created_at')
            ->pluck('count', 'day_name');
            $labels = $datas->keys()->toArray();
            $data = $datas->values()->toArray();
        }else if($date == 'month') {
            $datas = Appointment::where('doctor_id', Auth::user()->id)
            ->select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->groupBy(DB::raw("month_name"))
            ->orderBy('created_at')
            ->pluck('count', 'month_name');
            $labels = $datas->keys()->toArray();
            $data = $datas->values()->toArray();
        }else if($date == 'year') {
            $datas = Appointment::where('doctor_id', Auth::user()->id)
            ->select(DB::raw("COUNT(*) as count"), DB::raw("YEAR(created_at) as year"))
            ->groupBy(DB::raw("year"))
            ->orderBy('created_at')
            ->pluck('count', 'year');
            $labels = $datas->keys()->toArray();
            $data = $datas->values()->toArray();
        };
        Session::put('labels',$labels);
        Session::put('data',$datas);
        Session::put('chart_date',$date);
        return redirect()->back();
    }
    public function chart_reset() {
        Session::remove('labels');
        Session::remove('data');
        Session::remove('chart_date');
        return redirect()->back();

    }
    public function time() {
        return Doctor::all();
    }
    public function register() {
        $specialties = [
            'family_medicine',
            'general_surgery',
            'vascular_surgery',
            'pediatric_surgery',
            'neuro_surgery',
            'cardio-thoracic_surgery',
            'orthopedic_surgery',
            'plastic_surgery',
            'maxill-fascial_surgery',
            'onco-surgery',
            'urology',
            'nephrology',
            'medicine',
            'gastroentrology',
            'ent',
            'ophalmology',
            'ob_&_gy',
            'endocrinology',
            'neurology',
            'pediatrics',
            'psychiatry',
            'dermatology',
            'physio-therapy',
            'oncology',
            'immunology_&_rheummatology',
            'cardiology',
            'geriatrics',
            'hematology',
            'pain_management',
            'pulonology',
        ];
        $hours = [
            '8-9',
            '9-10',
            '10-11',
            '11-12',
            '12-13',
            '13-14',
            '14-15',
            '15-16',
            '16-17',
            '17-18',
            '18-19',
            '19-20',
            '20-21',
            '21-22',
            '22-23',
            '23-00',
        ];
        $hour_label = "Time Range";
        return view('dashboard.doctor.auth.register', compact('specialties','hours', 'hour_label'));
    }
    public function create(Request $req) {
        $req->validate([
            'name'=>'required',
            'email' => ['required', 'email', new UniqueEmailAcrossTables],
            'phone'=>'required|numeric|unique:doctors,phone',
            'specialty'=>'required',
            'day' => 'required',
            'gender' => 'required',
            'password'=>'required|max:30',
            'cpassword'=>'required|max:30|same:password',
        ]);
        if($req->sun_hour != null) {
            $sun_hour = 'sunday_'.implode(',',$req->sun_hour);
        }else {
            $sun_hour = null;
        }
        if($req->mon_hour != null) {
            $mon_hour = 'monday_'.implode(',',$req->mon_hour);
        }else {
            $mon_hour = null;
        }
        if($req->tue_hour != null) {
            $tue_hour = 'tuesday_'.implode(',',$req->tue_hour);
        }else {
            $tue_hour = null;
        }
        if($req->wed_hour != null) {
            $wed_hour = 'wednesday_'.implode(',',$req->wed_hour);
        }else {
            $wed_hour = null;
        }
        if($req->thu_hour != null) {
            $thu_hour = 'wednesday_'.implode(',',$req->thu_hour);
        }else {
            $thu_hour = null;
        }
        if($req->fri_hour != null) {
            $fri_hour = 'friday_'.implode(',',$req->fri_hour);
        }else {
            $fri_hour = null;
        }
        if($req->sat_hour != null) {
            $sat_hour = 'saturday_'.implode(',',$req->sat_hour);
        }else {
            $sat_hour = null;
        }
        $hour = [
            $sun_hour,
            $mon_hour,
            $tue_hour,
            $wed_hour,
            $thu_hour,
            $fri_hour,
            $sat_hour,
        ];
        $hours = [];
        foreach ($hour as $day) {
            if ($day != null) {
                $hours[] = $day;
            }
        }
        $hours = implode('|', $hours);
        $doctor = new Doctor();
        $doctor->name = $req->name;
        $doctor->email = $req->email;
        $doctor->gender = $req->gender;
        $doctor->specialty = $req->specialty;
        $doctor->days = implode('|',$req->day);
        $doctor->hours = $hours;
        $doctor->phone = $req->phone;
        $doctor->password = Hash::make($req->password);
        $save = $doctor->save();
        if($save) {
            Toast::success('Doctor Registered Successfuly!')
            ->autoDismiss(5);
            return redirect()->route('home');
        }else {
            Toast::danger('Doctor Registered Failed!')
            ->autoDismiss(5);
            return redirect()->route('home');
        }
    }
    public function check(Request $req) {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required',
            ]);
        $creds = $req->only('email','password');
        if(Auth::guard('doctor')->attempt($creds)) {
            Toast::success('Logged In Successfuly!')
            ->autoDismiss(5);
            return redirect()->route('home');
        }else {
            Toast::danger('Invallid Credintiols :(')
            ->autoDismiss(5);
            return redirect()->route('home');
        }
    }
    public function logout(Request $req) {
        Auth::guard('doctor')->logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        Toast::success(Lang::get('auth.logout'))
        ->autoDismiss(5);
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
        $days = explode('|',Auth::user()->days);
        $hours = explode('|',Auth::user()->hours);
        $count = count($days);
        $date = [];
        $lol = [];
        for ($i = 0; $i < $count; $i++) {
            $lol[] = Carbon::createFromFormat('l', $days[$i])->format('Y-m-d');
            $hours_array = explode(',', $hours[$i]);
            foreach ($hours_array as $hour) {
                $hour_parts = explode('_', $hour);
                $temp = explode('_', $hour_parts[0]);
                $hour_parts[0] = end($temp);
                $hour_parts = array_filter($hour_parts, function($value) { return!is_string($value) ||!str_contains($value, 'day'); });
                foreach ($hour_parts as $part) {
                    if (!isset($date[$lol[count($lol) - 1]])) {
                        $date[$lol[count($lol) - 1]] = [];
                    }
                    if (!in_array($part, $date[$lol[count($lol) - 1]])) {
                        $date[$lol[count($lol) - 1]][] = $part;
                    }
                }
            }
        }
        $doctor = Auth::user();
        $carbon = new Carbon();
        return view('dashboard.doctor.profile.index',compact('doctor','date','carbon'));
    }
    public function profile_update(Request $req) {
        $formField = $req->validate(
            [
                'name' => 'required',
                'email' => ['required', 'email', new UniqueEmailAcrossTables($req->user()->id)],
                'image'=> 'nullable',
            ]
        );
        $doctor = Doctor::find(Auth::user()->id);
        $oldImage = $doctor->image; // get the old image path
        // check if the doctor did not change anything
        if ($formField['name'] == $doctor->name && $formField['email'] == $doctor->email && (!$req->hasFile('image') || $oldImage == $formField['image'])) {
            Toast::danger(Lang::get('toast.data_changed'));
            return redirect()->back();
        }
        $oldImage = $doctor->image; // get the old image path
        if($req->hasFile('image')) {
            $image = $req->file('image');
            $filename = time() . '_' . Str::random(10) . '_' . uniqid().'.'.$image->getClientOriginalExtension();
            $path = $image->storeAs('images/profiles/doctors', $filename, 'public');
            $formField['image'] = $path;
            $doctor->image = $path;
            // delete the old image file
            if($oldImage && file_exists(public_path('storage/'.$oldImage))) {
                unlink(public_path('storage/'.$oldImage));
            }
        } else {
            unset($formField['image']); // remove 'image' from the form fields if no new image is uploaded
        }
        $doctor->update($formField);
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
        $doctor = Doctor::find(Auth::user()->id);
        // check if the data was not changed
        $isDataChanged = false;
        foreach ($formField as $key => $value) {
            if ($value != $doctor->$key) {
                $isDataChanged = true;
                break;
            }
        }
        if (!$isDataChanged) {
            Toast::danger(Lang::get('toast.data_changed'));
            return redirect()->back();
        }
        $doctor->first_name = $req->first_name;
        $doctor->last_name = $req->last_name;
        $doctor->date_of_brith = $req->date_of_brith;
        $doctor->phone = $req->phone;
        $doctor->gender = $req->gender;
        $doctor->national_id = $req->national_id;
        $doctor->update($formField);
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
        $doctor = Doctor::find(Auth::user()->id);
        $isDataChanged = false;
        foreach ($formField as $key => $value) {
            if ($value != $doctor->$key) {
                $isDataChanged = true;
                break;
            }
        }
        if (!$isDataChanged) {
            Toast::danger(Lang::get('toast.data_changed'));
            return redirect()->back();
        }
        $doctor->facebook = $req->facebook;
        $doctor->instagram = $req->instagram;
        $doctor->twitter = $req->twitter;
        $doctor->linkedin = $req->linkedin;
        $doctor->save();
        Toast::success(Lang::get('toast.profile_updated'));
        return redirect()->back();
    }
    public function job_update(Request $req) {
        // $formField = $req->validate(
        //     [
        //         'specialty' => 'required',
        //     ]
        // );
        // $doctor = Doctor::find(Auth::user()->id);
        // $isDataChanged = false;
        // foreach ($formField as $key => $value) {
        //     if ($value != $doctor->$key) {
        //         $isDataChanged = true;
        //         break;
        //     }
        // }
        // if (!$isDataChanged) {
        //     Toast::danger('You can\'t update your data without changing it!');
        //     return redirect()->back();
        // }
        // $doctor->specialty = $req->specialty;
        // $doctor->update($formField);
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

        $doctor = Doctor::find(Auth::user()->id);
        $doctor->password = Hash::make($req->input('password'));
        $doctor->save();

        Toast::success(Lang::get('toast.pwd_update'));
        return redirect()->back();
    }
    public function delete_profile(Request $req) {
        $doctor = Doctor::find($req->id);
        $doctor->delete();
        Auth::guard('doctor')->logout();
        Toast::success(Lang::get('toast.acc_delete'));
        return redirect()->route('home');
    }

}
