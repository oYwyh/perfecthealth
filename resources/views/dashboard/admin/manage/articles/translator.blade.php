<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('titles.translated') @lang('titles.article') @lang('titles.version')</div>
        @if ($prevRoute == 'admin.manage.articles.add')
            <x-splade-form :default="$translated" action="{{Route('admin.manage.articles.create')}}" method="POST" id="form" autocomplete="off">
                <x-splade-input type="hidden" name="lang"/>
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
                <div class="group">
                    <div class="form-column">
                        <label for="name">@lang('titles.article') @lang('labels.content')</label>
                        <x-splade-wysiwyg name="content" />
                    </div>
                </div>
                <x-splade-submit id="submit" class="mt-4">
                    @lang('buttons.create')
                </x-splade-submit>
            </x-splade-form>
            @else
            <x-splade-form :default="$translated" action="{{Route('admin.manage.articles.update')}}" method="POST" id="form" autocomplete="off">
                <x-splade-input type="hidden" name="lang"/>
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
                <div class="group">
                    <div class="form-column">
                        <label for="name">@lang('titles.article') @lang('labels.content')</label>
                        <x-splade-wysiwyg name="content" />
                    </div>
                </div>
                <x-splade-submit id="submit" class="mt-4">
                    @lang('buttons.update')
                </x-splade-submit>
            </x-splade-form>
        @endif
    </x-admin.content>
</x-admin.layout>
