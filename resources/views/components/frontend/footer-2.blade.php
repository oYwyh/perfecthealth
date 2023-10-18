@php
    $user = null;
    $guards = ['web', 'admin', 'doctor'];
    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            $user = Auth::guard($guard)->user();
            break;
        }
    }
@endphp
<div class="front-footer-2">
    <div class="wrapper">
        <div class="start">
            <div class="box links">
                <p class="title">Address</p>
                <div class="row">
                    <Link class="info-txt"><i class="fa fa-map-marker-alt me-3"></i>6743 Street, New York, USA</Link>
                    <Link class="info-txt"><i class="fa fa-phone-alt me-3"></i>+012-3434-43443</Link>
                </div>
            </div>
            <div class="box newsletter">
                <p class="title">Newsletter</p>
                @if($user)
                    <x-splade-form class="form" :default="['email' => $user->email]" :action="route('subscribe')" method="POST" stay>
                        <x-splade-input type="hidden" name="email"/>
                        <x-splade-submit label="Subscribe" />
                    </x-splade-form>
                @else
                    <x-splade-form class="form" :action="route('subscribe')" method="POST" stay>
                        <x-splade-input name="email" value="{{old('name')}}"/>
                        <x-splade-submit label="Subscribe"  />
                    </x-splade-form>
                @endif
            </div>
        </div>
        <div class="end">
            <div class="box">
                <span class="copy-txt">LOL All Right Reserved.</span>,
            </div>
            <div class="box image-box">
                <img src="https://nordis.true-emotions.studio/v2/wp-content/themes/nordis_v2/assets/img/logo.png" alt="">
            </div>
            <div class="box">
                <span class="copy-txt">Design By <Link href="#">YWYH</Link></span>
            </div>
        </div>
    </div>
</div>
