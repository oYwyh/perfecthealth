<x-doctor.layout>
    <x-doctor.content class="bg">

        <div class="title">@lang('titles.radiology') @lang('titles.prescription')</div>
        <div class="wrapper prescription">
                <div class="links">
                    <Link href="{{route('back')}}" method="POST" class="back">
                        @lang('buttons.back')
                    </Link>
                    <div class="next" id="saveBtn" data-redirect-url="{{ route('doctor.manage.appointments.medicine') }}">
                        @lang('buttons.next')
                    </div>
                </div>
                @php
                    $app = Session::get('appointment');
                @endphp
                @if(null != $app['medicine'])
                    <x-splade-form method="GET" id="redirect-form"  :action="route('doctor.manage.appointments.medicine')">
                        <x-splade-submit id="redirect-btn" />
                    </x-splade-form>
                @else
                    <x-splade-form method="GET" id="redirect-form"  :action="route('doctor.manage.appointments.save')">
                        <x-splade-submit id="redirect-btn" />
                    </x-splade-form>
                @endif
                <div class="parent" id="rad-parent">
                    <div class="presc" id="prescRad">
                            @php
                                $app = Session::get('appointment');
                                $radiology = explode(',',Session::get('appointment')['radiology']);
                            @endphp
                        <div class="presc-img" id="presc-img">
                        </div>
                        <div class="presc-box">
                            <div class="prescription" id="prescription">
                                <div class="header">
                                    <div class="logo">
                                        <img src="{{asset('images/logo/prescription.png')}}" alt="">
                                    </div>
                                    <div class="info">
                                        <div class="wrapper">
                                            <p class="name">الأســــــم : &nbsp;<span>{{$app['patient_fullname']}}</span></p>
                                            <p class="name">الســــــــن : &nbsp;<span>{{$app['patient_age']}}</span></p>
                                            <p class="diagnosis">التشخيص : &nbsp;<span>{{$app['diagnosis']}}</span></p>
                                            <p class="date">التاريـــــــخ : &nbsp;<span>{{Carbon\Carbon::now()->locale('ar')->format('Y/m/d')}}</span> </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="content">
                                    <div class="letter">R/</div>
                                    <div class="presc-txt" id="prescTxt">
                                        @foreach ($radiology as $item)
                                            - {{$item}}
                                            <br>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="footer">
                                    <div class="address">
                                        <p>
                                            ٦ اكتوبر - ٣٦١ المحور المركزي - امام التوحيد والنور بجوار المنوفي الكبابجي
                                            الدور الثاني شقة 4
                                        </p>
                                        <p>
                                            الجـــيــــزة - المـــــحور المــــركــزي - عقــــــار 9 مــــــول الداون تـــــــــاون - عيــــــــاده 315
                                        </p>
                                    </div>
                                    <div class="info">
                                        <p class="appartement">ت: ٠١٠٢٤٨٢٤٧١٦</p>
                                        <p class="website">www.waleedhaikal.com</p>
                                    </div>
                                </div>
                            </div>
                            <div class="editor" id="editor">
                                <x-splade-form id="editForm">
                                    <div class="column-group">
                                        <label for="editor">@lang('titles.al')@lang('titles.prescription') @lang('titles.editor')</label>
                                        <x-splade-textarea id="editTxt" name="editor" autosize/>
                                    </div>
                                    <x-splade-submit id="editBtn" style="width: 100%" label="edit" class="mt-2" >
                                        @lang('buttons.edit')
                                    </x-splade-submit>
                                    <div class="note mt-4 text-red-500">@lang('messages.prescNote')</div>
                                </x-splade-form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-doctor.content>
        <prescription type="Rad"></prescription>

</x-doctor.layout>
