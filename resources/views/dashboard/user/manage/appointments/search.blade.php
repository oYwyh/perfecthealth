<x-user.layout>
    <x-user.content class="bg">
            <div class="title">@lang('buttons.book') @lang('titles.appointment')</div>
            @php
                if(null != Session::get('doctors')) {
                    $doctors = Session::get('doctors');
                }
            @endphp
                <x-splade-form :action="Route('user.manage.appointments.getDoctors')" method="POST" autocomplete="off">
                    <div class="form-group">
                        <x-splade-form style="width: 100%;" submit-on-change method="POST" :action="Route('user.manage.appointments.getSpecialty')">
                            @if (Session::get('specialty'))
                            <div class="form-column">
                                <label for="speicalty">@lang('labels.specialty')</label>
                                @if (Session::get('locale') == 'en')
                                    <x-splade-select class="input" name="specialty" label="" style="text-transform: capitalize;" choices>
                                        <option value="{{Session::get('specialty')}}" disabled selected style="text-transform: capitalize;">{{implode(' ',explode('_',Session::get('specialty')))}}</option>
                                        <option value="all" style="text-transform: capitalize;">@lang('labels.all') @lang('labels.specialties')</option>
                                        @foreach ($specialties as $specialty => $key)
                                            @php
                                                $key = $key
                                            @endphp
                                            <option value="{{$specialty}}" style="text-transform: capitalize;">{{$key}}</option>
                                        @endforeach
                                    </x-splade-select>
                                    @else
                                    <x-splade-select class="input" name="specialty" label="" style="text-transform: capitalize;" choices>
                                        <option value="{{Session::get('specialty')}}" disabled selected style="text-transform: capitalize;">{{\google_translate(implode(' ',explode('_',Session::get('specialty'))),'ar','en')}}</option>
                                        <option value="all" style="text-transform: capitalize;">@lang('labels.all') @lang('labels.specialties')</option>
                                        @foreach ($specialties_ar as $specialty => $key)
                                            @php
                                                $key = $key
                                            @endphp
                                            <option value="{{$specialty}}" style="text-transform: capitalize;">{{$key}}</option>
                                        @endforeach
                                    </x-splade-select>
                                @endif
                            </div>
                                @else
                                @if (Session::get('locale') == 'en')
                                <x-splade-select class="input" name="specialty" label="Speicalty" style="text-transform: capitalize;" choices>
                                    <option value="all" style="text-transform: capitalize;">@lang('labels.all') @lang('labels.specialties')</option>
                                    @foreach ($specialties as $specialty => $key)
                                        @php
                                            $key = $key
                                        @endphp
                                        <option value="{{$specialty}}" style="text-transform: capitalize;">{{$key}}</option>
                                    @endforeach
                                </x-splade-select>
                                @else
                                <x-splade-select class="input" name="specialty" label="Speicalty" style="text-transform: capitalize;" choices>
                                    <option value="all" style="text-transform: capitalize;">@lang('labels.all') @lang('labels.specialties')</option>
                                    @foreach ($specialties_ar as $specialty => $key)
                                        @php
                                            $key = $key
                                        @endphp
                                        <option value="{{$specialty}}" style="text-transform: capitalize;">{{$key}}</option>
                                    @endforeach
                                </x-splade-select>
                            @endif
                            @endif
                        </x-splade-form>
                        <div class="form-column">
                            <label for="doctor">@lang('labels.doctor')</label>
                            <x-splade-select class="input" name="doctor" choices>
                                <option value="all" selected style="text-transform: capitalize;">@lang('labels.all') @lang('labels.doctors')</option>
                                @foreach ($doctors as $doctor)
                                    @if (Session::get('locale') == 'en')
                                        <option value="{{$doctor->id}}" style="text-transform: capitalize;">{{ $doctor->first_name . ' ' . $doctor->last_name }}</option>
                                    @else
                                        <option value="{{$doctor->id}}" style="text-transform: capitalize;">{{\google_translate($doctor->first_name . ' ' . $doctor->last_name,'ar','en')}}</option>
                                    @endif
                                @endforeach
                            </x-splade-select>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <div class="form-column">
                            <label for="start_date">@lang('labels.from') @lang('labels.date')</label>
                            <x-splade-input class="input" name="start_date" value="{{$carbon->now()->format('Y-m-d')}}" date />
                        </div>

                        <div class="form-column">
                            <label for="end_date">@lang('labels.from') @lang('labels.date')</label>
                            <x-splade-input class="input" name="end_date" value="{{$carbon->now()->addDays(7)->format('Y-m-d')}}" date />
                        </div>

                    </div>
                    <div class="form-group mt-4">
                        {{-- <x-splade-group name="time" label="Appointment Time" style="display: flex; flex-direction: row; gap:1rem; align-item: center;">
                            <x-splade-radio name="time" value="morning" label="Morning { 10 AM - 1 PM }" />
                            <x-splade-radio name="time" value="afternoon" label="After Noon { 2PM - 5PM }" />
                            <x-splade-radio name="time" value="evening" label="Evening { 6 PM - 12 AM }" />
                        </x-splade-group> --}}
                    </div>
                    <x-splade-submit class="mt-4" style="width:100%;" label="Search Now" />
                </x-splade-form>
    </x-user.content>
</x-user.layout>
