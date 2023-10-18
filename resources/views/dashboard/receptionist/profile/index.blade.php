<x-receptionist.layout>
    <x-receptionist.content>
        <div class="profile">
            <div class="title">Manage Profile</div>
            <div class="wrapper">
                <div class="box">
                    <div class="img-box">
                        @if (Auth::user()->image)
                        @if (Str::startsWith($receptionist->image, ['http://', 'https://']))
                            <img src="{{$receptionist->image}}" alt="">
                        @else

                            @if (Storage::exists('public/'. $receptionist->image))
                                <img src="{{asset('storage/'.$receptionist->image)}}" alt="">
                            @else
                                <img src="{{asset('storage/'.'images/profiles/default.jpg')}}" alt="">
                            @endif


                        @endif
                        @else
                            <img src="{{asset('storage/'.'images/doc.jpg')}}" alt="">
                        @endif
                    </div>
                </div>
                <div class="container">
                    <div class="form-box">
                        <div class="title">Profile Information</div>
                        <p class="description">Update Your Profile Information.</p>
                        <x-splade-form background  :action="route('receptionist.profile.profile-update')" :default="['name' => $receptionist->name, 'email' => $receptionist->email]" method="POST" class="form">
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
                        <x-splade-form background  :action="route('receptionist.profile.personal-update')" :default="$receptionist" method="POST" class="form">
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
                        <div class="title">Work Information</div>
                        <p class="description">Update Your Medical Information.</p>
                        <x-splade-form background :action="route('receptionist.profile.work-update')" :default="$receptionist" method="POST" class="form">
                            <div class="form-group column mt-2 mb-2">
                                <div class="label">
                                    Work Days & Hours
                                </div>
                                <div class="row">
                                    @php
                                        $days = explode('|', $receptionist->hours);
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
                        <x-splade-form background :action="route('receptionist.profile.pwd-update')" :default="$receptionist" method="POST" class="form">
                            <x-splade-input type="password" class="input" name="current_password" label="Curent Password" />
                            <x-splade-input type="password" class="input" name="password" label="New Passowrd" />
                            <x-splade-input type="password" class="input" name="password_confirmation" label="Confirm Password" />
                            <x-splade-submit id="save" label="Save changes" />
                        </x-splade-form>
                    </div>
                    <div class="form-box">
                        <div class="title">Delete Account</div>
                        <p class="description">Once Your Account Is Deleted, All of the resource and data will be gone and cannot be restored</p>
                        <x-splade-form :action="route('receptionist.profile.delete-profile')" :default="$receptionist" method="POST" class="form">
                            <x-splade-input type="hidden" name="id" />
                            <x-splade-submit id="delete" label="Delete Account" />
                        </x-splade-form>
                    </div>
                </div>
            </div>
        </div>
    </x-receptionist.content>
</x-receptionist.layout>
