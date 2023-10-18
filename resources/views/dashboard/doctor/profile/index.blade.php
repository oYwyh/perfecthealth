<x-doctor.layout>
    <x-doctor.content>
        <div class="profile">
            <div class="title">Manage Profile</div>
            <div class="wrapper">
                <div class="box">
                    <div class="img-box">
                        @if (Auth::user()->image)
                        @if (Str::startsWith($doctor->image, ['http://', 'https://']))
                            <img src="{{$doctor->image}}" alt="">
                        @else

                            @if (Storage::exists('public/'. $doctor->image))
                                <img src="{{asset('storage/'.$doctor->image)}}" alt="">
                            @else
                                <img src="{{asset('storage/'.'images/profiles/default.jpg')}}" alt="">
                            @endif

                        @endif
                        @else
                            <img src="{{asset('storage/'.'images/profiles/default.jpeg')}}" alt="">
                        @endif
                    </div>
                </div>
                <div class="container">
                    <div class="form-box">
                        <div class="title">Profile Information</div>
                        <p class="description">Update Your Profile Information.</p>
                        <x-splade-form background  :action="route('doctor.profile.profile-update')" :default="['name' => $doctor->name, 'email' => $doctor->email]" method="POST" class="form">
                            <div class="group">
                                <x-splade-input type="text" class="input" name="name" label="Username"/>
                                <x-splade-input type="text" class="input" name="email" label="Email"/>
                            </div>
                                <x-splade-file id="file" class="mt-2" filepond label="Profile Picture" name="image"/>
                            <x-splade-submit id="save" label="Save changes" />
                        </x-splade-form>
                    </div>
                    <div class="form-box">
                        <div class="title">Personal Information</div>
                        <p class="description">Update Your Personal Information.</p>
                        <x-splade-form background  :action="route('doctor.profile.personal-update')" :default="$doctor" method="POST" class="form">
                            <div class="group">
                                <x-splade-input type="text" class="input" name="first_name" label="First Name"/>
                                <x-splade-input type="text" class="input" name="last_name" label="Last Name"/>
                            </div>
                            <div class="group">
                                <x-splade-input type="text" class="input" date name="date_of_brith" label="Date of brith"/>
                                <x-splade-select name="gender" choices class="input" label="gender">
                                    <option value="" selected disabled></option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </x-splade-select>
                            </div>
                            <div class="group">
                                <x-splade-input type="text"  class="input" name="phone" label="Phone Number" />
                                <x-splade-input type="text"  class="input" name="national_id" label="National id" />
                            </div>
                            <x-splade-submit id="save" label="Save changes" />
                        </x-splade-form>
                    </div>
                    <div class="form-box">
                        <div class="title">Social Information</div>
                        <p class="description">Update Your Social Information.</p>
                        <x-splade-form background :action="route('doctor.profile.social-update')" :default="$doctor" method="POST" class="form">
                            <div class="group">
                                <x-splade-input class="input" name="facebook" label="Facebook" placeholder="https://www.facebook.com/example/"/>
                                <x-splade-input class="input" name="instagram" label="Instagram" placeholder="https://www.instagram.com/example/"/>
                            </div>
                            <div class="group">
                                <x-splade-input class="input" name="twitter" label="Twitter" placeholder="https://www.twitter.com/example/"/>
                                <x-splade-input class="input" name="linkedin" label="Linkedin" placeholder="https://www.linkedin.com/in/example/"/>
                            </div>
                            <x-splade-submit id="save" label="Save changes" />
                        </x-splade-form>
                    </div>
                    <div class="form-box">
                        <div class="title">Work Information</div>
                        <p class="description">Update Your Medical Information.</p>
                        <x-splade-form background :action="route('doctor.profile.work-update')" :default="$doctor" method="POST" class="form">
                            <div class="group">
                                <x-splade-select name="specialty" disabled :options="$specialties" choices class="input" label="Specialty"></x-splade-select>
                            </div>
                            <div class="form-group column mt-2 mb-2">
                                <div class="label">
                                    Work Days & Hours
                                </div>
                                <div class="row">
                                    @php
                                    $days = explode('|', $doctor->hours);
                                    $formattedDays = [];
                                    foreach ($days as $day) {
                                        $dayParts = explode('_', $day);
                                        $dayName = substr($dayParts[0], 0, 3);
                                        $hours = explode(',', $dayParts[1]);

                                        $formattedHours = [];
                                        foreach ($hours as $hour) {
                                            $hourParts = explode('-', $hour);
                                            $startHour = date("ga", strtotime($hourParts[0] . ":00"));
                                            $endHour = date("ga", strtotime($hourParts[1] . ":00"));
                                            $formattedHours[] = $startHour . ' to ' . $endHour;
                                        }

                                        $formattedDays[] = $dayName . ' => ' . implode(' , ', $formattedHours);
                                    }
                                    echo '<p style="text-transform: capitalize;">'. implode(' <br> ', $formattedDays) .'</p>'
                                @endphp
                                </div>
                            </div>
                        </x-splade-form>
                    </div>
                    <div class="form-box">
                        <div class="title">Update Password</div>
                        <p class="description">Update Your Password Real Quick.</p>
                        <x-splade-form background :action="route('doctor.profile.pwd-update')" method="POST" class="form">
                            <x-splade-input type="password" class="input" name="current_password" label="Curent Password" />
                            <x-splade-input type="password" class="input" name="password" label="New Passowrd" />
                            <x-splade-input type="password" class="input" name="password_confirmation" label="Confirm Password" />
                            <x-splade-submit id="save" label="Save changes" />
                        </x-splade-form>
                    </div>
                    <div class="form-box">
                        <div class="title">Delete Account</div>
                        <p class="description">Once Your Account Is Deleted, All of the resource and data will be gone and cannot be restored</p>
                        <x-splade-form :action="route('doctor.profile.delete-profile')" :default="$doctor" method="POST" class="form">
                            <x-splade-input type="hidden" name="id" />
                            <x-splade-submit id="delete" label="Delete Account" />
                        </x-splade-form>
                    </div>
                </div>
            </div>
        </div>
    </x-doctor.content>
