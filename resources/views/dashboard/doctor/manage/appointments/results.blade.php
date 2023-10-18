<x-doctor.layout>
    <x-doctor.content class="bg">
        <div class="wrapper">
            <x-splade-toggle>
                <div class="title">
                    Results
                </div>
                <div class="toggle">
                    <ul>
                        <li  @click.prevent="setToggle(false)">Patient</li>
                        <li  @click.prevent="setToggle(true)">Diagnosis</li>
                    </ul>
                </div>
                <x-splade-transition show="!toggled">
                    <div class="title">Patient</div>
                    <x-splade-form :default="$patient">
                        <div class="row-group">
                            <x-splade-input name="name" class="input" disabled label="Patient Name" />
                            <x-splade-input name="phone" class="input" disabled label="Patient Phone Number" />
                        </div>
                        <div class="row-group">
                            <x-splade-input name="age" class="input" disabled label="Patient Age" />
                            <x-splade-input name="gender" class="input" disabled label="Patient Gender" />
                        </div>
                        <div class="row-group">
                            <x-splade-input name="blood" class="input" disabled label="Patient Blood Type" />
                            <x-splade-input name="disease" class="input" disabled label="Patient Chronic Disease" />
                        </div>
                        <div class="row-group">
                            <x-splade-input name="height" class="input" disabled label="Patient Height" />
                            <x-splade-input name="weight" class="input" disabled label="Patient Weight" />
                        </div>
                        <div class="column-group">
                            <div class="label">Investigations</div>
                            <div class="row">
                                @if (isset($patient->investigations))
                                    @foreach (explode(',',$patient->investigations) as $item)
                                    <div class="img-box">
                                        <img src="{{asset($item)}}" alt="">
                                    </div>
                                    @endforeach
                                @else
                                    <p class="note text-red-500">No investigations found!</p>
                                @endif
                            </div>
                        </div>
                        <div class="row-group mt-2">
                            <x-splade-input name="insurance" class="input" disabled label="Insurance company" />
                        </div>
                        <div class="column-group">
                            <div class="label">Insurance Card</div>
                            <div class="row">
                                @if (isset($patient->insurance_card))
                                    @foreach (explode(',',$patient->insurance_card) as $item)
                                        <div class="img-box">
                                            <img src="{{asset($item)}}" alt="">
                                        </div>
                                    @endforeach
                                @else
                                    <p class="note text-red-500">No insurance found!</p>
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
                    <div class="title" style="font-size: 30px; margin-top:1rem;">Doctor Diagnosis</div>
                    <x-splade-form :default="$appointment">
                        <div class="group">
                            <x-splade-textarea name="history" autosize label="History" disabled/>
                        </div>
                        <div class="group">
                            <x-splade-input name="diagnosis" label="Diagnosis" disabled />
                        </div>
                        <div class="group mt-2">
                            <x-splade-input name="laboratory" label="Laboratory Request" disabled />
                        </div>
                        <div class="prescription-img">
                                <div class="label">Laboratory Prescription</div>
                                @if ($appointment->lab_img != '')
                                <div class="presc-box">
                                    <img src="{{asset('storage/images/prescriptions/laboratory/'.$appointment->lab_img)}}" alt="">
                                    <div id="print" data-for="lab">Print</div>
                                </div>
                                @else
                                    <p class="note text-red-500">No Data Here</p>
                                @endif
                        </div>
                        <div class="group mt-2">
                            <x-splade-input name="radiology" label="Radiology Request" disabled />
                        </div>
                        <div class="prescription-img">
                            <div class="label">Radiology Prescription</div>
                            @if ($appointment->rad_img != '')
                            <div class="presc-box">
                                <img src="{{asset('storage/images/prescriptions/radiology/'.$appointment->rad_img)}}" alt="">
                                <div id="print" data-for="rad">Print</div>
                            </div>
                            @else
                                <p class="note text-red-500">No Data Here</p>
                            @endif
                        </div>
                        <div class="group mt-2">
                            <x-splade-input name="medicine" label="Medicine Request" disabled />
                        </div>
                        <div class="prescription-img">
                            <div class="label">Medicine Prescription</div>
                            @if ($appointment->med_img != '')
                            <div class="presc-box">
                                <img src="{{asset('storage/images/prescriptions/medicine/'.$appointment->med_img)}}" alt="">
                                <div id="print" data-for="med">Print</div>
                            </div>
                            @else
                                <p class="note text-red-500">No Data Here</p>
                            @endif
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
    </x-doctor.content>

</x-doctor.layout>
