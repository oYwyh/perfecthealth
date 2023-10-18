<x-doctor.layout>
    <x-doctor.content class="bg">

        <div class="title">Prescriptions</div>
        <div class="wrapper prescription">
                <x-splade-toggle  data="laboratory,radiology,medicine">
                        <div class="toggle" id="toggle">
                            <ul >
                                <li id="lab-toggle" >Laboratory</li>
                                <li id="rad-toggle" >Radiology</li>
                                <li id="med-toggle" >Medicine</li>
                            </ul>
                        </div>
                    <div class="parent active" id="lab-parent">
                        <div class="presc" id="prescLab">
                            @php
                                $app = Session::get('appointment');
                                $laboratory = explode(',',Session::get('appointment')->laboratory);
                            @endphp
                            <div class="presc-img" id="presc-img">
                            </div>
                            <div class="row">
                                <div class="prescription" id="prescription">
                                    <div class="header">
                                        <div class="info">
                                            <p class="name">Patient: {{$app->patient}}</p>
                                            <p class="diagnosis">Diagnosis: {{$app->diagnosis}}</p>
                                            <p class="date">Date: {{$app->date}}</p>
                                        </div>
                                        <div class="logo">
                                            <img src="{{asset('images/logo/logo.png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="content">
                                        <div class="letter">R/</div>
                                        <div class="presc-txt" id="prescTxt">
                                            @foreach ($laboratory as $item)
                                                - {{$item}}
                                                <br>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <p class="address">
                                            ٦ اكتوبر - ٣٦١ المحور المركزي - امام التوحيد والنور بجوار المنوفي الكبابجي
                                        </p>
                                        <div class="box">
                                            <p class="appartement">الدور الثاني ت: ٠١٠٢٤٨٢٤٧١٦</p>
                                            <p class="website">www .waleedhaikal.com</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="editor" id="editor">
                                    <x-splade-form id="editForm">
                                        <x-splade-textarea id="editTxt" name="history" autosize label="Prescription Editor"/>
                                        <div class="note text-red-500">Note: hit enter to start new line</div>
                                        <x-splade-submit id="editBtn" style="width: 100%" label="edit" class="mt-2" />
                                    </x-splade-form>
                                </div>
                            </div>
                            <button id="saveBtn" class="mt-2">Save</button>
                        </div>
                    </div>
                    <div class="parent" id="rad-parent">
                        <div class="presc" id="prescRad">
                                @php
                                    $app = Session::get('appointment');
                                    $radiology = explode(',',Session::get('appointment')->radiology);
                                @endphp
                            <div class="presc-img" id="presc-img">
                            </div>
                            <div class="row">
                                <div class="prescription" id="prescription">
                                    <div class="header">
                                        <div class="info">
                                            <p class="name">Patient: {{$app->patient}}</p>
                                            <p class="diagnosis">Diagnosis: {{$app->diagnosis}}</p>
                                            <p class="date">Date: {{$app->date}}</p>
                                        </div>
                                        <div class="logo">
                                            <img src="{{asset('images/logo/logo.png')}}" alt="">
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
                                        <p class="address">
                                            ٦ اكتوبر - ٣٦١ المحور المركزي - امام التوحيد والنور بجوار المنوفي الكبابجي
                                        </p>
                                        <div class="box">
                                            <p class="appartement">الدور الثاني ت: ٠١٠٢٤٨٢٤٧١٦</p>
                                            <p class="website">www .waleedhaikal.com</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="editor" id="editor">
                                    <x-splade-form id="editForm">
                                        <x-splade-textarea id="editTxt" name="history" autosize label="Prescription Editor"/>
                                        <div class="note text-red-500">Note: hit enter to start new line</div>
                                        <x-splade-submit id="editBtn" style="width: 100%" label="edit" class="mt-2" />
                                    </x-splade-form>
                                </div>
                            </div>
                            <button id="saveBtn" class="mt-2">Save</button>
                        </div>
                    </div>
                    <div class="parent" id="med-parent">
                        <div class="presc" id="prescMed">
                                @php
                                    $app = Session::get('appointment');
                                    $medicine = explode(',',Session::get('appointment')->medicine);
                                @endphp
                            <div class="presc-img" id="presc-img">
                            </div>
                            <div class="row">
                                <div class="prescription" id="prescription">
                                    <div class="header">
                                        <div class="info">
                                            <p class="name">Patient: {{$app->patient}}</p>
                                            <p class="diagnosis">Diagnosis: {{$app->diagnosis}}</p>
                                            <p class="date">Date: {{$app->date}}</p>
                                        </div>
                                        <div class="logo">
                                            <img src="{{asset('images/logo/logo.png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="content">
                                        <div class="letter">R/</div>
                                        <div class="presc-txt" id="prescTxt">
                                            @foreach ($medicine as $item)
                                                - {{$item}}
                                                <br>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <p class="address">
                                            ٦ اكتوبر - ٣٦١ المحور المركزي - امام التوحيد والنور بجوار المنوفي الكبابجي
                                        </p>
                                        <div class="box">
                                            <p class="appartement">الدور الثاني ت: ٠١٠٢٤٨٢٤٧١٦</p>
                                            <p class="website">www .waleedhaikal.com</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="editor" id="editor">
                                    <x-splade-form id="editForm">
                                        <x-splade-textarea id="editTxt" name="history" autosize label="Prescription Editor"/>
                                        <div class="note text-red-500">Note: hit enter to start new line</div>
                                        <x-splade-submit id="editBtn" style="width: 100%" label="edit" class="mt-2" />
                                    </x-splade-form>
                                </div>
                            </div>
                            <button id="saveBtn" class="mt-2">Save</button>
                        </div>
                    </div>
                </x-splade-toggle>
            </div>
        </x-doctor.content>

        <x-splade-script>
                const editBtn = document.querySelectorAll('#editBtn');
                const saveBtn = document.querySelectorAll('#saveBtn');
                const prescImgLab = document.querySelector('#prescLab #presc-img');
                const prescImgRad = document.querySelector('#prescRad #presc-img');
                const prescImgMed = document.querySelector('#prescMed #presc-img');
                let textValue;
                editBtn.forEach(editBtn => {
                    editBtn.addEventListener('click',(e) => {
                        e.preventDefault();
                        let parent = editBtn.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement;
                        if(parent.id == 'prescLab') {
                            textValue = parent.querySelector('#editTxt').value.split('\n').map(line => `- ${line}`).join('<br>');
                            parent.querySelector('#prescTxt').innerHTML = `${textValue}`;
                        }else if(parent.id == 'prescRad') {
                            textValue = parent.querySelector('#editTxt').value.split('\n').map(line => `- ${line}`).join('<br>');
                            parent.querySelector('#prescTxt').innerHTML = `${textValue}`;
                        }else if(parent.id == 'prescMed') {
                            textValue = parent.querySelector('#editTxt').value.split('\n').map(line => `- ${line}`).join('<br>');
                            parent.querySelector('#prescTxt').innerHTML = `${textValue}`;
                        }
                    })
                })
                let newLab;
                let url;
                let prescImg;
                let popup;
                let parent;
                let prescription;
                saveBtn.forEach(saveBtn => {
                    saveBtn.addEventListener('click',(e) => {
                        parent = saveBtn.parentElement;
                        console.log(textValue)
                        prescription = parent.querySelector(`#prescription`)
                        if(textValue != undefined) {
                            newLab = textValue
                            .split('<br>')
                            .map(line => line.replace(/^- /, ''))
                            .join(',');
                        }
                        function createImg(prescriptionElement, imageUrl) {
                            prescImg = document.createElement('img');
                            prescImg.src = decodeURIComponent(imageUrl);
                            prescriptionElement.prepend(prescImg);
                        }
                        html2canvas(prescription).then(function(canvas) {
                            try {
                                var img = document.createElement('img');
                                img.src = canvas.toDataURL('image/jpeg', 0.9);
                                var xhr = new XMLHttpRequest();
                                xhr.open('POST', `/doctor/manage/appointments/save-image?newLab=${encodeURIComponent(newLab)}&section=${parent.id}`, true);
                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                                xhr.send('img=' + encodeURIComponent(img.src));
                                url = encodeURIComponent(img.src);
                                if(parent.id == 'prescLab') {
                                    createImg(prescImgLab, url);
                                }else if(parent.id == 'prescRad') {
                                    createImg(prescImgRad, url);
                                }else if(parent.id == 'prescMed') {
                                    createImg(prescImgMed, url);
                                }
                                newLab = undefined;
                            }
                            catch (err) {
                                console.log(err);
                            }

                        });
                        const printBtn = document.createElement('button');
                        printBtn.id = 'printBtn';
                        printBtn.innerHTML = 'Print';
                        if(parent.id == 'prescLab') {
                            prescImgLab.appendChild(printBtn);
                        }else if(parent.id == 'prescRad') {
                            prescImgRad.appendChild(printBtn);
                        }else if(parent.id == 'prescMed') {
                            prescImgMed.appendChild(printBtn);
                        }
                        printBtn.addEventListener('click',(e) => {
                            function closePrint () {
                                if ( printWindow ) {
                                    printWindow.close();
                                }
                            }
                            var printWindow = window.open('', '_blank');
                            printWindow.document.write('<html><head><title>Print</title></head><body>');
                            printWindow.document.write('<img src="' + prescImg.src + '" style="width: 100%; height: 100%;" />');
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
                        parent.querySelector('#prescription').style.width = '350px'
                        saveBtn.remove();
                        parent.querySelector('#editForm').remove();
                        parent.querySelector('#editor').remove();
                        parent.querySelector('#prescription').remove();
                    })

                })
        </x-splade-script>
        <x-splade-script>

            const toggle = document.querySelectorAll('#toggle ul li')
            let parent;
            let comment = document.createComment('');

            toggle.forEach(li => {
                li.addEventListener('click',() => {
                    parent = document.querySelectorAll('.parent')
                    if(li.id == 'lab-toggle'){
                        parent.forEach(parent => {
                            parent.classList.add('active')
                            if(parent.id != 'lab-parent') {
                                parent.classList.remove('active')
                            }
                        })
                    }else if(li.id == 'rad-toggle') {
                        parent.forEach(parent => {
                            parent.classList.add('active')
                            if(parent.id != 'rad-parent') {
                                parent.classList.remove('active')
                            }
                        })
                    }else {
                        parent.forEach(parent => {
                            parent.classList.add('active')
                            if(parent.id != 'med-parent') {
                                parent.classList.remove('active')
                            }
                        })
                    }
                })
            })
        </x-splade-script>
</x-doctor.layout>
