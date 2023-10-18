<x-admin.layout>
    <x-admin.content>
        <div class="profile">
            <div class="title" style="text-transform: capitalize">{{$receptionist->first_name}} {{$receptionist->last_name}} @lang('titles.profile')</div>
            <div class="wrapper">
                <div class="box">
                    <div class="img-box">
                        @if ($receptionist->image)
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
                            <img src="{{asset('storage/'.'images/profiles/default.jpeg')}}" alt="">
                        @endif
                    </div>
                </div>
                <div class="container">
                    <div class="form-box">
                        <div class="title">@lang('titles.profile_info')</div>
                        <p class="description">@lang('descriptions.profile_info')</p>
                        <x-splade-form background  :action="route('admin.manage.receptionists.profile-update',['id'=>$receptionist->id])" :default="['name' => $receptionist->name, 'email' => $receptionist->email]" method="POST" class="form">
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
                        <x-splade-form background :action="route('admin.manage.receptionists.personal-update',['id'=>$receptionist->id],['id'=>$receptionist->id])" :default="$receptionist" method="POST" class="form">
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
                        <div class="title">@lang('titles.job_info')</div>
                        <p class="description">@lang('descriptions.job_info')</p>
                        <x-splade-form background :action="route('admin.manage.receptionists.job-update',['id'=>$receptionist->id])" :default="$receptionist" method="POST" class="form">
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
                            <div class="form-group mt-2 mb-2">
                                <div class="form-column">
                                    <label for="linkedin">@lang('labels.days')</label>
                                    <x-splade-group name="day" id="days" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;">
                                        <x-splade-checkbox name="day[]" class="check-day" value="sunday"  >
                                            @lang('labels.sunday')
                                        </x-splade-checkbox>
                                        <x-splade-checkbox name="day[]" class="check-day" value="monday" >
                                            @lang('labels.monday')
                                        </x-splade-checkbox>
                                        <x-splade-checkbox name="day[]" class="check-day" value="tuesday">
                                            @lang('labels.tuesday')
                                        </x-splade-checkbox>
                                        <x-splade-checkbox name="day[]" class="check-day" value="wednesday" >
                                            @lang('labels.wednesday')
                                        </x-splade-checkbox>
                                        <x-splade-checkbox name="day[]" class="check-day" value="thursday" >
                                            @lang('labels.thursday')
                                        </x-splade-checkbox>
                                        <x-splade-checkbox name="day[]" class="check-day" value="friday" >
                                            @lang('labels.friday')
                                        </x-splade-checkbox>
                                        <x-splade-checkbox name="day[]" class="check-day" value="saturday" >
                                            @lang('labels.saturday')
                                        </x-splade-checkbox>
                                    </x-splade-group>
                                </div>
                            </div>
                            <div class="group-check mt-2 mb-2" id="sun_check">
                                <div class="form-column">
                                    <label for="sun_hours">@lang('labels.sun_hours')</label>
                                    <x-splade-group name="sun_hour" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;">
                                        @foreach ($work_hours as $hour)
                                            <x-splade-checkbox name="sun_hour[]" :show-errors="false" value="{{ $hour }}" label="{{ \Carbon\Carbon::createFromFormat('H',  explode('-', $hour)[0])->format('gA') . '-' . \Carbon\Carbon::createFromFormat('H',  explode('-', $hour)[1])->format('gA') }}" />
                                        @endforeach
                                    </x-splade-group>
                                </div>
                            </div>
                            <div class="group-check mt-2 mb-2" id="mon_check">
                                <div class="form-column">
                                    <label for="mon_hours">@lang('labels.mon_hours')</label>
                                    <x-splade-group name="mon_hour" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;" >
                                        @foreach ($work_hours as $hour)
                                            <x-splade-checkbox name="mon_hour[]" :show-errors="false" value="{{ $hour }}" label="{{ \Carbon\Carbon::createFromFormat('H',  explode('-', $hour)[0])->format('gA') . '-' . \Carbon\Carbon::createFromFormat('H',  explode('-', $hour)[1])->format('gA') }}" />
                                        @endforeach
                                    </x-splade-group>
                                </div>
                            </div>
                            <div class="group-check mt-2 mb-2" id="tue_check">
                                <div class="form-column">
                                    <label for="tue_hours">@lang('labels.tue_hours')</label>
                                    <x-splade-group name="tue_hour" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;">
                                        @foreach ($work_hours as $hour)
                                            <x-splade-checkbox name="tue_hour[]" :show-errors="false" value="{{ $hour }}" label="{{ \Carbon\Carbon::createFromFormat('H',  explode('-', $hour)[0])->format('gA') . '-' . \Carbon\Carbon::createFromFormat('H',  explode('-', $hour)[1])->format('gA') }}" />
                                        @endforeach
                                    </x-splade-group>
                                </div>
                            </div>
                            <div class="group-check mt-2 mb-2" id="wed_check">
                                <div class="form-column">
                                    <label for="wed_hours">@lang('labels.wed_hours')</label>
                                    <x-splade-group name="wed_hour" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;">
                                        @foreach ($work_hours as $hour)
                                            <x-splade-checkbox name="wed_hour[]" :show-errors="false" value="{{ $hour }}" label="{{ \Carbon\Carbon::createFromFormat('H',  explode('-', $hour)[0])->format('gA') . '-' . \Carbon\Carbon::createFromFormat('H',  explode('-', $hour)[1])->format('gA') }}" />
                                        @endforeach
                                    </x-splade-group>
                                </div>
                            </div>
                            <div class="group-check mt-2 mb-2" id="thu_check">
                                <div class="form-column">
                                    <label for="thu_hours">@lang('labels.thu_hours')</label>
                                    <x-splade-group name="thu_hour" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;">
                                        @foreach ($work_hours as $hour)
                                            <x-splade-checkbox name="thu_hour[]" :show-errors="false" value="{{ $hour }}" label="{{ \Carbon\Carbon::createFromFormat('H',  explode('-', $hour)[0])->format('gA') . '-' . \Carbon\Carbon::createFromFormat('H',  explode('-', $hour)[1])->format('gA') }} " />
                                        @endforeach
                                    </x-splade-group>
                                </div>
                            </div>
                            <div class="group-check mt-2 mb-2" id="fri_check">
                                <div class="form-column">
                                    <label for="fri_hours">@lang('labels.fri_hours')</label>
                                    <x-splade-group name="fri_hour" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;">
                                        @foreach ($work_hours as $hour)
                                            <x-splade-checkbox name="fri_hour[]" :show-errors="false" value="{{ $hour }}" label="{{ \Carbon\Carbon::createFromFormat('H',  explode('-', $hour)[0])->format('gA') . '-' . \Carbon\Carbon::createFromFormat('H',  explode('-', $hour)[1])->format('gA') }}" />
                                        @endforeach
                                    </x-splade-group>
                                </div>
                            </div>
                            <div class="group-check mt-2 mb-2" id="sat_check">
                                <div class="form-column">
                                    <label for="sat_hours">@lang('labels.sat_hours')</label>
                                    <x-splade-group name="sat_hour" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;">
                                        @foreach ($work_hours as $hour)
                                            <x-splade-checkbox name="sat_hour[]" :show-errors="false" value="{{ $hour }}" label="{{ \Carbon\Carbon::createFromFormat('H',  explode('-', $hour)[0])->format('gA') . '-' . \Carbon\Carbon::createFromFormat('H',  explode('-', $hour)[1])->format('gA') }}" />
                                        @endforeach
                                    </x-splade-group>
                                </div>
                            </div>
                            <x-splade-submit id="save">
                                @lang('buttons.save')
                            </x-splade-submit>
                        </x-splade-form>
                    </div>
                    <div class="form-box">
                        <div class="title">@lang('titles.update_pwd')</div>
                        <p class="description">@lang('descriptions.update_pwd')</p>
                        <x-splade-form background :action="route('admin.manage.receptionists.pwd-update',['id'=>$receptionist->id])" method="POST" class="form">
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
                        <x-splade-form :action="route('admin.manage.receptionists.delete-profile')" :default="$receptionist" method="POST" class="form">
                            <x-splade-input type="hidden" name="id" />
                            <x-splade-submit id="delete">
                                @lang('buttons.delete_acc')
                            </x-splade-submit>
                        </x-splade-form>
                    </div>
                </div>
            </div>
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
        </x-splade-script>
    </x-admin.content>
</x-admin.layout>
