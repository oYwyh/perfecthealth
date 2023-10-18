<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('titles.translated') @lang('titles.service') @lang('titles.version')</div>
        @if ($prevRoute == 'admin.manage.services.add')
            <x-splade-form :default="$translated" action="{{Route('admin.manage.services.create')}}" method="POST" id="form" autocomplete="off">
                <div class="group">
                    <div class="form-column">
                        <label for="title">@lang('labels.title')</label>
                        <x-splade-input type="text" name="title" value="{{ old('title') }}"/>
                    </div>
                    <div class="form-column">
                        <label for="description">@lang('labels.description')</label>
                        <x-splade-input type="text"  name="description" value="{{ old('description') }}"/>
                    </div>
                </div>
                <div class="group">
                    <div class="form-column">
                        <label for="tags">@lang('labels.tags')</label>
                        <x-splade-input name="tags"/>
                        <span class="note text-red-500">@lang('messages.tagsNote')</span>
                    </div>
                </div>
                <x-splade-submit id="submit" class="mt-4">
                    @lang('buttons.create')
                </x-splade-submit>
            </x-splade-form>
            @else
            <x-splade-form :default="$translated" action="{{Route('admin.manage.services.update')}}" method="POST" id="form" autocomplete="off">
                <div class="group">
                    <div class="form-column">
                        <label for="title">@lang('labels.title')</label>
                        <x-splade-input type="text" name="title" value="{{ old('title') }}"/>
                    </div>
                    <div class="form-column">
                        <label for="description">@lang('labels.description')</label>
                        <x-splade-input type="text"  name="description" value="{{ old('description') }}"/>
                    </div>
                </div>
                <div class="group">
                    <div class="form-column">
                        <label for="tags">@lang('labels.tags')</label>
                        <x-splade-input name="tags"/>
                        <span class="note text-red-500">@lang('messages.tagsNote')</span>
                    </div>
                </div>
                <x-splade-submit id="submit" class="mt-4">
                    @lang('buttons.update')
                </x-splade-submit>
            </x-splade-form>
        @endif
    </x-admin.content>
</x-admin.layout>
