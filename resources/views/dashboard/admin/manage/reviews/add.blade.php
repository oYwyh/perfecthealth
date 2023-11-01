<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('buttons.add') @lang('titles.review')</div>
            <x-splade-form  :action="Route('admin.manage.reviews.create')" method="POST" autocomplete="off">
                <div class="row-group">
                    <div class="form-column">
                        <label for="fullname">@lang('labels.fullname')</label>
                        <x-splade-input class="input" name="fullname"/>
                    </div>
                    <div class="form-column">
                        <label for="username">@lang('labels.username')</label>
                        <x-splade-input class="input" name="username" />
                    </div>
                    <div class="form-column">
                        <label for="stars">@lang('labels.stars')</label>
                        <x-splade-input type="number" class="input" name="stars" />
                    </div>
                </div>
                <div class="form-column">
                    <label for="content">@lang('labels.content')</label>
                    <x-splade-textarea class="input" autosize name="content" />
                </div>
                <x-splade-submit id="submit" class="mt-4">
                    @lang('buttons.create')
                </x-splade-submit>
            </x-splade-form>
    </x-admin.content>
</x-admin.layout>

