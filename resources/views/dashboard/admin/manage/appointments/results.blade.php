<x-admin.layout>
    <x-admin.content class="bg">
        <div class="wrapper">
            <x-splade-toggle>
                <div class="title">
                    @lang('titles.resaults')
                </div>
                <div class="toggle">
                    <ul>
                        <li  @click.prevent="setToggle(false)">@lang('titles.patient')</li>
                        <li  @click.prevent="setToggle(true)">@lang('titles.diagnosis')</li>
                    </ul>
                </div>
                <x-splade-transition show="!toggled">
                    <div class="title">@lang('titles.patient')</div>
                    <x-splade-form :default="$patient">
                        <div class="row-group">
                            <div class="form-column">
                                <label for="first_name">@lang('labels.first_name')</label>
                                <x-splade-input name="first_name" class="input" disabled />
                            </div>
                            <div class="form-column">
                                <label for="last_name">@lang('labels.last_name')</label>
                                <x-splade-input name="last_name" class="input" disabled />
                            </div>
                            <div class="form-column">
                                <label for="phone">@lang('labels.phone')</label>
                                <x-splade-input name="phone" class="input" disabled/>
                            </div>
                        </div>
                        <div class="row-group">
                            <div class="form-column">
                                <label for="date_of_brith">@lang('labels.date_of_brith')</label>
                                <x-splade-input name="date_of_brith" class="input" disabled  />
                            </div>
                            <div class="form-column">
                                <label for="gebder">@lang('labels.gender')</label>
                                <x-splade-input name="gender" class="input" disabled />
                            </div>

                        </div>
                        <div class="row-group">
                            <div class="form-column">
                                <label for="Blood">@lang('labels.blood') @lang('labels.type')</label>
                                <x-splade-input name="blood" class="input" disabled  />
                            </div>
                            <div class="form-column">
                                <label for="chronic">@lang('labels.chronic') @lang('labels.disease')</label>
                                <x-splade-input name="disease" class="input" disabled  />
                            </div>

                        </div>
                        <div class="row-group">
                            <div class="form-column">
                                <label for="height">@lang('labels.height')</label>
                                <x-splade-input name="height" class="input" disabled />
                            </div>

                            <div class="form-column">
                                <label for="weight">@lang('labels.weight')</label>
                                <x-splade-input name="weight" class="input" disabled />
                            </div>

                        </div>
                        <div class="column-group">
                            <div class="label">@lang('labels.investigations')</div>
                            <div class="row">
                                @if (isset($patient->investigations))
                                    @foreach (explode(',',$patient->investigations) as $item)
                                    <div class="img-box">
                                        <img src="{{asset($item)}}" alt="">
                                    </div>
                                    @endforeach
                                @else
                                    <p class="note text-red-500">@lang('messages.noData')</p>
                                @endif
                            </div>
                        </div>
                        <div class="row-group mt-2">
                            <x-splade-input name="insurance" class="input" disabled label="Insurance company" />
                        </div>
                        <div class="column-group">
                            <div class="label">@lang('labels.insurance') @lang('labels.card')</div>
                            <div class="row">
                                @if (isset($patient->insurance_card))
                                    @foreach (explode(',',$patient->insurance_card) as $item)
                                    <div class="img-box">
                                        <img src="{{asset($item)}}" alt="">
                                    </div>
                                    @endforeach
                                @else
                                    <p class="note text-red-500">@lang('messages.noData')</p>
                                @endif
                            </div>
                        </div>
                    </x-splade-form>
                    <x-splade-script>
                        const img = document.querySelectorAll('.img-box img')
                        img.forEach(img => {
                            img.addEventListener('click',() => {
                                if (document.fullscreenElement) {
                                    document.exitFullscreen();
                                }else {
                                    img.requestFullscreen();
                                }
                            })
                        })
                    </x-splade-script>
                </x-splade-transition>
                <x-splade-transition show="toggled">
                    <div class="title" style="font-size: 30px; margin-top:1rem;">@lang('titles.doctor') @lang('titles.diagnosis')</div>
                    <x-splade-form :default="$appointment">
                        <div class="group">
                            <div class="form-column">
                                <label for="history">@lang('labels.history')</label>
                                <x-splade-textarea name="history" autosize  disabled/>
                            </div>

                        </div>

                        <div class="group">
                            <div class="form-column">
                                <label for="diagnosis">@lang('labels.diagnosis')</label>
                                <x-splade-input name="diagnosis" disabled />
                            </div>

                        </div>
                        <div class="group mt-2">
                            <div class="form-column">
                                <label for="laboratory">@lang('labels.laboratory') @lang('labels.request')</label>
                                <x-splade-input name="laboratory" disabled />
                            </div>

                        </div>
                        <div class="prescription-img">
                            <div class="form-column">
                                <label for="labratory">@lang('labels.laboratory') @lang('labels.prescription')</label>
                                @if ($appointment->lab_img != '')
                                <div class="presc-box">
                                    <img src="{{asset('storage/images/prescriptions/laboratory/'.$appointment->lab_img)}}" alt="">
                                    <div id="print" data-for="lab">@lang('buttons.print')</div>
                                </div>
                                @else
                                    <p class="note text-red-500">@lang('messages.noData')</p>
                                @endif
                            </div>
                        </div>
                        <div class="group mt-2">
                            <div class="form-column">
                                <label for="radiology">@lang('labels.radiology') @lang('labels.request')</label>
                                <x-splade-input name="radiology" disabled />
                            </div>

                        </div>
                        <div class="prescription-img">
                            <div class="form-column">
                                <label for="radiology">@lang('labels.radiology')</label>
                                @if ($appointment->rad_img != '')
                                <div class="presc-box">
                                    <img src="{{asset('storage/images/prescriptions/radiology/'.$appointment->rad_img)}}" alt="">
                                    <div id="print" data-for="rad">@lang('buttons.print')</div>
                                </div>
                                @else
                                    <p class="note text-red-500">@lang('messages.noData')</p>
                                @endif
                            </div>
                        </div>
                        <div class="group mt-2">
                            <div class="form-column">
                                <label for="medicine">@lang('labels.medicine') @lang('labels.request')</label>
                                <x-splade-input name="medicine" disabled />
                            </div>

                        </div>
                        <div class="prescription-img">
                            <div class="form-column">
                                <label for="medicine">@lang('titles.medicine') @lang('titles.prescription')</label>
                                @if ($appointment->med_img != '')
                                <div class="presc-box">
                                    <img src="{{asset('storage/images/prescriptions/medicine/'.$appointment->med_img)}}" alt="">
                                    <div id="print" data-for="med">@lang('buttons.print')</div>
                                </div>
                                @else
                                    <p class="note text-red-500">@lang('messages.noData')</p>
                                @endif
                            </div>

                        </div>
                    </x-splade-form>
                    <x-splade-script>
                        const img = document.querySelectorAll('.prescription-img img')
                        img.forEach(img => {
                            img.addEventListener('click',() => {
                                if (document.fullscreenElement) {
                                    document.exitFullscreen();
                                }else {
                                    img.requestFullscreen();
                                }
                            })
                        })
                        const print = document.querySelectorAll('#print')
                        print.forEach(btn => {
                            btn.addEventListener('click',(e) => {
                                function closePrint () {
                                    if ( printWindow ) {
                                        printWindow.close();
                                    }
                                }
                                var printWindow = window.open('', '_blank');
                                printWindow.document.write('<html><head><title>Print</title></head><body>');
                                printWindow.document.write('<img src="' + btn.previousElementSibling.src + '" style="width: 100%; height: 100%;" />');
                                printWindow.document.write('</body></html>');
                                printWindow.document.close();
                                printWindow.print();
                                printWindow.onbeforeunload = closePrint;
                                printWindow.onafterprint = closePrint;
                                printWindow.focus(); // Required for IE
                                printWindow.print();
                                if(printWindow.print()) {
                                    window.close();
                                }
                            })
                        })
                    </x-splade-script>
                </x-splade-transition>

            </x-splade-toggle>

        </div>
    </x-admin.content>
</x-admin.layout>
