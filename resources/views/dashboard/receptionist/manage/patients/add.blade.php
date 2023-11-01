<x-receptionist.layout>
    <x-receptionist.content class="bg">
        <div class="title">@lang('buttons.add') @lang('titles.patient')</div>
        <x-splade-toggle>
            <div class="toggle" >
                <ul>
                    <li  @click.prevent="setToggle(false)">@lang('titles.out') @lang('titles.patient')</li>
                    <li  @click.prevent="setToggle(true)">@lang('titles.in') @lang('titles.patient')</li>
                </ul>
            </div>
            <x-splade-transition show="!toggled">
                <x-splade-form :action="Route('patient.createOut',['route' => Route::currentRouteName()])"  method="POST" autocomplete="off">
                    <div class="divider-title">@lang('titles.patient') @lang('titles.data')</div>
                    <div class="form-group">
                        <div class="form-column">
                            <label for="name">@lang('labels.fullname')</label>
                            <x-splade-input class="input" name="name"/>
                        </div>
                        <div class="form-column">
                            <label for="name">@lang('labels.phone')</label>
                            <x-splade-input class="input" name="phone"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-column">
                            <label for="name">@lang('labels.gender')</label>
                            <x-splade-select class="input" :options="['male' => 'Male', 'female'=>'Female']" choices name="gender" value="{{ old('gender') }}"/>
                        </div>
                        <div class="form-column">
                            <label for="name">@lang('labels.age')</label>
                            <x-splade-input class="input"  name="age"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-column">
                            <label for="name">@lang('labels.address')</label>
                            <x-splade-input class="input" name="address"/>
                        </div>
                        <div class="form-column">
                            <label for="name">@lang('labels.national_id')</label>
                            <x-splade-input class="input"  name="national_id"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <x-splade-submit class="mt-4" confirm>
                            @lang('buttons.add') @lang('titles.al')@lang('titles.patient')
                        </x-splade-submit>
                    </div>
                </x-splade-form>
            </x-splade-transition>
            <x-splade-transition show="toggled">
                <x-splade-form :action="Route('patient.createIn',['route' => Route::currentRouteName()])"  method="POST" autocomplete="off">
                    <div class="divider-title">@lang('titles.patient') @lang('titles.data')</div>
                    <div class="form-group">
                        <div class="form-column">
                            <label for="name">@lang('labels.fullname')</label>
                            <x-splade-input class="input" name="name"/>
                        </div>
                        <div class="form-column">
                            <label for="name">@lang('labels.phone')</label>
                            <x-splade-input class="input" name="phone"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-column">
                            <label for="name">@lang('labels.address')</label>
                            <x-splade-input class="input"  name="address"/>
                        </div>
                        <div class="form-column">
                            <label for="name">@lang('labels.gender')</label>
                            <x-splade-select class="input" :options="['male' => 'Male', 'female'=>'Female']" choices name="gender" value="{{ old('gender') }}"/>
                        </div>
                        <div class="form-column">
                            <label for="name">@lang('labels.age')</label>
                            <x-splade-input class="input" name="age"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-column">
                            <label for="name">@lang('labels.national_id')</label>
                            <x-splade-input class="input"  name="national_id"/>
                        </div>
                        <div class="form-column">
                            <label for="name">@lang('labels.admission_time')</label>
                            <x-splade-input class="input" time  name="admission_time"/>
                        </div>
                        <div class="form-column">
                            <label for="name">@lang('labels.admission_date')</label>
                            <x-splade-input class="input"  date  name="admission_date"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-column">
                            <label for="name">@lang('labels.diagnosis')</label>
                            <x-splade-input class="input"  name="diagnosis"/>
                        </div>
                        <div class="form-column">
                            <label for="name">@lang('labels.surgical_procedure')</label>
                            <x-splade-input class="input"  name="surgical_procedure"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-column">
                            <label for="name">@lang('labels.insurance')</label>
                            <x-splade-input class="input"  name="insurance"/>
                        </div>
                        <div class="form-column">
                            <label for="name">@lang('labels.room_number')</label>
                            <x-splade-input class="input"  name="room_number"/>
                        </div>
                    </div>
                    <div class="divider-title">@lang('titles.doctor') @lang('titles.data')</div>
                    <div class="form-group">
                        <div class="form-column">
                            <label for="name">@lang('labels.physician')</label>
                            <x-splade-input class="input"  name="physician"/>
                        </div>
                        <div class="form-column">
                            <label for="name">@lang('labels.physician_code')</label>
                            <x-splade-input class="input"  name="physician_code"/>
                        </div>
                    </div>
                    <div class="divider-title">@lang('messages.kin_data')</div>
                    <div class="form-group">
                        <div class="form-column">
                            <label for="name">@lang('labels.relative_name')</label>
                            <x-splade-input class="input"  name="relative_name"/>
                        </div>
                        <div class="form-column">
                            <label for="name">@lang('labels.degree')</label>
                            <x-splade-input class="input"  name="degree"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-column">
                            <label for="name">@lang('labels.relative_national_id')</label>
                            <x-splade-input class="input"  name="relative_national_id"/>
                        </div>
                        <div class="form-column">
                            <label for="name">@lang('labels.relative_phone')</label>
                            <x-splade-input class="input"  name="relative_phone"/>
                        </div>
                        <div class="form-column">
                            <label for="name">@lang('labels.relative_another_phone')</label>
                            <x-splade-input class="input"  name="relative_another_phone"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <x-splade-submit class="mt-4" confirm>
                            @lang('buttons.add') @lang('titles.al')@lang('titles.patient')
                        </x-splade-submit>
                    </div>
                </x-splade-form>
            </x-splade-transition>
        </x-splade-toggle>
    </x-receptionist.content>
</x-receptionist.layout>
