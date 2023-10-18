<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('titles.send') @lang('titles.mail')</div>
            <x-splade-form :default="$mail" :action="Route('admin.manage.mails.send_mail',['id' => $mail->id])" method="POST" autocomplete="off">
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
                <div class="form-column">
                    <label for="image">@lang('labels.to')</label>
                    <x-splade-group name="recivers" inline>
                        <div class="form-row">
                            <label for="newsletter">@lang('labels.newsletter') @lang('labels.subscribers')</label>
                            <x-splade-radio name="recivers" value="newsletter"  />
                        </div>
                        <div class="form-row">
                            <label for="admins">@lang('labels.admins')</label>
                            <x-splade-radio name="recivers" value="admins"/>
                        </div>
                        <div class="form-row">
                            <label for="users">@lang('labels.users')</label>
                            <x-splade-radio name="recivers" value="users"/>
                        </div>
                        <div class="form-row">
                            <label for="doctors">@lang('labels.doctors')</label>
                            <x-splade-radio name="recivers" value="doctors"/>
                        </div>
                        <div class="form-row">
                            <label for="receptionists">@lang('labels.receptionists')</label>
                            <x-splade-radio name="recivers" value="receptionists"/>
                        </div>
                    </x-splade-group>
                </div>
                <x-splade-submit id="submit" class="mt-4">
                    @lang('buttons.create')
                </x-splade-submit>
            </x-splade-form>
    </x-admin.content>
</x-admin.layout>