</x-doctor.layout>




{{-- <div class="group" style="margin-top:1rem;display: flex; gap:0 !important; flex-direction: column !important;">
    <p class="label">Work Times</p>
    <div style="padding-left: 1rem;">
        @foreach($date as $day => $hours)
            <p>- {{$carbon->parse($day)->format('l')}}</p> <!-- Add the day name here -->
            @foreach($hours as $hour)
                @php
                    $lol = explode('-',$hour);
                @endphp
                @foreach ($lol as $lol)
                    <span class="time" style="padding-left: 1rem;">
                        {{$carbon->parse($day . 'T' . $lol . ':00:00')->format('g:i A')}}
                    </span>                                                @endforeach
            @endforeach
        @endforeach
    </div>
</div>
<div class="group" style="width:100%;">
    <x-splade-select name="specialty" label="Speicalty" choices :options="collect($specialties)->map(function ($specialty) {
        return [
        'label' => ucwords(str_replace('_', ' ', $specialty)),
        'value' => $specialty,
        ];
    })->toArray()">
    </x-splade-select>
</div>
<div class="group mt-2 mb-2">
    <x-splade-group name="day" id="days" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;" label="Days">
        <x-splade-checkbox name="day[]" class="check-day" :show-errors="false" value="sunday" label="Sunday" />
        <x-splade-checkbox name="day[]" class="check-day" :show-errors="false" value="monday" label="Monday" />
        <x-splade-checkbox name="day[]" class="check-day" :show-errors="false" value="tuesday" label="Tuesday" />
        <x-splade-checkbox name="day[]" class="check-day" :show-errors="false" value="wednesday" label="Wednesday" />
        <x-splade-checkbox name="day[]" class="check-day" :show-errors="false" value="thursday" label="Thursday" />
        <x-splade-checkbox name="day[]" class="check-day" :show-errors="false" value="friday" label="Friday" />
        <x-splade-checkbox name="day[]" class="check-day" :show-errors="false" value="saturday" label="Saturday" />
    </x-splade-group>
</div>
<div class="group-check mt-2 mb-2" id="sun_check">
    <x-splade-group name="sun_hour" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;" label="Sunday Hours">
        @foreach ($freeHours as $hour)
            <x-splade-checkbox name="sun_hour[]" :show-errors="false" value="{{ $hour }}" label="{{ $hour }}" />
        @endforeach
    </x-splade-group>
</div>
<div class="group-check mt-2 mb-2" id="mon_check">
    <x-splade-group name="mon_hour" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;" label="Monday Hours">
        @foreach ($freeHours as $hour)
            <x-splade-checkbox name="mon_hour[]" :show-errors="false" value="{{ $hour }}" label="{{ $hour }}" />
        @endforeach
    </x-splade-group>
</div>
<div class="group-check mt-2 mb-2" id="tue_check">
    <x-splade-group name="tue_hour" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;" label="Tuesday Hours">
        @foreach ($freeHours as $hour)
            <x-splade-checkbox name="tue_hour[]" :show-errors="false" value="{{ $hour }}" label="{{ $hour }}" />
        @endforeach
    </x-splade-group>
</div>
<div class="group-check mt-2 mb-2" id="wed_check">
    <x-splade-group name="wed_hour" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;" label="Wednesday Hours">
        @foreach ($freeHours as $hour)
            <x-splade-checkbox name="wed_hour[]" :show-errors="false" value="{{ $hour }}" label="{{ $hour }}" />
        @endforeach
    </x-splade-group>
</div>
<div class="group-check mt-2 mb-2" id="thu_check">
    <x-splade-group name="thu_hour" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;" label="Thursday Hours">
        @foreach ($freeHours as $hour)
            <x-splade-checkbox name="thu_hour[]" :show-errors="false" value="{{ $hour }}" label="{{ $hour }}" />
        @endforeach
    </x-splade-group>
</div>
<div class="group-check mt-2 mb-2" id="fri_check">
    <x-splade-group name="fri_hour" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;" label="Friday Hours">
        @foreach ($freeHours as $hour)
            <x-splade-checkbox name="fri_hour[]" :show-errors="false" value="{{ $hour }}" label="{{ $hour }}" />
        @endforeach
    </x-splade-group>
</div>
<div class="group-check mt-2 mb-2" id="sat_check">
    <x-splade-group name="sat_hour" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;" label="Saturday Hours">
        @foreach ($freeHours as $hour)
            <x-splade-checkbox name="sat_hour[]" :show-errors="false" value="{{ $hour }}" label="{{ $hour }}" />
        @endforeach
    </x-splade-group>
</div>
<x-splade-script>
    const days = document.querySelectorAll('#days .check-day');
    days.forEach(day => {
        day.addEventListener('input', () => {
            const text = day.querySelector('label input')
            const three  = text.value.substring(0,3);
            const form = document.querySelector(`#${three}_check`);
            console.log(form);
            form.classList.toggle('active')
        })
    })
</x-splade-script> --}}
