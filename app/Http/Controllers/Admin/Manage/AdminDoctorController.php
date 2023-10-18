<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Models\Doctor;
use App\Tables\Doctors;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use ProtoneMedia\Splade\Facades\SEO;
use App\Rules\UniqueEmailAcrossTables;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;

class AdminDoctorController extends Controller
{
    public function index() {
        if(Session::get('locale') == 'en') {
            SEO::title('Doctors | Dr Waleed Haikal Clinic')
                ->description('Dr waleed haikal clinic')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }else {
            SEO::title('الأطباء | عيادة الدكتور وليد هيكل')
                ->description('عيادة الدكتور وليد هيكل')
                ->keywords('hms', 'clinic','waleed','haikal','doctor','doctor waleed haikal clinic','عيادة الدكتور وليد هيكل' , 'وليد هيكل', 'دكتور');
        }
        return view('dashboard.admin.manage.doctors.index',[
            'doctors' => Doctors::class,
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
        $hour_label = "Time Range";
        return view('dashboard.admin.manage.doctors.edit',[
            'id'=> $req->id,
            'doctor' => Doctor::find($req->id),
        ]);
    }
    public function update(Request $req) {
        $doctor = Doctor::find($req->id);
        $formFields = $req->validate(
            [
                'name' => 'required',
                'email' => ['required', 'email', new UniqueEmailAcrossTables($doctor->id)],
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'specialty' => 'required',
                'day' => 'required',
                'date_of_brith' => 'required',
                'national_id' => 'required|numeric',
                'phone' => 'required|numeric',
                'password'=>'required|confirmed',
                'password_confirmation'=>'required',
                // 'sun_hour' => [
                //     'required_if:day.*,sunday',
                //     function ($attribute, $value, $fail) use ($req) {
                //         if (in_array('sunday', $req->day) && $value == null) {
                //             $fail($attribute.' is required.');
                //         }
                //     },
                // ],
                // 'mon_hour' => [
                //     'required_if:day.*,monday',
                //     function ($attribute, $value, $fail) use ($req) {
                //         if (in_array('monday', $req->day) && $value == null) {
                //             $fail($attribute.' is required.');
                //         }
                //     },
                // ],
                // 'tue_hour' => [
                //     'required_if:day.*,tuesday',
                //     function ($attribute, $value, $fail) use ($req) {
                //         if (in_array('tuesday', $req->day) && $value == null) {
                //             $fail($attribute.' is required.');
                //         }
                //     },
                // ],
                // 'wed_hour' => [
                //     'required_if:day.*,wednesday',
                //     function ($attribute, $value, $fail) use ($req) {
                //         if (in_array('wednesday', $req->day) && $value == null) {
                //             $fail($attribute.' is required.');
                //         }
                //     },
                // ],
                // 'thu_hour' => [
                //     'required_if:day.*,thursday',
                //     function ($attribute, $value, $fail) use ($req) {
                //         if (in_array('thursday', $req->day) && $value == null) {
                //             $fail($attribute.' is required.');
                //         }
                //     },
                // ],
                // 'fri_hour' => [
                //     'required_if:day.*,friday',
                //     function ($attribute, $value, $fail) use ($req) {
                //         if (in_array('friday', $req->day) && $value == null) {
                //             $fail($attribute.' is required.');
                //         }
                //     },
                // ],
                // 'sat_hour' => [
                //     'required_if:day.*,saturday',
                //     function ($attribute, $value, $fail) use ($req) {
                //         if (in_array('saturday', $req->day) && $value == null) {
                //             $fail($attribute.' is required.');
                //         }
                //     },
                // ],
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
        $doctor->days = implode('|',$req->day);
        $doctor->hours = $hours;
        $doctor->name = $req->name;
        $doctor->first_name = $req->first_name;
        $doctor->last_name = $req->last_name;
        $doctor->email = $req->email;
        $doctor->gender = $req->gender;
        $doctor->phone = $req->phone;
        $doctor->national_id = $req->national_id;
        $doctor->specialty = $req->specialty;
        $doctor->date_of_brith = $req->date_of_brith;
        $doctor->password = Hash::make($req->password);
        $doctor->save();
        $doctor->update($formFields);
        Toast::success(Lang::get('toast.profile_updated'));
        return redirect()->route('admin.manage.doctors.index');
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
        return view('dashboard.admin.manage.doctors.add');
    }
    public function register(Request $req) {
        $formFields = $req->validate(
            [
                'name' => 'required',
                'email' => ['required', 'email', new UniqueEmailAcrossTables],
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'specialty' => 'required',
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
        $doctor = new Doctor();
        $doctor->days = implode('|',$req->day);
        $doctor->hours = $hours;
        $doctor->name = $req->name;
        $doctor->first_name = $req->first_name;
        $doctor->last_name = $req->last_name;
        $doctor->email = $req->email;
        $doctor->gender = $req->gender;
        $doctor->phone = $req->phone;
        $doctor->national_id = $req->national_id;
        $doctor->specialty = $req->specialty;
        $doctor->date_of_brith = $req->date_of_brith;
        $doctor->password = Hash::make($req->password);
        $doctor->save();
        Toast::success(Lang::get('toast.acc_register'));
        return redirect()->route('admin.manage.doctors.index');
    }
    public function delete(Request $req) {
        Doctor::find($req->id)->delete();
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
        $doctor = Doctor::find($req->id);
        return view('dashboard.admin.manage.doctors.profile',compact('doctor'));
    }
    public function profile_update(Request $req) {
        $formField = $req->validate(
            [
                'name' => 'required',
                'email' => ['required', 'email', new UniqueEmailAcrossTables($req->id)],
                'image'=> 'nullable',
            ]
        );
        $doctor = Doctor::find($req->id);
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
        $doctor = Doctor::find($req->id);
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
        $doctor = Doctor::find($req->id);
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
        $formField = $req->validate(
            [
                'specialty' => 'required',
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
        $doctor = Doctor::find($req->id);
        $isDataChanged = false;
        foreach ($formField as $key => $value) {
            if ($value != $doctor->$key) {
                $isDataChanged = true;
                break;
            }
        }
        // if (!$isDataChanged) {
        //     Toast::danger('You can\'t update your data without changing it!');
        //     return redirect()->back();
        // }
        $hours = implode('|', $hours);
        $doctor->days = implode('|',$req->day);
        $doctor->hours = $hours;
        $doctor->specialty = $req->specialty;
        $doctor->update($formField);
        Toast::success(Lang::get('toast.profile_updated'));
        return redirect()->back();
    }
    public function pwd_update(Request $req) {
        $formField = $req->validate(
            [
                // 'current_password' => ['required', function ($attribute, $value, $fail) use ($req) {
                //     if (!Hash::check($value, $req->user()->password)) {
                //         return $fail(__('The current password is incorrect.'));
                //     }
                // }],
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
            ]
        );

        $doctor = Doctor::find($req->id);
        $doctor->password = Hash::make($req->input('password'));
        $doctor->save();

        Toast::success(Lang::get('toast.pwd_update'));
        return redirect()->back();
    }
    public function delete_profile(Request $req) {
        $doctor = Doctor::find($req->id);
        $oldImage = $doctor->image;
        if($oldImage && file_exists(public_path('storage/'.$oldImage))) {
            unlink(public_path('storage/'.$oldImage));
        }
        $doctor->delete();
        Toast::success(Lang::get('toast.acc_delete'));
        return redirect()->route('admin.manage.doctors.index');
    }

}
