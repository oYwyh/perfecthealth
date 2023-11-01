<x-user.layout>
    <x-user.content>
        <div class="box">
            <div class="title">@lang('titles.overview')</div>
        </div>
        <div class="overview user">
            <div class="profile-box">
                <div class="main">
                    <div class="row-box">
                        <div class="img-box">
                            @if (Auth::user()->image)
                            @if (Str::startsWith(Auth::user()->image, ['http://', 'https://']))
                                <img src="{{Auth::user()->image}}" alt="">
                            @else
                                @if (Storage::exists('public/'. Auth::user()->image))
                                    <img src="{{asset('storage/'.Auth::user()->image)}}" alt="">
                                @else
                                    <img src="{{asset('storage/'.'images/profiles/default.jpg')}}" alt="">
                                @endif
                            @endif
                            @else
                                <img src="{{asset('storage/'. 'images/profiles/default.jpg')}}" alt="">
                            @endif
                        </div>
                        <div class="column">
                            <p class="name">
                                @if($user->name)
                                    {{$user->name}}
                                    @else
                                    @lang('labels.unknown')
                                @endif
                            </p>
                            <p class="age">
                                @if($user->date_of_brith)
                                    {{\getAge($user->date_of_brith)}} @lang('labels.years')
                                    @else
                                    @lang('labels.unknown')
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row-box">
                        <div class="column">
                            <div class="label">@lang('labels.height')</div>
                            <div class="txt">
                                @if($user->height)
                                    {{$user->height}}
                                    @else
                                    @lang('labels.unknown')
                                @endif
                            </div>
                        </div>
                        <div class="column">
                            <div class="label">@lang('labels.weight')</div>
                            <div class="txt">
                                @if($user->weight)
                                    {{$user->weight}}
                                    @else
                                    @lang('labels.unknown')
                                @endif
                            </div>
                        </div>
                        <div class="column">
                            <div class="label">@lang('labels.blood') @lang('labels.type')</div>
                            <div class="txt">
                                @if($user->blood)
                                    {{$user->blood}}
                                    @else
                                    @lang('labels.unknown')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nor-row">
                    <div class="nor-column">
                        <p class="label">@lang('labels.phone')</p>
                        <p class="txt">
                            @if($user->phone)
                                {{$user->phone}}
                                @else
                                @lang('labels.unknown')
                            @endif
                        </p>
                    </div>
                    <div class="nor-column">
                        <p class="label">@lang('labels.email')</p>
                        <p class="txt">
                            @if($user->email)
                                {{$user->email}}
                                @else
                                @lang('labels.unknown')
                            @endif
                        </p>
                    </div>
                    <div class="nor-column">
                        <p class="label">@lang('labels.national_id')</p>
                        <p class="txt">
                            @if($user->national_id)
                                {{$user->national_id}}
                                @else
                                @lang('labels.unknown')
                            @endif
                        </p>
                    </div>
                    {{-- <div class="nor-column">
                        <p class="label">@lang('labels.patient') @lang('labels.number')</p>
                        <p class="txt">
                            @if($user->id)
                                {{$user->id}}
                                @else
                                @lang('labels.unknown')
                            @endif
                        </p>
                    </div> --}}
                    <div class="nor-column">
                        <p class="label">@lang('labels.medical') @lang('labels.condition')</p>
                        <p class="txt">
                            @if($user->disease)
                                {{$user->disease}}
                                @else
                                @lang('labels.unknown')
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="horizontal">
                <div class="clender-box">
                    <clender id="clender" doctor="{{implode(',',$doctor)}}" date="{{implode(',',$date)}}"/>
                </div>
                <div class="doctors-box">
                    @if (Session::get('locale') == 'en')
                        <div class="title">@lang('titles.our') @lang('titles.doctors')</div>
                    @else
                        <div class="title">@lang('titles.our_doctors')</div>
                    @endif
                    <div class="wrapper">
                        @foreach ($doctors as $doctor)
                        <div class="doctor-box">
                            <div class="group">
                                <div class="img-box">
                                    @if ($doctor->image)
                                        <img src="{{asset('storage/'. $doctor->image)}}" alt="">
                                        @else
                                        <img src="{{asset('images/profile/default.jpeg')}}" alt="">
                                    @endif
                                </div>
                                <div class="column">
                                    <div class="name">
                                        @php
                                            $full_name = $doctor->first_name . ' ' . $doctor->last_name
                                        @endphp
                                            @lang('titles.dr') {{$full_name}}
                                    </div>
                                    <div class="special">
                                        @php
                                            $specialty = implode(' ',explode('_',$doctor->specialty));
                                        @endphp
                                        @if (Session::get('locale') == 'en')
                                            {{$specialty}}
                                        @else
                                            {{\google_translate($specialty)}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="book">
                                <Link class="primary-btn" style="width: 100% !important; display: block;" href="{{route('user.manage.appointments.externalBook', ['id'=> $doctor->id])}}">@lang('buttons.book')</Link>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </x-user.content>
    <x-splade-script>

    </x-splade-script>
</x-user.layout>
