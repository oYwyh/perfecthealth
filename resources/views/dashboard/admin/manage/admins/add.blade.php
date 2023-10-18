<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('auth.register') @lang('titles.admin')</div>
            <x-splade-form :action="Route('admin.manage.admins.register')" method="POST" autocomplete="off">
                <div class="row-group">
                    <div class="form-column">
                        <label for="username">@lang('labels.username')</label>
                        <x-splade-input class="input" type="text" name="name" value="{{ old('name') }}"/>
                    </div>
                    <div class="form-column">
                        <label for="email">@lang('labels.email')</label>
                        <x-splade-input class="input" type="email" name="email" value="{{ old('email') }}"/>
                    </div>
                </div>
                <div class="row-group">
                    <div class="form-column">
                        <label for="first_name">@lang('labels.first_name')</label>
                        <x-splade-input class="input" type="text" name="first_name" value="{{ old('first_name') }}"/>
                    </div>
                    <div class="form-column">
                        <label for="last_name">@lang('labels.last_name')</label>
                        <x-splade-input class="input" type="text" name="last_name" value="{{ old('last_name') }}"/>
                    </div>
                </div>
                <div class="row-group">
                    <div class="form-column">
                        <label for="gender">@lang('labels.gender')</label>
                        <x-splade-select :options="['male' => 'Male', 'female'=>'Female']" class="input" choices  name="gender" />
                    </div>
                    <div class="form-column">
                        <label for="date_of_brith">@lang('labels.date_of_brith')</label>
                        <x-splade-input class="input" type="email" date name="date_of_brith" value="{{ old('email') }}"/>
                    </div>
                    <div class="form-column">
                        <label for="phone">@lang('labels.phone')</label>
                        <x-splade-input class="input" type="text" name="phone" value="{{ old('phone') }}"/>
                    </div>

                </div>
                <div class="row-group">
                    <div class="form-column">
                        <label for="phone">@lang('labels.phone')</label>
                        <x-splade-input type="password" class="input" name="phone" />
                    </div>
                    <div class="form-column">
                        <label for="password_confirmation">@lang('labels.cpwd')</label>
                        <x-splade-input type="password" class="input" name="password_confirmation" />
                    </div>
                </div>
                <x-splade-submit class="mt-4" style="width:100%;" confirm>
                    @lang('auth.register')
                </x-splade-submit>
            </x-splade-form>
    </x-admin.content>
</x-admin.layout>
