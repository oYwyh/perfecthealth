<x-doctor.layout>
    <x-doctor.content class="bg">
        <div class="title">Add Article</div>
            <x-splade-form action="{{Route('doctor.manage.articles.create')}}" method="POST" id="form" autocomplete="off">
                <div class="group">
                    <x-splade-file filepond name="image" label="Thumbnail" />
                    <x-splade-input type="text" label="Title" name="title" value="{{ old('title') }}"/>
                    <x-splade-input type="text" label="Description" name="description" value="{{ old('description') }}"/>
                </div>
                <div class="group">
                    <x-splade-input name="tags" label="Tags"/>
                    <span class="note text-red-500">Add comma to add another tag</span>
                </div>
                <div class="group">
                    <x-splade-wysiwyg name="content" label="Article Content" />
                </div>
                <x-splade-submit label="Create" id="submit" class="mt-4"/>
            </x-splade-form>
    </x-doctor.content>
</x-doctor.layout>
