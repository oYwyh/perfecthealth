<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Support\Str;
use App\Models\Receptionist;
use Illuminate\Http\Request;
use App\Tables\Receptionists;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use ProtoneMedia\Splade\Facades\SEO;
use App\Rules\UniqueEmailAcrossTables;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;

class AdminReceptionistController extends Controller
{
    public function index() {
        if(Session::get('locale') == 'en') {
            SEO::title('Receptionists | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('موظفوا الاستقبال | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        return view('dashboard.admin.manage.receptionists.index',[
            'receptionists' => Receptionists::class,
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
        return view('dashboard.admin.manage.receptionists.edit',[
            'id'=> $req->id,
            'receptionist' => Receptionist::find($req->id),
        ]);
    }
    public function update(Request $req) {
        $receptionist = Receptionist::find($req->id);
        $formFields = $req->validate(
            [
                'name' => 'required',
                'email' => ['required', 'email', new UniqueEmailAcrossTables($receptionist->id)],
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'day' => 'required',
                'date_of_brith' => 'required',
                'national_id' => 'required|numeric',
                'phone' => 'required|numeric',
                'password'=>'required|confirmed',
                'password_confirmation'=>'required',
            ]
        );
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
        $days = implode('|',$req->day);
        $receptionist->days = $days;
        $receptionist->hours = $hours;
        $receptionist->name = $req->name;
        $receptionist->first_name = $req->first_name;
        $receptionist->last_name = $req->last_name;
        $receptionist->email = $req->email;
        $receptionist->gender = $req->gender;
        $receptionist->phone = $req->phone;
        $receptionist->national_id = $req->national_id;
        $receptionist->date_of_brith = $req->date_of_brith;
        $receptionist->password = Hash::make($req->password);
        $receptionist->save();
        Toast::success(Lang::get('toast.profile_updated'));
        return redirect()->route('admin.manage.receptionists.index');
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
        return view('dashboard.admin.manage.receptionists.add');
    }
    public function register(Request $req) {
        $req->validate(
            [
                'name' => 'required',
                'email' => ['required', 'email', new UniqueEmailAcrossTables],
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'day' => 'required',
                'date_of_brith' => 'required',
                'national_id' => 'required|numeric',
                'phone' => 'required|numeric',
                'password'=>'required|confirmed',
                'password_confirmation'=>'required',
            ]
        );
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
        $receptionist = new Receptionist();
        $hours = implode('|', $hours);
        $receptionist->days = implode('|',$req->day);
        $receptionist->hours = $hours;
        $receptionist->name = $req->name;
        $receptionist->first_name = $req->first_name;
        $receptionist->last_name = $req->last_name;
        $receptionist->email = $req->email;
        $receptionist->gender = $req->gender;
        $receptionist->phone = $req->phone;
        $receptionist->national_id = $req->national_id;
        $receptionist->date_of_brith = $req->date_of_brith;
        $receptionist->password = Hash::make($req->password);
        $save = $receptionist->save();

        Toast::success(Lang::get('toast.acc_register'));

        return redirect()->route('admin.manage.receptionists.index');
    }
    public function delete(Request $req) {
        Receptionist::find($req->id)->delete();
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
        $receptionist = Receptionist::find($req->id);
        return view('dashboard.admin.manage.receptionists.profile',compact('receptionist'));
    }

    public function profile_update(Request $req) {
        $formField = $req->validate(
            [
                'name' => 'required',
                'email' => ['required', 'email', new UniqueEmailAcrossTables($req->id)],
                'image'=> 'nullable',
            ]
        );
        $receptionist = Receptionist::find($req->id);
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
        $receptionist = Receptionist::find($req->id);
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
    public function job_update(Request $req) {
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
            $thu_hour = 'thursday_'.implode(',',$req->thu_hour);
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
        $receptionist = Receptionist::find($req->id);
        $hours = implode('|', $hours);
        $receptionist->days = implode('|',$req->day);
        $receptionist->hours = $hours;
        $receptionist->save();
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
        $receptionist = Receptionist::find($req->id);
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
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
            ]
        );

        $receptionist = Receptionist::find($req->id);
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
        Toast::success(Lang::get('toast.employee_delete'));
        return redirect()->route('admin.manage.receptionists.index');
    }
}
