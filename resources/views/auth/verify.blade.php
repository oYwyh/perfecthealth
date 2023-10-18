    <x-splade-modal>
        <x-splade-form :action="route('verify')" class="code-form">
            @if (Session::get('locale') == 'en')
            <x-splade-input class="code-input" placeholder="Verfication Code" name="verfication_code" style="width: 100% !important;"/>
            @else
            <x-splade-input class="code-input" placeholder="رمز التأكيد" name="verfication_code" style="width: 100% !important;"/>
            @endif
            <x-splade-submit>
                @lang('auth.verify')
            </x-splade-submit>
        </x-splade-form>
        <Link away href="{{route('send-code')}}" class="link-style">@lang('messages.email_recive')</Link>
    </x-splade-modal>
