<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('auth.register') @lang('titles.doctor')</div>
            <x-splade-form :action="Route('admin.manage.doctors.register')" method="POST" autocomplete="off">
                <div class="row-group">
                    <div class="form-column">
                        <label for="name">@lang('labels.username')</label>
                        <x-splade-input class="input"  name="name" value="{{ old('Name') }}"/>
                    </div>
                    <div class="form-column">
                        <label for="email">@lang('labels.email')</label>
                        <x-splade-input class="input"  name="email" value="{{ old('email') }}"/>
                    </div>
                </div>
                <div class="row-group">
                    <div class="form-column">
                        <label for="first_name">@lang('labels.first_name')</label>
                        <x-splade-input class="input"  name="first_name" value="{{ old('first_name') }}"/>
                    </div>
                    <div class="form-column">
                        <label for="last_name">@lang('labels.last_name')</label>
                        <x-splade-input class="input"  name="last_name" value="{{ old('last_name') }}"/>
                    </div>
                </div>
                <div class="row-group">
                    <div class="form-column">
                        <label for="gender">@lang('labels.gender')</label>
                        <x-splade-select :options="['male' => 'Male', 'female'=>'Female']" class="input" choices name="gender" />
                    </div>
                    <div class="form-column">
                        <label for="date_of_brith">@lang('labels.date_of_brith')</label>
                        <x-splade-input class="input"  date name="date_of_brith" value="{{ old('date_of_brith') }}"/>
                    </div>
                    <div class="form-column">
                        <label for="phone">@lang('labels.phone')</label>
                        <x-splade-input class="input"  name="phone" value="{{ old('phone') }}"/>
                    </div>
                </div>
                <div class="row-group">
                    <div class="form-column">
                        <label for="specialty">@lang('labels.specialty')</label>
                        <x-splade-select :options="$specialties" class="input" choices name="specialty" />
                    </div>
                    <div class="form-column">
                        <label for="national_id">@lang('labels.national_id')</label>
                        <x-splade-input class="input"  name="national_id" value="{{ old('national_id') }}"/>
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
                <div class="row-group">
                    <div class="form-column">
                        <label for="password">@lang('labels.password')</label>
                        <x-splade-input type="password" class="input" name="password"  />
                    </div>
                    <div class="form-column">
                        <label for="password_confirmation">@lang('labels.cpwd')</label>
                        <x-splade-input type="password" class="input" name="password_confirmation" />
                    </div>
                </div>
                <x-splade-submit class="mt-4" style="width:100%;" confirm>
                    @lang('auth.register')
                </x-splade-submit>
            </x-splade-form>
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
