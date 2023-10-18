<x-splade-modal>
    <div class="auth">
        <x-splade-toggle>
            <x-splade-transition show="!toggled">
                <div class="login">
                    <div class="start">
                        <div class="title">
                            @lang('auth.login')
                        </div>
                        <x-splade-form class="form" method="POST"  action="{{route('auth.index')}}">
                            @if (Session::get('locale') == 'en')
                                <x-splade-input class="input" type="text" placeholder="Email" name="email" />
                                <x-splade-input class="input" type="password" placeholder="Password" name="password" />
                                <x-splade-submit class="submit primary-btn">
                                    @lang('auth.login')
                                </x-splade-submit>
                                @else
                                <x-splade-input class="input" type="text" placeholder="البريد الإلكتروني" name="email" />
                                <x-splade-input class="input" type="password" placeholder="كلمة المرور" name="password" />
                                <x-splade-submit class="submit primary-btn">
                                    @lang('auth.login')
                                </x-splade-submit>
                            @endif
                        </x-splade-form>
                        <Link class="restore" modal href="{{route('reset.password.email')}}">
                            @lang('auth.forgot')
                        </Link>
                    </div>
                    <div class="divider bet"></div>
                    <div class="end">
                            <p>
                                @lang('auth.acc_dhad')
                            </p>
                            <button class="create" @click.prevent="toggle">@lang('auth.create')</button>
                            <div class="divider">Or</div>
                            <ul class="socialite">
                                <Link class="google-btn" href="{{route('auth.google.index')}}">
                                    <div class="google-icon-wrapper">
                                        <img class="google-icon" src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg"/>
                                    </div>
                                    <p class="btn-text"><b>@lang('auth.google')</b></p>
                                </Link>
                                <Link class="facebook-btn" href="{{route('auth.facebook.index')}}">
                                    <div class="facebook-icon-wrapper">
                                        <img class="facebook-icon" src="https://upload.wikimedia.org/wikipedia/commons/7/79/Facebook_f_logo_2013.png"/>
                                    </div>
                                    <p class="btn-text"><b>@lang('auth.facebook')</b></p>
                                </Link>
                            </li>
                    </div>
                </div>
            </x-splade-transition>
            <x-splade-transition show="toggled">
                <div class="register">
                    <div class="start">
                        <div class="title">
                            @lang('auth.register')
                        </div>
                        <x-splade-form :action="route('user.create')" class="form" id="user-form">
                            @if (Session::get('locale') == 'en')
                                <x-splade-input class="input" name="first_name" placeholder="First Name" />
                                <x-splade-input class="input" name="last_name" placeholder="Last Name" />
                                <x-splade-input class="input" name="name" placeholder="Username" />
                                <x-splade-input class="input" name="email" placeholder="Email" />
                                <x-splade-input class="input" name="date_of_brith" placeholder="Date Of Brith" date />
                                <x-splade-select id="gender" name="gender" choices>
                                    <option value="" selected disabled>Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </x-splade-select>
                                <x-splade-input class="input" type="password" name="password" placeholder="password"/>
                                <x-splade-input class="input" type="password" name="cpassword" placeholder="Password Confirmation"/>
                                @else
                                <x-splade-input class="input" name="first_name" placeholder="الإسم الأول" />
                                <x-splade-input class="input" name="last_name" placeholder="الإسم الاخير" />
                                <x-splade-input class="input" name="name" placeholder="إسم المستخدم" />
                                <x-splade-input class="input" name="email" placeholder="البريد الإلكروني" />
                                <x-splade-input class="input" name="date_of_brith" placeholder="تاريخ الميلاد" date />
                                <x-splade-select id="gender" name="gender" choices>
                                    <option value="" selected disabled>الجنس</option>
                                    <option value="male">ذكر</option>
                                    <option value="female">انثى</option>
                                </x-splade-select>
                                <x-splade-input class="input" type="password" name="password" placeholder="كلمة المرور"/>
                                <x-splade-input class="input" type="password" name="cpassword" placeholder="تأكيد كلمه المرور"/>
                            @endif
                        <x-splade-submit class="submit primary-btn">
                            @lang('auth.create')
                        </x-splade-submit>
                    </x-splade-form>
                    </div>
                    <div class="divider bet"></div>
                    <div class="end">
                        <div class="box start">
                            <p>
                                @lang('auth.acc_had')
                            </p>
                            <button class="create" @click.prevent="toggle">@lang('auth.login')</button>
                        </div>
                        <div class="box end">
                            <div class="divider">@lang('auth.or')</div>
                            <ul class="socialite">
                                <Link class="google-btn" href="{{route('auth.google.index')}}">
                                    <div class="google-icon-wrapper">
                                        <img class="google-icon" src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg"/>
                                    </div>
                                    <p class="btn-text"><b>@lang('auth.google')</b></p>
                                </Link>
                                <Link class="facebook-btn" href="{{route('auth.facebook.index')}}">
                                    <div class="facebook-icon-wrapper">
                                        <img class="facebook-icon" src="https://upload.wikimedia.org/wikipedia/commons/7/79/Facebook_f_logo_2013.png"/>
                                    </div>
                                    <p class="btn-text"><b>@lang('auth.facebook')</b></p>
                                </Link>
                            </li>
                        </div>
                    </div>
                </div>
                <x-splade-script>
                    {{-- const confirm = document.querySelector('#confirm')
                    const role = document.querySelector('#role')
                    const registerForm = document.querySelector('#register-form')
                    const userForm = document.querySelector('#user-form')
                    const note = document.querySelector('#note')
                    confirm.addEventListener('click',(e) => {
                        e.preventDefault();
                        switch(role.value) {
                            case '':
                                note.classList.remove('none')
                            break;
                            case 'user':
                            registerForm.style.display = 'none';
                                userForm.style.display = 'block';
                            break;
                            case 'doctor':
                                console.log(role.value)
                            break;
                        }
                    }) --}}
                </x-splade-script>
            </x-splade-transition>
        </x-splade-toggle>
    </div>

</x-splade-modal>
