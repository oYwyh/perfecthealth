<script setup></script>
<template>

</template>
<script>
export default {
    name:'Prescription',
    props: ['type'],
    mounted() {
            const type = this.type;
            const editBtn = document.querySelector('#editBtn');
            const saveBtn = document.querySelector('#saveBtn');
            const prescImgDiv = document.querySelector(`#presc${type} #presc-img`);
            let textValue;

            editBtn.addEventListener('click',(e) => {
                e.preventDefault();
                let parent = editBtn.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement;
                if(parent.id == `presc${type}`) {
                    textValue = parent.querySelector('#editTxt').value.split('\n').map(line => `- ${line}`).join('<br>');
                    parent.querySelector('#prescTxt').innerHTML = `${textValue}`;
                }
            })
            let newPresc;
            let url;
            let prescImg;
            let popup;
            let parent;
            let prescription;
            let xhr;
            saveBtn.addEventListener('click',(e) => {
                parent = document.getElementById(`presc${type}`);
                prescription = parent.querySelector(`#prescription`)
                if(textValue != undefined) {
                    newPresc = textValue
                    .split('<br>')
                    .map(line => line.replace(/^- /, ''))
                    .join(',');
                }
                function createImg(prescriptionElement, imageUrl) {
                    prescImg = document.createElement('img');
                    prescImg.src = decodeURIComponent(imageUrl);
                    // prescriptionElement.prepend(prescImg);
                }
                html2canvas(prescription).then(function(canvas) {
                    try {
                        console.log(parent.id == `presc${type}`)
                        var img = document.createElement('img');
                        img.src = canvas.toDataURL('image/jpeg', 0.9);
                        xhr = new XMLHttpRequest();
                        xhr.open('POST', `/doctor/manage/appointments/save-image?newPresc=${encodeURIComponent(newPresc)}&section=${parent.id}`, true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                        xhr.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById('redirect-btn').click()
                                // Redirect the user after the image has been saved
                                // window.location.href = saveBtn.dataset.redirectUrl;
                            }
                        };
                        xhr.send('img=' + encodeURIComponent(img.src));
                        url = encodeURIComponent(img.src);
                        if(parent.id == `presc${type}`) {
                            createImg(prescImgDiv, url);
                        }
                        newPresc = undefined;
                    }
                    catch (err) {
                        console.log(err);
                    }
                });
                // const printBtn = document.createElement('button');
                // printBtn.id = 'printBtn';
                // printBtn.innerHTML = 'Print';
                // if(parent.id == `presc${type}`) {
                //     prescImgDiv.appendChild(printBtn);
                // }
                // printBtn.addEventListener('click',(e) => {
                //     function closePrint () {
                //         if ( printWindow ) {
                //             printWindow.close();
                //         }
                //     }
                //     var printWindow = window.open('', '_blank');
                //     printWindow.document.write('<html><head><title>Print</title></head><body>');
                //     printWindow.document.write('<img src="' + prescImg.src + '" style="width: 100%; height: 100%;" />');
                //     printWindow.document.write('</body></html>');
                //     printWindow.document.close();
                //     printWindow.print();
                //     printWindow.onbeforeunload = closePrint;
                //     printWindow.onafterprint = closePrint;
                //     printWindow.focus(); // Required for IE
                //     printWindow.print();
                //     if(printWindow.print()) {
                //         window.close();
                //     }
                // })
            })
        },
}
</script>
