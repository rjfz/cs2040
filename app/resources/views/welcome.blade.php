@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <h1>In honor of lost things</h1>
        <img id="trump" style="display: none;" src="/cs2040/app/public/trump.jpg" />
        <img id="queen" style="display: none;" src="/cs2040/app/public/queen.jpg" />
        <canvas id="myCanvas" width="1028" height="686" style="border:1px solid #d3d3d3;">
            Your browser does not support the HTML5 canvas tag.
        </canvas>
    </div>
</div>
<script>
    window.onload = () => {
        var c = document.getElementById("myCanvas")
        var ctx = c.getContext("2d")
        ctx.filter = 'saturate(0.75)'
        var rotate = 18
        ctx.rotate(rotate * Math.PI / 180)
        ctx.drawImage(document.getElementById("queen"), 0, 0, 650, 355)
        ctx.filter = 'saturate(1)'

        ctx.rotate(-rotate * Math.PI / 180)

        var [width, height] = [210, 225]
        var [start_x, start_y] = [130, 190]
        var imgData = ctx.getImageData(start_x, start_y, width, height)

        imgData.data = imgData.data.map(pixel => {
            if (((pixel[0] - pixel[1]) < 10) && ((pixel[1] - pixel[2]) < 20)) {
                pixel[3] = 0
            }
            return pixel
        })

        console.log(imgData.data)

        ctx.drawImage(document.getElementById("trump"), 0, 0, 1028, 686)

        ctx.putImageData(imgData, 520, 230)
    }
</script>
@endsection
