<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@lang('auth.reset') @lang('auth.pwd') @lang('auth.link')</title>
    <link rel="stylesheet" href="./css/mail.css">
</head>
<body style="text-align: center;">
    <table style="width: 50%; margin: auto; background: #f0f0f0; margin: auto;">
        <tr>
            <td style="text-align: center;">
                <table style="width: 100%;">
                    <tr>
                        <td style="font-size: 25px; text-align: center">@lang('auth.reset') @lang('auth.pwd')</td>
                    </tr>
                </table>
                <table style="margin-top: 1rem; width: 100%; background: white;">
                    <tr>
                        <td style="text-align: center; font-size:25px;">@lang('auth.pwd_link')</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: 37px; letter-spacing: 0.7em;">
                            <a href="http://127.0.0.1:8000/reset/password/{{$data['token']}}">@lang('auth.reset')</a>
                        </td>
                    </tr>
                </table>
                {{-- <table style="margin-top: 1rem; width: 100%; background: #f0f0f0;">
                    <tr>
                        <td style="padding: 10px;"><a href="#"><img style="width: 50px;" src="https://ci3.googleusercontent.com/proxy/rcYs7Ll_uIUjD9WNGmKlTNhb4cXQbPY74SRuVSHR0xo6dMVHuuIo7OGERmIgiJTAgbN-wWamF2Y2Bx4UrkFJxyZCKPoVbQ5gmosM9fK-gqAoX3OcqQ3oCa3ZneHf2yYEnA=s0-d-e1-ft#https://lolstatic-a.akamaihd.net/email-marketing/betabuddies/facebook-logo.png" alt=""></a></td>
                        <td style="padding: 10px;"><a href="#"><img style="width: 50px;" src="https://ci3.googleusercontent.com/proxy/D4hP2lnb57fnEsNaXmx5rescxZFQefhk2d2t4kzCJoWDHwFwF5C2NZ_ouWvf3WRSl7ggI0n-D2YsrEiVQfYHff-4gSXVL2_Hfc-m_6vPnKHEpONs0cw4nMDN49luRFWZock=s0-d-e1-ft#https://lolstatic-a.akamaihd.net/email-marketing/betabuddies/instagram-logo.png" alt=""></a></td>
                        <td style="padding: 10px;"><a href="#"><img style="width: 50px;" src="https://ci6.googleusercontent.com/proxy/h-EejfrBWXVSwoMk2OPjry1O9ZHk0T7bVDKaXDkI5M07QXKudBg2eFTT1u5Du3nO-WD_C31SBXgSXe4BgndKAERMA95VnXRyHSyNNGKMIotYO6GP1-ExvcH2zliH-Oj7=s0-d-e1-ft#https://lolstatic-a.akamaihd.net/email-marketing/betabuddies/youtube-logo.png" alt=""></a></td>
                        <td style="padding: 10px;"><a href="#"><img style="width: 50px;" src="https://ci5.googleusercontent.com/proxy/rZKdKE_oYIJ9VcKSnc7yPwsQ6KzeuZaiu2IY21TgvBQE7Qi6f9GyBgNMUBACMHuRJriRxDhokEws9toSnB23QH2uhDrLMAbqp9woQO1XsfGhYSLnuhzfoVJVFyXQjQh1=s0-d-e1-ft#https://lolstatic-a.akamaihd.net/email-marketing/betabuddies/twitter-logo.png" alt=""></a></td>
                    </tr>
                </table> --}}
            </td>
        </tr>
    </table>
</body>
</html>
