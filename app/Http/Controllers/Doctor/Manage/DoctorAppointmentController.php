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
use ProtoneMedia\Splade\Facades\SEO;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DoctorAppointmentController extends Controller
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
        $lab = [
            'lab',
            'lab2'
        ];
        $rad = [
            'rad'
        ];
        $med = [
            'med'
        ];
        return view('dashboard.doctor.manage.appointments.info', compact('patient','app_id','lab','rad','med'));
    }
    public function saveInfo(Request $req) {
        $formField = $req->validate([
            'history' => 'required',
            'diagnosis' => 'required',
            'laboratory' => 'required',
            'radiology' => 'required',
            'medicine' => 'required',
        ]);
        $laboratory = implode(',',$req->laboratory);
        $radiology = implode(',',$req->radiology);
        $medicine = implode(',',$req->medicine);
        $appointment = Appointment::find($req->app_id);
        $appointment->history = $req->history;
        $appointment->diagnosis = $req->diagnosis;
        $appointment->laboratory = $laboratory;
        $appointment->radiology = $radiology;
        $appointment->medicine = $medicine;
        $appointment->status = 'seen';
        $appointment->update($formField);
        Session::put('appointment', $appointment);
        Toast::title('Info Savd Successfuly!')
        ->autoDismiss(5);
        return redirect()->route('doctor.manage.appointments.prescription');
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
        $newLab = $request->query('newLab');
        $section = $request->query('section');
        $img = str_replace('data:image/jpeg;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);
        $fileName = Str::uuid().'.'.'jpeg';
        $appointment = Appointment::find(Session::get('appointment')->id);
        if($section == 'prescLab') {
            $appointment->lab_img = $fileName;
            Storage::disk('public')->put('images/prescriptions/laboratory/' . $fileName, $fileData);
            if($newLab != 'undefined') {
                $appointment->laboratory = $newLab;
                $appointment->save();
            }else {
                $appointment->save();
            }
        }else if($section == 'prescRad') {
            $appointment->rad_img = $fileName;
            Storage::disk('public')->put('images/prescriptions/radiology/' . $fileName, $fileData);
            if($newLab != 'undefined') {
                $appointment->radiology = $newLab;
                $appointment->save();
            }else {
                $appointment->save();
            }
        }else {
            $appointment->med_img = $fileName;
            Storage::disk('public')->put('images/prescriptions/medicine/' . $fileName, $fileData);
            if($newLab != 'undefined') {
                $appointment->medicine = $newLab;
                $appointment->save();
            }else {
                $appointment->save();
            }
        }
        Toast::title('lol')
        ->autoDismiss(5);
        return redirect()->back();
    }
    public function cancle(Request $req) {
        Appointment::destroy($req->id);
        Toast::info('Appointment Has Been Canceled!')
        ->autoDismiss(5);
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

        Toast::title('Date changed successfuly!');
        return redirect()->back();
    }
    public function app_box_reset(Request $req) {
        Session::forget('appointments_patients_dictionary');
        Session::forget('appointments');
        Session::forget('appointments_patients');
        Session::forget('date');
        Toast::title('Date changed successfuly!');
        return redirect()->back();
    }
}
