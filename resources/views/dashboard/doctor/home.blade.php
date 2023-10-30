<?php
    if (null !== Session::get('labels')) {
        $first_labels = Session::get('labels');
        $first_data = Session::get('data');
        $labels = array();
        $data = array();
        foreach ($first_labels as $label) {
            $labels[] = $label;
        }
        foreach ($first_data as $datas) {
            $data[] = $datas;
        }
        $chart_date = Session::get('chart_date');
    }
?>

<x-doctor.layout>
    <x-doctor.content>
        <div class="box">
            <div class="title">@lang('titles.overview')</div>
        </div>
        <div class="overview doc">
            <div class="main-group">
                <div class="welcome">
                    <div class="title capital">
                        @lang('messages.welcome_back') {{Auth::user()->first_name}} {{Auth::user()->last_name}}
                    </div>
                    <div class="note">
                    </div>
                </div>
                <div class="row-group">
                    <div class="chart">
                        <div class="header">
                            @if (Session::get('locale') == 'en')
                                <div class="title_sp sm">
                                    @lang('titles.app_summ')
                                </div>
                                @else
                                <div class="title_sp ar sm">
                                    @lang('titles.app_summ')
                                </div>
                            @endif
                            <div class="group">
                                <x-splade-form class="form" action="{{route('doctor.chart_date')}}" method="POST" submit-on-change>
                                    @if (null !== Session::get('chart_date'))
                                        @if (Session::get('locale') == 'en')
                                            <x-splade-select class="fit capital" :options="['day' => 'Day', 'month' => 'Month' , 'year' => 'Year']" name="date" placeholder="{{Session::get('chart_date')}}" />
                                            @else
                                            <x-splade-select class="fit capital" :options="['day' => 'يومي', 'month' => 'شهري' , 'year' => 'سنوي']" name="date" placeholder="{{\google_translate(Session::get('chart_date'))}}" />
                                        @endif
                                        @else
                                        @if (Session::get('locale') == 'en')
                                            <x-splade-select class="fit capital" :options="['day' => 'Day', 'month' => 'Month' , 'year' => 'Year']" name="date" placeholder="Date" />
                                            @else
                                            <x-splade-select class="fit capital" :options="['day' => 'يومي', 'month' => 'شهري' , 'year' => 'سنوي']" name="date" placeholder="التاريخ" />
                                        @endif
                                    @endif
                                </x-splade-form>
                                <Link class="link" method="POST" href="{{route('doctor.chart_reset')}}">@lang('titles.reset')</Link>

                            </div>
                        </div>
                        <div class="chart-box">
                            <chart id="chart" label="Appointments" labels="{{ implode(',', $labels) }}" datas="{{ implode(',', $data) }}" type="Bar"/>
                        </div>
                    </div>
                    <div class="appointments">
                        <div class="header">
                            @if (Session::get('locale') == 'en')
                                <div class="title_sp">
                                    @lang('titles.al')@lang('titles.appointments')
                                </div>
                                @else
                                <div class="title_sp ar">
                                    @lang('titles.al')@lang('titles.appointments')
                                </div>
                            @endif
                            <div class="group">
                                <x-splade-form :action="route('doctor.manage.appointments.app_box_date')" method="POST" submit-on-change>
                                    @if (null !== Session::get('date'))
                                        <x-splade-input class="fit" name="date" placeholder="{{Session::get('date')}}" date />
                                        @else
                                        <x-splade-input class="fit" name="date" placeholder="Date" date />
                                    @endif
                                </x-splade-form>
                                <Link class="link" method="POST" href="{{route('doctor.manage.appointments.app_box_reset')}}">@lang('titles.reset')</Link>
                            </div>
                        </div>
                        <div class="column-group">
                            <?php
                                if(null !== Session::get('appointments')) {
                                    $appointments = Session::get('appointments');
                                    $appointments_patients_dictionary = Session::get('appointments_patients_dictionary');
                                    $appointments_patients = Session::get('appointments_patients');
                                }
                            ?>
                            @if (isset($appointments[0]))
                                @foreach ($appointments as $app)
                                    <?php
                                        $patientId = $appointments_patients_dictionary[$app->id];
                                    ?>
                                    @foreach ($appointments_patients as $patient)
                                        @if ($patient->id == $patientId)
                                            <div class="box">
                                                <div class="group">
                                                    <div class="img-box">
                                                        @if ($patient->image)
                                                        @if (Str::startsWith($patient->image, ['http://', 'https://']))
                                                            <img src="{{$patient->image}}" alt="">
                                                        @else
                                                            @if (Storage::exists('public/'. $patient->image))
                                                                <img src="{{asset('storage/'.$patient->image)}}" alt="">
                                                            @else
                                                                <img src="{{asset('storage/'.'images/profiles/default.jpg')}}" alt="">
                                                            @endif
                                                        @endif
                                                        @else
                                                            <img src="{{asset('storage/'.'images/doc.jpg')}}" alt="">
                                                        @endif
                                                    </div>
                                                    <div class="column">
                                                        <div class="full-name">
                                                            {{$patient->first_name}} {{$patient->last_name}}
                                                        </div>
                                                        <div class="name">
                                                            {{$patient->name}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="date">
                                                    @if ($app->status == 'seen')
                                                        <Link href="{{route('doctor.manage.appointments.results',['patient_id' => $patient->id, 'app_id'=>$app->id])}}" class="note font-normal italic ">Finished</Link>
                                                    @else
                                                        {{ date('g:i A', strtotime('2023-09-11T11:00:00')) }}
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach
                                @else
                                <div class="note text-red-500">
                                    @lang('messages.noData')
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="recent">
                    <div class="header">
                        @if (Session::get('locale') == 'en')
                            <div class="title_sp">
                                @lang('titles.recent') @lang('titles.patients')
                            </div>
                            @else
                            <div class="title_sp ar">
                                @lang('titles.recent') @lang('titles.patients')
                            </div>
                        @endif
                    </div>
                    <table class="table">
                        <tr>
                            <th>@lang('labels.fullname')</th>
                            <th>@lang('labels.age')</th>
                            <th class="md-gone">@lang('labels.gender')</th>
                            <th class="md-gone">@lang('labels.blood')</th>
                            <th>@lang('labels.settings')</th>
                        </tr>
                        @foreach ($relative_patients as $patient)
                            <tr>
                                <td class="capital">{{$patient->name ? $patient->first_name . ' ' . $patient->last_name : 'Unkown'}}</td>
                                <td class="capital">{{$patient->date_of_brith ? $carbon->now()->diff($patient->date_of_brith)->y : 'Unkown'}}</td>
                                <td class="capital">{{$patient->gender ? $patient->gender : 'Unkown'}}</td>
                                <td class="capital" class="md-gone">{{$patient->blood ? $patient->blood : 'Unkown'}}</td>
                                <td class="capital"><Link modal href="{{route('doctor.manage.patient.info',['id' => $patient->id])}}">More</Link></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="main-group">
                <div class="welcome sm">
                    <div class="title capital">
                        @lang('messages.welcome_back') {{Auth::user()->first_name}} {{Auth::user()->last_name}}
                    </div>
                    <div class="note">
                    </div>
                </div>
                <div class="profile">
                    <div class="info">
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
                                <img src="{{asset('storage/'.'images/profiles/default.jpeg')}}" alt="">
                            @endif
                        </div>
                        <div class="name">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</div>
                        @if (Session::get('locale') == 'en')
                        <div class="specialty capital">{{implode(' ',explode('_',Auth::user()->specialty))}}</div>
                        @else
                        <div class="specialty capital">{{\google_translate(implode(' ',explode('_',Auth::user()->specialty)))}}</div>
                        @endif
                    </div>
                    <div class="divider"></div>
                    <div class="summary">
                        @if (Session::get('locale') == 'en')
                            <div class="title_sp sm">
                                @lang('titles.summary')
                            </div>
                            @else
                            <div class="title_sp ar sm">
                                @lang('titles.summary')
                            </div>
                        @endif
                        <div class="group">
                            <div class="box">
                                <div class="total">{{count($total_appointments)}}</div>
                                <div class="title">@lang('titles.al')@lang('titles.appointments')</div>
                            </div>
                            <div class="box">
                                <div class="total">{{count($total_appointments)}}</div>
                                <div class="title">@lang('titles.al')@lang('titles.appointments')</div>
                            </div>
                        </div>
                        <div class="group">
                            <div class="box">
                                <div class="total">{{count($total_appointments)}}</div>
                                <div class="title">@lang('titles.al')@lang('titles.appointments')</div>
                            </div>
                            <div class="box">
                                <div class="total">{{count($total_appointments)}}</div>
                                <div class="title">@lang('titles.al')@lang('titles.appointments')</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="income">
                    <div class="header">
                        <div class="title">@lang('titles.income')</div>
                        <x-splade-form :action="route('doctor.manage.appointments.app_box_date')" method="POST" submit-on-change>
                            <x-splade-input class="fit" name="date" placeholder="Date" date />
                        </x-splade-form>
                    </div>
                    <div class="box">
                        <p class="note text-red-500">
                            @lang('messages.soon')
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </x-doctor.content>
</x-doctor.layout>
