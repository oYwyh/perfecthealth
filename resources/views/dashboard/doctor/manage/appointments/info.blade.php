<x-doctor.layout>
    <x-doctor.content class="bg">
        <div class="wrapper info">
            <x-splade-toggle>
                <div class="title">
                    Info
                </div>
                <div class="toggle mb-4">
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
                                    <p class="mt-4 note text-red-500">No investigations foundd</p>
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
                                <p class="mt-4 note text-red-500">No insurance_card foundd</p>
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
                    <div class="diagnosis">
                        <div class="title" style="font-size: 30px; margin-top:1rem;">Doctor Diagnosis</div>
                        <x-splade-form :action="route('doctor.manage.appointments.saveInfo')" :default="$app_id">
                            <div class="form-group">
                                <x-splade-input class="input" name="app_id" style="display: none;"/>
                            </div>
                            <div class="form-group">
                                <x-splade-textarea class="input" name="history" autosize label="History" />
                            </div>
                            <div class="form-group">
                                <x-splade-input class="input" name="diagnosis" label="Diagnosis" />
                                <x-splade-select class="input" name="laboratory" id="lab" :options="$lab" label="Laboratory Request" choices multiple />
                            </div>
                            <div class="form-group">
                                <x-splade-select class="input" name="radiology" id="rad" :options="$rad" label="Radiology Request" choices multiple />
                                <x-splade-select class="input" name="medicine" id="med" :options="$med" label="Medicine Request" choices multiple />
                            </div>
                            {{-- <div class="eyes">
                                <div class="wrapper">
                                    <div class="group1">
                                        <div class="iop">
                                            <div class="title">IOP</div>
                                            <table>
                                                <tr>
                                                    <th>Rt</th>
                                                    <th>Lt</th>
                                                </tr>
                                                <tr>
                                                    <td><x-splade-input class="input" name="iop_rt" /></td>
                                                    <td><x-splade-input class="input" name="iop_let" /></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="pubil">
                                            <div class="title">Pubil</div>
                                            <table>
                                                <tr>
                                                    <th>Rt</th>
                                                    <th>Lt</th>
                                                </tr>
                                                <tr>
                                                    <td><x-splade-input class="input" name="pubil_rt" /></td>
                                                    <td><x-splade-input class="input" name="pubil_let" /></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="group2">
                                        <div class="wrapper">
                                            <div class="header">
                                                <table>
                                                    <tr>
                                                        <th class="header" style="opacity: 0;">V/A</th>
                                                    </tr>
                                                </table>
                                                <table  class="first">
                                                    <tr>
                                                        <th class="visit one"><span>Visit 1</span><x-splade-input class="input" name="visit" date /></th>
                                                    </tr>
                                                </table>
                                                <table class="second">
                                                    <tr>
                                                        <th class="visit two"><span>Visit 2</span><x-splade-input class="input" name="visit" date /></th>
                                                    </tr>
                                                </table>
                                                <table  class="third">
                                                    <tr>
                                                        <th class="visit three"><span>Visit 3</span><x-splade-input class="input" name="visit" date /></th>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="column">
                                                <div class="row">
                                                    <table>
                                                        <tr class="header">
                                                            <th class="header">V/A</th>
                                                        </tr>
                                                    </table>
                                                    <table class="first">
                                                        <tr>
                                                            <th>Rt</th>
                                                            <th>Lt</th>
                                                        </tr>
                                                        <tr>
                                                            <td><x-splade-input class="input" name="iop_rt" /></td>
                                                            <td><x-splade-input class="input" name="iop_let" /></td>
                                                        </tr>
                                                    </table>
                                                    <table class="second">
                                                        <tr>
                                                            <th>Rt</th>
                                                            <th>Lt</th>
                                                        </tr>
                                                        <tr>
                                                            <td><x-splade-input class="input" name="iop_rt" /></td>
                                                            <td><x-splade-input class="input" name="iop_let" /></td>
                                                        </tr>
                                                    </table>
                                                    <table class="third">
                                                        <tr>
                                                            <th>Rt</th>
                                                            <th>Lt</th>
                                                        </tr>
                                                        <tr>
                                                            <td><x-splade-input class="input" name="iop_rt" /></td>
                                                            <td><x-splade-input class="input" name="iop_let" /></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="row">
                                                    <table>
                                                        <tr class="header">
                                                            <th class="header">Ref</th>
                                                        </tr>
                                                    </table>
                                                    <table class="first">
                                                        <tr>
                                                            <th>Rt</th>
                                                            <th>Lt</th>
                                                        </tr>
                                                        <tr>
                                                            <td><x-splade-input class="input" name="iop_rt" /></td>
                                                            <td><x-splade-input class="input" name="iop_let" /></td>
                                                        </tr>
                                                    </table>
                                                    <table class="second">
                                                        <tr>
                                                            <th>Rt</th>
                                                            <th>Lt</th>
                                                        </tr>
                                                        <tr>
                                                            <td><x-splade-input class="input" name="iop_rt" /></td>
                                                            <td><x-splade-input class="input" name="iop_let" /></td>
                                                        </tr>
                                                    </table>
                                                    <table class="third">
                                                        <tr>
                                                            <th>Rt</th>
                                                            <th>Lt</th>
                                                        </tr>
                                                        <tr>
                                                            <td><x-splade-input class="input" name="iop_rt" /></td>
                                                            <td><x-splade-input class="input" name="iop_let" /></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="row">
                                                    <table>
                                                        <tr class="header">
                                                            <th class="header long">BCVA</th>
                                                        </tr>
                                                    </table>
                                                    <table class="first">
                                                        <tr>
                                                            <th>Rt</th>
                                                            <th>Lt</th>
                                                        </tr>
                                                        <tr>
                                                            <td><x-splade-input class="input" name="iop_rt" /></td>
                                                            <td><x-splade-input class="input" name="iop_let" /></td>
                                                        </tr>
                                                    </table>
                                                    <table class="second">
                                                        <tr>
                                                            <th>Rt</th>
                                                            <th>Lt</th>
                                                        </tr>
                                                        <tr>
                                                            <td><x-splade-input class="input" name="iop_rt" /></td>
                                                            <td><x-splade-input class="input" name="iop_let" /></td>
                                                        </tr>
                                                    </table>
                                                    <table class="third">
                                                        <tr>
                                                            <th>Rt</th>
                                                            <th>Lt</th>
                                                        </tr>
                                                        <tr>
                                                            <td><x-splade-input class="input" name="iop_rt" /></td>
                                                            <td><x-splade-input class="input" name="iop_let" /></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="row">
                                                    <table>
                                                        <tr class="header">
                                                            <th class="header long">Contrast Test</th>
                                                        </tr>
                                                    </table>
                                                    <table  class="first">
                                                        <tr>
                                                            <th>Rt</th>
                                                            <th>Lt</th>
                                                        </tr>
                                                        <tr>
                                                            <td><x-splade-input class="input" name="iop_rt" /></td>
                                                            <td><x-splade-input class="input" name="iop_let" /></td>
                                                        </tr>
                                                    </table>
                                                    <table class="second">
                                                        <tr>
                                                            <th>Rt</th>
                                                            <th>Lt</th>
                                                        </tr>
                                                        <tr>
                                                            <td><x-splade-input class="input" name="iop_rt" /></td>
                                                            <td><x-splade-input class="input" name="iop_let" /></td>
                                                        </tr>
                                                    </table>
                                                    <table class="third">
                                                        <tr>
                                                            <th>Rt</th>
                                                            <th>Lt</th>
                                                        </tr>
                                                        <tr>
                                                            <td><x-splade-input class="input" name="iop_rt" /></td>
                                                            <td><x-splade-input class="input" name="iop_let" /></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="row">
                                                    <table>
                                                        <tr class="header">
                                                            <th class="header long">Color Test</th>
                                                        </tr>
                                                    </table>
                                                    <table class="first">
                                                        <tr>
                                                            <th>Rt</th>
                                                            <th>Lt</th>
                                                        </tr>
                                                        <tr>
                                                            <td><x-splade-input class="input" name="iop_rt" /></td>
                                                            <td><x-splade-input class="input" name="iop_let" /></td>
                                                        </tr>
                                                    </table>
                                                    <table class="second">
                                                        <tr>
                                                            <th>Rt</th>
                                                            <th>Lt</th>
                                                        </tr>
                                                        <tr>
                                                            <td><x-splade-input class="input" name="iop_rt" /></td>
                                                            <td><x-splade-input class="input" name="iop_let" /></td>
                                                        </tr>
                                                    </table>
                                                    <table class="third">
                                                        <tr>
                                                            <th>Rt</th>
                                                            <th>Lt</th>
                                                        </tr>
                                                        <tr>
                                                            <td><x-splade-input class="input" name="iop_rt" /></td>
                                                            <td><x-splade-input class="input" name="iop_let" /></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="group3">
                                        <table>
                                            <tr>
                                                <th>Anterior Segment</th>
                                                <th>Rt</th>
                                                <th>Lt</th>
                                            </tr>
                                            <tr>
                                                <td>Lid</td>
                                                <td><x-splade-input name="lol" /></td>
                                                <td><x-splade-input name="lol" /></td>
                                            </tr>
                                            <tr>
                                                <td>Conj</td>
                                                <td><x-splade-input name="lol" /></td>
                                                <td><x-splade-input name="lol" /></td>
                                            </tr>
                                            <tr>
                                                <td>Cornea</td>
                                                <td><x-splade-input name="lol" /></td>
                                                <td><x-splade-input name="lol" /></td>
                                            </tr>
                                            <tr>
                                                <td>A/C</td>
                                                <td><x-splade-input name="lol" /></td>
                                                <td><x-splade-input name="lol" /></td>
                                            </tr>
                                            <tr>
                                                <td>Iris</td>
                                                <td><x-splade-input name="lol" /></td>
                                                <td><x-splade-input name="lol" /></td>
                                            </tr>
                                            <tr>
                                                <td>Lens</td>
                                                <td><x-splade-input name="lol" /></td>
                                                <td><x-splade-input name="lol" /></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="group4">
                                        <img id="eye1" style="display: none;" src="{{asset('images/eyes/eyes.png')}}" alt="">
                                        <canvas
                                            id="canvas1"
                                            style="border: 1px solid black; width: 100%"
                                        ></canvas>
                                        <div style="margin-top:5px">
                                            <x-splade-input type="range" label="Size" name="range" min="1" max="50" value="10" class="size" id="sizeRange1"/>
                                        </div>
                                        <div style="margin-top:5px">
                                            <x-splade-group style="display: flex; flex-direction: row;" name="colorRadio1" label="Colors">
                                                <x-splade-radio name="colorRadio1" label="black" value="black" />
                                                <x-splade-radio name="colorRadio1" label="white" value="white" />
                                                <x-splade-radio name="colorRadio1" label="red" value="red" />
                                                <x-splade-radio name="colorRadio1" label="green" value="green" />
                                                <x-splade-radio name="colorRadio1" label="blue" value="blue" />
                                            </x-splade-group>
                                        </div>
                                        <div style="margin-top:5px">
                                            <button id="clear1" class="outline-btn">Clear</button>
                                        </div>
                                    </div>
                                    <div class="group5">
                                        <img id="eye2" style="display: none;" src="{{asset('images/eyes/eyes2.png')}}" alt="">
                                        <canvas
                                            id="canvas2"
                                            style="border: 1px solid black; width: 100%"
                                        ></canvas>
                                        <div style="margin-top: 5px">
                                            <x-splade-textarea name="lol" label="EOM" />
                                        </div>
                                        <div style="margin-top:5px">
                                            <x-splade-input type="range" label="Size" name="range2" min="1" max="50" value="10" class="size" id="sizeRange2"/>
                                        </div>
                                        <div style="margin-top:5px">
                                            <x-splade-group style="display: flex; flex-direction: row; align-items: center; gap: 1rem;" name="colorRadio2" label="Colors">
                                                <x-splade-radio name="colorRadio2" label="black" value="black" />
                                                <x-splade-radio name="colorRadio2" label="white" value="white" />
                                                <x-splade-radio name="colorRadio2" label="red" value="red" />
                                                <x-splade-radio name="colorRadio2" label="green" value="green" />
                                                <x-splade-radio name="colorRadio2" label="blue" value="blue" />
                                            </x-splade-group>
                                        </div>
                                        <div style="margin-top:5px">
                                            <button id="clear2" class="outline-btn">Clear</button>
                                        </div>

                                    </div>
                                </div>
                            </div> --}}
                            <x-splade-submit label="Save" class="mt-4" style="width:100%;" />
                        </x-splade-form>
                    </div>

                </x-splade-transition>
            </x-splade-toggle>
        </div>
        {{-- <x-splade-script>
            // enabling drawing on the blank canvas
            brush('eye2','sizeRange2','colorRadio2','canvas2','clear2')
            brush('eye1','sizeRange1','colorRadio1','canvas1','clear1', 'textInput1', 'textButton1');
            function brush(imgId,sizePar,colorPar,canvasPar,clearPar,textInputPar,textButtonPar) {
                window.addEventListener("load", async (e) => {
                    loadImg()
                });
                drawOnImage();
                function loadImg() {
                    // displaying the uploaded image
                    const image = document.createElement("img");
                    image.src = document.getElementById(`${imgId}`).src;

                    // enabling the brush after the image
                    // has been uploaded
                    image.addEventListener("load", () => {
                        drawOnImage(image);
                    });

                    return false;
                }
                const sizeElement = document.querySelector(`#${sizePar}`);
                    let size = sizeElement.value;
                    sizeElement.oninput = (e) => {
                    size = e.target.value;
                };

                const colorElement = document.getElementsByName(`${colorPar}`);
                    let color;
                    colorElement.forEach((c) => {
                    if (c.checked) color = c.value;
                    });
                    colorElement.forEach((c) => {
                    c.onclick = () => {
                        color = c.value;
                    };
                });
                function drawOnImage(image = null) {
                    const canvasElement = document.getElementById(`${canvasPar}`);
                    const context = canvasElement.getContext("2d");
                    canvasElement.width = window.innerWidth;
                    canvasElement.height = window.innerHeight;
                    // if an image is present,
                    // the image passed as parameter is drawn in the canvas
                    if (image) {
                        const imageWidth = image.width;
                        const imageHeight = image.height;

                        // rescaling the canvas element
                        canvasElement.width = imageWidth;
                        canvasElement.height = imageHeight;

                        context.drawImage(image, 0, 0, imageWidth, imageHeight);
                    }
                    const clearElement = document.getElementById(`${clearPar}`);
                    clearElement.onclick = (e) => {
                        e.preventDefault()
                        context.clearRect(0, 0, canvasElement.width, canvasElement.height);
                        loadImg()
                    };
                    let isDrawing;
                    canvasElement.onmousedown = (e) => {
                        isDrawing = true;
                        context.beginPath();
                        context.lineWidth = size;
                        context.strokeStyle = color;
                        context.lineJoin = "round";
                        context.lineCap = "round";
                        let rect = canvasElement.getBoundingClientRect();
                        let x = e.clientX - rect.left;
                        let y = e.clientY - rect.top;
                        context.moveTo(x, y);
                        if (isDrawing) {
                            let rect = canvasElement.getBoundingClientRect();
                            let x = e.clientX - rect.left;
                            let y = e.clientY - rect.top;
                            context.lineTo(x, y);
                            context.stroke();
                        }
                    };
                    canvasElement.onmousemove = (e) => {
                        if (isDrawing) {
                            let rect = canvasElement.getBoundingClientRect();
                            let x = e.clientX - rect.left;
                            let y = e.clientY - rect.top;
                            context.lineTo(x, y);
                            context.stroke();
                        }
                    };
                    canvasElement.onmouseup = function () {
                        isDrawing = false;
                        context.closePath();
                    };
                }
            }
        </x-splade-script> --}}

    </x-doctor.content>

</x-doctor.layout>
