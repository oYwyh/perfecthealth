<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('buttons.edit') @lang('titles.service')</div>
            <x-splade-form :default="$service" action="{{Route('admin.manage.services.translate',['id' => $id,'oldImage' => $oldImage])}}" method="POST" id="form" autocomplete="off">
                <div class="group">
                    <div class="form-column">
                        <label for="image">@lang('labels.thumbnail')</label>
                        <x-splade-file filepond name="image"  preview />
                    </div>
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
                    <div class="form-row">
                        <label for="frontpage">@lang('messages.disInFront')</label>
                        <x-splade-checkbox name="frontpage" />
                    </div>
                </div>
                <div class="form-column">
                    <label for="lang">@lang('labels.usedLang')</label>
                    <x-splade-group name="lang" style="display: flex; flex-direction: row; gap:1rem; flex-wrap:wrap;">
                        <div class="form-row">
                            <x-splade-radio name="lang" value="en" />
                            <label for="en">@lang('labels.en')</label>
                        </div>
                        <div class="form-row">
                            <x-splade-radio name="lang" value="ar" />
                            <label for="ar">@lang('labels.ar')</label>
                        </div>
                    </x-splade-group>
                </div>
                <x-splade-submit id="submit" class="mt-4">
                    @lang('buttons.update')
                </x-splade-submit>
            </x-splade-form>
    </x-admin.content>
</x-admin.layout>
