<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('titles.manage') @lang('titles.users')</div>

        <Link class="add" href="{{route('admin.manage.users.add')}}">@lang('buttons.add') @lang('titles.user') </Link>
        <div class="wrapper" style="">
            <x-splade-table :for="$users">
                {{-- @cell('action',$user)
                    <Link href="{{route('admin.manage.users.edit',['id'=>$user->id])}}" class="text-green-500"> Edit </Link>
                    <Link href="{{route('admin.manage.users.delete',['id'=>$user->id])}}" method="POST" class="text-red-500 ms-2"> Delete </Link>
                @endcell --}}
                @cell('full_control',$user)
                    <Link href="{{route('admin.manage.users.control',['id'=>$user->id])}}" class="text-blue-500">Full Control</Link>
                @endcell
            </x-splade-table>
        </div>
    </x-admin.content>
</x-admin.layout>
