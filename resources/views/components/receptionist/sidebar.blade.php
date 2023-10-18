{{-- <div class="sidebar">
    <span class="title">Menu</span>
    <ul>
        <li><Link class="{{Route::current()->getName() == 'receptionist.home' ? 'active' : ''}} Link" href="{{Route('receptionist.home')}}"><i class="fa-solid fa-screwdriver-wrench" style="color:#efc74f;"></i> <span>Home</span></Link></li>
        <li><Link class=" {{Route::current()->getName() == 'receptionist.manage.patients.index' ? 'active' : ''}} Link" href="{{route('receptionist.manage.patients.index')}}"><i class="fa-solid fa-lock" style="color: #3b5fe0;"></i> <span>Patients</span></Link></li>
    </ul>
</div> --}}
<div class="sidebar" id="sidebar">
    <x-partials.sidebar-header />
    <ul>
        <div class="title">MENU</div>
        <li><Link class="link"  href="{{Route('receptionist.home')}}">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 48 48">
                    <path d="M 23.951172 4 A 1.50015 1.50015 0 0 0 23.072266 4.3222656 L 8.859375 15.519531 C 7.0554772 16.941163 6 19.113506 6 21.410156 L 6 40.5 C 6 41.863594 7.1364058 43 8.5 43 L 18.5 43 C 19.863594 43 21 41.863594 21 40.5 L 21 30.5 C 21 30.204955 21.204955 30 21.5 30 L 26.5 30 C 26.795045 30 27 30.204955 27 30.5 L 27 40.5 C 27 41.863594 28.136406 43 29.5 43 L 39.5 43 C 40.863594 43 42 41.863594 42 40.5 L 42 21.410156 C 42 19.113506 40.944523 16.941163 39.140625 15.519531 L 24.927734 4.3222656 A 1.50015 1.50015 0 0 0 23.951172 4 z M 24 7.4101562 L 37.285156 17.876953 C 38.369258 18.731322 39 20.030807 39 21.410156 L 39 40 L 30 40 L 30 30.5 C 30 28.585045 28.414955 27 26.5 27 L 21.5 27 C 19.585045 27 18 28.585045 18 30.5 L 18 40 L 9 40 L 9 21.410156 C 9 20.030807 9.6307412 18.731322 10.714844 17.876953 L 24 7.4101562 z"></path>
                </svg>
                <span class="gone">Home</span>
            </Link>
        </li>

        @if (Session::get('locale') == 'en')
            <li>
                <Link class="link locale" href="{{ url('locale/ar') }}">
                    <img src="{{asset('svg/eg.png')}}" width="30" alt="">
                    <span class="gone">العربية</span>
                </Link>
            </li>
            @else
            <li>
                <Link class="link locale" href="{{ url('locale/en') }}">
                    <img src="{{asset('svg/uk.png')}}" width="30" alt="">
                    <span class="gone">English</span>
                </Link>
            </li>
        @endif

        <li><Link class="link"  href="{{route('receptionist.manage.patients.index')}}">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 48 48">
                    <path d="M 13.5 4.9003906 C 11.581818 4.9003906 10 6.4822088 10 8.4003906 L 10 20.710938 A 1.50015 1.50015 0 1 0 13 20.710938 L 13 8.4003906 C 13 8.1185724 13.218182 7.9003906 13.5 7.9003906 L 34.5 7.9003906 C 34.781818 7.9003906 35 8.1185724 35 8.4003906 L 35 13.097656 A 1.5006446 1.5006446 0 0 0 35.603516 16.007812 C 38.024181 15.84087 40.447539 16.830017 42.148438 18.871094 A 1.50015 1.50015 0 0 0 42.15625 18.882812 C 45.01247 22.243071 44.493133 27.374244 41.162109 30.039062 A 1.5007322 1.5007322 0 0 0 43.037109 32.382812 C 47.704466 28.648927 48.384518 21.585128 44.445312 16.945312 C 42.741757 14.904648 40.447531 13.607403 38 13.164062 L 38 8.4003906 C 38 6.4822088 36.418182 4.9003906 34.5 4.9003906 L 13.5 4.9003906 z M 29.964844 15.197266 A 1.50015 1.50015 0 0 0 29.044922 15.554688 C 24.401776 19.385282 23.71247 26.44229 27.65625 31.082031 C 29.580906 33.346332 32.258192 34.890484 35.240234 35.009766 A 1.5002067 1.5002067 0 1 0 35.359375 32.011719 C 33.341418 31.931 31.418703 30.874371 29.943359 29.138672 C 27.08714 25.778413 27.598224 20.636592 30.955078 17.867188 A 1.50015 1.50015 0 0 0 29.964844 15.197266 z M 36.078125 19.189453 A 1.50015 1.50015 0 0 0 34.599609 20.710938 L 34.599609 22.511719 L 32.800781 22.511719 A 1.50015 1.50015 0 1 0 32.800781 25.511719 L 34.599609 25.511719 L 34.599609 27.310547 A 1.50015 1.50015 0 1 0 37.599609 27.310547 L 37.599609 25.511719 L 39.400391 25.511719 A 1.50015 1.50015 0 1 0 39.400391 22.511719 L 37.599609 22.511719 L 37.599609 20.710938 A 1.50015 1.50015 0 0 0 36.078125 19.189453 z M 11.476562 25.478516 A 1.50015 1.50015 0 0 0 10 27 L 10 39.599609 C 10 42.387109 13.372336 44.113978 15.615234 42.388672 L 24.001953 36.316406 L 32.429688 42.322266 C 33.569226 43.134956 35.028036 43.171828 36.117188 42.605469 C 37.207026 42.038752 38 40.8625 38 39.5 L 38 37.46875 A 1.50015 1.50015 0 1 0 35 37.46875 L 35 39.5 C 35 39.7375 34.892583 39.860076 34.732422 39.943359 C 34.572261 40.026639 34.432019 40.06472 34.171875 39.878906 A 1.50015 1.50015 0 0 0 34.169922 39.878906 L 25.470703 33.677734 L 25.660156 33.839844 C 24.771399 32.951087 23.382033 33.040228 22.501953 33.699219 L 13.820312 39.984375 A 1.50015 1.50015 0 0 0 13.785156 40.011719 C 13.428106 40.286413 13 40.012109 13 39.599609 L 13 27 A 1.50015 1.50015 0 0 0 11.476562 25.478516 z"></path>
                </svg>
                <span class="gone">Patients</span>
            </Link>
        </li>
    </ul>
    <ul class="end">
        <li class="img">
            <Link class="link" href="{{route('receptionist.profile.index')}}">
                <div class="box">
                    @if (Auth::user()->image)
                    @if (Str::startsWith(Auth::user()->image, ['http://', 'https://']))
                        <img src="{{Auth::user()->image}}" alt="">
                    @else
                        @if (Storage::exists('public/'. Auth::user()->image))
                            <img src="{{asset('storage/'.Auth::user()->image)}}" alt="">
                        @else
                            <img src="{{asset('storage/'.'images/profiles/default.jpg')}}" alt="">
                        @endif
                    @endif
                    @else
                        <img src="{{asset('storage/'.'images/doc.jpg')}}" alt="">
                    @endif
                </div>
                <div class="column">
                    <div class="name">{{Auth::user()->name}}</div>
                    <div class="email">{{Auth::user()->email}}</div>
                </div>
            </Link>
        </li>
        <li class="logout">
            <Link confirm class="link" method="POST" href="{{Route('auth.logout')}}">
                <svg
                class="h-5 w-5 text-red-700"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                <span class="gone">Logout</span>
            </Link>
        </li>
    </ul>
</div>
