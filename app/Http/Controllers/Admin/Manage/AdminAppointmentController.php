<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Models\User;

use App\Models\Appointment;
use App\Tables\Appointments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use ProtoneMedia\Splade\Facades\SEO;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;

class AdminAppointmentController extends Controller
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
        return view('dashboard.admin.manage.appointments.index', [
            'appointments' => Appointments::class,
        ]);
    }
    public function delete(Request $req) {
        Appointment::find($req->id)->delete();
        Toast::success(Lang::get('toast.appointment_cancled'));
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
        return view('dashboard.admin.manage.appointments.results',compact('patient','appointment'));
    }
}
