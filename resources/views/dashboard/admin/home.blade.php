<x-admin.layout>
    <x-admin.content class="bg">
        <div class="box">
            <div class="title">@lang('titles.overview')</div>
        </div>
        @php
            if(null !== Session::get('counts')) {
                $percentageChanges = Session::get('percentageChanges');
                $counts = Session::get('counts');
            }
            if(null !== Session::get('month')) {
                $month = Session::get('month');
            }
            if(null !== Session::get('doctors')) {
                $doctors = Session::get('doctors');
            }
            if(null !== Session::get('doctors_date')) {
                $doctors_date = Session::get('doctors_date');
            }
            if(null !== Session::get('receptionists')) {
                $receptionists = Session::get('receptionists');
            }
            if(null !== Session::get('receptionists_date')) {
                $receptionists_date = Session::get('receptionists_date');
            }
        @endphp
        <div class="overview admin">
            <div class="main-group">
                <div class="total">
                    <div class="header">
                        <div class="group">
                            <div class="title">@lang('titles.total')</div>
                        </div>
                        <div class="group">
                            <x-splade-form :action="route('admin.total_date')" method="POST" submit-on-change>
                                @if (Session::get('month'))
                                <x-splade-select :options="$months" name="month"  class="select" placeholder="{{$month}}"/>
                                @else
                                <x-splade-select :options="$months" name="month"  class="select" placeholdre="Date"/>
                                @endif
                            </x-splade-form>
                            <Link class="link" method="POST" href="{{route('admin.total_reset')}}">@lang('titles.reset')</Link>
                        </div>
                    </div>
                    <div class="wrapper">
                        @foreach($counts as $key => $count)
                            <div class="box swiper-slide">
                                <div class="group">
                                    <div class="icon">
                                        <svg version="1.0" xmlns="http://www.w3.org/2000/svg"  width="100.000000pt" height="100.000000pt" viewBox="0 0 100.000000 100.000000"  preserveAspectRatio="xMidYMid meet">  <g transform="translate(0.000000,100.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none"> <path d="M121 886 c-69 -35 -71 -41 -71 -203 0 -153 9 -194 53 -241 25 -27 88 -62 112 -62 12 0 15 -14 15 -75 0 -88 15 -131 59 -168 70 -59 162 -56 226 8 46 47 55 86 55 256 l0 147 29 31 c24 26 37 31 73 31 83 -1 108 -41 108 -178 l0 -100 -37 -7 c-101 -19 -134 -144 -57 -216 36 -34 145 -39 192 -9 41 25 66 81 57 126 -6 35 -57 94 -81 94 -11 0 -14 22 -14 115 0 128 -8 155 -60 198 -66 56 -162 53 -221 -6 -45 -44 -49 -64 -49 -215 0 -75 -5 -154 -10 -174 -14 -50 -52 -78 -105 -78 -37 0 -48 5 -74 35 -29 33 -31 41 -31 109 l0 73 38 11 c21 6 52 26 71 44 59 58 65 79 69 241 l4 147 -34 33 c-40 39 -112 66 -136 50 -21 -13 -28 -59 -11 -79 13 -16 60 -19 76 -3 7 7 15 5 27 -6 25 -25 23 -234 -4 -292 -48 -106 -198 -112 -260 -11 -17 29 -20 51 -20 164 0 105 3 134 15 144 12 10 18 10 29 1 8 -7 27 -11 43 -9 25 3 28 8 31 42 5 61 -29 71 -107 32z m604 -633 c-16 -38 -17 -54 -6 -83 13 -40 -7 -37 -27 3 -10 22 -10 32 2 62 8 19 20 35 27 35 7 0 8 -7 4 -17z m123 0 c31 -28 35 -56 11 -86 -25 -32 -61 -35 -89 -7 -28 28 -25 64 6 89 32 26 46 26 72 4z"/> </g> </svg>
                                    </div>
                                    <div class="column">
                                        <div class="title">
                                            @if(Session::get('locale') == 'en')
                                                {{$key}}
                                            @else
                                                {{\google_translate($key)}}
                                            @endif
                                        </div>
                                        <div class="number">{{$count}}</div>
                                    </div>
                                </div>
                                <div class="group">
                                    <div class="date">
                                        @lang('messages.compLastMonth')
                                    </div>
                                    <div class="analysis">
                                        @if (substr($percentageChanges[$key], 0, 1) == '-')
                                        <svg class="decrease" version="1.0" xmlns="http://www.w3.org/2000/svg"  width="40.000000pt" height="31.000000pt" viewBox="0 0 40.000000 31.000000"  preserveAspectRatio="xMidYMid meet">  <g transform="translate(0.000000,31.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none"> <path d="M56 226 c8 -14 35 -41 59 -61 l44 -35 30 32 30 33 51 -50 c27 -27 53 -46 56 -42 10 10 -90 107 -109 107 -9 0 -25 -13 -36 -29 l-21 -30 -52 50 c-55 53 -78 64 -52 25z"/> <path d="M351 167 c-1 -75 -13 -87 -88 -88 -80 -1 -40 -17 45 -18 l62 -1 -1 58 c-1 83 -17 125 -18 49z"/> </g> </svg>                                         <span class="precent decrease">
                                                {{$percentageChanges[$key]}}%
                                            </span>
                                                @else
                                            <svg clas version="1.0" xmlns="http://www.w3.org/2000/svg"  width="300.000000pt" height="193.000000pt" viewBox="0 0 300.000000 193.000000"  preserveAspectRatio="xMidYMid meet">  <g transform="translate(0.000000,193.000000) scale(0.050000,-0.050000)" fill="#000000" stroke="none"> <path d="M3508 3021 c-381 -14 -434 -30 -458 -142 -24 -109 -34 -108 856 -121 453 -6 826 -13 829 -15 26 -17 -12 -68 -90 -124 -187 -134 -514 -429 -978 -881 -463 -451 -473 -459 -513 -424 -22 20 -146 162 -275 316 -530 634 -505 635 -1203 -17 -739 -689 -1109 -1226 -790 -1146 186 47 927 717 1282 1159 193 240 175 243 411 -67 447 -588 554 -667 738 -543 245 164 1105 1061 1516 1582 29 36 40 -125 57 -849 14 -580 27 -834 43 -850 42 -42 173 3 205 71 44 92 71 919 50 1540 l-18 520 -660 2 c-363 1 -814 -4 -1002 -11z"/> </g> </svg>
                                            <span class="precent">
                                                {{$percentageChanges[$key]}}%
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="group">
                    <div class="doctors">
                        <div class="header">
                            <div class="group">
                                @if (isset($doctors_date))
                                    <div class="title">
                                        @if($doctors_date == $carbon->now()->format('Y-m-d'))
                                            @lang('onDuty')
                                        @else
                                            {{$carbon->parse($doctors_date)->format('l')}} @lang('titles.doctors')
                                        @endif
                                    </div>
                                @else
                                    <div class="title">@lang('titles.onDuty') @lang('titles.doctors')</div>
                                @endif
                            </div>
                            <div class="group">
                                <x-splade-form class="form" :action="route('admin.doctors_date')" method="POST" submit-on-change>
                                    @if (isset($doctors_date))
                                    <x-splade-input  name="date" placeholder="Date" placeholder="{{$doctors_date}} ({{$doctors_date == $carbon->now()->format('Y-m-d') ? 'Today' : $carbon->parse($doctors_date)->format('l') }})" date/>
                                    @else
                                    <x-splade-input  name="date" placeholder="Date" date/>
                                    @endif
                                </x-splade-form>
                                <Link class="link" method="POST" href="{{route('admin.doctors_reset')}}">@lang('titles.reset')</Link>
                            </div>
                        </div>
                        <div class="header mobile none">
                            <div class="group">
                                @if (isset($doctors_date))
                                    <div class="title">
                                        @if($doctors_date == $carbon->now()->format('Y-m-d'))
                                            @lang('onDuty')
                                        @else
                                            {{$carbon->parse($doctors_date)->format('l')}} @lang('titles.doctors')
                                        @endif
                                    </div>
                                @else
                                    <div class="title">@lang('titles.onDuty') @lang('titles.doctors')</div>
                                @endif
                            </div>
                            <div class="group">
                                <form class="form" action="{{route('admin.doctors_date')}}" method="POST">
                                    @csrf
                                    @if (isset($doctors_date))
                                    <input  type="date" name="date" placeholder="{{$doctors_date}} ({{$doctors_date == $carbon->now()->format('Y-m-d') ? 'Today' : $carbon->parse($doctors_date)->format('l') }})" >
                                    @else
                                    <input  type="date" name="date" placeholder="Date" >
                                    @endif
                                </form>
                                <Link class="link" method="POST" href="{{route('admin.doctors_reset')}}">@lang('titles.reset')</Link>
                            </div>
                        </div>
                        <div class="wrapper">
                            @if (count($doctors) > 0)
                                @foreach ($doctors as $doctor)
                                    <div class="box">
                                        <div class="group">
                                            <div class="img-box">
                                                <img src="{{asset('storage/' . $doctor->image)}}" alt="">
                                            </div>
                                            <div class="column">
                                                <div class="row">
                                                    <div class="fullname">{{$doctor->first_name}} {{$doctor->last_name}}</div>
                                                    <div class="username">(&commat;{{$doctor->name}})</div>
                                                </div>
                                                <div class="specialty">{{$doctor->specialty}}</div>
                                            </div>
                                        </div>
                                        <div class="hours">
                                            @if (isset($doctor->today_hours))
                                                @foreach ($doctor->today_hours as $hour)
                                                    <p>
                                                        @foreach (explode('-',$hour) as $hour)
                                                            {{$carbon->parse($carbon->now()->format('Y-m-d') . ' ' . $hour . ':00:00')->format('g:i A')}}
                                                        @endforeach
                                                    </p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                <p class="note text-red-500">@lang('messages.noData')</p>
                            @endif

                        </div>
                    </div>
                    <div class="receptionists">
                        <div class="header">
                            <div class="group">
                                @if (isset($receptionists_date))
                                    <div class="title">
                                        {{$receptionists_date}}
                                        @if($receptionists_date == $carbon->now()->format('Y-m-d'))
                                            @lang('titles.onDuty')
                                        @else
                                            {{ $carbon->parse($receptionists_date)->format('l') }} @lang('titles.receptionists')
                                        @endif
                                    </div>
                                @else
                                    <div class="title">@lang('titles.onDuty') @lang('titles.receptionists')</div>
                                @endif
                            </div>
                            <div class="group">
                                <x-splade-form class="form" :action="route('admin.receptionists_date')" method="POST" submit-on-change>
                                    @if (isset($receptionists_date))
                                    {{-- <x-splade-input  name="date" placeholder="Date" placeholder="{{$receptionists_date}} ({{$receptionists_date == $carbon->now()->format('Y-m-d') ? 'Today' : $carbon->parse($doctors_date)->format('l') }})" date/> --}}
                                    @else
                                    <x-splade-input  name="date" placeholder="Date" date/>
                                    @endif
                                </x-splade-form>
                                <Link class="link" method="POST" href="{{route('admin.receptionists_reset')}}">@lang('titles.reset')</Link>
                            </div>
                        </div>
                        <div class="header mobile none">
                            <div class="group">
                                @if (isset($receptionists_date))
                                    <div class="title">
                                        {{$receptionists_date}}
                                        @if($receptionists_date == $carbon->now()->format('Y-m-d'))
                                            @lang('titles.onDuty')
                                        @else
                                            {{ $carbon->parse($receptionists_date)->format('l') }} @lang('titles.receptionists')
                                        @endif
                                    </div>
                                @else
                                    <div class="title">@lang('titles.onDuty') @lang('titles.receptionists')</div>
                                @endif
                            </div>
                            <div class="group">
                                <form class="form" action="{{route('admin.receptionists_date')}}" method="POST">
                                    @csrf
                                    @if (isset($receptionists_date))
                                    <input  type="date" name="date" placeholder="{{$receptionists_date}} ({{$receptionists_date == $carbon->now()->format('Y-m-d') ? 'Today' : $carbon->parse($receptionists_date)->format('l') }})" >
                                    @else
                                    <input  type="date" name="date" placeholder="Date" >
                                    @endif
                                </form>
                                <Link class="link" method="POST" href="{{route('admin.receptionists_reset')}}">@lang('titles.reset')</Link>
                            </div>
                        </div>
                        <div class="wrapper">
                            @if (count($receptionists) > 0)
                                @foreach ($receptionists as $receptionist)
                                    <div class="box">
                                        <div class="group">
                                            <div class="img-box">
                                                <img src="{{asset('storage/' . $receptionist->image)}}" alt="">
                                            </div>
                                            <div class="column">
                                                <div class="row">
                                                    <div class="fullname">{{$receptionist->first_name}} {{$receptionist->last_name}}</div>
                                                    <div class="username">(&commat;{{$receptionist->name}})</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hours">
                                            @if (isset($receptionist->today_hours))
                                                @foreach ($receptionist->today_hours as $hour)
                                                    <p>
                                                        @foreach (explode('-',$hour) as $hour)
                                                            {{$carbon->parse($carbon->now()->format('Y-m-d') . ' ' . $hour . ':00:00')->format('g:i A')}}
                                                        @endforeach
                                                    </p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                <p class="note text-red-500">@lang('messages.noData')</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-splade-script>

            const doctorsHeader = document.querySelector('.doctors .header')
            const doctorsMobileHeader = document.querySelector('.doctors .header.mobile')
            if (window.matchMedia('(max-width: 768px)').matches) {
                doctorsHeader.classList.add('none')
                doctorsMobileHeader.classList.remove('none')
                doctorsMobileHeader.querySelector('input[type="date"]').onchange = () => {
                    doctorsMobileHeader.querySelector('form').submit()
                }
            }
            const receptionistsHeader = document.querySelector('.receptionists .header')
            const receptionistsMobileHeader = document.querySelector('.receptionists .header.mobile')
            if (window.matchMedia('(max-width: 768px)').matches) {
                receptionistsHeader.classList.add('none')
                receptionistsMobileHeader.classList.remove('none')
                receptionistsMobileHeader.querySelector('input[type="date"]').onchange = () => {
                    receptionistsMobileHeader.querySelector('form').submit()
                }
            }
            {{-- let swiper = new Swiper("#swiper", {
                loop: true,
                spaceBetween: 10,
                grabCursor: true,
                freeMode: true,
                speed: 10000,
                autoplay: {
                    delay: 1,
                    disableOnInteraction: false
                },
                breakpoints:{
                767: {
                    slidesPerView: 1,
                },
                991: {
                    slidesPerView: 2,
                },
                },
            }); --}}
        </x-splade-script>
        {{-- <x-splade-script>
            const gender = {!! $patientGender !!};
            console.log(gender)
            const ctx = document.getElementById('chart');
            const options = {
                responsive: true,
                legend: {
                    position: "right",
                },
            };
            const data = {
                labels: [
                    'male',
                    'female',
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: gender,
                    backgroundColor: [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)',
                    ],
                    hoverOffset: 4
                }]
            };
            new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options,
            });
        </x-splade-script> --}}
    </x-admin.content>
</x-admin.layout>

