<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="height: 200vh;">

<canvas
id="canvas1"
style="border: 1px solid black; width: 100%"
></canvas>
<div style="margin-top:5px">
    <input type="text" id="textInput1" placeholder="Enter text here" />
    <button id="textButton1" class="outline-btn">Add Text</button>
</div>

<x-splade-script>
    brush('eye1','sizeRange1','colorRadio1','canvas1','clear1', 'textInput1', 'textButton1');
    function brush(imgId,sizePar,colorPar,canvasPar,clearPar,textInputPar,textButtonPar) {
        const canvasElement = document.getElementById(`${canvasPar}`);
        const context = canvasElement.getContext("2d");

        canvasElement.width = window.innerWidth - 10;
        canvasElement.height = window.innerHeight - 100;
        let offsetX;
        let offsetY;

        function getOffset() {
            let canvasOffset = canvasElement.getBoundingClientRect();

            offsetX = canvasOffset.left
            offsetY = canvasOffset.top

            // Update the offsetX and offsetY variables with the scroll position
            offsetX += window.scrollX;
            offsetY += window.scrollY;
          }

        getOffset();
        window.onscroll = () => {
            console.log('lol')
            getOffset()
        }
        window.onresize = () => {
            getOffset()
        }

        canvasElement.style.border = '5px solid red'
        let shapes = [];
        let currentShapeIndex = null;
        let isDragging = false;
        let startX;
        let startY;

        {{-- shapes.push({x:200,y:10,width:300,height:100,color:'blue'}) --}}
        {{-- shapes.push({x:10,y:50,width:200,height:200,color:'red'}) --}}

        let isMouseInShape = function(x,y,shape) {
            let shapeLeft = shape.x;
            let shapeRight = shape.x + shape.width;
            let shapeTop = shape.y;
            let shapeBottom = shape.y + shape.height;
            if(x > shapeLeft && x < shapeRight && y > shapeTop && y < shapeBottom) {
                return true;
            }
            return false;
        }
        let mousedown = function(e) {
            e.preventDefault();
            startX = parseInt(e.clientX - offsetX + window.scrollX)
            startY = parseInt(e.clientY - offsetY + window.scrollY)
            let  i = 0;
            for(let shape of shapes) {
                if(isMouseInShape(startX,startY,shape)) {
                    currentShapeIndex = i;
                    isDragging = true;
                    return;
                }
                i++
            }
        }
        let mousemove = function(e) {
            if(!isDragging) {
                return;
            }else {
                e.preventDefault();
                let mouseX = parseInt(e.clientX - offsetY + window.scrollX)
                let mouseY = parseInt(e.clientY - offsetY + window.scrollY)

                let dx = mouseX - startX
                let dy = mouseY - startY

                let currentShape = shapes[currentShapeIndex];
                currentShape.x += dx
                currentShape.y += dy

                draw_shapes();

                startX = mouseX
                startY = mouseY
            }
        }
        let mouseup = function(e) {
            e.preventDefault();
            if(!isDragging) {
                return;
            }
            isDragging = false;
        }
        let mouseout = function(e) {
            e.preventDefault();
            if(!isDragging) {
                return;
            }
            isDragging = false;
        }

        canvasElement.onmousedown = mousedown;
        canvasElement.onmouseout = mouseout;
        canvasElement.onmouseup = mouseup;
        canvasElement.onmousemove = mousemove;

        function draw_shapes() {
            context.clearRect(0,0,canvasElement.width,canvasElement.height)
            for(let shape of shapes) {
                context.font = '80px Arial';
                context.fillStyle = shape.color;
                context.fillText(shape.text,shape.x,shape.y,shape.width,shape.height)
                context.fillRect(shape.x,shape.y,shape.width,shape.height)
            }
        }

        const textInputElement = document.getElementById(`${textInputPar}`);
        const textButtonElement = document.getElementById(`${textButtonPar}`);
        textButtonElement.onclick = (e) => {
            e.preventDefault();
            const txt = textInputElement.value;
            shapes.push({text:txt,x:300,y:100,width:100,height:50,color:'blue'})
        draw_shapes()

        };

    }
</x-splade-script>

</body>
</html>
