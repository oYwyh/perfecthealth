<?php

namespace App\Http\Controllers\Doctor\Manage;

use Carbon\Carbon;
use App\Models\User;
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
use Illuminate\Support\Facades\Storage;

class DoctorAppointmentController extends Controller
{
    public function back() {
        return redirect()->back();
    }
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
        return view('dashboard.doctor.manage.appointments.index',
        [
            'appointments' => Appointments::class,
        ]);
    }
    public function info(Request $req) {
        if(Session::get('locale') == 'en') {
            SEO::title('Info | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('المعلومات | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        $patient = User::find($req->patient_id);
        $app_id = [
            'app_id' => $req->app_id
        ];
        return view('dashboard.doctor.manage.appointments.info', compact('patient','app_id'));
    }
    public function saveInfo(Request $req) {
        $formField = $req->validate([
            'history' => 'required',
            'diagnosis' => 'required',
            'laboratory' => 'nullable',
            'radiology' => 'nullable',
            'medicine' => 'nullable',
        ]);
        if (null != $req->laboratory) {
            $laboratory = implode(',',$req->laboratory);
        }else {
            $laboratory = null;
        }
        if (null != $req->radiology) {
            $radiology = implode(',',$req->radiology);
        }else {
            $radiology = null;
        }
        if (null != $req->medicine) {
            $medicine = implode(',',$req->medicine);
        }else {
            $medicine = null;
        }
        $appointment = [
            'id' => $req->app_id,
            'patient_fullname' => $req->first_name . ' ' . $req->last_name,
            'patient_age' => \getAge($req->date_of_brith),
            'history' => $req->history,
            'diagnosis' => $req->diagnosis,
            'laboratory' => $laboratory,
            'radiology' => $radiology,
            'medicine' => $medicine,
            'lab_img' => null,
            'rad_img' => null,
            'med_img' => null,
        ];
        Session::put('appointment', $appointment);
        if (null != $laboratory) {
            return redirect()->route('doctor.manage.appointments.laboratory');
        }else if(null != $radiology) {
            return redirect()->route('doctor.manage.appointments.radiology');
        }else if(null != $medicine) {
            return redirect()->route('doctor.manage.appointments.medicine');
        }else {
            $appointment = Appointment::find($req->app_id);
            $appointment->history = $req->history;
            $appointment->diagnosis = $req->diagnosis;
            $appointment->laboratory = null;
            $appointment->radiology = null;
            $appointment->medicine = null;
            $appointment->lab_img = null;
            $appointment->rad_img = null;
            $appointment->med_img = null;
            $appointment->status = 'seen';
            $appointment->save();
            Session::remove('appointment');
            Toast::success(Lang::get('toast.appointment_created'));
            return redirect()->route('doctor.manage.appointments.index');
            Toast::success(Lang::get('toast.appointment_created'));
            return redirect()->route('doctor.manage.appointments.index');
        }
    }
    public function laboratory() {
        if(Session::get('locale') == 'en') {
            SEO::title('Laboratory Prescription | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('روشتت المعمل | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        return view('dashboard.doctor.manage.appointments.prescriptions.laboratory');
    }
    public function radiology() {
        if(Session::get('locale') == 'en') {
            SEO::title('Radiology Prescription | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('روشتت الأشعة | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        return view('dashboard.doctor.manage.appointments.prescriptions.radiology');
    }
    public function medicine() {
        if(Session::get('locale') == 'en') {
            SEO::title('Medicine Prescription | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('روشتت الدواء | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        return view('dashboard.doctor.manage.appointments.prescriptions.medicine');
    }
    public function prescription() {
        if(Session::get('locale') == 'en') {
            SEO::title('Prescriptions | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('الروشتات | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        return view('dashboard.doctor.manage.appointments.prescription');
    }
    public function saveImage(Request $request){
        $img = $request->get('img');
        $newPresc = $request->query('newPresc');
        $section = $request->query('section');
        // Decode the base64 image data.
        $img = str_replace('data:image/jpeg;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);
        // Generate a unique file name for the image.
        $fileName = Str::uuid() . '.' . 'jpeg';
        // Get the appointment data from the session.
        $appointment = Session::get('appointment');
        // Update the appointment data with the new image and prescription.
        if ($section == 'prescLab') {
            $appointment['lab_img'] = 'images/prescriptions/laboratory/'.$fileName;
            Storage::disk('public')->put('images/prescriptions/laboratory/' . $fileName, $fileData);
            if ($newPresc != 'undefined') {
                $appointment['laboratory'] = $newPresc;
            }
        } elseif ($section == 'prescRad') {
            $appointment['rad_img'] = 'images/prescriptions/radiology/'.$fileName;
            Storage::disk('public')->put('images/prescriptions/radiology/' . $fileName, $fileData);
            if ($newPresc != 'undefined') {
                $appointment['radiology'] = $newPresc;
            }
        } else {
            $appointment['med_img'] = 'images/prescriptions/medicine/'.$fileName;
            Storage::disk('public')->put('images/prescriptions/medicine/' . $fileName, $fileData);
            if ($newPresc != 'undefined') {
                $appointment['medicine'] = $newPresc;
            }
        }

        // Save the updated appointment data back to the session.
        Session::put('appointment', $appointment);
    }
    public function save(Request $req) {
        $app = $req->session()->get('appointment');
        $appointment = Appointment::find($app['id']);
        $appointment->history = $app['history'];
        $appointment->diagnosis = $app['diagnosis'];
        $appointment->laboratory = $app['laboratory'];
        $appointment->radiology = $app['radiology'];
        $appointment->medicine = $app['medicine'];
        $appointment->lab_img = $app['lab_img'];
        $appointment->rad_img = $app['rad_img'];
        $appointment->med_img = $app['med_img'];
        $appointment->status = 'seen';
        $appointment->save();
        Session::remove('appointment');
        Toast::success(Lang::get('toast.appointment_created'));
        return redirect()->route('doctor.manage.appointments.index');
    }
    public function cancle(Request $req) {
        Appointment::destroy($req->id);
        Toast::info(Lang::get('toast.appointment_cancled'));
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
        $patient = User::find($req->patient_id);
        $appointment = Appointment::find($req->app_id);
        return view('dashboard.doctor.manage.appointments.results',compact('patient','appointment'));
    }
    public function patient_info(Request $req) {

        $patient = User::find($req->id);
        $carbon = new Carbon();
        return view('dashboard.doctor.manage.patients.info',compact('patient','carbon'));
    }
    public function app_box_date(Request $req) {
        $appointments = Appointment::where('doctor_id',Auth::user()->id)->where('day',$req->date)->get();

        $appointments_id = Appointment::where('doctor_id',Auth::user()->id)->where('day',$req->date)->get('patient_id');
        $appointments_patients_id = [];
        foreach ($appointments_id as $id) {
            $appointments_patients_id[] = $id->patient_id;
        }
        $appointments_patients_dictionary = [];
        foreach ($appointments as $app) {
            $appointments_patients_dictionary[$app->id] = $app->patient_id;
        }
        $appointments_patients = User::whereIn('id', $appointments_patients_id)->get();
        Session::put('appointments_patients_dictionary', $appointments_patients_dictionary);
        Session::put('appointments', $appointments);
        Session::put('appointments_patients', $appointments_patients);
        Session::put('date', $req->date);

        Toast::success(Lang::get('toast.data_change_success'));
        return redirect()->back();
    }
    public function app_box_reset(Request $req) {
        Session::forget('appointments_patients_dictionary');
        Session::forget('appointments');
        Session::forget('appointments_patients');
        Session::forget('date');
        Toast::success(Lang::get('toast.data_change_success'));
        return redirect()->back();
    }
}
