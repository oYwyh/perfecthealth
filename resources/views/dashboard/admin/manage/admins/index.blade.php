<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('titles.manage') @lang('titles.admins')</div>
        <Link class="add" href="{{route('admin.manage.admins.add')}}">@lang('buttons.add') @lang('titles.admin')</Link>
        <div class="wrapper" style="">
            <x-splade-table :for="$admins">
                @cell('full_control',$admin)
                    <Link href="{{route('admin.manage.admins.control',['id'=>$admin->id])}}" class="text-blue-500">Full Control</Link>
                @endcell
            </x-splade-table>
        </div>
    </x-admin.content>
</x-admin.layout>
