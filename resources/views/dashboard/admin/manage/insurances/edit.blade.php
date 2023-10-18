<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('buttons.edit') @lang('titles.insurance')</div>
            <x-splade-form :default="$insurance" action="{{Route('admin.manage.insurances.update',['id' => $id])}}" method="POST" id="form" autocomplete="off">
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
                        <label for="title_ar">@lang('labels.title_ar')</label>
                        <x-splade-input type="text" name="title_ar" value="{{ old('title_ar') }}"/>
                    </div>
                </div>
                <div class="group">
                    <div class="form-row">
                        <label for="frontpage">@lang('messages.disInFront')</label>
                        <x-splade-checkbox name="frontpage" />
                    </div>
                </div>
                <x-splade-submit id="submit" class="mt-4">
                    @lang('buttons.update')
                </x-splade-submit>
            </x-splade-form>
    </x-admin.content>
</x-admin.layout>
