<div class="footer">
    <div class="newsletter">
        <x-splade-form background class="form" :action="route('newsletter.subscribe')">
            @if (Session::get('locale') == 'en')
                <x-splade-input class="input" name="email" placeholder="Subscribe to newsletter"/>
                @else
                <x-splade-input class="input" name="email" placeholder="اشترك في النشرة الاخبارية"  />
            @endif
            <x-splade-submit class="submit">
                @lang('buttons.subscribe')
            </x-splade-submit>
        </x-splade-form>
    </div>
    <div class="wrapper">
        <div class="info">
            <div class="box main">
                {{-- <div class="logo">Dr Waleed Haikal</div> --}}
                <Link class="logo" href="{{route('home')}}">
                    <img src="{{asset('images/logo/full/gold_horizontal.png')}}" alt="">
                </Link>
                <div class="desc">@lang('footer.description')</div>
                <Link class="btn primary-btn" href="{{route('user.manage.appointments.search')}}">@lang('buttons.book')</Link>

            </div>
            <div class="row">
                <div class="box quick-links">
                    <div class="title">@lang('footer.quickTitle')</div>
                    <ul>
                        <li><Link href="#">@lang('footer.home')</Link></li>
                        <li><Link href="#">@lang('footer.articles')</Link></li>
                        @auth('admin')
                            <li><Link class="link" href="{{route('admin.home')}}">@lang('footer.dashboard') </Link><span></span></li>
                        @endauth
                        @auth('web')
                            <li><Link class="link" href="{{route('user.home')}}">@lang('footer.dashboard') </Link><span></span></li>
                        @endauth
                        @auth('doctor')
                            <li><Link class="link" href="{{route('doctor.home')}}">@lang('footer.dashboard') </Link><span></span></li>
                        @endauth
                        @auth('receptionist')
                            <li><Link class="link" href="{{route('receptionist.home')}}">@lang('footer.dashboard') </Link><span></span></li>
                        @endauth
                    </ul>
                </div>
                <div class="box work-time">
                    <div class="title">@lang('footer.workTitle')</div>
                    <div class="column">
                        <div class="small-box">
                            <div class="title">@lang('footer.locationOne')</div>
                            <div class="days">@lang('footer.locationOneDays')</div>
                            <div class="hours">@lang('footer.locationOneHours')</div>
                        </div>
                        <div class="small-box">
                            <div class="title last">@lang('footer.locationTwo')</div>
                            <div class="days">@lang('footer.locationOneDays')</div>
                            <div class="hours">@lang('footer.locationOneHours')</div>
                        </div>
                    </div>
                </div>
                <div class="box dashboard">
                    <div class="title">@lang('footer.dashboardTitle')</div>
                    <ul>
                        @auth('admin')
                            <li><Link href="{{route('admin.profile.index')}}">@lang('footer.profile')</Link></li>
                            <li><Link href="{{route('admin.home')}}">@lang('footer.overview')</Link></li>
                        @endauth
                        @auth('web')
                            <li><Link href="{{route('user.profile.index')}}">@lang('footer.profile')</Link></li>
                            <li><Link href="{{route('user.manage.appointments.search')}}">@lang('footer.book')</Link></li>
                            <li><Link href="{{route('user.file')}}">@lang('footer.medical')</Link></li>
                        @endauth
                        @auth('doctor')
                            <li><Link href="{{route('doctor.profile.index')}}">@lang('footer.profile')</Link></li>
                            <li><Link href="{{route('doctor.home')}}">@lang('footer.overview')</Link></li>
                            <li><Link href="{{route('doctor.manage.appointments.index')}}">@lang('footer.latest')</Link></li>
                        @endauth
                        @auth('receptionist')
                            <li><Link href="{{route('receptionist.profile.index')}}">@lang('footer.profile')</Link></li>
                            <li><Link href="{{route('receptionist.home')}}">@lang('footer.overview')</Link></li>
                        @endauth
                        @if (!Auth::user())
                            <li><Link href="{{route('user.profile.index')}}">@lang('footer.profile')</Link></li>
                            <li><Link href="{{route('user.manage.appointments.search')}}">@lang('footer.book')</Link></li>
                            <li><Link href="{{route('user.file')}}">@lang('footer.medical')</Link></li>
                        @endif
                    </ul>
                </div>
                <div class="box social-footer">
                    <div class="title">@lang('footer.socialTitle')</div>
                    <ul>
                        <li><Link href="https://www.facebook.com/profile.php?id=100083383471982">@lang('social.facebook')</Link></li>
                        <li><Link href="https://m.me/waleed.haikal.3">@lang('social.messenger')</Link></li>
                        <li><Link href="https://wa.me/201024824716">@lang('social.whatsapp')</Link></li>
                        <li><Link href="tel:201024824716">@lang('social.phone')</Link></li>
                        <li><Link href="mailto:waldmed@waleedhaikal.com">@lang('social.mail')</Link></li>
                        <li><Link href="https://waleedhaikal.com">@lang('social.website')</Link></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="divider"></div>
        <div class="copyright">
            <div class="rights">@lang('messages.copyright') &copy; <span id="year"></span> </div>
            <a href="mailto:support@waleedhaikal.com" class="under">@lang('messages.under')</a>
            <div class="creator">@lang('messages.madeby') <a href="mailto:ywyhinfo@gmail.com">@lang('messages.creator')</a></div>
        </div>
    </div>
</div>
<x-splade-script>let date = new Date(); document.getElementById('year').innerHTML = date.getFullYear()</x-splade-script>
