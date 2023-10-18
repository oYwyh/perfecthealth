<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">Edit Receptionists</div>
            <x-splade-form :default="$receptionist" :action="Route('admin.manage.receptionists.update',['id'=>$id])" method="POST" autocomplete="off">
                <div class="row-group">
                    <x-splade-input class="input" label="Username" name="name" value="{{ old('Name') }}"/>
                    <x-splade-input class="input" label="Email" name="email" value="{{ old('email') }}"/>
                    <x-splade-input class="input" label="National Id" name="national_id" value="{{ old('national_id') }}"/>
                </div>
                <div class="row-group">
                    <x-splade-input class="input" label="First Name" name="first_name" value="{{ old('first_name') }}"/>
                    <x-splade-input class="input" label="Last Name" name="last_name" value="{{ old('last_name') }}"/>
                </div>
                <div class="row-group">
                    <x-splade-select :options="['male' => 'Male', 'female'=>'Female']" class="input" choices label="Gender" name="gender" />
                    <x-splade-input class="input" label="Date of Brith" date name="date_of_brith" value="{{ old('email') }}"/>
                    <x-splade-input class="input" label="phone" name="phone" value="{{ old('phone') }}"/>
                </div>
                <div class="form-group mt-2 mb-2">
                    <x-splade-group name="day" id="days" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;" label="Days" >
                        <x-splade-checkbox   name="day[]" class="check-day" value="sunday" label="Sunday" {{--:checked="in_array('sunday', old('day', explode('|', $doctor->days)))"--}} />
                        <x-splade-checkbox name="day[]" class="check-day" value="monday" label="Monday" {{--:checked="in_array('sunday', old('day', explode('|', $doctor->days)))"--}}/>
                        <x-splade-checkbox name="day[]" class="check-day" value="tuesday" label="Tuesday" {{--:checked="in_array('sunday', old('day', explode('|', $doctor->days)))"--}}/>
                        <x-splade-checkbox name="day[]" class="check-day" value="wednesday" label="Wednesday" {{--:checked="in_array('sunday', old('day', explode('|', $doctor->days)))"--}}/>
                        <x-splade-checkbox name="day[]" class="check-day" value="thursday" label="Thursday" {{--:checked="in_array('sunday', old('day', explode('|', $doctor->days)))"--}}/>
                        <x-splade-checkbox name="day[]" class="check-day" value="friday" label="Friday" {{--:checked="in_array('sunday', old('day', explode('|', $doctor->days)))"--}}/>
                        <x-splade-checkbox name="day[]" class="check-day" value="saturday" label="Saturday" {{--:checked="in_array('sunday', old('day', explode('|', $doctor->days)))"--}}/>
                    </x-splade-group>
                </div>
                <div class="group-check mt-2 mb-2" id="sun_check">
                    <x-splade-group name="sun_hour" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;" label="Sunday Hours">
                            @foreach ($work_hours as $hour)
                                <x-splade-checkbox name="sun_hour[]" :show-errors="false" value="{{ $hour }}" label="{{ $hour }}" />
                            @endforeach
                    </x-splade-group>
                </div>
                <div class="group-check mt-2 mb-2" id="mon_check">
                    <x-splade-group name="mon_hour" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;" label="Monday Hours">
                        @foreach ($work_hours as $hour)
                            <x-splade-checkbox name="mon_hour[]" :show-errors="false" value="{{ $hour }}" label="{{ $hour }}" />
                        @endforeach
                    </x-splade-group>
                </div>
                <div class="group-check mt-2 mb-2" id="tue_check">
                    <x-splade-group name="tue_hour" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;" label="Tuesday Hours">
                        @foreach ($work_hours as $hour)
                            <x-splade-checkbox name="tue_hour[]" :show-errors="false" value="{{ $hour }}" label="{{ $hour }}" />
                        @endforeach
                    </x-splade-group>
                </div>
                <div class="group-check mt-2 mb-2" id="wed_check">
                    <x-splade-group name="wed_hour" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;" label="Wednesday Hours">
                        @foreach ($work_hours as $hour)
                            <x-splade-checkbox name="wed_hour[]" :show-errors="false" value="{{ $hour }}" label="{{ $hour }}" />
                        @endforeach
                    </x-splade-group>
                </div>
                <div class="group-check mt-2 mb-2" id="thu_check">
                    <x-splade-group name="thu_hour" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;" label="Thursday Hours">
                        @foreach ($work_hours as $hour)
                            <x-splade-checkbox name="thu_hour[]" :show-errors="false" value="{{ $hour }}" label="{{ $hour }}" />
                        @endforeach
                    </x-splade-group>
                </div>
                <div class="group-check mt-2 mb-2" id="fri_check">
                    <x-splade-group name="fri_hour" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;" label="Friday Hours">
                        @foreach ($work_hours as $hour)
                            <x-splade-checkbox name="fri_hour[]" :show-errors="false" value="{{ $hour }}" label="{{ $hour }}" />
                        @endforeach
                    </x-splade-group>
                </div>
                <div class="group-check mt-2 mb-2" id="sat_check">
                    <x-splade-group name="sat_hour" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;" label="Saturday Hours">
                        @foreach ($work_hours as $hour)
                            <x-splade-checkbox name="sat_hour[]" :show-errors="false" value="{{ $hour }}" label="{{ $hour }}" />
                        @endforeach
                    </x-splade-group>
                </div>
                <div class="row-group">
                    <x-splade-input type="password" class="input" name="password" label="New Passowrd" />
                    <x-splade-input type="password" class="input" name="password_confirmation" label="Confirm Password" />
                </div>
                <x-splade-submit class="mt-4" style="width:100%;" label="Edit" confirm/>
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
