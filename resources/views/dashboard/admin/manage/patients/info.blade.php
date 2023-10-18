<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">Patient info</div>
        @if ($info->type == 'out_patient')
        <x-splade-toggle>
                <div class="toggle" >
                    <ul>
                        <li  @click.prevent="setToggle(false)">Out Patient</li>
                    </ul>
                </div>
                <x-splade-transition show="!toggled">
                    <x-splade-form :default="$info" method="POST" autocomplete="off">
                        <div class="divider-title">Patient Data</div>
                        <div class="form-group">
                            <x-splade-input disabled class="input" label="Name" name="name" value="{{ old('name') }}"/>
                            <x-splade-input disabled class="input" label="Phone" name="phone" value="{{ old('phone') }}"/>
                        </div>
                        <div class="form-group">
                            <x-splade-input disabled class="input" label="Gender" name="gender" value="{{ old('gender') }}"/>
                            <x-splade-input disabled class="input" label="Age" name="age" value="{{ old('age') }}"/>
                        </div>
                        <div class="form-group">
                            <x-splade-input disabled class="input" label="address" name="address" value="{{ old('address') }}"/>
                            <x-splade-input disabled class="input" label="National ID" name="national_id" value="{{ old('national_id') }}"/>
                        </div>

                    </x-splade-form>
                </x-splade-transition>
            </x-splade-toggle>
            @else
            <x-splade-toggle>
                <div class="toggle" >
                    <ul>
                        <li  @click.prevent="setToggle(false)">In Patient</li>
                        <li  @click.prevent="setToggle(true)">Form</li>
                    </ul>
                </div>
                <x-splade-transition show="!toggled">
                    <x-splade-form :default="$info" method="POST" autocomplete="off">
                        <div class="divider-title">Patient data</div>
                        <div class="form-group">
                            <x-splade-input disabled class="input" label="Name" name="name"  value="{{ old('name') }}"/>
                            <x-splade-input disabled class="input" label="Phone" name="phone" value="{{ old('phone') }}"/>
                        </div>
                        <div class="form-group">
                            <x-splade-input disabled class="input" label="Address" name="address" value="{{ old('phone') }}"/>
                            <x-splade-select class="input" label="Gender" :options="['male' => 'Male', 'female'=>'Female']" choices name="gender" value="{{ old('gender') }}"/>
                                <x-splade-input disabled class="input" label="age" name="age" value="{{ old('age') }}"/>
                        </div>
                        <div class="form-group">
                            <x-splade-input disabled class="input" label="National ID" name="national_id" value="{{ old('national_id') }}"/>
                            <x-splade-input disabled class="input" label="Admission time" name="admission_time" time value="{{ old('admission_time') }}"/>
                            <x-splade-input disabled class="input" label="Admission date" name="admission_date" date value="{{ old('admission_date') }}"/>
                        </div>
                        <div class="form-group">
                            <x-splade-input disabled class="input" label="diagnosis" name="diagnosis" value="{{ old('diagnosis') }}"/>
                            <x-splade-input disabled class="input" label="Surgical procedure" name="surgical_procedure" value="{{ old('surgical_procedure') }}"/>
                        </div>
                        <div class="form-group">
                            <x-splade-input disabled class="input" label="Insurance" name="insurance" value="{{ old('insurance') }}"/>
                            <x-splade-input disabled class="input" label="Room Number" name="room_number" value="{{ old('room_number') }}"/>
                        </div>
                        <div class="divider-title">Doctor data</div>
                        <div class="form-group">
                            <x-splade-input disabled class="input" label="Physician"  name="physician" value="{{ old('physician') }}"/>
                            <x-splade-input disabled class="input" label="Physician Code"  name="physician_code" value="{{ old('physician_code') }}"/>
                        </div>
                        <div class="divider-title">Data of the patient's next of kin:</div>
                        <div class="form-group">
                            <x-splade-input disabled class="input" label="Name" name="relative_name"  value="{{ old('relative_name') }}"/>
                            <x-splade-input disabled class="input" label="Degree" name="degree" value="{{ old('degree') }}"/>
                        </div>
                        <div class="form-group">
                            <x-splade-input disabled class="input" label="National ID" name="relative_national_id" value="{{ old('relative_national_id') }}"/>
                            <x-splade-input disabled class="input" label="Phone" name="relative_phone" value="{{ old('relative_phone') }}"/>
                            <x-splade-input disabled class="input" label="Another Phone" name="relative_another_phone" value="{{ old('relative_another_phone') }}"/>
                        </div>
                    </x-splade-form>
                </x-splade-transition>
                <x-splade-transition show="toggled">
                    <div class="patient_form">
                        <div class="title mb-4">Patient Form</div>
                        <iframe class="mt-4" src="{{asset($info->patient_form)}}" frameborder="0"></iframe>
                    </div>
                </x-splade-transition>
            </x-splade-toggle>
            @endif
    </x-admin.content>
</x-admin.layout>
