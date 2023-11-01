<x-doctor.layout>
    <x-doctor.content>
        <div class="profile">
            <div class="title">@lang('titles.manage') @lang('titles.profile')</div>
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
                        <div class="title">@lang('titles.profile_info')</div>
                        <p class="description">@lang('descriptions.profile_info')</p>
                        <x-splade-form background  :action="route('doctor.profile.profile-update')" :default="['name' => $doctor->name, 'email' => $doctor->email]" method="POST" class="form">
                            <div class="group">
                                <div class="form-column">
                                    <label for="name">@lang('labels.username')</label>
                                    <x-splade-input type="text" class="input" name="name"/>
                                </div>
                                <div class="form-column">
                                    <label for="email">@lang('labels.email')</label>
                                    <x-splade-input type="text" class="input" name="email"/>
                                </div>
                            </div>
                            <div class="form-column">
                                <label for="image">@lang('labels.pfp')</label>
                                <x-splade-file id="file" filepond name="image"/>
                            </div>
                            <x-splade-submit id="save">
                                @lang('buttons.save')
                            </x-splade-submit>
                        </x-splade-form>
                    </div>
                    <div class="form-box">
                        <div class="title">@lang('titles.personal_info')</div>
                        <p class="description">@lang('descriptions.personal_info')</p>
                        <x-splade-form background :action="route('doctor.profile.personal-update')" :default="$doctor" method="POST" class="form">
                            <div class="group">
                                <div class="form-column">
                                    <label for="first_name">@lang('labels.first_name')</label>
                                    <x-splade-input type="text" class="input" name="first_name"/>
                                </div>
                                <div class="form-column">
                                    <label for="last_name">@lang('labels.last_name')</label>
                                    <x-splade-input type="text" class="input" name="last_name"/>
                                </div>
                            </div>
                            <div class="group">
                                <div class="form-column">
                                    <label for="gender">@lang('labels.date_of_brith')</label>
                                    <x-splade-input type="text" class="input" date name="date_of_brith"/>
                                </div>
                                <div class="form-column">
                                    <label for="email">@lang('labels.gender')</label>
                                    <x-splade-select name="gender" choices class="input">
                                        <option value="" selected disabled></option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </x-splade-select>
                                </div>
                            </div>
                            <div class="group">
                                <div class="form-column">
                                    <label for="phone">@lang('labels.phone')</label>
                                    <x-splade-input type="text" class="input" name="phone" />
                                </div>
                                <div class="form-column">
                                    <label for="national_id">@lang('labels.national_id')</label>
                                    <x-splade-input type="text"  class="input" name="national_id"/>
                                </div>
                            </div>
                            <x-splade-submit id="save">
                                @lang('buttons.save')
                            </x-splade-submit>
                        </x-splade-form>
                    </div>
                    <div class="form-box">
                        <div class="title">@lang('titles.social_info')</div>
                        <p class="description">@lang('descriptions.social_info')</p>
                        <x-splade-form background :action="route('doctor.profile.social-update')" :default="$doctor" method="POST" class="form">
                            <div class="group">
                                <div class="form-column">
                                    <label for="facebook">@lang('labels.facebook')</label>
                                    <x-splade-input class="input" name="facebook" placeholder="https://www.facebook.com/example/"/>
                                </div>
                                <div class="form-column">
                                    <label for="instagram">@lang('labels.instagram')</label>
                                    <x-splade-input class="input" name="instagram" placeholder="https://www.instagram.com/example/"/>
                                </div>
                            </div>
                            <div class="group">
                                <div class="form-column">
                                    <label for="twitter">@lang('labels.twitter')</label>
                                    <x-splade-input class="input" name="twitter" placeholder="https://www.twitter.com/example/"/>
                                </div>
                                <div class="form-column">
                                    <label for="linkedin">@lang('labels.linkedin')</label>
                                    <x-splade-input class="input" name="linkedin" placeholder="https://www.linkedin.com/in/example/"/>
                                </div>
                            </div>
                            <x-splade-submit id="save">
                                @lang('buttons.save')
                            </x-splade-submit>
                        </x-splade-form>
                    </div>
                    <div class="form-box">
                        <div class="title">@lang('titles.job_info')</div>
                        <p class="description">@lang('descriptions.job_info')</p>
                        <x-splade-form background :default="$doctor" method="POST" class="form">
                            <div class="group">
                                <div class="form-column">
                                    <label for="specialty">@lang('labels.specialty')</label>
                                    <x-splade-select name="specialty" disabled :options="$specialties" choices class="input" ></x-splade-select>
                                </div>
                            </div>
                            <div class="form-group column mt-2 mb-2">
                                <label for="work_days_hours">@lang('labels.work_days_hours')</label>
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
                                    echo '<p style="text-transform: capitalize; font-size:18px;">'. implode(' <br> ', $formattedDays) .'</p>'
                                @endphp
                                </div>
                            </div>
                        </x-splade-form>
                    </div>
                    <div class="form-box">
                        <div class="title">@lang('titles.update_pwd')</div>
                        <p class="description">@lang('descriptions.update_pwd')</p>
                        <x-splade-form background :action="route('doctor.profile.pwd-update')" method="POST" class="form">
                            <div class="form-column">
                                <label for="current_password">@lang('labels.currentpwd')</label>
                                <x-splade-input type="password" class="input" name="current_password"/>
                            </div>
                            <div class="form-column">
                                <label for="password">@lang('labels.newpwd')</label>
                                <x-splade-input type="password" class="input" name="password" />
                            </div>
                            <div class="form-column">
                                <label for="password_confirmation">@lang('labels.cpwd')</label>
                                <x-splade-input type="password" class="input" name="password_confirmation" />
                            </div>
                            <x-splade-submit id="save">
                                @lang('buttons.save')
                            </x-splade-submit>
                        </x-splade-form>
                    </div>
                    <div class="form-box">
                        <div class="title">@lang('titles.delete_acc')</div>
                        <p class="description">@lang('descriptions.delete_acc')</p>
                        <x-splade-form :action="route('doctor.profile.delete-profile')" :default="$doctor" method="POST" class="form">
                            <x-splade-input type="hidden" name="id" />
                            <x-splade-submit id="delete">
                                @lang('buttons.delete_acc')
                            </x-splade-submit>
                        </x-splade-form>
                    </div>
                </div>
            </div>
        </div>
    </x-doctor.content>
</x-doctor.layout>
