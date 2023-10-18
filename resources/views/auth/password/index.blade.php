<x-splade-modal>
    <x-splade-form class="form-row" :action="route('reset.password.email.post')" method="POST">
        @if (Session::get('locale') == 'en')
        <x-splade-input placeholder="Email" name="email"/>
        @else
        <x-splade-input placeholder="البريد الإلكتروني" name="email"/>
        @endif
        <x-splade-submit class="submit primary-btn">
            @lang('auth.submit')
        </x-splade-submit>
    </x-splade-form>
</x-splade-modal>
