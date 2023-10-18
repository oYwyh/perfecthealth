<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('titles.translated') @lang('titles.insurance') @lang('titles.version')</div>
        @if ($prevRoute == 'admin.manage.insurances.add')
            <x-splade-form :default="$translated" action="{{Route('admin.manage.insurances.create')}}" method="POST" id="form" autocomplete="off">
                <div class="group">
                    <div class="form-column">
                        <label for="title">@lang('labels.title')</label>
                        <x-splade-input type="text" name="title" value="{{ old('title') }}"/>
                    </div>
                </div>
                <x-splade-submit id="submit" class="mt-4">
                    @lang('buttons.create')
                </x-splade-submit>
            </x-splade-form>
            @else
            <x-splade-form :default="$translated" action="{{Route('admin.manage.insurances.update')}}" method="POST" id="form" autocomplete="off">
                <div class="group">
                    <div class="form-column">
                        <label for="title">@lang('labels.title')</label>
                        <x-splade-input type="text" name="title" value="{{ old('title') }}"/>
                    </div>
                </div>
                <x-splade-submit id="submit" class="mt-4">
                    @lang('buttons.update')
                </x-splade-submit>
            </x-splade-form>
        @endif

    </x-admin.content>
</x-admin.layout>
