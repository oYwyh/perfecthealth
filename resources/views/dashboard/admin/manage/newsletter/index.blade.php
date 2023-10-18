<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('titles.manage') @lang('titles.newsletter')</div>
        <div class="wrapper" style="">
            <x-splade-table :for="$newsletter">
                @cell('action',$newsletter)
                    <Link href="{{route('admin.manage.newsletter.remove',['id'=>$newsletter->id])}}" method="POST" class="text-red-500">@lang('buttons.remove')</Link>
                @endcell
            </x-splade-table>
        </div>
    </x-admin.content>
</x-admin.layout>
