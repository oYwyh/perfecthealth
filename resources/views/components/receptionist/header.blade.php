<div class="header">
    <div class="wrapper">
        <div class="logo">place<span>holder</span></div>
        <div class="icons">
            <div class="dropdown">
                <x-splade-toggle>
                    <div class="bell" @click.prevent="toggle" id="dropbbtn">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <x-splade-transition show="toggled">
                        <div id="dropdown-bell-content" class="dropdown-content">
                                <div class="box">
                                    <div class="img">
                                        <img src="{{Auth::user()->image ? asset('storage/'.Auth::user()->image) : asset('images/doc.jpg')}}" alt="">
                                    </div>
                                    <div class="msg">
                                        ez
                                    </div>
                                </div>
                                <div class="divider-primary"></div>
                                <div class="box">
                                    <div class="img">
                                        <img src="{{Auth::user()->image ? asset('storage/'.Auth::user()->image) : asset('images/doc.jpg')}}" alt="">
                                    </div>
                                    <div class="msg">
                                        ez
                                    </div>
                                </div>
                                <div class="divider-primary"></div>
                                <div class="box">
                                    <div class="img">
                                        <img src="{{Auth::user()->image ? asset('storage/'.Auth::user()->image) : asset('images/doc.jpg')}}" alt="">
                                    </div>
                                    <div class="msg">
                                        ez
                                    </div>
                                </div>
                                <div class="divider-primary"></div>
                                <div class="box">
                                    <div class="img">
                                        <img src="{{Auth::user()->image ? asset('storage/'.Auth::user()->image) : asset('images/doc.jpg')}}" alt="">
                                    </div>
                                    <div class="msg">
                                        ez
                                    </div>
                                </div>
                        </div>
                    </x-splade-transition>
                </x-splade-toggle>
            </div>
            <div class="divider">
            </div>
            <div class="dropdown">
                <x-splade-toggle>
                    <div class="profile-pic" @click.prevent="toggle" id="droppbtn">
                        @if (Auth::user()->image)
                        @if (Str::startsWith(Auth::user()->image, ['http://', 'https://']))
                            <img src="{{Auth::user()->image}}" alt="">
                        @else
                            <img src="{{asset('storage/'.Auth::user()->image)}}" alt="">
                        @endif
                        @else
                            <img src="{{asset('storage/'.'images/doc.jpg')}}" alt="">
                        @endif                    </div>
                    <x-splade-transition show="toggled">
                        <div id="dropdown-profile-content" class="dropdown-content">
                            <x-splade-form id="form" method="GET" :action="Route('user.profile.index')">
                                <x-splade-submit style="background: none; color:black !important; border:none !important;">{{Auth::user()->name}}</x-splade-submit>
                            </x-splade-form>
                            <x-splade-form
                                id="form"
                                confirm="Logout"
                                confirm-text="Are you sure you want to logout?"
                                confirm-button="Yes!"
                                cancel-button="No, I want to stay!"
                                :action="Route('auth.logout')">
                                <x-splade-submit style="background: none; color:black !important; border:none !important;" >Logout</x-splade-submit>
                            </x-splade-form>
                        </div>
                    </x-splade-transition>
                </x-splade-toggle>

            </div>
        </div>
    </div>
</div>
