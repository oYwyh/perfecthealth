<x-receptionist.layout>
    <x-receptionist.content class="bg">
        <div class="title">@lang('titles.patient') @lang('titles.info')</div>
        @php
            if (null != Session::get('patient_id')) {
                $info = App\Models\Patient::find(Session::get('patient_id'));
            }
        @endphp
        @if ($info->type == 'out_patient')
            <x-splade-toggle>
                    <div class="toggle" >
                        <ul>
                            <li  @click.prevent="setToggle(false)">@lang('titles.out') @lang('titles.patient')</li>
                        </ul>
                    </div>
                    <x-splade-transition show="!toggled">
                        <x-splade-form :default="$info" method="POST" autocomplete="off">
                            <div class="divider-title">@lang('titles.patient') @lang('titles.data')</div>
                            <div class="form-group">
                                <div class="form-column">
                                    <label for="name">@lang('labels.fullname')</label>
                                    <x-splade-input disabled class="input" name="name"/>
                                </div>
                                <div class="form-column">
                                    <label for="name">@lang('labels.phone')</label>
                                    <x-splade-input disabled class="input" name="phone"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-column">
                                    <label for="name">@lang('labels.gender')</label>
                                    <x-splade-select disabled class="input" :options="['male' => 'Male', 'female'=>'Female']" choices name="gender" value="{{ old('gender') }}"/>
                                </div>
                                <div class="form-column">
                                    <label for="name">@lang('labels.age')</label>
                                    <x-splade-input disabled class="input"  name="age"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-column">
                                    <label for="name">@lang('labels.address')</label>
                                    <x-splade-input disabled class="input" name="address"/>
                                </div>
                                <div class="form-column">
                                    <label for="name">@lang('labels.national_id')</label>
                                    <x-splade-input disabled class="input"  name="national_id"/>
                                </div>
                            </div>
                        </x-splade-form>
                    </x-splade-transition>
                </x-splade-toggle>
            @else
                <x-splade-toggle>
                    <div class="toggle" >
                        <ul>
                            <li  @click.prevent="setToggle(false)">@lang('titles.in') @lang('titles.patient')</li>
                            <li  @click.prevent="setToggle(true)">@lang('titles.form')</li>
                        </ul>
                    </div>
                    <x-splade-transition show="!toggled">
                        <x-splade-form :default="$info" method="POST" autocomplete="off">
                            <div class="divider-title">@lang('titles.patient') @lang('titles.data')</div>
                            <div class="form-group">
                                <div class="form-column">
                                    <label for="name">@lang('labels.fullname')</label>
                                    <x-splade-input disabled class="input" name="name"/>
                                </div>
                                <div class="form-column">
                                    <label for="name">@lang('labels.phone')</label>
                                    <x-splade-input disabled class="input" name="phone"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-column">
                                    <label for="name">@lang('labels.address')</label>
                                    <x-splade-input disabled class="input"  name="address"/>
                                </div>
                                <div class="form-column">
                                    <label for="name">@lang('labels.gender')</label>
                                    <x-splade-select disabled class="input" :options="['male' => 'Male', 'female'=>'Female']" choices name="gender" value="{{ old('gender') }}"/>
                                </div>
                                <div class="form-column">
                                    <label for="name">@lang('labels.age')</label>
                                    <x-splade-input disabled class="input" name="age"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-column">
                                    <label for="name">@lang('labels.national_id')</label>
                                    <x-splade-input disabled class="input"  name="national_id"/>
                                </div>
                                <div class="form-column">
                                    <label for="name">@lang('labels.admission_time')</label>
                                    <x-splade-input disabled class="input" time  name="admission_time"/>
                                </div>
                                <div class="form-column">
                                    <label for="name">@lang('labels.admission_date')</label>
                                    <x-splade-input disabled class="input"  date  name="admission_date"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-column">
                                    <label for="name">@lang('labels.diagnosis')</label>
                                    <x-splade-input disabled class="input"  name="diagnosis"/>
                                </div>
                                <div class="form-column">
                                    <label for="name">@lang('labels.surgical_procedure')</label>
                                    <x-splade-input disabled class="input"  name="surgical_procedure"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-column">
                                    <label for="name">@lang('labels.insurance')</label>
                                    <x-splade-input disabled class="input"  name="insurance"/>
                                </div>
                                <div class="form-column">
                                    <label for="name">@lang('labels.room_number')</label>
                                    <x-splade-input disabled class="input"  name="room_number"/>
                                </div>
                            </div>
                            <div class="divider-title">@lang('titles.doctor') @lang('titles.data')</div>
                            <div class="form-group">
                                <div class="form-column">
                                    <label for="name">@lang('labels.physician')</label>
                                    <x-splade-input disabled class="input"  name="physician"/>
                                </div>
                                <div class="form-column">
                                    <label for="name">@lang('labels.physician_code')</label>
                                    <x-splade-input disabled class="input"  name="physician_code"/>
                                </div>
                            </div>
                            <div class="divider-title">@lang('messages.kin_data')</div>
                            <div class="form-group">
                                <div class="form-column">
                                    <label for="name">@lang('labels.relative_name')</label>
                                    <x-splade-input disabled class="input"  name="relative_name"/>
                                </div>
                                <div class="form-column">
                                    <label for="name">@lang('labels.degree')</label>
                                    <x-splade-input disabled class="input"  name="degree"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-column">
                                    <label for="name">@lang('labels.relative_national_id')</label>
                                    <x-splade-input disabled class="input"  name="relative_national_id"/>
                                </div>
                                <div class="form-column">
                                    <label for="name">@lang('labels.relative_phone')</label>
                                    <x-splade-input disabled class="input"  name="relative_phone"/>
                                </div>
                                <div class="form-column">
                                    <label for="name">@lang('labels.relative_another_phone')</label>
                                    <x-splade-input disabled class="input"  name="relative_another_phone"/>
                                </div>
                            </div>
                        </x-splade-form>
                    </x-splade-transition>
                    <x-splade-transition show="toggled">
                        <div class="patient_form">
                            <div class="title mb-4">@lang('titles.al')@lang('titles.patient') @lang('titles.form')</div>
                            <iframe class="mt-4" src="{{asset($info->patient_form)}}" frameborder="0"></iframe>
                        </div>
                    </x-splade-transition>
                </x-splade-toggle>
            @endif
    </x-receptionist.content>
</x-receptionist.layout>
