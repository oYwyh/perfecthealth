<x-receptionist.layout>
    <x-receptionist.content>
        <div class="profile">
            <div class="title" style="text-transform: capitalize">@lang('titles.manage') @lang('titles.profile')</div>
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
                            <img src="{{asset('storage/'.'images/profiles/default.jpg')}}" alt="">
                        @endif
                    </div>
                </div>
                <div class="container">
                    <div class="form-box">
                        <div class="title">@lang('titles.profile_info')</div>
                        <p class="description">@lang('descriptions.profile_info')</p>
                        <x-splade-form background  :action="route('receptionist.profile.profile-update')" :default="['name' => $receptionist->name, 'email' => $receptionist->email]" method="POST" class="form">
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
                        <x-splade-form background :action="route('receptionist.profile.personal-update')" :default="$receptionist" method="POST" class="form">
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
                                        <option value="male">@lang('labels.male')</option>
                                        <option value="female">@lang('labels.female')</option>
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
                        <div class="title">@lang('titles.job_info')</div>
                        <p class="description">@lang('descriptions.job_info')</p>
                        <x-splade-form background :action="route('receptionist.profile.work-update')" :default="$receptionist" method="POST" class="form">
                            <div class="form-group column mt-2 mb-2">
                                <label for="work_days_hours">@lang('labels.work_days_hours')</label>
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
                        <div class="title">@lang('titles.update_pwd')</div>
                        <p class="description">@lang('descriptions.update_pwd')</p>
                        <x-splade-form background :action="route('receptionist.profile.pwd-update')" method="POST" class="form">
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
                        <x-splade-form :action="route('receptionist.profile.delete-profile')" :default="$receptionist" method="POST" class="form">
                            <x-splade-input type="hidden" name="id" />
                            <x-splade-submit id="delete">
                                @lang('buttons.delete_acc')
                            </x-splade-submit>
                        </x-splade-form>
                    </div>
                </div>
            </div>
        </div>
    </x-receptionist.content>
</x-receptionist.layout>
