<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('auth.register') @lang('titles.user')</div>
            <x-splade-form :action="Route('admin.manage.users.register')" method="POST" autocomplete="off">
                <div class="row-group">
                    <div class="form-column">
                        <label for="name">@lang('labels.username')</label>
                        <x-splade-input class="input" name="name" value="{{ old('Name') }}"/>
                    </div>
                    <div class="form-column">
                        <label for="email">@lang('labels.email')</label>
                        <x-splade-input class="input" name="email" value="{{ old('email') }}"/>
                    </div>
                </div>
                <div class="row-group">
                    <div class="form-column">
                        <label for="first_name">@lang('labels.first_name')</label>
                        <x-splade-input class="input"  name="first_name" value="{{ old('first_name') }}"/>
                    </div>
                    <div class="form-column">
                        <label for="last_name">@lang('labels.last_name')</label>
                        <x-splade-input class="input" name="last_name" value="{{ old('last_name') }}"/>
                    </div>
                    <div class="form-column">
                        <label for="national_id">@lang('labels.national_id')</label>
                        <x-splade-input class="input" name="national_id" value="{{ old('national_id') }}"/>
                    </div>
                </div>
                <div class="row-group">
                    <div class="form-column">
                        <label for="gender">@lang('labels.gender')</label>
                        <x-splade-select :options="['male' => 'Male', 'female'=>'Female']" class="input" choices name="gender" />
                    </div>
                    <div class="form-column">
                        <label for="date_of_brith">@lang('labels.date_of_brith')</label>
                        <x-splade-input class="input" date name="date_of_brith" value="{{ old('email') }}"/>
                    </div>
                    <div class="form-column">
                        <label for="phone">@lang('labels.phone')</label>
                        <x-splade-input class="input" name="phone" value="{{ old('phone') }}"/>
                    </div>
                </div>
                <div class="row-group">
                    <div class="form-column">
                        <label for="password">@lang('labels.password')</label>
                        <x-splade-input type="password" class="input" name="password"  />
                    </div>
                    <div class="form-column">
                        <label for="password_confirmation">@lang('labels.cpwd')</label>
                        <x-splade-input type="password" class="input" name="password_confirmation"  />
                    </div>
                </div>
                <x-splade-submit class="mt-4" style="width:100%;" confirm>
                    @lang('auth.register')
                </x-splade-submit>
            </x-splade-form>
    </x-admin.content>
</x-admin.layout>
