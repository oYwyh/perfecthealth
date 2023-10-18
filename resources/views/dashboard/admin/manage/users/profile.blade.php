<x-admin.layout>
    <x-admin.content>
        <div class="profile">
            <div class="title" style="text-transform: capitalize">{{$user->first_name}} {{$user->last_name}} @lang('titles.profile')</div>
            <div class="wrapper">
                <div class="box">
                    <div class="img-box">
                        @if ($user->image)
                        @if (Str::startsWith($user->image, ['http://', 'https://']))
                            <img src="{{$user->image}}" alt="">
                        @else
                            @if (Storage::exists('public/'. $user->image))
                                <img src="{{asset('storage/'.$user->image)}}" alt="">
                            @else
                                <img src="{{asset('storage/'.'images/profiles/default.jpg')}}" alt="">
                            @endif
                        @endif
                        @else
                            <img src="{{asset('storage/'.'images/profiles/default.jpeg')}}" alt="">
                        @endif
                    </div>
                </div>
                <div class="container">
                    <div class="form-box">
                        <div class="title">@lang('titles.profile_info')</div>
                        <p class="description">@lang('descriptions.profile_info')</p>
                        <x-splade-form background  :action="route('admin.manage.users.profile-update',['id'=>$user->id])" :default="['name' => $user->name, 'email' => $user->email]" method="POST" class="form">
                            <div class="group">
                                <div class="form-column">
                                    <label for="name">@lang('labels.username')</label>
                                    <x-splade-input type="text" class="input" name="name"/>
                                </div>
                                <div class="form-column">
                                    <label for="email">@lang('labels.email')</label>
                                    <x-splade-input type="text" class="input" name="email"/>
                                </div>
                            </div>
                            <div class="form-column">
                                <label for="image">@lang('labels.pfp')</label>
                                <x-splade-file id="file" filepond name="image"/>
                            </div>
                            <x-splade-submit id="save">
                                @lang('buttons.save')
                            </x-splade-submit>
                        </x-splade-form>
                    </div>
                    <div class="form-box">
                        <div class="title">@lang('titles.personal_info')</div>
                        <p class="description">@lang('descriptions.personal_info')</p>
                        <x-splade-form background :action="route('admin.manage.users.personal-update',['id'=>$user->id],['id'=>$user->id])" :default="$user" method="POST" class="form">
                            <div class="group">
                                <div class="form-column">
                                    <label for="first_name">@lang('labels.first_name')</label>
                                    <x-splade-input type="text" class="input" name="first_name"/>
                                </div>
                                <div class="form-column">
                                    <label for="last_name">@lang('labels.last_name')</label>
                                    <x-splade-input type="text" class="input" name="last_name"/>
                                </div>
                            </div>
                            <div class="group">
                                <div class="form-column">
                                    <label for="gender">@lang('labels.date_of_brith')</label>
                                    <x-splade-input type="text" class="input" date name="date_of_brith"/>
                                </div>
                                <div class="form-column">
                                    <label for="email">@lang('labels.gender')</label>
                                    <x-splade-select name="gender" choices class="input">
                                        <option value="" selected disabled></option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </x-splade-select>
                                </div>
                            </div>
                            <div class="group">
                                <div class="form-column">
                                    <label for="phone">@lang('labels.phone')</label>
                                    <x-splade-input type="text" class="input" name="phone" />
                                </div>
                                <div class="form-column">
                                    <label for="national_id">@lang('labels.national_id')</label>
                                    <x-splade-input type="text"  class="input" name="national_id"/>
                                </div>
                            </div>
                            <div class="group">
                                <div class="form-column">
                                    <label for="height">@lang('labels.height')</label>
                                    <x-splade-input type="text" class="input" name="height" />
                                </div>
                                <div class="form-column">
                                    <label for="weight">@lang('labels.weight')</label>
                                    <x-splade-input type="text"  class="input" name="weight"/>
                                </div>
                            </div>
                            <x-splade-submit id="save">
                                @lang('buttons.save')
                            </x-splade-submit>
                        </x-splade-form>
                    </div>
                    <div class="form-box">
                        <div class="title">@lang('titles.medical_info')</div>
                        <p class="description">@lang('descriptions.medical_info')</p>
                        <x-splade-form background  :action="route('admin.manage.users.medical-update',['id' => $user->id])" :default="$user" method="POST" class="form">
                            <div class="group">
                                <x-splade-select name="blood" choices class="input" label="Blood Type">
                                    <option value=""></option>
                                    <option value="A+">A+</option>
                                    <option value="B+">B+</option>
                                    <option value="AB+">AB+</option>
                                    <option value="O+">O+</option>
                                    <option value="A-">A-</option>
                                    <option value="B-">B-</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O-">O-</option>
                                </x-splade-select>
                                <x-splade-input type="text" class="input" name="disease" label="chronic disease" />
                            </div>
                            <x-splade-submit id="save" label="Save changes" />
                        </x-splade-form>
                    </div>
                    <div class="form-box">
                        <div class="title">@lang('titles.update_pwd')</div>
                        <p class="description">@lang('descriptions.update_pwd')</p>
                        <x-splade-form background :action="route('admin.manage.users.pwd-update',['id'=>$user->id])" method="POST" class="form">
                            <div class="form-column">
                                <label for="password">@lang('labels.newpwd')</label>
                                <x-splade-input type="password" class="input" name="password" />
                            </div>
                            <div class="form-column">
                                <label for="password_confirmation">@lang('labels.cpwd')</label>
                                <x-splade-input type="password" class="input" name="password_confirmation" />
                            </div>
                            <x-splade-submit id="save">
                                @lang('buttons.save')
                            </x-splade-submit>
                        </x-splade-form>
                    </div>
                    <div class="form-box">
                        <div class="title">@lang('titles.delete_acc')</div>
                        <p class="description">@lang('descriptions.delete_acc')</p>
                        <x-splade-form :action="route('admin.manage.users.delete-profile')" :default="$user" method="POST" class="form">
                            <x-splade-input type="hidden" name="id" />
                            <x-splade-submit id="delete">
                                @lang('buttons.delete_acc')
                            </x-splade-submit>
                        </x-splade-form>
                    </div>
                </div>
            </div>
        </div>
        <x-splade-script>
            const days = document.querySelectorAll('#days .check-day');
            days.forEach(day => {
                day.addEventListener('input', () => {
                    const text = day.querySelector('label input')
                    const three  = text.value.substring(0,3);
                    const form = document.querySelector(`#${three}_check`);
                    console.log(form);
                    form.classList.toggle('active')
                })
            })
        </x-splade-script>
    </x-admin.content>
</x-admin.layout>
