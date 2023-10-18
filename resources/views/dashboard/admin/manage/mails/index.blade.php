<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('titles.manage') @lang('titles.mails')</div>
        <Link class="add" href="{{route('admin.manage.mails.add')}}">@lang('buttons.create') @lang('titles.mail')</Link>
        <div class="wrapper" style="">
            <x-splade-table :for="$mails">
                @cell('action',$mails)
                <Link href="{{route('admin.manage.mails.remove',['id'=>$mails->id])}}" class="text-red-500"> @lang('buttons.remove') </Link>
                <Link href="{{route('admin.manage.mails.confirm',['id'=>$mails->id])}}" class="text-green-500 ms-2"> @lang('buttons.send') </Link>
                @endcell
            </x-splade-table>
        </div>
    </x-admin.content>
</x-admin.layout>
