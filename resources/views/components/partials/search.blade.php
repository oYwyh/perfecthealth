<x-splade-form class="search" method="GET" :action="route('articles.index')" >
    @if (Session::get('locale') == 'en')
        <x-splade-input class="input" name="search" placeholder="Search articles"/>
        @else
        <x-splade-input class="input" name="search" placeholder="أبحث عن مقال"/>
    @endif
    <x-splade-submit class="submit">
        @lang('buttons.search')
    </x-splade-submit>
</x-splade-form>
