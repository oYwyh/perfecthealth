<?php

namespace App\Http\Controllers\User\Manage;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Str;
use App\Tables\Appointments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use ProtoneMedia\Splade\Facades\SEO;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;

class UserAppointmentController extends Controller
{
    public function index() {
        if(Session::get('locale') == 'en') {
            SEO::title('Appointments | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('المواعيد | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        $carbon = new Carbon();
        $appointments = Appointments::class;
        return view('dashboard.user.manage.appointments.index',compact('appointments'));
    }
    public function search() {
        if(Session::get('locale') == 'en') {
            SEO::title('Book Appointment | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('حجز موعد | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        $doctors = Doctor::all();
        $carbon = new Carbon();
        return view('dashboard.user.manage.appointments.search',compact('doctors','carbon'));
    }
    public function getSpecialty(Request $req) {
        $specialty = $req->specialty;
        if($req->specialty == 'all') {
            $doctors = Doctor::all();
            Session::put('specialty','All Specialties');
        }else {
            $doctors = Doctor::where('specialty',$specialty)->get();
            Session::put('specialty',$specialty);
        }
        Session::put('doctors',$doctors);
        return redirect()->back();
    }
    public function getDoctors(Request $request) {
        $req = $request->all();
        $req['doctor'] = $req['doctor'] ?? 'all';
        $req['specialty'] = $req['specialty'] ?? 'all';
        $req['start_date'] = $req['start_date'] ?? Carbon::now()->format('Y-m-d');
        $req['end_date'] = $req['end_date'] ?? Carbon::now()->addDays(7)->format('Y-m-d');
        $doctor = $req['doctor'];
        $specialty = $req['specialty'];
        $start_date = Carbon::parse($req['start_date']);
        $end_date = Carbon::parse($req['end_date']);
        $doctors = Doctor::query();
        if($doctor != 'all') {
            $doctors->where('id', $doctor);
        }
        if($specialty != 'all') {
            $doctors->where('specialty', $specialty);
        }
        $doctors->where(function ($query) use ($start_date, $end_date) {
            for ($date = $start_date; $date->lte($end_date); $date->addDay()) {
                $dayOfWeek = strtolower($date->format('l'));
                $query->orWhere('days', 'like', "%{$dayOfWeek}%");
            }
        });
        $doctors = $doctors->get();
        Session::put('doctors',$doctors);
        return redirect()->route('user.manage.appointments.doctors');
    }
    public function doctors() {
        if(Session::get('locale') == 'en') {
            SEO::title('Doctors | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('الأطباء | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        $doctors = Session::get('doctors');
        return view('dashboard.user.manage.appointments.doctors',compact('doctors'));
    }
    public function doctor(Request $req) {
        if(Session::get('locale') == 'en') {
            SEO::title('Book Appointment | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('حجز موعد | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        if(null !== (Session::get('doc'))) {
            $doctor = Doctor::find(Session::get('doc')->id);
            $days = explode('|',Session::get('doc')->days);
            $hours = explode('|',Session::get('doc')->hours);
        }else {
            $doctor = Doctor::find($req->id);
            $days = explode('|',$doctor->days);
            $hours = explode('|',$doctor->hours);
        }
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
        $carbon = new Carbon();
        return view('dashboard.user.manage.appointments.book',compact('doctor','date','carbon'));
    }
    public function externalBook(Request $req) {
        $doc = Doctor::find($req->id);
        session()->put('doc',$doc);
        session()->save();
        return redirect()->route('user.manage.appointments.doctor');
    }
    public function book(Request $req) {
        $formField = $req->validate([
            'date' => 'required',
        ]);
        $doctor = Doctor::find($req->query('doctor'));
        $appointment = new Appointment();
        $appointment->fill($formField);
        $appointment->patient_id = Auth::user()->id;
        $appointment->patient = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $appointment->doctor_id = $doctor->id;
        $appointment->doctor = $doctor->first_name . ' ' . $doctor->last_name;
        $appointment->day = date('Y-m-d', strtotime($req->date));
        $appointment->hour = date('g:i A', strtotime($req->date));
        $appointment->history = '';
        $appointment->diagnosis = '';
        $appointment->laboratory = '';
        $appointment->radiology = '';
        $appointment->medicine = '';
        $appointment->lab_img = '';
        $appointment->rad_img = '';
        $appointment->med_img = '';
        $appointment->status = 'pending';
        $appointment->save();
        Toast::success(Lang::get('toast.appointment_book'));
        return redirect()->route('user.manage.appointments.index');
    }
    public function cancle(Request $req) {
        Appointment::destroy($req->id);
        Toast::success(Lang::get('toast.appointment_book'));
        return redirect()->back();
    }
    public function results(Request $req) {
        if(Session::get('locale') == 'en') {
            SEO::title('Results | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('النتائج | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        $patient = User::find(Auth::user()->id);
        $appointment = Appointment::find($req->app_id);
        return view('dashboard.user.manage.appointments.results',compact('patient','appointment'));
    }
}
