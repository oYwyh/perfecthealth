<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password reset</title>
</head>
<body>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-content: center;
            height: 100vh;
        }
        div {
            width: 600px;
            background-color: #f5f5f5;
            border-radius: 8px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            padding: 5rem;
        }
    </style>
    <div class="div">
        <x-splade-form class="form-column" :action="route('reset.password.reset',['token' => $token])" method="POST">
            @if (Session::get('locale') == 'en')
            <x-splade-input type="password" label="password" name="password"/>
            <x-splade-input type="password" label="Confirm Password" name="cpassword"/>
            @else
            <x-splade-input type="password" label="كلمة المرور" name="password"/>
            <x-splade-input type="password" label="تأكيد كلمة المرور" name="cpassword"/>
            @endif
            <x-splade-submit class="submit primary-btn">
                @lang('auth.reset')
            </x-splade-submit>
        </x-splade-form>
    </div>

</body>
</html>
