<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

</head>
@if (Session::get('locale') == 'ar')
    <body class="ar">
        @else
    <body>
@endif
    <div class="layout">
        <div id="backdrop" class=""></div>
        <div class="top" id="top">
            <i class="fa-solid fa-chevron-up"></i>
        </div>
        {{-- <x-frontend.pre-header /> --}}
        <x-frontend.header />
            <div class="front-main">
                {{$slot}}
                <x-frontend.footer />
            </div>
            <loader />
            <x-splade-script>
                const top = document.querySelector('#top');

                const displayButton = () => {
                    window.addEventListener('scroll', () => {
                    if (window.scrollY > 200) {
                        top.style.opacity = '1';
                        top.style.display = "flex";
                    }else {
                        top.style.opacity = '0';
                        top.style.display = "none";
                    }
                    });
                };

                const scrollToTop = () => {
                    top.addEventListener("click", () => {
                    window.scroll({
                        top: 0,
                        left: 0,
                        behavior: 'smooth'
                    });
                    console.log(event);
                    });
                };

                displayButton();
                scrollToTop();

            </x-splade-script>
    </div>
</body>
</html>
