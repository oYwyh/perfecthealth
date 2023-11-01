<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receptionist Dashboard | Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="background: #f8f9ff;">
    @if (Session::get('locale') == 'ar')
        <div class="main dashboard" style="direction: rtl;" id="main">
        @else
        <div class="main dashboard" id="main">
    @endif
    @php
    if (Route::currentRouteName() != 'receptionist.manage.patients.info') {
            Session::remove('patient_id');
        }
    @endphp
        <x-receptionist.sidebar/>
            {{$slot}}
        <x-receptionist.footer/>
    </div>
    <loader></loader>

</body>
</html>
