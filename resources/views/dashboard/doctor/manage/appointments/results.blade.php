<x-doctor.layout>
    <x-doctor.content class="bg">
        <div class="wrapper results">
            <x-splade-toggle data="Patient, Diagnosis, Prescriptions">
                <div class="title">
                    @lang('titles.results')
                </div>
                <div class="toggle">
                    <ul>
                        <li @click.prevent="toggle('Patient')">@lang('titles.patient') @lang('titles.info')</li>
                        <li @click.prevent="toggle('Diagnosis')">@lang('titles.diagnosis')</li>
                        <li @click.prevent="toggle('Prescriptions')">@lang('titles.prescriptions')</li>
                    </ul>
                </div>
                <x-splade-transition show="!Patient">
                    <div class="title">@lang('titles.patient')</div>
                    <x-splade-form :default="$patient">
                        <div class="row-group">
                            <div class="form-column">
                                <label for="name">@lang('titles.patient') @lang('labels.fullname')</label>
                                <x-splade-input name="first_name" class="input" disabled  />
                            </div>
                            <div class="form-column">
                                <label for="name">@lang('titles.patient') @lang('labels.phone')</label>
                                <x-splade-input name="phone" class="input" disabled  />
                            </div>
                        </div>
                        <div class="row-group">
                            <div class="form-column">
                                <label for="name">@lang('titles.patient') @lang('labels.age')</label>
                                <x-splade-input name="age" class="input" disabled  />
                            </div>
                            <div class="form-column">
                                <label for="name">@lang('titles.patient') @lang('labels.gender')</label>
                                <x-splade-input name="gender" class="input" disabled />
                            </div>
                        </div>
                        <div class="row-group">
                            <div class="form-column">
                                <label for="name">@lang('titles.patient') @lang('labels.blood')</label>
                                <x-splade-input name="blood" class="input" disabled/>
                            </div>
                            <div class="form-column">
                                <label for="name">@lang('titles.patient') @lang('labels.disease')</label>
                                <x-splade-input name="disease" class="input" disabled />
                            </div>
                        </div>
                        <div class="row-group">
                            <div class="form-column">
                                <label for="name">@lang('titles.patient') @lang('labels.height')</label>
                                <x-splade-input name="height" class="input" disabled/>
                            </div>
                            <div class="form-column">
                                <label for="name">@lang('titles.patient') @lang('labels.weight')</label>
                                <x-splade-input name="weight" class="input" disabled/>
                            </div>
                        </div>
                        <div class="column-group">
                            <div class="label">@lang('titles.investigations')</div>
                            <div class="row">
                                @if (isset($patient->investigations))
                                    @foreach (explode(',',$patient->investigations) as $item)
                                        <div class="img-box">
                                            <img src="{{asset($item)}}" alt="">
                                        </div>
                                    @endforeach
                                    @else
                                    <p class="mt-4 note text-red-500">@lang('messages.noData')</p>
                                @endif
                            </div>
                        </div>
                        <div class="row-group mt-2">
                            <x-splade-input name="insurance" class="input" disabled label="Insurance company" />
                        </div>
                        <div class="column-group">
                            <div class="label">@lang('titles.insurance') @lang('titles.card')</div>
                            <div class="row">
                                @if (isset($patient->insurance_card))
                                @foreach (explode(',',$patient->insurance_card) as $item)
                                    <div class="img-box">
                                        <img src="{{asset($item)}}" alt="">
                                    </div>
                                @endforeach
                                @else
                                <p class="mt-4 note text-red-500">@lang('messages.noData')</p>
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
                <x-splade-transition show="Diagnosis">
                    <div class="title" style="font-size: 30px; margin-top:1rem;">@lang('titles.doctor') @lang('titles.diagnosis')</div>
                    <x-splade-form :default="$appointment">
                        <div class="form-group">
                            <div class="form-column">
                                <label for="name">@lang('labels.history')</label>
                                <x-splade-textarea disabled class="input" name="history" autosize  />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-column">
                                <label for="name">@lang('labels.diagnosis')</label>
                                <x-splade-input disabled class="input" name="diagnosis"  />
                            </div>
                            <div class="form-column">
                                <label for="name">@lang('labels.laboratory')</label>
                                <x-splade-input disabled  class="input" name="laboratory" id="lab" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-column">
                                <label for="name">@lang('labels.radiology')</label>
                                <x-splade-input disabled  class="input" name="radiology" id="rad" />
                            </div>
                            <div class="form-column">
                                <label for="name">@lang('labels.medicine')</label>
                                <x-splade-input disabled  class="input" name="medicine" id="med"  />
                            </div>
                        </div>
                    </x-splade-form>
                </x-splade-transition>
                <x-splade-transition show="Prescriptions">
                    <div class="title" style="margin-bottom: 2rem;">@lang('titles.prescriptions')</div>
                    <div class="prescriptions">
                        <div class="presc-box">
                            <div class="title">@lang('titles.laboratory') @lang('titles.prescription')</div>
                            @if ($appointment->lab_img != '')
                            <div class="presc-row">
                                <img src="{{asset('storage/'.$appointment->lab_img)}}" alt="">
                                <button id="print" data-for="rad">@lang('buttons.print')</button>
                            </div>
                            @else
                                <p class="note text-red-500">@lang('messages.noData')</p>
                            @endif
                        </div>
                        <div class="presc-box">
                            <div class="title">@lang('titles.radiology') @lang('titles.prescription')</div>
                            @if ($appointment->rad_img != '')
                            <div class="presc-row">
                                <img src="{{asset('storage/'.$appointment->rad_img)}}" alt="">
                                <button id="print" data-for="rad">@lang('buttons.print')</button>
                            </div>
                            @else
                                <p class="note text-red-500">@lang('messages.noData')</p>
                            @endif
                        </div>
                        <div class="presc-box">
                            <div class="title">@lang('titles.medicine') @lang('titles.prescription')</div>
                            @if ($appointment->med_img != '')
                            <div class="presc-row">
                                <img src="{{asset('storage/'.$appointment->med_img)}}" alt="">
                                <button id="print" data-for="med">@lang('buttons.print')</button>
                            </div>
                            @else
                                <p class="note text-red-500">@lang('messages.noData')</p>
                            @endif
                        </div>
                    </div>
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
    </x-doctor.content>
</x-doctor.layout>
