<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('titles.create') @lang('titles.mail')</div>
            <x-splade-form  :action="Route('admin.manage.mails.create')" method="POST" autocomplete="off">
                <div class="row-group">
                    <div class="form-column">
                        <label for="title">@lang('labels.title')</label>
                        <x-splade-input class="input" name="title" value="{{ old('title') }}"/>
                    </div>
                    <div class="form-column">
                        <label for="description">@lang('labels.description')</label>
                        <x-splade-input class="input" name="description" value="{{ old('description') }}"/>
                    </div>
                    <div class="form-column">
                        <label for="type">@lang('labels.type')</label>
                        <x-splade-select :options="$types" class="input" choices name="type" />
                    </div>
                </div>
                <div class="form-column">
                    <label for="content">@lang('labels.content')</label>
                    <x-splade-wysiwyg  class="input" name="content" />
                </div>
                <x-splade-submit id="submit" class="mt-4">
                    @lang('buttons.create')
                </x-splade-submit>
            </x-splade-form>
    </x-admin.content>
</x-admin.layout>

